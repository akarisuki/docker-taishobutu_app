<?php

try {

    require_once '/var/www/html/taishobutu_app/common/db_connect.php';


    $post = $_POST;

    $staff_name = $post['name'];
    $staff_pass = $post['pass'];

    
    //ユーザー名の重複
    $sql = 'SELECT COUNT(*) FROM firedept_staff WHERE staff_name = :staff_name';
    $stmt = $db_host->prepare($sql);
    $stmt->bindValue(':staff_name', $staff_name, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $result = array_map('intval', $result);

    $error = [];

    if ($result['COUNT(*)'] >= 1) {
        $error[] = 'この職員名は既に使用されています。';
    }

    if ($staff_name === '') {
        $error[] = '職員名が入力されていません。';
    }

    if ($staff_pass === '') {
        $error[] = 'パスワードが入力されていません。';
    }



    if (!preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,20}+\z/i', $staff_pass)) {
        $error[] = 'パスワードは８文字以上20文字以下に英数字を最低１文字含むようにしてください。';
    }

    

} catch (Exception  $e) {
    $error_message = 'ただいま障害により大変ご迷惑をおかけしております。';
}


?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../common/sass/sign_up/sign_up.css">
    <title>防火対象物管理アプリ</title>
</head>

<body>

    <div class="form-wrapper">
        <form method="post" action="sign_up_done.php">
        <label for="name"class="required">職員名</label>
        <input type="text" placeholder="消防太郎"name="name"><br/>
        <label for="password"class="required">パスワード</label>
        <input type="password" placeholder="半角整数8文字以上で"name="pass">
        
        <br>
        <?php if (!empty($error)) : ?>
            <ul class="error-message">
                <?php foreach ($error as $err) : ?>
                    <li><?= $err ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
        <?php
            $hash_pass = password_hash($staff_pass, PASSWORD_DEFAULT);

            $sql = 'INSERT INTO firedept_staff SET staff_name = :staff_name,staff_pass = :staff_pass';
            $stmt = $db_host->prepare($sql);
            $stmt->bindValue(':staff_name', $staff_name, PDO::PARAM_STR);
            $stmt->bindValue(':staff_pass', $hash_pass, PDO::PARAM_STR);
            $stmt->execute();
            header('Location: ../login/login.php');
            exit();
        
        ?>
        <?php endif; ?>
            <input type="submit" value="登録">
            <input type="button" onclick="history.back()"value="戻る">
        </form>
    </div>
</body>
</html>