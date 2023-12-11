<?php
// config.php
if ($_SERVER['HTTP_HOST'] == 'localhost:50080' || $_SERVER['HTTP_HOST'] == '127.0.0.1') {
  // 開発環境のURL
  define('BASE_URL', 'http://localhost:50080/taishobutu_app/');
} else {
  // 本番環境のURL
  define('BASE_URL', 'http://firedeptyobou119.com/taishobutu_app/');
}

?>