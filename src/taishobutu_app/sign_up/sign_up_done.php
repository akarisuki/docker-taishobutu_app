<?php
    try{
        
            
            
            //データベースに接続するファイルを呼び出す。
            require_once '/var/www/html/taishobutu_app/common/db_connect.php';

            //登録フォームから入力したデータを$postに格納する
            $post = $_POST;

            $staff_name = $post['name'];
            $staff_pass = $post['pass'];

            //パスワードの暗号化
            $hash_pass = password_hash($staff_pass, PASSWORD_DEFAULT);

            $sql = 'INSERT INTO firedept_staff SET staff_name = :staff_name,staff_pass = :staff_pass';
            $stmt = $db_host->prepare($sql);
            $stmt->bindValue(':staff_name', $staff_name, PDO::PARAM_STR);
            $stmt->bindValue(':staff_pass', $hash_pass, PDO::PARAM_STR);
            $stmt->execute();

            header('Location: ../taishobutu/taishobutu_index.php');
            exit;
            

            /*
            //登録後、即座にログイン処理
            $sql = " SELECT * FROM firedept_staff WHERE staff_name = :staff_name";
            $stmt = $db_host->prepare($sql);
            $stmt->bindValue(':staff_name',$staff_name, PDO::PARAM_STR);
            $stmt->execute();
            $result  =  $stmt->fetch(PDO::FETCH_ASSOC);

            

            if (password_verify($staff_pass, $hash_pass)) {
                //ログイン成功の場合、セッションにログイン情報を格納
                session_start();  
                $_SESSION['login'] = 1;
                $_SESSION['id'] = $result['code'];
                $_SESSION['name'] = $result['staff_name'];
                header('Location: ../taishobutu/taishobutu_index.php');
                exit;
            } else {
                //ログイン失敗の場合、エラーメッセージを表示し、ログイン画面に戻す
                echo "ログインに失敗しました。入力された情報をご確認ください。";
                echo '<a href="login.php">ログイン画面に戻る</a>';
            }
            */
            
        

    } catch (PDOException  $e) {
            print $e->getMessage().'ただいま障害により大変ご迷惑をおかけしております。';
            exit();
    }

        
    
?> 