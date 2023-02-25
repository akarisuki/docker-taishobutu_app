<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport"
        content="width=device-width,user-scalable, initial-scale=1.0,
        maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../common/sass/sign_up/sign_up.css">
    <title>防火対象物管理アプリ</title>
</head>
<body>
    
<div class="form-wrapper">
    <form method="post" action="sign_up_check.php">
    <label for="name"class="required">職員名</label>
    <input type="text" placeholder="消防太郎"name="name"><br/>
    <label for="password"class="required">パスワード</label>
    <input type="password" placeholder="半角整数8文字以上で"name="pass">
    
    <br/>
    <input type="submit" value="登録">
    <input type="button" onclick="history.back()"value="戻る">
    </form>
</div>

</body>
</html>