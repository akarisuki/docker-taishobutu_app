
<header>
  <nav id="navbar" class="d-flex align-items-center">
    <div class="hamburger-menu">
      <div></div>
      <div></div>
      <div></div>
    </div>
    <div class="title">
      <p>予防１１９</p>
    </div>
      
    <div class="buttons d-flex justify-content-center desktop-nav">
      <?php if(isset($_SESSION['login'])):?>
        <a href="<?php echo BASE_URL; ?>taishobutu/taishobutu_add.php" class="button">対象物登録</a> 
        <a href="<?php echo BASE_URL; ?>taishobutu/taishobutu_index.php" class="button">対象物一覧</a>
      <?php endif; ?>
    </div>
    
    <div class="user-info desktop-nav">
      <?php if(isset($_SESSION['login']) === false): ?>
        <p>ログインされていません。<br /><a href="<?php echo BASE_URL;?>/login/login.php">ログイン画面へ</a></p>
      <?php else: ?>
        <p><?= $_SESSION['name'] ?>さんログイン中</p>
        <form action="<?php echo BASE_URL;?>/login/logout.php" method="post">
          <button type="submit" class="button">ログアウト</button>
        </form>
      <?php endif; ?>
    </div>

    
  </nav>
</header>