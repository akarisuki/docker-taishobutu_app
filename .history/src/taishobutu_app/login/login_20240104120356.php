<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport"
        content="width=device-width,user-scalable, initial-scale=1.0,
        maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../common/sass/login/login.css">
    <title>防火対象物管理アプリ</title>
</head>
<body>
<?php
    require_once __DIR__ . '/../common/config.php';
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        echo  "<div id='flashMessage' class='alert alert-{$flash['type']}'>{$flash['message']}</div>";
        $_SESSION['flash'] = null;
    }

    $error_name = isset($_GET['職員名エラー']) ? $_GET['職員名エラー'] : null;
    $error_pass = isset($_GET['パスワードエラー']) ? $_GET['パスワードエラー'] : null;
    $error_fire_dept_code = isset($_GET['消防署コードエラー']) ? $_GET['消防署コードエラー'] : null;

    
?>
<div class="title">ログイン画面</div>
    <div class="form-wrapper"> <!-- フォームを囲む要素を追加 -->
        <form method="post" action="login_check.php">
            <div class="staff_name">
                <label for="name"class="required">職員名</label>
                <input type="text" placeholder="消防太郎"name="name">
                <?php if (!empty($error_name)) : ?>
                    <ul class="error-message-name">
                            <li><?= $error_name ?></li>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="staff_pass">
                <label for="password"class="required" >パスワード</label>
                <input type="password" placeholder="半角整数8文字以上で"name="pass">
                <?php if (!empty($error_pass)) : ?>
                    <ul class="error-message-pass">
                            <li><?= $error_pass ?></li>
                    </ul>
                <?php endif; ?>
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
                <?php if (!empty($error_fire_dept_code)) : ?>
                    <ul class="error-fire-dept-code">
                        <li><?= $error_fire_dept_code ?></li>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="link">
                <a class="sign_up" href="<?php echo BASE_URL; ?>sign_up/sign_up.php">登録していない場合はこちら</a><br/>
                <a class="password_reset" href="<?php echo BASE_URL; ?>password_reset/request_form.php">パスワードを忘れてしまった場合はこちら</a>
            </div>
            <div class="rememberme">
                <input type="checkbox" name="rememberme">ログイン情報を保持する。
            </div>
            <input type="submit" value="ログイン">
        </form>
    </div>
    

</body>
</html>