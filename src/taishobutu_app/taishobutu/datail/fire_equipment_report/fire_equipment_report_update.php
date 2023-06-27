<?php
require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';

$fire_equipment_report_code = $_POST['fire_equipment_report_code'];
$report_date = $_POST['report_date'];
$deficiency = $_POST['deficiency'];
$inspector = $_POST['inspector'];
$remarks = $_POST['remarks'];

$sql = "UPDATE fire_equipment_report SET report_date = :report_date, deficiency = :deficiency, inspector = :inspector, remarks = :remarks WHERE fire_equipment_report_code = :fire_equipment_report_code";
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':report_date', $report_date, PDO::PARAM_STR);
$stmt->bindValue(':deficiency', $deficiency, PDO::PARAM_STR);
$stmt->bindValue(':inspector', $inspector, PDO::PARAM_STR);
$stmt->bindValue(':remarks', $remarks, PDO::PARAM_STR);
$stmt->bindValue(':fire_equipment_report_code', $fire_equipment_report_code, PDO::PARAM_INT);

$stmt->execute();
echo '更新しました。';