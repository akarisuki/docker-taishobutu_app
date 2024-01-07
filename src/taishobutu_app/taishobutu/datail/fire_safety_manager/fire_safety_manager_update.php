<?php
session_start();
session_regenerate_id(true);
$isLoggedIn = isset($_SESSION['name']);  // 例: $_SESSION['name'] にユーザーIDが保存されている場合をログイン済みとみなす
require_once '../../../common/config.php';
include("../../../common/header.php");
require_once '../../../common/db_operation/db_connect.php';

$code = isset($_POST['code']) ? $_POST['code'] : (isset($_GET['code']) ? $_GET['code'] : (isset($_SESSION['code']) ? $_SESSION['code'] : ''));
$fire_safety_manager_code = $_POST['fire_safety_manager_code'];
$fire_safety_manager_director = $_POST['fire_safety_manager_director'];
$fire_safety_manager_name = $_POST['fire_safety_manager_name'];
$appointment_date = $_POST['appointment_date'];
$fire_plan_date = $_POST['fire_plan_date'];

$sql = "UPDATE fire_safety_manager SET fire_safety_manager_director = :director, fire_safety_manager_name = :fire_safety_manager_name, appointment_date = :appointment_date, fire_plan_date = :fire_plan_date,updated_at = :updated_at WHERE fire_safety_manager_code = :fire_safety_manager_code";
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':fire_safety_manager_code', $fire_safety_manager_code, PDO::PARAM_INT);
$stmt->bindValue(':director', $fire_safety_manager_director, PDO::PARAM_STR);
$stmt->bindValue(':fire_safety_manager_name', $fire_safety_manager_name, PDO::PARAM_STR);
$stmt->bindValue(':appointment_date', $appointment_date, PDO::PARAM_STR);
$stmt->bindValue(':fire_plan_date', $fire_plan_date, PDO::PARAM_STR);
$stmt->bindValue(':updated_at', (new \DateTime())->format('Y-m-d H:i:s'), PDO::PARAM_STR);
$stmt->execute();
$_SESSION['flash'] = [
  'type' => 'success',
  'message' => '更新が完了しました。'
];
var_dump($_SESSION['flash']);

$_SESSION['code'] = $code;
header('Location: fire_safety_manager_datail.php?code=' . urlencode($code));
exit();

?>