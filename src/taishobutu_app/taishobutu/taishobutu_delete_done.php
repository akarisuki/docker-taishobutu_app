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
    <link rel="stylesheet" href="../common/sass/taishobutu.css">


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

    $code = (int)$post['code'];

    $sql = 'DELETE FROM taishobutu_main WHERE code = :code';

    $stmt = $db_host->prepare($sql);
    $stmt->bindValue(':code', $code, PDO::PARAM_INT);
    $stmt->execute();

    $db_host = null;
    print '削除しました。';

} catch (Exception $e){
  print'ただいま障害により大変ご迷惑をおかけしております。';
  exit();
}

?>

<a href="taishobutu_index.php">戻る</a>