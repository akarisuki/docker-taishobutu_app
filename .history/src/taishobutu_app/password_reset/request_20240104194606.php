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
