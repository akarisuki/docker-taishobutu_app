<?php session_start();
      session_regenerate_id(true);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0,
          maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../common/header.css">


    <title>防火対象物管理アプリ</title>
</head>
<body>
<?php


try{
    
        

    //ヘッダーを読み込み
    include("/var/www/html/taishobutu_app/common/header.php");
    //データベースに接続するファイルを呼び出す。
    require_once '/var/www/html/taishobutu_app/common/db_connect.php';

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

    $db_host = null;
    print '追加しました。';
    print '<a href="../taishobutu/taishobutu_index.php">対象物一覧に戻る<a>';

} catch (PDOException $e){
  print'ただいま障害により大変ご迷惑をおかけしております。';
  exit();
}


?>