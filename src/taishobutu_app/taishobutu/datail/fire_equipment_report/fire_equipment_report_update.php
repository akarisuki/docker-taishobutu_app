<?php
session_start();
session_regenerate_id(true);
$isLoggedIn = isset($_SESSION['name']);  // 例: $_SESSION['name'] にユーザーIDが保存されている場合をログイン済みとみなす
require_once '../../../common/config.php';
include("../../../common/header.php");
require_once '../../../common/db_operation/db_connect.php';
require_once '../../../common/function.php';


$code = isset($_POST['code']) ? $_POST['code'] : (isset($_GET['code']) ? $_GET['code'] : (isset($_SESSION['code']) ? $_SESSION['code'] : ''));
$fire_equipment_report_code = $_POST['fire_equipment_report_code'];
$report_date = $_POST['report_date'];
$deficiency = $_POST['deficiency'];
$inspector = $_POST['inspector'];
$remarks = $_POST['remarks'];

$sql = "UPDATE fire_equipment_report SET report_date = :report_date, deficiency = :deficiency, inspector = :inspector, remarks = :remarks, updated_at = :updated_at WHERE fire_equipment_report_code = :fire_equipment_report_code";
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':fire_equipment_report_code', $fire_equipment_report_code, PDO::PARAM_INT);
$stmt->bindValue(':report_date', $report_date, PDO::PARAM_STR);
$stmt->bindValue(':deficiency', $deficiency, PDO::PARAM_STR);
$stmt->bindValue(':inspector', $inspector, PDO::PARAM_STR);
$stmt->bindValue(':remarks', $remarks, PDO::PARAM_STR);
$stmt->bindValue(':updated_at', (new \DateTime())->format('Y-m-d H:i:s'), PDO::PARAM_STR);
$stmt->execute();

$_SESSION['flash'] = [
  'type' => 'success',
  'message' => '更新が完了しました。'
];
var_dump($_SESSION['flash']);
$_SESSION['code'] = $code;
header('Location: fire_equipment_report_datail.php?code=' . urlencode($code));
exit();