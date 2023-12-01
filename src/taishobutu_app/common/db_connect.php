<?php

//PDOにてデータベースに接続
try {
    // 環境変数から接続情報を取得（本番環境用）
    $dbHost = getenv('DB_HOST') ?: 'db'; // 本番環境では環境変数から、それ以外はデフォルト値
    $dbName = getenv('DB_NAME') ?: 'taishobutu';
    $dbUser = getenv('DB_USER') ?: 'user';
    $dbPassword = getenv('DB_PASSWORD') ?: 'pass';

    // DSN（データソース名）の構築
    $dsn = "mysql:dbname={$dbName};host={$dbHost}";

    // PDOでデータベースに接続
    $driver_options = array(PDO::ATTR_PERSISTENT => true);
    $db_host = new PDO($dsn, $dbUser, $dbPassword, $driver_options);
    $db_host->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // データベースへの接続失敗時のエラーメッセージ
    echo 'ただいま接続障害が発生しております。' . $e->getMessage() . '<br/>恐れ入りますが時間を置いてから再度お試しください。';
    exit;
}
//PDOにてデータベースに接続
try {

    $db_name = 'mysql:dbname=taishobutu;host=db';
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