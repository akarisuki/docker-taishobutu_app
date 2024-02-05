
<header class="fix_menu">
<div class="rogo">
  <p>予防１１９</p>
</div>
<div class="login_text">
  <p>
    <?= $_SESSION['name'] ?>さんログイン中
  </p>
</div>
<input type="checkbox" id="switch">
<label for="switch">
<p><span></span></p>
</label>
<nav id="navwrap">
  <ul class="header_menu">
    <li><a href="<?php echo BASE_URL; ?>taishobutu/taishobutu_add.php" class="button">対象物登録</a></li>
    <li><a href="<?php echo BASE_URL; ?>taishobutu/taishobutu_index.php" class="button">対象物一覧</a></li>
    <li>
      <form action="<?php echo BASE_URL;?>/login/logout.php" method="post">
          <button type="submit" class="button">ログアウト</button>
      </form>
    </li>
    
  </ul>
</nav>
</header>