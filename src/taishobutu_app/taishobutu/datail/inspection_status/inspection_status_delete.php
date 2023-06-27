<?php
require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';

$inspection_status_code = $_POST['inspection_status_code'];

$sql = "DELETE FROM inspection_status WHERE inspection_status_code = :code";
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':code', $inspection_status_code, PDO::PARAM_INT);

$stmt->execute();
