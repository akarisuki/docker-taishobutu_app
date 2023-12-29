<?php
session_start();
session_regenerate_id(true);
$isLoggedIn = isset($_SESSION['name']);  // 例: $_SESSION['name'] にユーザーIDが保存されている場合をログイン済みとみなす
require_once '../common/config.php';
include("../common/header.php");
require_once '../common/db_operation/db_connect.php';
include("../common/cookie_user.php");

$fire_dept_code = $_SESSION['fire_dept_code']; 

$sql = "DELETE taishobutu_main, taishobutu_datail,firefighting_equipment_list,fire_equipment_report,fire_fighting_training,fire_safety_manager,inspection_status
        FROM taishobutu_main 
        JOIN taishobutu_datail           ON taishobutu_main.code = taishobutu_datail.code
        JOIN firefighting_equipment_list ON taishobutu_main.code = firefighting_equipment_list.code 
        JOIN fire_equipment_report       ON taishobutu_main.code = fire_equipment_report.code 
        JOIN fire_fighting_training      ON taishobutu_main.code = fire_fighting_training.code 
        JOIN fire_safety_manager         ON taishobutu_main.code = fire_safety_manager.code 
        JOIN inspection_status           ON taishobutu_main.code = inspection_status.code  
        WHERE taishobutu_main.fire_dept_code = :fire_dept_code";
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':fire_dept_code', $fire_dept_code, PDO::PARAM_INT);
$stmt->execute();
var_dump($stmt);
// 削除が成功したら、セッション変数に削除フラグを設定
$_SESSION['flash'] = [
  'type' => 'success',
  'message' => '全削除が完了しました。'
];

$db_host = null;

// 削除後に元のページにリダイレクト
header('Location: taishobutu_index.php');
exit();

?>