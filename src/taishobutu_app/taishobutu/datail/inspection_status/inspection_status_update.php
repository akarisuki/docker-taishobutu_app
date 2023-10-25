<?php
session_start();
session_regenerate_id(true);
$isLoggedIn = isset($_SESSION['name']);  // 例: $_SESSION['name'] にユーザーIDが保存されている場合をログイン済みとみなす
include("/var/www/html/taishobutu_app/common/header.php");
require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';


$code = isset($_POST['code']) ? $_POST['code'] : (isset($_GET['code']) ? $_GET['code'] : (isset($_SESSION['code']) ? $_SESSION['code'] : ''));
$inspection_status_code = $_POST['inspection_status_code'];
$inspection_date = $_POST['inspection_date'];
$inspection_name = $_POST['inspection_name'];
$instructions = $_POST['instructions'];
$remarks	= $_POST['remarks'];

$sql = "UPDATE inspection_status SET inspection_date = :inspection_date, inspection_name = :inspection_name, instructions = :instructions, remarks = :remarks WHERE inspection_status_code = :inspection_status_code";
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':inspection_status_code', $inspection_status_code, PDO::PARAM_INT);
$stmt->bindValue(':inspection_date', $inspection_date, PDO::PARAM_STR);
$stmt->bindValue(':inspection_name', $inspection_name, PDO::PARAM_STR);
$stmt->bindValue(':instructions', $instructions, PDO::PARAM_STR);
$stmt->bindValue(':remarks', $remarks, PDO::PARAM_STR);


$stmt->execute();
$_SESSION['flash'] = [
  'type' => 'success',
  'message' => '更新が完了しました。'
];
var_dump($_SESSION['flash']);
$_SESSION['code'] = $code;
header('Location: http://localhost:50080/taishobutu_app/taishobutu/datail/inspection_status/inspection_status_datail.php?code=' . urlencode($code));
exit();