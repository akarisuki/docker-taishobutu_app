<?php
session_start();


require_once __DIR__ . '/../common/db_operation/db_connect.php';


// クエリからtokenを取得
$passwordResetToken = filter_input(INPUT_GET, 'token');


$sql = 'SELECT * FROM firedept_staff WHERE mail_address = :mail_address ';
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':mail_address', $mail_address, PDO::PARAM_STR);
$stmt->execute();