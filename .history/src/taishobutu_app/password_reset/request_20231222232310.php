<?php

  require_once __DIR__ .  '/../common/config.php';
  require_once __DIR__ . '/../common/db_operation/db_connect.php';


  $staff_name = $_POST['name'];
  $fire_dept_code = $_POST['fire_dept_code'];
  $input_security_answer = $_POST['input_security_answer'];
  $new_password = $_POST['new_password'] ?? '';

  if (empty($staff_name) || empty($fire_dept_code)) {
    $message = '職員名又は消防署コードが間違っています。';
    header('Location: password_reset.php?message='. urlencode($message));
    exit;
  }


    // 秘密の質問の答えを確認
    $sql = 'SELECT security_answer FROM firedept_staff WHERE staff_name = :staff_name AND fire_dept_code = :fire_dept_code';
    $stmt = $db_host->prepare($sql);
    $stmt->bindValue(':staff_name', $staff_name, PDO::PARAM_STR);
    $stmt->bindValue(':fire_dept_code', $fire_dept_code, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $security_answer = $result['security_answer'];


    $error_security_answer = [];

    $error_new_password = [];

    if (empty($input_security_answer)) {
      $error_security_answer['未入力'] = '秘密の質問の答えが入力されていません。';
    }

    if ($input_security_answer !== $security_answer){
      $error_security_answer['不一致'] = '秘密の質問の答えが間違っています。' ;
    }

    if (empty($new_password)) {
      $error_new_password ['未入力'] = '新しいパスワードが入力されていません。';
    }

    if (!preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,20}+\z/i', $new_password)) {
      $error_new_password ['規則性違反'] = 'パスワードは8文字以上20文字以下に英数字を最低1文字含むようにしてください。';
      
  }

    $error = array_merge($error_security_answer,$error_new_password);

    if (empty($error)) {
      // エラーがなければ自動的にsign_up_done.phpにPOST
      echo '<body onload="document.FRM.submit();" >';
      echo '<form name="FRM" method="POST" action="password_reset_done.php">';
      echo '<input type="hidden" name="staff_name" value="' . htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8') . '">';
      echo '<input type="hidden" name="fire_dept_code" value="' . $fire_dept_code . '">';
      echo '<input type="hidden" name="new_password" value="' . htmlspecialchars($new_password, ENT_QUOTES, 'UTF-8') . '">';
      echo '</body>';
  } else {
        

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../common/sass/password_reset/password_reset.css">
    <title>防火対象物管理アプリ</title>
</head>
<body>
    <div class="title">パスワードリセット</div>
    <div class="form-wrapper">
      <?php var_dump($input_security_answer);?>
        <form method="post" action="password_reset_check.php">
            <div class="staff_name">
                <label for="name" class="required">職員名</label>
                <input type="text" placeholder="消防太郎" name="name"value="<?php echo $staff_name; ?>">
            </div>
            <div class="fire_dept_code">
                <label for="fire_dept_code" class="required">消防署コード</label>
                <select name="fire_dept_code" id="fire_dept_code" value="<?php echo $fire_dept_code; ?>">
                    <option value=0 selected>選択してください</option>
                    <option value=1>A消防署</option>
                    <option value=2>B消防署</option>
                    <option value=3>C消防署</option>
                    <option value=4>D消防署</option>
                    <option value=5>E消防署</option>
                    <option value=6>F消防署</option>
                </select>
            </div>
            <div class="security_answer">
                <label for="security_answer" class="required">秘密の質問の答え</label>
                <input type="text" placeholder="秘密の質問の答えを入力" name="input_security_answer">
                <?php if (!empty($error_security_answer)) : ?>
                    <ul class="error-security-answer">
                        <?php foreach ($error_security_answer as $output_pass_confirm) : ?>
                            <li><?= $output_pass_confirm ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="new_password">
                <label for="new_password" class="required">新しいパスワード</label>
                <input type="password" placeholder="半角整数8文字以上で" name="new_password">
                <?php if (!empty($error_new_password)) : ?>
                    <ul class="error-new-password">
                        <?php foreach ($error_new_password as $output_new_password) : ?>
                            <li><?= $output_new_password ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <input type="submit" value="パスワードをリセット">
         </form>
      </div>
</body>
</html>
<?php
}
?>