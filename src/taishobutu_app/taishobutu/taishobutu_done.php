<?php


try{
    
        

    //ヘッダーを読み込み
    require_once '/home/ubuntu/public_html/taishobutu_app/common/header.php';
    //データベースに接続するファイルを呼び出す。
    require_once '/home/ubuntu/public_html/taishobutu_app/common/db_connect.php';

    $post = $_POST;

    $appendix = (int)$post['appendix'];

    $taishobutu_name = $post['taishobutu_name'];

    $taishobutu_address = $post['taishobutu_address'];

    $taishobutu_tel = $post['taishobutu_tel'];

    $concern_name = $post['concern_name'];

    $concern_tel = $post['concern_tel'];

    $total_area = (double)$post['total_area'];

    $sql = <<<EOD
    INSERT INTO taishobutu_main SET appendix = :appendix ,taishobutu_name = :taishobutu_name,
    taishobutu_address = :taishobutu_address , taishobutu_tel = :taishobutu_tel,
    concern_name = :concern_name ,concern_tel = :concern_tel ,total_area = :total_area;
    EOD;

    $stmt = $db_host->prepare($sql);
    $stmt->bindValue(':appendix', $appendix, PDO::PARAM_INT);
    $stmt->bindValue(':taishobutu_name', $taishobutu_name, PDO::PARAM_STR);
    $stmt->bindValue(':taishobutu_address', $taishobutu_address, PDO::PARAM_STR);
    $stmt->bindValue(':taishobutu_tel', $taishobutu_tel, PDO::PARAM_STR);
    $stmt->bindValue(':concern_name', $concern_name, PDO::PARAM_STR);
    $stmt->bindValue(':concern_tel', $concern_tel, PDO::PARAM_STR);
    $stmt->bindValue(':total_area', $total_area, PDO::PARAM_INT);
    $stmt->execute();

    $db_host = null;
    print '追加しました。';

} catch (PDOException $e){
  print'ただいま障害により大変ご迷惑をおかけしております。';
  exit();
}


?>