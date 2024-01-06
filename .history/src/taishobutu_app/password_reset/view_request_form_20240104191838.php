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
        <form method="post" action="request.php">
        <div class="reset-message"><p>メールアドレスを入力してください。リセット用URLをお送りします。</p></div>
        <input type="hidden" name="_csrf_token" value="<?= $_SESSION['_csrf_token']; ?>">
            <div class="mail_address">
                <label for="mail_address" class="required">メールアドレス</label>
                <input type="email"  name="mail_address" value="">
            </div>
            
            <input type="submit" value="パスワードをリセット">
        </form>
    </div>
</body>
</html>