<?php
 

require_once '/home/ubuntu/public_html/taishobutu_app/common/header.php';

?>

<h1>防火対象物を追加</h1>
<form method="post"action="taishobutu_check.php">
    <table>
        
        
        <label for="appendix">用途区分</label>
        
        <?php require_once   '/home/ubuntu/public_html/taishobutu_app/common/bettpiyo_select.php'; ?>
        <label for="taishobutu_name">対象物名</label>
        <input type="text" name="taishobutu_name">
        <label for="taishobutu_address">対象物所在地</label>
        <input type="text" name="taishobutu_address">
        <label for="taihobutu_tel">対象物連絡先</label>
        <input type="text" name="taishobutu_tel">
        <label for="concern_name">関係者名</label>
        <input type="text" name="concern_name">
       <th><label for="concern_tel">関係者連絡先</label></th>
        <td><input type="text" name="concern_tel"></td>
       <th><label>延べ面積</label></th>
        <td><input type="text" name="total_area">㎡</td>       
        
    </table>
    <input type="submit"value="追加する">
</form>



</body>
</html>