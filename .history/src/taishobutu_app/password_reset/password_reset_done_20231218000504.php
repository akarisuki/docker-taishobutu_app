<?php
require_once __DIR__ . '/../common/db_operation/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $staff_name = $_POST['name'];
    $fire_dept_code = $_POST['fire_dept_code'];
    $security_answer = $_POST['security_answer'];
    $new_password = $_POST['new_password'];

    // 秘密の質問の答えを確認
    $sql = 'SELECT security_answer FROM firedept_staff WHERE staff_name = :staff_name AND fire_dept_code = :fire_dept_code';
    $stmt = $db_host->prepare($sql);
    $stmt->bindValue(':staff_name', $staff_name, PDO::PARAM_STR);
    $stmt->bindValue(':fire_dept_code', $fire_dept_code, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['security_answer'] === $security_answer) {
        // 新しいパスワードをハッシュ化
        $hash_pass = password_hash($new_password, PASSWORD_DEFAULT);

        // パスワードを更新
        $sql = 'UPDATE firedept_staff SET staff_pass = :staff_pass WHERE staff_name = :staff_name AND fire_dept_code = :fire_dept_code';
        $stmt = $db_host->prepare($sql);
        $stmt->bindValue(':staff_name', $staff_name, PDO::PARAM_STR);
        $stmt->bindValue(':fire_dept_code', $fire_dept_code, PDO::PARAM_INT);
        $stmt->bindValue(':staff_pass', $hash_pass, PDO::PARAM_STR);
        $stmt->execute();

        echo 'パスワードがリセットされました。';
    } else {
        echo '名前、消防署コード、または秘密の質問の答えが間違っています。';
    }
} else {
    // フォームの表示
}
?>