<?php
require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';

$fire_equipment_report_code = $_POST['fire_equipment_report_code'];

$sql = "DELETE FROM fire_equipment_report WHERE fire_equipment_report_code = :code";
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':code', $fire_equipment_report_code, PDO::PARAM_INT);

$stmt->execute();
echo '削除しました。';