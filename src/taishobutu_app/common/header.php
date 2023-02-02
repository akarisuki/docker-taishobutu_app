<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport"
          content="width=device-width,user-scalable, initial-scale=1.0,
          maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"type="text/css" href="../sass/taishobutu.css">


    <title>防火対象物管理アプリ</title>
</head>
<body>
<style>
  nav {
    background-color: #333;
    color: #fff;
  }
  nav a {
    color: #fff;
    text-decoration: none;
    padding: 10px;
  }
  nav a:hover {
    background-color: #444;
  }
</style>
<header>
  <nav id="navbar">
    <a href="../taishobutu/taishobutu_add.php">対象物追加</a> |
    <a href="../taishobutu/taishobutu_index.php">対象物一覧</a> |
    <a href="#services">Services</a> |
    <a href="#contact">Contact</a>
    <?php
      session_start();
      session_regenerate_id(true);
      if(isset($_SESSION['login'])===false){
          print'ログインされていません。<br />';
          print'<a href="../login/login.php">ログイン画面へ</a>';
          exit();
      } else {
          print $_SESSION['name'];
          print 'さんログイン中<br />';
          print '<br />';
      }
    ?>
    <span id="login-status"></span>
  </nav>
</header>
</body>
</html>