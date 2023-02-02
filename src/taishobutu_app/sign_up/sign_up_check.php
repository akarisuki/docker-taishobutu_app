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


    <?php
        ini_set('display_errors', 1);

        require_once '/home/ubuntu/public_html/taishobutu_app/common/db_connect.php';

        

        //登録フォームから入力したデータを$postに格納する
        //$post をエスケープする
        //$post = sanitize($_POST);
        //項目別に格納する。
        $post = $_POST;
        
        $staff_name = $post['name'];
        $staff_pass = $post['pass'];
        $staff_pass2 = $post['pass2'];

        

        //バリデーションする。
        // $a === '' シングルクォーテーションのみは空を意味する。

        //ユーザー名の重複
        $sql = 'SELECT COUNT(*) FROM firedept_staff WHERE staff_name = :staff_name';
        $stmt = $db_host->prepare($sql);
        $stmt->bindValue(':staff_name',$staff_name,PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $result = array_map('intval',$result);

        

        $error = [];
        
        if($result['COUNT(*)'] >= 1){
            $error[] = 'この職員名は既に使用されています。';
        } 
        
        if($staff_name === ''){
            $error[] =  '職員名が入力されていません。';
        } 

        if($staff_pass === ''){
            $error[] =  'パスワードが入力されていません。';
        } 

        if($staff_pass !== $staff_pass2){
            $error[] =  'パスワードが一致しません。';
        }

        if(!preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,20}+\z/i',$staff_pass)){
            $error[] = 'パスワードは８文字以上20文字以下に英数字を最低１文字含むようにしてください。';
        } 

        
        
        if(count($error) > 0){
            foreach($error as $value){
                print '・'.$value . '<br>';
            }
            print '<form>';
            print '<input type="button" onclick="history.back()" value="戻る">';
            print '<form>';
        } else {

            print '職員名:';
            print $staff_name;
            print '<form method="post" action="sign_up_done.php">';
            print'<input type="hidden" name="name" value="'.$staff_name.'">';
            print'<input type="hidden" name="pass" value="'.$staff_pass.'">';
            print'登録してもよろしいですか？';
            print'<input type="submit" value="OK">';
            print'<input type="button" onclick="history.back()"value="戻る">';
            print'</form>';
        }

        
       
       
    
    ?> 



</body>
</html>