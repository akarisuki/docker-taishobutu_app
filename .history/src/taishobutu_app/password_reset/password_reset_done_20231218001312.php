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
        <form method="post" action="password_reset_done.php">
            <div class="staff_name">
                <label for="name" class="required">職員名</label>
                <input type="text" placeholder="消防太郎" name="name">
            </div>
            <div class="fire_dept_code">
                <label for="fire_dept_code" class="required">消防署コード</label>
                <select name="fire_dept_code" id="fire_dept_code">
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
                <input type="text" placeholder="秘密の質問の答えを入力" name="security_answer">
            </div>
            <div class="new_password">
                <label for="new_password" class="required">新しいパスワード</label>
                <input type="password" placeholder="半角整数8文字以上で" name="new_password">
            </div>
            <input type="submit" value