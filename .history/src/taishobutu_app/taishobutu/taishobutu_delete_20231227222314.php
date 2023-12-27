<?php
ob_start();
session_start(); 
session_regenerate_id(true);
$isLoggedIn = isset($_SESSION['name']);  // 例: $_SESSION['name'] にユーザーIDが保存されている場合をログイン済みとみなす
require_once '../common/config.php';
include("../common/header.php");
require_once '../common/db_operation/db_connect.php';
include("../common/cookie_user.php");



if(isset($_POST['delete']) && isset($_POST['codes'])){
      $codes = $_POST['codes'];
      
      //すべてのコードが整数であることを確認
      $all_integers = true;
      foreach($codes as $code) {
            if(!ctype_digit($code)) {
                  $all_integers = false;
                  break;
            }
      }
}

if($all_integers) {
      $placeholders = implode(',',array_fill(0,count($codes), '?'));

      

      $sql = "DELETE taishobutu_main, taishobutu_datail,firefighting_equipment_list,fire_equipment_report,fire_fighting_training,fire_safety_manager,inspection_status
              FROM taishobutu_main 
              JOIN taishobutu_datail           ON taishobutu_main.code = taishobutu_datail.code
              JOIN firefighting_equipment_list ON taishobutu_main.code = firefighting_equipment_list.code 
              JOIN fire_equipment_report       ON taishobutu_main.code = fire_equipment_report.code 
              JOIN fire_fighting_training      ON taishobutu_main.code = fire_fighting_training.code 
              JOIN fire_safety_manager         ON taishobutu_main.code = fire_safety_manager.code 
              JOIN inspection_status           ON taishobutu_main.code = inspection_status.code  
              WHERE taishobutu_main.code IN ($placeholders)";
      $stmt = $db_host->prepare($sql);

      foreach($codes as $index => $code) {
            $stmt->bindValue($index + 1, $code, PDO::PARAM_INT);
      }

      $stmt->execute();

      

      $_SESSION['deleted'] = true;
}

$db_host = null;
$_SESSION['flash'] = [
      'type' => 'success',
      'message' => '削除が完了しました。'
];
// 削除後に元のページにリダイレクト
header('Location: taishobutu_index.php');
exit();


?>
