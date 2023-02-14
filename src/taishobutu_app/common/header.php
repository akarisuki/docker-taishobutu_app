
<header>
  <nav id="navbar">
    
    <a href="../taishobutu/taishobutu_add.php">対象物追加</a> 
    
    <a href="../taishobutu/taishobutu_index.php">対象物一覧</a> 
    <a href="#services">Services</a> 
    <a href="#contact">Contact</a>
    <?php
      
      if(isset($_SESSION['login'])===false){
          print'ログインされていません。<br />';
          print'<a href="../login/login.php">ログイン画面へ</a>';
          exit();
      } else {
          print $_SESSION['name'];
          print 'さんログイン中';
          print '<a href="../login/logout.php">ログアウト</a>';
          print '<br />';
      }
    ?>
    <span id="login-status"></span>
  </nav>
</header>
