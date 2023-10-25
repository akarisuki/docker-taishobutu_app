<?php
session_start();
session_regenerate_id(true);
$isLoggedIn = isset($_SESSION['name']);  // 例: $_SESSION['name'] にユーザーIDが保存されている場合をログイン済みとみなす
include("/var/www/html/taishobutu_app/common/header.php");
require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';

$code = isset($_POST['code']) ? $_POST['code'] : (isset($_GET['code']) ? $_GET['code'] : (isset($_SESSION['code']) ? $_SESSION['code'] : ''));
$inspection_status_code = $_POST['inspection_status_code'];

$sql = "DELETE FROM inspection_status WHERE inspection_status_code = :code";
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':code', $inspection_status_code, PDO::PARAM_INT);

$stmt->execute();

$_SESSION['flash'] = [
  'type' => 'success',
  'message' => '削除が完了しました。'
];

var_dump($_SESSION['flash']);
$_SESSION['code'] = $code;
header('Location: http://localhost:50080/taishobutu_app/taishobutu/datail/inspection_status/inspection_status_datail.php?code=' . urlencode($code));
exit();