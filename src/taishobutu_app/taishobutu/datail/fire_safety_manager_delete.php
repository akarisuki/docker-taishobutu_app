<?php
require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';

$fire_safety_manager_code = $_POST['fire_safety_manager_code'];

$sql = "DELETE FROM fire_safety_manager WHERE fire_safety_manager_code = :code";
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':code', $fire_safety_manager_code, PDO::PARAM_INT);

$stmt->execute();
