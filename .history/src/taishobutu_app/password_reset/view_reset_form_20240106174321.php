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
        <form action="reset.php" method="POST">
            <input type="hidden" name="_csrf_token" value="<?= $_SESSION['_csrf_token']; ?>">
            <input type="hidden" name="password_reset_token" value="<?= $passwordResetToken ?>">

            <label>
                新しいパスワード
                <input type="password" name="password">
            </label>
            <br>
            <label>
                パスワード（確認用）
                <input type="password" name="password_confirmation">
            </label>
            <br>
            
            <button type="submit">送信する</button>
        </form>
    </div>
</body>
</html>