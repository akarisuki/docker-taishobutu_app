<?php
session_start();
session_regenerate_id(true);

include("/var/www/html/taishobutu_app/common/header.php");
require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';
require_once '/var/www/html/taishobutu_app/common/bettpiyo/bettpiyo_array.php';
require_once '/var/www/html/taishobutu_app/common/function.php';




$code = isset($_POST['code']) ? $_POST['code'] : (isset($_GET['code']) ? $_GET['code'] : (isset($_SESSION['code']) ? $_SESSION['code'] : ''));


$sql_taishobutu_main = "SELECT * FROM taishobutu_main WHERE code = :code";
$stmt_taishobutu_main = $db_host->prepare($sql_taishobutu_main);
$stmt_taishobutu_main->bindParam(':code', $code, PDO::PARAM_INT);
$stmt_taishobutu_main->execute();

$result_taishobutu_main = $stmt_taishobutu_main->fetch(PDO::FETCH_ASSOC);

$sql_fire_safety_manager = "SELECT * FROM fire_safety_manager WHERE code = :code";
$stmt_fire_safety_manager = $db_host->prepare($sql_fire_safety_manager);
$stmt_fire_safety_manager->bindParam(':code',$code, PDO::PARAM_INT);
$stmt_fire_safety_manager->execute();

$result_fire_safety_manager = $stmt_fire_safety_manager->fetch(PDO::FETCH_ASSOC);

$sql_taishobutu_datail = "SELECT * FROM taishobutu_datail WHERE code = :code";
$stmt_taishobutu_datail = $db_host->prepare($sql_taishobutu_datail);
$stmt_taishobutu_datail->bindParam(':code',$code, PDO::PARAM_INT);
$stmt_taishobutu_datail->execute();

