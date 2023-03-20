<?php

use PHP_CodeSniffer\Tokenizers\PHP;

require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';


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

    $error_name = [];
    $error_pass = [];

    if ($result['COUNT(*)'] >= 1) {
        $error_name['重複'] = 'この職員名は既に使用されています。';
    }

    if (empty($staff_name)) {
        $error_name['未入力'] = '職員名が入力されていません。';
    }

    if (empty($staff_pass)) {
        $error_pass['未入力'] = 'パスワードが入力されていません。';
    }


    if (!preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,20}+\z/i', $staff_pass)) {
        $error_pass['規則性違反'] = 'パスワードは８文字以上20文字以下に英数字を最低１文字含むようにしてください。';
    }

    $error = array_merge($error_name, $error_pass);

    if (empty($error)) {
        // エラーがなければ自動的にsign_up_done.phpにPOST
        echo '<body onload="document.FRM.submit();" >';
        echo '<form name="FRM" method="POST" action="sign_up_done.php">';
        echo '<input type="hidden" name="name" value="' . htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8') . '">';
        echo '<input type="hidden" name="pass" value="' . htmlspecialchars($staff_pass, ENT_QUOTES, 'UTF-8') . '">';
        echo '</form>';
        echo '</body>';
    } else {

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
        <form method="post" action="sign_up_check.php">
            <label for="name"class="required">職員名</label>
            <input type="text" placeholder="消防太郎" name="name" value="<?php 
                if(isset($staff_name['重複'])) {
                    echo '';
                } else {
                    echo htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8');
                } 
            ?>"><br/>
            <?php if (!empty($error_name)) : ?>
                <ul class="error-message-name">
                    <?php foreach ($error_name as $err_name) : ?>
                        <li><?= $err_name ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <label for="password"class="required">パスワード</label>
            <input type="password" placeholder="半角整数8文字以上で" name="pass" value="<?php
                if(isset($staff_pass['規則性違反'])) {
                    echo '';
                } else {
                    echo htmlspecialchars($staff_pass, ENT_QUOTES, 'UTF-8');
                }
            ?>"><br>
            <?php if (!empty($error_pass)) : ?>
                <ul class="error-message-pass">
                    <?php foreach ($error_pass as $err_pass) : ?>
                        <li><?= $err_pass ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <input type="submit" value="登録" >
            <input type="button" onclick="history.back()" value="戻る">
            
        </form>
    </div>
</body>
</html>
<?php } ?>