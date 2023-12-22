<?php

    require_once __DIR__ .  '/../common/config.php';
    require_once __DIR__ . '/../common/db_operation/db_connect.php';

    


    $staff_name = $_POST['staff_name'];
    $fire_dept_code = $_POST['fire_dept_code'];
    $new_password = $_POST['new_password'] ?? '';


    // 新しいパスワードをハッシュ化
    $hash_pass = password_hash($new_password, PASSWORD_DEFAULT);

    // パスワードを更新
    $sql = 'UPDATE firedept_staff SET staff_pass = :staff_pass WHERE staff_name = :staff_name AND fire_dept_code = :fire_dept_code';
    $stmt = $db_host->prepare($sql);
    $stmt->bindValue(':staff_name', $staff_name, PDO::PARAM_STR);
    $stmt->bindValue(':fire_dept_code', $fire_dept_code, PDO::PARAM_INT);
    $stmt->bindValue(':staff_pass', $hash_pass, PDO::PARAM_STR);
    $stmt->execute();
    $message = 'パスワードがリセットされました。';
    header('Location: ' . BASE_URL . 'welcome.php?message=' . urlencode($message));
    exit;
   
    

?>
