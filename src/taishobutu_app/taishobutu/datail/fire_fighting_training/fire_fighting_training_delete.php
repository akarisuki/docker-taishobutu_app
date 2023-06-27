<?php
require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';

$fire_fighting_training_code = $_POST['fire_fighting_training'];

$sql = "DELETE FROM fire_fighting_training WHERE fire_fighting_training_code = :code";
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':code', $fire_fighting_training_code, PDO::PARAM_INT);

$stmt->execute();
