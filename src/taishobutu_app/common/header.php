
<header>
  <nav id="navber" class="d-flex align-items-center">
    <div class="title">
      <p>予防１１９</p>
    </div>
      
    <div class="buttons d-flex justify-content-center">
      <?php if(isset($_SESSION['login'])):?>
        <a href="http://localhost:50080/taishobutu_app/taishobutu/taishobutu_add.php" class="button">対象物登録</a> 
        <a href="http://localhost:50080/taishobutu_app/taishobutu/taishobutu_index.php" class="button">対象物一覧</a> 
      <?php endif; ?>
    </div>
    
    <div class="user-info">
      <?php if(isset($_SESSION['login']) === false): ?>
        <p>ログインされていません。<br /><a href="../login/login.php">ログイン画面へ</a></p>
        <?php 
          $dbHost = getenv('DB_HOST');
          $dbUser = getenv('DB_USER');
          $dbPassword = getenv('DB_PASSWORD');
          $dbName = getenv('DB_NAME');
          
        ?>
      <?php else: ?>
        <p><?= $_SESSION['name'] ?>さんログイン中</p>
        <form action="../login/logout.php" method="post">
          <button type="submit" class="button">ログアウト</button>
        </form>
      <?php endif; ?>
    </div>
  </nav>
</header>