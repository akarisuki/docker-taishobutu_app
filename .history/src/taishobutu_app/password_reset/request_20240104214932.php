<?php

session_start();

$csrfToken = filter_input(INPUT_POST, '_csrf_token');

// csrf tokenを検証
if (
  empty($csrfToken)
  || empty($_SESSION['_csrf_token'])
  || $csrfToken !== $_SESSION['_csrf_token']
) {
  exit('不正なリクエストです');
}


// 本来はここでemailのバリデーションもかける
$mail_address = filter_input(INPUT_POST, 'mail_address');

require_once __DIR__ . '/../common/db_operation/db_connect.php';

$sql = 'SELECT * FROM firedept_staff WHERE mail_address = :mail_address ';
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':mail_address', $mail_address, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_OBJ);
if (!$result) {
  require_once 'views_email_sent.php';
  exit();
}

// 既にパスワードリセットのフロー中（もしくは有効期限切れ）かどうかを確認
// $passwordResetUserが取れればフロー中、取れなければ新規のリクエストということ

$sql = 'SELECT * FROM password_reset WHERE mail_address = :mail_address';
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':mail_address', $mail_address, PDO::PARAM_STR);
$stmt->execute();
$passwordResetFiredeptstaff = $stmt->fetch(PDO::FETCH_OBJ); 

if (!$passwordResetFiredeptstaff) {
  // $passwordResetUserがいなければ、仮登録としてテーブルにインサート
  $sql = 'INSERT INTO `password_reset`(`mail_address`, `token`, `token_sent_at`) VALUES(:mail_address, :token, :token_sent_at)';
} else {
  $sql = 'UPDATE `password_reset` SET `token` = :token, `token_sent_at` = :token_sent_at WHERE `mail_address` = :mail_address';
}

// password reset token生成
$passwordResetToken = bin2hex(random_bytes(32));

// password_resetsテーブルへの変更とメール送信は原子性を保ちたいため、トランザクションを設置する
// メール送信に失敗した場合は、パスワードリセット処理自体も失敗させる
try {
  $db_host->beginTransaction();
  $stmt = $db_host->prepare($sql);
  $stmt->bindValue(':mail_address',$mail_address, PDO::PARAM_STR);
  $stmt->bindValue(':token',$passwordResetFiredeptstaff, PDO::PARAM_STR);
  $stmt->bindValue(':token_sent_at', (new \DateTime())->format('Y-m-d H:i:s'), \PDO::PARAM_STR);
  $stmt->execute();

  // 以下、mail関数でパスワードリセット用メールを送信
  mb_language("Japanese");
  mb_internal_encoding("UTF-8");

    $url = "http://localhost:50080/show_reset_form.php?token={$passwordResetToken}";

    $subject =  'パスワードリセット用URLをお送りします';

    $body = <<<EOD
        24時間以内に下記URLへアクセスし、パスワードの変更を完了してください。
        {$url}
        EOD;

    // Fromはご自身の環境に合わせてください
    $headers = "From : firedept119.com\n";
    // text/htmlを指定し、html形式で送ることも可能
    $headers .= "Content-Type : text/plain";

    // mb_send_mailは成功したらtrue、失敗したらfalseを返す
    $isSent = mb_send_mail($mail_address, $subject, $body, $headers);

    if (!$isSent) throw new \Exception('メール送信に失敗しました。');

    // メール送信まで成功したら、password_resetsテーブルへの変更を確定
    $db_host->commit();

} catch (\Exception $e) {
  $db_host->rollBack();
  var_dump($isSent);
  exit($e->getMessage());
}

?>
