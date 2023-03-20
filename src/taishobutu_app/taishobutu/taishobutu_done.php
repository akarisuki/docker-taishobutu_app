<?php 
error_reporting(0);

ob_start(); 
session_start();
session_regenerate_id(true);

// 出力バッファリングを開始


try{
    
        
    //データベースに接続するファイルを呼び出す。
    require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';

    $post = $_POST;

    $appendix = (int)$post['appendix'];

    $taishobutu_name = $post['taishobutu_name'];

    $taishobutu_address = $post['taishobutu_address'];

    $taishobutu_tel = $post['taishobutu_tel'];

    $owners_name = $post['owners_name'];

    $owners_tel = $post['owners_tel'];

    $total_area = (int)$post['total_area'];

    $sql = <<<EOD
    INSERT INTO taishobutu_main SET appendix = :appendix ,taishobutu_name = :taishobutu_name,
    taishobutu_address = :taishobutu_address , taishobutu_tel = :taishobutu_tel,
    owners_name = :owners_name ,owners_tel = :owners_tel ,total_area = :total_area;
    EOD;

    $stmt = $db_host->prepare($sql);
    $stmt->bindValue(':appendix', $appendix, PDO::PARAM_INT);
    $stmt->bindValue(':taishobutu_name', $taishobutu_name, PDO::PARAM_STR);
    $stmt->bindValue(':taishobutu_address', $taishobutu_address, PDO::PARAM_STR);
    $stmt->bindValue(':taishobutu_tel', $taishobutu_tel, PDO::PARAM_STR);
    $stmt->bindValue(':owners_name', $owners_name, PDO::PARAM_STR);
    $stmt->bindValue(':owners_tel', $owners_tel, PDO::PARAM_STR);
    $stmt->bindValue(':total_area', $total_area, PDO::PARAM_INT);
    $stmt->execute();
    // 出力バッファをクリアしてバッファリングを終了
    $redirectUrl = '../taishobutu/taishobutu_index.php';
    echo '<script>window.location.href = "' . $redirectUrl . '";</script>';
    
    exit;

} catch (PDOException $e){
  print'ただいま障害により大変ご迷惑をおかけしております。';
  exit();
}


?>