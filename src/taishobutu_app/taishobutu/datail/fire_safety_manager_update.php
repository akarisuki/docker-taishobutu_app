<?php
require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';

$fire_safety_manager_code = $_POST['fire_safety_manager_code'];
$fire_safety_manager_director = $_POST['fire_safety_manager_director'];
$fire_safety_manager_name = $_POST['fire_safety_manager_name'];
$appointment_date = $_POST['appointment_date'];
$fire_plan_date = $_POST['fire_plan_date'];

$sql = "UPDATE fire_safety_manager SET fire_safety_manager_director = :director, fire_safety_manager_name = :name, appointment_date = :appointment_date, fire_plan_date = :fire_plan_date WHERE fire_safety_manager_code = :code";
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':code', $fire_safety_manager_code, PDO::PARAM_INT);
$stmt->bindValue(':director', $fire_safety_manager_director, PDO::PARAM_STR);
$stmt->bindValue(':name', $fire_safety_manager_name, PDO::PARAM_STR);
$stmt->bindValue(':appointment_date', $appointment_date, PDO::PARAM_STR);
$stmt->bindValue(':fire_plan_date', $fire_plan_date, PDO::PARAM_STR);

$stmt->execute();
