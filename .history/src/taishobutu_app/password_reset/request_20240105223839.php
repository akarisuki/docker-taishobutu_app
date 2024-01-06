<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Composer のオートローダーの読み込み（ファイルの位置によりパスを適宜変更）
require '../../vendor/autoload.php';
//エラーメッセージ用日本語言語ファイルを読み込む場合（25行目の指定も必要）
require 'vendor/phpmailer/phpmailer/language/phpmailer.lang-ja.php';

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
//try {
  $db_host->beginTransaction();
  $stmt = $db_host->prepare($sql);
  $stmt->bindValue(':mail_address',$mail_address, PDO::PARAM_STR);
  $stmt->bindValue(':token',$passwordResetFiredeptstaff, PDO::PARAM_STR);
  $stmt->bindValue(':token_sent_at', (new \DateTime())->format('Y-m-d H:i:s'), \PDO::PARAM_STR);
  $stmt->execute();

 
  mb_language("Japanese");
  mb_internal_encoding("UTF-8");

  // インスタンスを生成（引数に true を指定して例外 Exception を有効に）
  $mail = new PHPMailer(true);  

  var_dump($mail);
    

    // メール送信まで成功したら、password_resetsテーブルへの変更を確定
//     $db_host->commit();

// } catch (\Exception $e) {
//   $db_host->rollBack();
//   var_dump($isSent);
//   exit($e->getMessage());
// }

?>
