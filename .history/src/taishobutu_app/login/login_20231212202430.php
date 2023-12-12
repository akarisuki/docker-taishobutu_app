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
?>
<div class="title">ログイン画面</div>
    <div class="form-wrapper"> <!-- フォームを囲む要素を追加 -->
        <form method="post" action="login_check.php">
            <div class="staff_name">
                <label for="name"class="required">職員名</label>
                <input type="text" placeholder="消防太郎"name="name">
            </div>
            <div class="staff_pass">
                <label for="password"class="required" >パスワード</label>
                <input type="password" placeholder="半角整数8文字以上で"name="pass">
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
            <div class="link">
                <a class="sign_up" href="<?php echo BASE_URL; ?>sign_up/sign_up.php">登録していない場合はこちら</a>
            </div>
            <div class="rememberme">
                <input type="checkbox" name="rememberme">ログイン情報を保持する。
            </div>
            <input type="submit" value="ログイン">
        </form>
    </div>
    

</body>
</html>