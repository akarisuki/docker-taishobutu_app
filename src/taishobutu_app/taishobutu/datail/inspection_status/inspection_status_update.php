<?php
require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';

$inspection_status_code = $_POST['inspection_status_code'];
$inspection_date = $_POST['inspection_date'];
$inspector_name = $_POST['inspector_name'];
$instructions = $_POST['instructions'];
$remarks	= $_POST['remarks'];

$sql = "UPDATE inspection_status SET inspection_date = :inspection_date, inspector_name = :inspector_name, instructions = :instructions, remarks = :remarks WHERE inspection_status_code = :inspection_status_code";
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':inspection_status_code', $inspection_status_code, PDO::PARAM_INT);
$stmt->bindValue(':inspection_date', $inspection_date, PDO::PARAM_STR);
$stmt->bindValue(':inspector_name', $inspector_name, PDO::PARAM_STR);
$stmt->bindValue(':instructions', $instructions, PDO::PARAM_STR);
$stmt->bindValue(':remarks', $remarks, PDO::PARAM_STR);

$stmt->execute();
