<?php
session_start();

require_once __DIR__ .  '/../common/config.php';

$request = filter_input_array(INPUT_POST);


// csrf tokenが正しければOK
if (
  empty($request['_csrf_token'])
  || empty($_SESSION['_csrf_token'])
  || $request['_csrf_token'] !== $_SESSION['_csrf_token']
) {
  exit('不正なリクエストです');
}

// 本来はここでパスワードのバリデーションをする
$error = [];
if (empty($request['staff_pass']) || empty($request['staff_pass_confirm'])) {
    $error ['未入力'] = 'パスワードが入力されていません。';
}

if (!preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,20}+\z/i', $request['staff_pass'])
      ||  !preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,20}+\z/i', $request['staff_pass_confirm'])) {
  $error['規則性違反'] = 'パスワードは８文字以上20文字以下に英数字を最低１文字含むようにしてください。';
}

if ($request['staff_pass'] !== $request['staff_pass_confirm']){
  $error['不一致'] = 'パスワードとパスワード確認が一致しません。';
}

if(!empty($error)){
  
}

// // pdoオブジェクトを取得
// require_once __DIR__ . '/../common/db_operation/db_connect.php';

// // tokenに合致するユーザーを取得
// $sql = 'SELECT * FROM `password_reset` WHERE `token` = :token';
// $stmt = $db_host->prepare($sql);
// $stmt->bindValue(':token', $request['password_reset_token'], \PDO::PARAM_STR);
// $stmt->execute();
// $passwordResetuser = $stmt->fetch(\PDO::FETCH_OBJ);

// // どのレコードにも合致しない無効なtokenであれば、処理を中断
// if (!$passwordResetuser) exit('無効なURLです');



// // テーブルに保存するパスワードをハッシュ化
// $hashedPassword = password_hash($request['staff_pass'], PASSWORD_BCRYPT);

// // usersテーブルとpassword_resetsテーブルの原子性を原始性を保証するため、トランザクションを設置
// try {
//   $db_host->beginTransaction();

//   // 該当ユーザーのパスワードを更新
//   $sql = 'UPDATE `firedept_staff` SET `staff_pass` = :staff_pass WHERE `mail_address` = :mail_address';
//   $stmt = $db_host->prepare($sql);
//   $stmt->bindValue(':staff_pass', $hashedPassword, \PDO::PARAM_STR);
//   $stmt->bindValue(':mail_address', $passwordResetuser->mail_address, \PDO::PARAM_STR);
//   $stmt->execute();

//   // 用が済んだので、パスワードリセットテーブルから削除
//   $sql = 'DELETE FROM `password_reset` WHERE `mail_address` = :mail_address';
//   $stmt = $db_host->prepare($sql);
//   $stmt->bindValue(':mail_address', $passwordResetuser->mail_address, \PDO::PARAM_STR);
//   $stmt->execute();

//   $db_host->commit();


//   $message = 'パスワードがリセットされました。';
//     header('Location: ' . BASE_URL . 'welcome.php?message=' . urlencode($message));
//     exit;


// } catch (\Exception $e) {
//    $db_host->rollBack();

//    exit($e->getMessage());
// }
