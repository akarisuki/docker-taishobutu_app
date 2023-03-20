<?php
error_reporting(0);
session_start();
    try{
        
        //require_once '/home/ubuntu/public_html/taishobutu_app/common/sanitize.php';
        require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';

        $post = $_POST;

        $staff_name = $post['name'];
        $staff_pass = $post['pass'];

        

        
        if (empty($staff_name)) {
            $error_name = '職員名が入力されていません。';
        }

        if (empty($staff_pass)) {
            $error_pass = 'パスワードが入力されていません。';
        }

        

        $hash_pass = password_hash($staff_pass,PASSWORD_DEFAULT);

        $sql = 'SELECT * FROM firedept_staff WHERE staff_name = :staff_name';
        $stmt = $db_host->prepare($sql);
        $stmt->bindValue(':staff_name', $staff_name,PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($result) && password_verify($staff_pass, $result['staff_pass'])) {
            $_SESSION['login'] = 1;
            $_SESSION['id'] = $result['code'];
            $_SESSION['name'] = $result['staff_name'];
            header('Location: ../taishobutu/taishobutu_index.php');
            exit();
        } else {
            $error_name_pass = 'ユーザー名、またはパスワードが違います。';
        }
    } catch (Exception $e) {
        $error_message = 'ただいま障害により大変ご迷惑をおかけしております。';

    }


?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../common/sass/login/login.css">
    <title>防火対象物管理アプリ</title>
</head>

<body>
    <div class="form-wrapper">
        <form method="post" action="login_check.php">
            <label for="name" class="required">職員名</label>
            <input type="text" placeholder="消防太郎" name="name"><br />
            <?php if (!empty($error_name)) : ?>
                <ul class="error-message-name">
                        <li><?= $error_name ?></li>
                </ul>
            <?php endif; ?>
            <label for="password" class="required">パスワード</label>
            <input type="password" placeholder="半角整数8文字以上で" name="pass"><br /><br/><br/><br/>
            <?php if (!empty($error_pass)) : ?>
                <ul class="error-message-pass">
                        <li><?= $error_pass ?></li>
                </ul>
            <?php endif; ?>
                <a href="./password_reset.php">パスワードを忘れた場合</a><br>
                <a href="../sign_up/sign_up.php">登録していない場合はこちら</a><br />
            <div class="rememberme">
                <input type="checkbox" name="rememberme">ログイン情報を保持する。
            </div>
            <?php if (!empty($error_name_pass)) : ?>
                <ul class="error-message-name-pass">
                        <li><?= $error_name_pass ?></li>
                </ul>
            <?php endif; ?>
            <input type="submit" value="ログイン">
        </form>
    </div>
</body>

</html>



