<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport"
          content="width=device-width,user-scalable, initial-scale=1.0,
          maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>防火対象物管理アプリ</title>
</head>
<body>
    <h1>職員登録</h1><br/>
    <br/>

    <form method="post" action="sign_up_check.php">
        職員名を入力してください。
       <input type="text" name="name" style="width:100px"><br/>
       パスワードを入力してください。
       <input type="password" name="pass" style="width:100px"><br/>
       パスワードをもう一度入力してください。
       <input type="password" name="pass2"style="width:100px"><br/>
       <br/>
       <input type="submit" value="OK">
       <input type="button" onclick="history.back()"value="戻る">
    </form>

    
    
    
</body>
</html>