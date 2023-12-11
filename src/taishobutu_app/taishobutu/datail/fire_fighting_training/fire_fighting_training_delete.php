<?php
session_start();
session_regenerate_id(true);
$isLoggedIn = isset($_SESSION['name']);  // 例: $_SESSION['name'] にユーザーIDが保存されている場合をログイン済みとみなす
require_once '../../../common/config.php';
include("../../../common/header.php");
require_once '../../../common/db_operation/db_connect.php';

$code = isset($_POST['code']) ? $_POST['code'] : (isset($_GET['code']) ? $_GET['code'] : (isset($_SESSION['code']) ? $_SESSION['code'] : ''));
$fire_fighting_training_code = $_POST['fire_fighting_training_code'];

$sql = "DELETE FROM fire_fighting_training WHERE fire_fighting_training_code = :code";
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':code', $fire_fighting_training_code, PDO::PARAM_INT);

$stmt->execute();

$_SESSION['flash'] = [
  'type' => 'success',
  'message' => '削除が完了しました。'
];

var_dump($_SESSION['flash']);
$_SESSION['code'] = $code;
header('Location: fire_fighting_training_datail.php?code=' . urlencode($code));
exit();