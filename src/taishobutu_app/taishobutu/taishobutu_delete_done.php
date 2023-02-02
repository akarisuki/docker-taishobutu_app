<?php


try{
    
        

    //ヘッダーを読み込み
    require_once '/home/ubuntu/public_html/taishobutu_app/common/header.php';
    //データベースに接続するファイルを呼び出す。
    require_once '/home/ubuntu/public_html/taishobutu_app/common/db_connect.php';

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