<?php
session_start();
session_regenerate_id(true);

include("/var/www/html/taishobutu_app/common/header.php");
require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';
require_once '/var/www/html/taishobutu_app/common/bettpiyo/bettpiyo_array.php';
require_once '/var/www/html/taishobutu_app/common/function.php';

$code = $_GET['code'];

$sql = "SELECT * FROM taishobutu_main WHERE code = :code";
$stmt = $db_host->prepare($sql);
$stmt->bindParam(':code', $code, PDO::PARAM_STR);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);

$db_host = null;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0,
          maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../common/sass/common/header.css">
    <link rel="stylesheet" href="../../common/sass/taishobutu/datail/show_datail.css">


    <title>防火対象物管理アプリ</title>
</head>
<body>
  <div class="container">
    <div class="title-2"><h1>防火対象物台帳</h1></div>
      <div class="code"><?php echo '番号'.$result['code'];?></div>
      <div class="outline">
            <div class="appendix-cell-set">
                  <div class="cell">用途</div>
                  <div class="cell"><?php echo $appendix_array[$result['appendix']]; ?></div>
                  <div class="cell">
                  <?php 
                        $echo_specific = appendix_specific($result['appendix']);
                        echo $echo_specific;
                  ?>
                  </div>    
            </div>
            <div class="taishobutu_name-cell-set">
                  <div class="cell">対 象 物 名</div>
                  <div class="cell"><?php echo $result['taishobutu_name'];?></div>
            </div>

            <div class="taishobutu_address-cell-set">
                  <div class="cell">所  在  地</div>
                  <div class="cell"><?php echo $result['taishobutu_address'];?></div>
            </div>

            <div class="taishobutu_tel-cell-set">
                  <div class="cell">連  絡  先</div>
                  <div class="cell"><?php echo $result['taishobutu_tel'];?></div>
            </div>

            <div class="owners-set">
                  <div class="owner-label">
                  <p>所</p>
                  <p>有</p>
                  <p>者</p>
                  </div>
                <div class="owner-info">
                  <div class="owners_name-cell-set">
                        <div class="cell">所有者名</div>
                        <div class="cell"><?php echo $result['owners_name'];?></div>
                  </div>
                  <div class="owners_address-cell-set">
                        <div class="cell">所在地</div>
                        <div class="cell"></div>
                  </div>
                  <div class="owners_tel-cell-set">
                        <div class="cell">連絡先</div>
                        <div class="cell"><?php echo $result['owners_tel'];?></div>
                  </div>
                </div>
            </div>
            <!-- fire_safety_manager 防火管理者 -->
            <div class="fire_safety_manager-set">
                  <div class="fire_safety_manager-label">
                  <p>防</p>
                  <p>火</p>
                  <p>管</p>
                  <p>理</p>
                  <p>者</p>
                  </div>
                  <div class="fire_safety_manager-info">
                        <div class="fire_safety_manager-director-cell-set">
                              <div class="cell">職務上の地位</div>
                              <div class="cell"></div>
                        </div>
                        <div class="fire_safety_manager-name-cell-set">
                              <div class="cell">氏    名</div>
                              <div class="cell"></div>
                        </div>
                        <div class="appointment_date">
                              <div class="cell">選任年月日</div>
                              <div class="cell"></div>
                        </div>
                        <div class="fire_plan">
                              <div class="cell">消防計画</div>
                              <div class="cell"></div>
                        </div>
                  </div>
            </div>
            <div class="building-set">
                  <div class="building-row">
                        <div class="cell">新築年月日</div>
                        <div class="cell">○年○月○日</div>
                        <div class="cell">階数</div>
                        <div class="cell">地下 ○ 階 ・ 地上 ○ 階</div>
                  </div>
                  <div class="building-row">
                        <div class="cell">主要構造</div>
                        <div class="cell">耐火構造</div>
                        <div class="cell">内装制限</div>
                        <div class="cell">有</div>
                        <div class="cell building_classification">建築物区分</div>
                        <div class="cell">4号建築物</div>
                  </div>
                  <div class="building-row">
                        <div class="cell">敷地面積</div>
                        <div class="cell">○ ㎡</div>
                        <div class="cell">建築面積</div>
                        <div class="cell">○ ㎡</div>
                        <div class="cell">延べ面積</div>
                        <div class="cell">○ ㎡</div>
                  </div>
            </div>
            <div class="etc-set">
                  <div class="capacity">
                        <div class="cell">収容人員</div>
                        <div class="cell"></div>
                  </div>
                  <div class="no_window_floor">
                        <div class="cell">無窓階</div>
                        <div class="cell"></div>
                  </div>
            </div>
            <div class="betushi_url">
                  <form id="form1" action="http://localhost:50080/taishobutu_app/taishobutu/datail/fire_safety_manager_datail.php" method="post">
                        <input type="hidden" name="code" value="<?php echo $result['code']; ?>">
                        <a href="#" onclick="submitForm('form1');" class="fire_safety_manager-url">1. 防火管理者選任状況  →  別紙①</a>
                  </form>
                  <form id="form2" action="http://localhost:50080/taishobutu_app/taishobutu/datail/fire_equipment_report.php" method="post">
                        <input type="hidden" name="code" value="<?php echo $result['code']; ?>">
                        <a href="#" onclick="submitForm('form2');" class="fire_equipment_report-url">2. 消防用設備点検報告  →  別紙②</a>
                  </form>
                  <form id="form3" action="http://localhost:50080/taishobutu_app/taishobutu/datail/firefighting_training.php" method="post">
                        <input type="hidden" name="code" value="<?php echo $result['code']; ?>">
                        <a href="#" onclick="submitForm('form3');" class="firefighting_training-url">3. 消防訓練実施状況   →   別紙③</a>
                  </form>
            </div>

            <div class="bikorun">
                  <p>備  考  欄(対象物の取り扱いについての取り決め事項などを記入)</p>
                  <div class="bikorun-outline"></div>
            </div>
            <div class="free-line-top"></div>
            <div class="free-line-top2"></div>
            <div class="free-line-top3"></div>
            <div class="free-line-top4"></div>
            <div class="free-line-top5"></div>
            <div class="free-line-top6"></div>
            <div class="free-line-center"></div>
            <div class="free-line-right"></div>
            <div class="free-line-right2"></div>
            <div class="free-line-right3"></div>
            <div class="free-line-left"></div>
            <div class="free-line-left2"></div>
            <div class="free-line-left3"></div>
            <div class="free-line-left4"></div>
            <div class="free-line-bottom"></div>
            <div class="free-line-left5"></div>
            
      </div>
      
  </div>

</html>




