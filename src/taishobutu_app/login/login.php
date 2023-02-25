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
    
<div class="form-wrapper"> <!-- フォームを囲む要素を追加 -->
    <form method="post" action="login_check.php">
        <label for="name"class="required">職員名</label>
        <input type="text" placeholder="消防太郎"name="name"><br/>
        <label for="password"class="required" >パスワード</label>
        <input type="password" placeholder="半角整数8文字以上で"name="pass"><br/>
        <div class="link">
            <a href="./password_reset.php">パスワードを忘れた場合</a><br>
            <a href="../sign_up/sign_up.php">登録していない場合はこちら</a><br>
        </div>
        <div class="rememberme">
            <input type="checkbox" name="rememberme">ログイン情報を保持する。
        </div>
        <input type="submit" value="ログイン">
    </form>
</div>
    

</body>
</html>