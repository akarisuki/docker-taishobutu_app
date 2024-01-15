<?php
session_start();

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

// pdoオブジェクトを取得
require_once __DIR__ . '/../common/db_operation/db_connect.php';

// tokenに合致するユーザーを取得
$sql = 'SELECT * FROM `password_reset` WHERE `token` = :token';
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':token', $request['password_reset_token'], \PDO::PARAM_STR);
$stmt->execute();
$passwordResetuser = $stmt->fetch(\PDO::FETCH_OBJ);

// どのレコードにも合致しない無効なtokenであれば、処理を中断
if (!$passwordResetuser) exit('無効なURLです');



// テーブルに保存するパスワードをハッシュ化
// $hashedPassword = password_hash($request['staff_pass'], PASSWORD_BCRYPT);

// var_dump($hashedPassword);