$result_taishobutu_datail = $stmt_taishobutu_datail->fetch(PDO::FETCH_ASSOC);

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
  <div class="datail_add_button">
      <form id="form5" action="http://localhost:50080/taishobutu_app/taishobutu/datail/taishobutu_show_datail_add.php" method="post">
          <input type="hidden" name="code" value="<?php echo $result_taishobutu_main['code']; ?>">
          <a href="#" onclick="submitForm('form5');" class="button" id="datail_add_button">詳細記載項目追加</a>
      </form>
  </div>
  <div class="datail_edit_button">
      <form id="form6" action="http://localhost:50080/taishobutu_app/taishobutu/datail/taishobutu_show_datail_edit.php" method="post">
          <input type="hidden" name="code" value="<?php echo $result_taishobutu_main['code']; ?>">
          <a href="#" onclick="submitForm('form6');" class="button" id="datail_edit_button">詳細記載項目変更</a>
      </form>
  </div> 

  <div class="Frame">
      <div class="Code"><?php echo '番号'.$result_taishobutu_main['code'];?></div>
      <div class="Title2">防火対象物台帳</div>
      <div class="RemarksColumnCellSet"><h6>備　考　欄(対象物の取り扱いについての取り決め事項などを記入)</h6>
          <div class="RemarksColumnValueCell">
              <p>
                <?php
                    if($result_taishobutu_datail !== false){
                      echo $result_taishobutu_datail['remarks_column'];
                    }
                ?>
              </p>
          </div>
      </div>
      <div class="LinkCellSet">
        <div class="betushi_url">
          <form id="form1" action="http://localhost:50080/taishobutu_app/taishobutu/datail/fire_safety_manager/fire_safety_manager_datail.php" method="post">
                <input type="hidden" name="code" value="<?php echo $result_taishobutu_main['code']; ?>">
                <a href="#" onclick="submitForm('form1');" class="fire_safety_manager-url">1. 防火管理者選任状況  →  別紙①</a>
          </form>
          <form id="form2" action="http://localhost:50080/taishobutu_app/taishobutu/datail/fire_equipment_report/fire_equipment_report_datail.php" method="post">
                <input type="hidden" name="code" value="<?php echo $result_taishobutu_main['code']; ?>">
                <a href="#" onclick="submitForm('form2');" class="fire_equipment_report-url">2. 消防用設備点検報告  →  別紙②</a>
          </form>
          <form id="form3" action="http://localhost:50080/taishobutu_app/taishobutu/datail/fire_fighting_training/fire_fighting_training_datail.php" method="post">
                <input type="hidden" name="code" value="<?php echo $result_taishobutu_main['code']; ?>">
                <a href="#" onclick="submitForm('form3');" class="fire_fighting_training-url">3. 消防訓練実施状況     →   別紙③</a>
          </form>
          <form id="form4" action="http://localhost:50080/taishobutu_app/taishobutu/datail/inspection_status/inspection_status_datail.php" method="post">
                <input type="hidden" name="code" value="<?php echo $result_taishobutu_main['code']; ?>">
                  <a href="#" onclick="submitForm('form4');" class="inspection_status-url">4. 立入検査状況      →   別紙④</a>
          </form>
          <form id="form7" action="http://localhost:50080/taishobutu_app/taishobutu/datail/firefighting_equipment_list/firefighting_equipment_list_show.php" method="post">
                <input type="hidden" name="code" value="<?php echo $result_taishobutu_main['code']; ?>">
                  <a href="#" onclick="submitForm('form7');" class="firefighting_equipment_list-url">5. 消防用設備等一覧表    →   別紙⑤</a>
          </form>
          
        </div>
      </div>
      <div class="CapacityWindowlessFloorBuildingStructureCellSet">
        <div class="WindowlessFloorCellSet">
          <div class="WindowlessFloorValueCell">
            <h6>
              <?php 
                  if($result_taishobutu_datail !== false) {
                    echo $result_taishobutu_datail['windowless_floor'];
                  }
              ?>
            </h6>
          </div>
          <div class="WindowlessFloorCell"><h6>無窓階</h6></div>
        </div>
        <div class="CapacityCellSet">
          <div class="CapacityValueCell">
            <div class="Capacity-value">
              <span>
                <?php 
                    if($result_taishobutu_datail !== false) {
                      echo $result_taishobutu_datail['capacity'];
                    }
                ?>
              </span>
              <span>人</span>
            </div>
          </div>
          <div class="CapacityCell"><h6>収容人員</h6></div>
        </div>
        <div class="BuildingStructureCellSet">
          <div class="BuildingStructureValueCell">
            <h6>
              <?php
                  if($result_taishobutu_datail !== false)  {
                    echo $result_taishobutu_datail['building_structure']; 
                  }
              ?>
            </h6>
          </div>
          <div class="BuildingStructureCell"><h6>建築構造</h6></div>
        </div>
      </div>
      <div class="BuildingInfoCellSet">
        <div class="BuildingInfoBottomCellCet">
          <div class="TotalAreaCellSet">
            <div class="TotalAreaValueCell">
              <div class="total-area-value">
                  <span><?php echo $result_taishobutu_main['total_area'];?></span>
                  <span>㎡</span>
              </div>
            </div>
            <div class="TotalAreaCell"><h6>延べ面積</h6></div>
          </div>
          <div class="BuildingAreaCellSet">
            <div class="BuildingAreaValueCell">
              <div class="building-area-value">
                <span>
                  <?php 
                      if($result_taishobutu_datail !== false){
                        echo $result_taishobutu_datail['building_area'];
                      }
                  ?>
                </span>
                <span>㎡</span>
              </div>
            </div>
            <div class="BuildingAreaCell"><h6>建築面積</h6></div>
          </div>
          <div class="SiteAreaCellSet">
            <div class="SiteAreaValueCell">
              <div class="site-area-value">
                <span>
                  <?php 
                      if($result_taishobutu_datail !== false){
                        echo $result_taishobutu_datail['site_area'];
                      }
                  ?>
                </span>
                <span>㎡</span>
              </div>
            </div>
            <div class="SiteAreaCell"><h6>敷地面積</h6></div>
          </div>
        </div>
        <div class="BuildingInfoMiddleCellCet">
          <div class="BuildingClassificationCellSet">
            <div class="BuildingClassificationValueCell">
              <h6>
                <?php 
                    if($result_taishobutu_datail !== false){
                      echo $result_taishobutu_datail['building_classification'];
                    }
                ?>
              </h6>
            </div>
            <div class="BuildingClassificationCell"><h6>建築物区分</h6></div>
          </div>
          <div class="InteriorLimitCellSet">
            <div class="InteriorLimitValueCell">
              <h6>
                <?php 
                    if($result_taishobutu_datail !== false){
                      echo $result_taishobutu_datail['interior_limit'];
                    }
                ?>
              </h6>
            </div>
            <div class="InteriorLimitCell"><h6>内装制限</h6></div>
          </div>
          <div class="MainStructureCellSet">
            <div class="MainStructureValueCellSet">
              <h6>
                <?php 
                    if($result_taishobutu_datail !== false){
                      echo $result_taishobutu_datail['main_structure'];
                    }
                ?>
              </h6>
            </div>
            <div class="MainStructureCell"><h6>主要構造</h6></div>
          </div>
        </div>
        <div class="BuildingInfoTopCellSet">
          <div class="FloorsCellSet">
            <div class="FloorsValueCell">
              <h6>
                <?php 
                    if($result_taishobutu_datail !== false){
                      echo $result_taishobutu_datail['floor'];
                    }
                ?>
              </h6>
            </div>
            <div class="FloorsCell"><h6>階数</h6></div>
          </div>
          <div class="NewConstructionDateCellSet">
            <div class="NewConstructionDateValueCellSet">
              <h6>
                <?php 
                    if($result_taishobutu_datail !== false){
                      echo $result_taishobutu_datail['new_construction_date'];
                    }
                ?>
              </h6>
            </div>
            <div class="NewConstructionDateCell"><h6>新築年月日</h6></div>
          </div>
        </div>
      </div>
      
      <div class="FireSafetyManagerCellSet">
        <div class="FireSafetyManagerLavel"><h6>防<br/>火<br/>管<br/>理<br/>者</h6></div>
        <div class="FirePlanCellSet">
          <div class="FirePlanValueCell">
            <h6>
              <?php 
                  if($result_fire_safety_manager !== false){
                    echo $result_fire_safety_manager['fire_plan_date'];
                  }
              ?>
            </h6>
          </div>
          <div class="FirePlanCell"><h6>消防計画</h6></div>
        </div>
        <div class="AppointmentDateCellSet">
          <div class="AppointmentDateValueCell">
            <h6>
              <?php
                  if($result_fire_safety_manager !== false){
                    echo $result_fire_safety_manager['appointment_date'];
                  }
              ?>
            </h6>
          </div>
          <div class="AppointmentDateCell"><h6>選任年月日</h6></div>
        </div>
        <div class="FireSafetyManagerNameCellSet">
          <div class="FireSafetyManagerNameValueCell">
            <h6>
              <?php
                  if($result_fire_safety_manager){
                    echo $result_fire_safety_manager['fire_safety_manager_name'];
                  }
              ?>
            </h6>
          </div>
          <div class="FireSafetyManagerNameCell"><h6>氏名</h6></div>
        </div>
        <div class="DirectorCellSet">
          <div class="DirectorValueCell">
            <h6>
              <?php
                  if($result_fire_safety_manager){
                    echo $result_fire_safety_manager['fire_safety_manager_director'];
                  }
              ?>
            </h6>
          </div>
          <div class="DirectorCell"><h6>職務上の地位</h6></div>
        </div>
      </div>
      
      <div class="OwnerCellSet">
        <div class="OwnerTellCellSet">
          <div class="OwnerTellValueCell"><h6><?php echo $result_taishobutu_main['owners_tel'];?></h6></div>
          <div class="OwnerTellCell"><h6>連絡先</h6></div>
        </div>
        <div class="OwnerAddressCellSet">
          <div class="OwnerAddressValueCell">
            <h6>
              <?php
                  if($result_taishobutu_datail !== false){
                    echo $result_taishobutu_datail['owners_address'];
                  }
              ?>
            </h6>
          </div>
          <div class="OwnerAddressCell"><h6>所在地</h6></div>
        </div>
        <div class="OwnerNameCellSet">
          <div class="OwnerNameValueCell"><h6><?php echo $result_taishobutu_main['owners_name'];?></h6></div>
          <div class="OwnerNameCell"><h6>所有者名</h6></div>
        </div>
        <div class="OwnerLabelCell"><h6>所<br/>有<br/>者</h6></div>
      </div>
      <div class="TopNameAddressTellCellSet">
        <div class="TaishobutuAddressCellSet">
          <div class="TaishobutuAddressValiueCell"><h6><?php echo $result_taishobutu_main['taishobutu_address'];?></h6></div>
          <div class="TaishobutuAddressCell"><h6>所在地</h6></div>
        </div>
        <div class="TaishobutuTellCellSet">
          <div class="TaishobutuTellValueCell"><h6><?php echo $result_taishobutu_main['taishobutu_tel'];?></h6></div>
          <div class="TaishobutuTellCell"><h6>連絡先</h6></div>
        </div>
        <div class="TaishobutuNameCellSet">
          <div class="TaishobutuNameValueCell"><h6><?php echo $result_taishobutu_main['taishobutu_name'];?></h6></div>
          <div class="TaishobutuNameCell"><h6>対象物</h6></div>
        </div>
      
      </div>
      <div class="AppendixCellSet">
        <div class="TokuteiOrHitokuteiCell">
          <div class="TokuteiValue">
              <?php 
                  $echo_specific = appendix_specific($result_taishobutu_main['appendix']);
                  echo $echo_specific;
              ?>
          </div>
        </div>
        <div class="AppendixNumberCell"><div class="AppendixValue"><?php echo $appendix_array[$result_taishobutu_main['appendix']]; ?></div></div>
        <div class="AppendixTitleCell"><div class="Appendix">用途</div></div>
        
      </div>
      
  </div>
</body>

</html>


