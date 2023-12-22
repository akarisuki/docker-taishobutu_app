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
    <div class="title">職員登録画面</div>
    <div class="form-wrapper">
        <form method="post" action="sign_up_check.php">
            <div class="staff_name">
                <label for="name" class="required">職員名</label>
                <input type="text" placeholder="消防太郎" name="name">
            </div>
            <div class="staff_pass">
                <label for="password" class="required">パスワード</label>
                <input type="password" placeholder="半角整数8文字以上で" name="pass">
            </div>
            <div class="staff_pass_confirm">
                <label for="password_confirm"class="required">パスワード確認</label>
                <input type="password" placeholder="半角整数8文字以上で" name="pass_confirm">
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
            <div class="security_question">
                <label for="security_question" class="required">秘密の質問</label>
                <select name="security_question">
                    <option value="">秘密の質問を選択してください</option>
                    <option value="q1">初めて飼ったペットの名前は何ですか？</option>
                    <option value="q2">母親の旧姓は何ですか？</option>
                    <option value="q3">生まれた都市は何ですか？</option>
                    <!-- 他の質問を追加することも可能です -->
                </select>
                <input type="hidden" id="hidden_question" name="hidden_question">
                <input type="text" name="security_answer" placeholder="あなたの答え">
            </div>
            <div class="sign_up_botton">
                <input type="submit" value="登録">
                <input type="button" onclick="history.back()" value="戻る">
            </div>
        </form>
    </div>
</body>
</html>