<?php

//PDOにてデータベースに接続
try {

    //$db_name = 'mysql:dbname=taishobutu;host=db';
    //$db_name = 'mysql:dbname=taishobutu;host=localhost';
    $user = 'user';
    $password = 'pass';
    $driver_options = array(PDO::ATTR_PERSISTENT => true);
    $db_host = new PDO($db_name,$user,$password,$driver_options);
    $db_host->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    

} catch (PDOException $e) {
//データベースへのアクセスが失敗した場合はエラーメッセージを表示
    echo 'ただいま接続障害が発生しております。'.$e->getMessage() . '<br/>恐れ入りますが時間を置いてから再度お試しください。';
    exit;

}



?>