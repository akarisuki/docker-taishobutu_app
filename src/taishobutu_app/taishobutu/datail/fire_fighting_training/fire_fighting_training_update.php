<?php
require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';

$fire_fighting_training_code = $_POST['fire_fighting_training__code'];
$implementation_date = $_POST['implementation_date'];
$training_content = $_POST['training_content'];
$participation_of_fire_depts = $_POST['participation_of_fire_depts'];
$remarks = $_POST['remarks'];

$sql = "UPDATE fire_fighting_training SET implementation_date = implementation_date, training_content = :training_content, participation_of_fire_depts = :participation_of_fire_depts, remarks = :remarks WHERE fire_fighting_training_code = :fire_fighting_training";
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':fire_fighting_training', $fire_fighting_training_code, PDO::PARAM_INT);
$stmt->bindValue(':irectoimplementation_dater', $implementation_date, PDO::PARAM_STR);
$stmt->bindValue(':training_content', $training_content, PDO::PARAM_STR);
$stmt->bindValue(':participation_of_fire_depts', $participation_of_fire_depts, PDO::PARAM_STR);
$stmt->bindValue(':remarks', $remarks, PDO::PARAM_STR);

$stmt->execute();
