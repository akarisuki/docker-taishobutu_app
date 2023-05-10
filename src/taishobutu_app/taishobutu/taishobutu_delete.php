<?php
session_start(); 

require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';

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

      $sql = "DELETE FROM taishobutu_main WHERE code IN ($placeholders)";
      $stmt = $db_host->prepare($sql);

      foreach($codes as $index => $code) {
            $stmt->bindValue($index + 1, $code, PDO::PARAM_INT);
      }

      $stmt->execute();

      $_SESSION['deleted'] = true;
}

$db_host = null;

// 削除後に元のページにリダイレクト
header('Location: taishobutu_index.php');
exit();

?>
