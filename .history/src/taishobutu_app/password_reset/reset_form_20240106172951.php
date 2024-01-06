<?php
session_start();


require_once __DIR__ . '/../common/db_operation/db_connect.php';


// クエリからtokenを取得
$passwordResetToken = filter_input(INPUT_GET, 'token');

// tokenに合致するユーザーを取得
$sql = 'SELECT * FROM password_reset WHERE token = :token';
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':token', $passwordResetToken, PDO::PARAM_STR);
$stmt->execute();
$passwordResetuser = $stmt->fetch(PDO::FETCH_OBJ);

// 合致するユーザーがいなければ無効なトークンなので、処理を中断
if (!$passwordResetuser) exit('無効なURLです');

// 今回はtokenの有効期間を24時間とする
$tokenValidPeriod = (new \DateTime())->modify("-24 hour")->format('Y-m-d H:i:s');

var_dump($tokenValidPeriod);