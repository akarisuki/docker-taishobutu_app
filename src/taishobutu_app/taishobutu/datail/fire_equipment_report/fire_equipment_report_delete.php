<?php
session_start();
session_regenerate_id(true);
require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';

$code = isset($_POST['code']) ? $_POST['code'] : (isset($_GET['code']) ? $_GET['code'] : (isset($_SESSION['code']) ? $_SESSION['code'] : ''));
$fire_equipment_report_code = $_POST['fire_equipment_report_code'];

$sql = "DELETE FROM fire_equipment_report WHERE fire_equipment_report_code = :code";
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':code', $fire_equipment_report_code, PDO::PARAM_INT);

$stmt->execute();
$_SESSION['flash'] = [
  'type' => 'success',
  'message' => '削除が完了しました。'
];

var_dump($_SESSION['flash']);
$_SESSION['code'] = $code;
header('Location: http://localhost:50080/taishobutu_app/taishobutu/datail/fire_equipment_report/fire_equipment_report_datail.php?code=' . urlencode($code));
exit();