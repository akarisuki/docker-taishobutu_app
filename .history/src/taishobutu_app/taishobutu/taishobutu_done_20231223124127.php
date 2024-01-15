<?php 
error_reporting(0);

ob_start(); 
session_start();
session_regenerate_id(true);
$isLoggedIn = isset($_SESSION['name']);  // 例: $_SESSION['name'] にユーザーIDが保存されている場合をログイン済みとみなす



try{
    require_once '../common/config.php';
    include("../common/header.php");
    //データベースに接続するファイルを呼び出す。
    require_once '../common/db_operation/db_connect.php';
    include("../common/cookie_user.php");

    $post = $_POST;

    $fire_dept_code = (int)$_SESSION['fire_dept_code'];

    $appendix = (int)$post['appendix'];

    $taishobutu_name = $post['taishobutu_name'];

    $taishobutu_address = $post['taishobutu_address'];

    $taishobutu_tel = $post['taishobutu_tel'];

    $owners_name = $post['owners_name'];

    $owners_tel = $post['owners_tel'];

    $raw_total_area = $post['total_area'];
    $total_area = round((float)$raw_total_area, 2);
    $display_total_area = '';

    if (intval($total_area) === $total_area) {
        $display_total_area = intval($total_area);
    } else {
        $display_total_area = number_format($total_area, 2, '.', '');
    }


    $sql = <<<EOD
    INSERT INTO taishobutu_main SET  fire_dept_code = :fire_dept_code,
    appendix = :appendix ,taishobutu_name = :taishobutu_name,
    taishobutu_address = :taishobutu_address , taishobutu_tel = :taishobutu_tel,
    owners_name = :owners_name ,owners_tel = :owners_tel ,total_area = :total_area;
    EOD;

    $stmt = $db_host->prepare($sql);
    $stmt->bindValue(':fire_dept_code',$fire_dept_code, PDO::PARAM_INT);
    $stmt->bindValue(':appendix', $appendix, PDO::PARAM_INT);
    $stmt->bindValue(':taishobutu_name', $taishobutu_name, PDO::PARAM_STR);
    $stmt->bindValue(':taishobutu_address', $taishobutu_address, PDO::PARAM_STR);
    $stmt->bindValue(':taishobutu_tel', $taishobutu_tel, PDO::PARAM_STR);
    $stmt->bindValue(':owners_name', $owners_name, PDO::PARAM_STR);
    $stmt->bindValue(':owners_tel', $owners_tel, PDO::PARAM_STR);
    $stmt->bindValue(':total_area', $display_total_area, PDO::PARAM_STR);
    $stmt->execute();


    // 出力バッファをクリアしてバッファリングを終了
    $redirectUrl = '../taishobutu/taishobutu_index.php';
    echo '<script>window.location.href = "' . $redirectUrl . '";</script>';
    $_SESSION['flash'] = [
        'type' => 'success',
        'message' => '追加が完了しました。'
    ];
    exit;

} catch (PDOException $e){
    print'ただいま障害により大変ご迷惑をおかけしております。';

    exit();
}


?>