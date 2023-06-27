<?php
session_start();
session_regenerate_id(true);

include("/var/www/html/taishobutu_app/common/header.php");
require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';
require_once '/var/www/html/taishobutu_app/common/bettpiyo/bettpiyo_array.php';
require_once '/var/www/html/taishobutu_app/common/function.php';

$code = $_GET['code'];

$sql_taishobutu_main = "SELECT * FROM taishobutu_main WHERE code = :code";
$stmt_taishobutu_main = $db_host->prepare($sql_taishobutu_main);
$stmt_taishobutu_main->bindParam(':code', $code, PDO::PARAM_STR);
$stmt_taishobutu_main->execute();

$result_taishobutu_main = $stmt_taishobutu_main->fetch(PDO::FETCH_ASSOC);



$sql_fire_safety_manager = "SELECT * FROM fire_safety_manager WHERE code = :code";
$stmt_fire_safety_manager = $db_host->prepare($sql_fire_safety_manager);
$stmt_fire_safety_manager->bindParam(':code',$code, PDO::PARAM_STR);
$stmt_fire_safety_manager->execute();

$result_fire_safety_manager = $stmt_fire_safety_manager->fetch(PDO::FETCH_ASSOC);

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
    <link rel="stylesheet" href="../../common/sass/taishobutu/datail/show_datail_copy.css">


    <title>防火対象物管理アプリ</title>
</head>
<body>

  <div class="Frame">
      <div class="Code"><?php echo '番号'.$result_taishobutu_main['code'];?></div>
      <div class="Title2">防火対象物台帳</div>
      <div class="RemarksColumnCellSet" style="width: 660px; height: 199px; left: 72px; top: 872px; position: absolute;  border-left: 0.50px black solid; border-top: 0.50px black solid; border-right: 0.50px black solid; border-bottom: 0.50px black solid"></div>
      <div class="LinkCellSet" style="width: 660px; height: 234px; left: 72px; top: 638px; position: absolute;  border-left: 0.50px black solid; border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
      <div class="CapacityWindowlessFloorCellSet" style="width: 660px; height: 35px; left: 72px; top: 603px; position: absolute">
        <div class="WindowlessFloorCellSet" style="width: 330px; height: 35px; left: 330px; top: 0px; position: absolute">
          <div class="WindowlessFloorValueCell" style="width: 140px; height: 35px; left: 0px; top: 0px; position: absolute;  border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
          <div class="WindowlessFloorCell" style="width: 190px; height: 35px; left: 140px; top: 0px; position: absolute;  border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
        </div>
        <div class="CapacityCellSet" style="width: 330px; height: 35px; left: 0px; top: 0px; position: absolute">
          <div class="CapacityValueCell" style="width: 190px; height: 35px; left: 140px; top: 0px; position: absolute;  border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
          <div class="CapacityCell" style="width: 140px; height: 35px; left: 0px; top: 0px; position: absolute;  border-left: 0.50px black solid; border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
        </div>
      </div>
      <div class="BuildingInfoCellSet" style="width: 660px; height: 105px; left: 72px; top: 498px; position: absolute">
        <div class="BuildingInfoBottomCellCet" style="width: 660px; height: 35px; left: 0px; top: 70px; position: absolute">
          <div class="TotalAreaCellSet" style="width: 220px; height: 35px; left: 440px; top: 0px; position: absolute">
            <div class="TotalAreaValueCell" style="width: 130px; height: 35px; left: 90px; top: 0px; position: absolute;  border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
            <div class="TotalAreaCell" style="width: 90px; height: 35px; left: 0px; top: 0px; position: absolute;  border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
          </div>
          <div class="BuildingAreaCellSet" style="width: 220px; height: 35px; left: 220px; top: 0px; position: absolute">
            <div class="BuildingAreaValueCell" style="width: 130px; height: 35px; left: 90px; top: 0px; position: absolute;  border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
            <div class="BuildingAreaCell" style="width: 90px; height: 35px; left: 0px; top: 0px; position: absolute;  border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
          </div>
          <div class="SiteAreaCellSet" style="width: 220px; height: 35px; left: 0px; top: 0px; position: absolute">
            <div class="SiteAreaValueCell" style="width: 130px; height: 35px; left: 90px; top: 0px; position: absolute;  border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
            <div class="SiteAreaCell" style="width: 90px; height: 35px; left: 0px; top: 0px; position: absolute;  border-left: 0.50px black solid; border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
          </div>
        </div>
        <div class="BuildingInfoMiddleCellCet" style="width: 660px; height: 35px; left: 0px; top: 35px; position: absolute">
          <div class="BuildingClassificationCellSet" style="width: 220px; height: 35px; left: 440px; top: 0px; position: absolute">
            <div class="BuildingClassificationValueCell" style="width: 130px; height: 35px; left: 90px; top: 0px; position: absolute;  border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
            <div class="BuildingClassificationCellSet" style="width: 90px; height: 35px; left: 0px; top: 0px; position: absolute;  border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
          </div>
          <div class="InteriorLimitCellSet" style="width: 220px; height: 35px; left: 220px; top: 0px; position: absolute">
            <div class="InteriorLimitValueCell" style="width: 130px; height: 35px; left: 90px; top: 0px; position: absolute;  border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
            <div class="InteriorLimitCell" style="width: 90px; height: 35px; left: 0px; top: 0px; position: absolute;  border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
          </div>
          <div class="MainStructureCellSet" style="width: 220px; height: 35px; left: 0px; top: 0px; position: absolute">
            <div class="MainStructureValueCellSet" style="width: 130px; height: 35px; left: 90px; top: 0px; position: absolute;  border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
            <div class="MainStructureCell" style="width: 90px; height: 35px; left: 0px; top: 0px; position: absolute;  border-left: 0.50px black solid; border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
          </div>
        </div>
        <div class="BuildingInfoTopCellSet" style="width: 660px; height: 35px; left: 0px; top: 0px; position: absolute">
          <div class="FloorsCellSet" style="width: 350px; height: 35px; left: 310px; top: 0px; position: absolute">
            <div class="FloorsValueCell" style="width: 282px; height: 35px; left: 68px; top: 0px; position: absolute;  border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
            <div class="FloorsCell" style="width: 68px; height: 35px; left: 0px; top: 0px; position: absolute;  border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
          </div>
          <div class="NewConstructionDateCellSet" style="width: 310px; height: 35px; left: 0px; top: 0px; position: absolute">
            <div class="NewConstructionDateValueCellSet" style="width: 188px; height: 35px; left: 122px; top: 0px; position: absolute;  border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
            <div class="NewConstructionDateCell" style="width: 122px; height: 35px; left: 0px; top: 0px; position: absolute;  border-left: 0.50px black solid; border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
          </div>
        </div>
      </div>
      <div class="FireSafetyManagerCellSet" style="width: 660px; height: 140px; left: 72px; top: 358px; position: absolute">
        <div class="FirePlanCellSet" style="width: 625px; height: 35px; left: 35px; top: 105px; position: absolute">
          <div class="FirePlanValueCell" style="width: 523px; height: 35px; left: 102px; top: 0px; position: absolute;  border-left: 0.50px black solid; border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
          <div class="FirePlanCell" style="width: 102px; height: 35px; left: 0px; top: 0px; position: absolute;  border-top: 0.50px black solid"></div>
        </div>
        <div class="AppointmentDateCellSet" style="width: 625px; height: 35px; left: 35px; top: 70px; position: absolute">
          <div class="AppointmentDateValueCell" style="width: 523px; height: 35px; left: 102px; top: 0px; position: absolute;  border-left: 0.50px black solid; border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
          <div class="AppointmentDateCell" style="width: 102px; height: 35px; left: 0px; top: 0px; position: absolute;  border-top: 0.50px black solid"></div>
        </div>
        <div class="FireSafetyManagerNameCellSet" style="width: 625px; height: 35px; left: 35px; top: 35px; position: absolute">
          <div class="FireSafetyManagerNameValueCell" style="width: 523px; height: 35px; left: 102px; top: 0px; position: absolute;  border-left: 0.50px black solid; border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
          <div class="FireSafetyManagerNameCell" style="width: 102px; height: 35px; left: 0px; top: 0px; position: absolute;  border-top: 0.50px black solid"></div>
        </div>
        <div class="DirectorCellSet" style="width: 625px; height: 35px; left: 35px; top: 0px; position: absolute">
          <div class="DirectorValueCell" style="width: 523px; height: 35px; left: 102px; top: 0px; position: absolute;  border-left: 0.50px black solid; border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
          <div class="DirectorCell" style="width: 102px; height: 35px; left: 0px; top: 0px; position: absolute;  border-top: 0.50px black solid"></div>
        </div>
        <div class="Rectangle18" style="width: 35px; height: 140px; left: 0px; top: 0px; position: absolute;  border-left: 0.50px black solid; border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
      </div>
      <div class="OwnerCellSet" style="width: 660px; height: 105px; left: 72px; top: 253px; position: absolute">
        <div class="OwnerTellCellSet" style="width: 625px; height: 35px; left: 35px; top: 70px; position: absolute">
          <div class="OwnerTellValueCell" style="width: 523px; height: 35px; left: 102px; top: 0px; position: absolute;  border-left: 0.50px black solid; border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
          <div class="OwnerTellCell" style="width: 102px; height: 35px; left: 0px; top: 0px; position: absolute;  border-top: 0.50px black solid"></div>
        </div>
        <div class="OwnerAddressCellSet" style="width: 625px; height: 35px; left: 35px; top: 35px; position: absolute">
          <div class="OwnerAddressValueCell" style="width: 523px; height: 35px; left: 102px; top: 0px; position: absolute;  border-left: 0.50px black solid; border-right: 0.50px black solid"></div>
          <div class="OwnerAddressCell" style="width: 102px; height: 35px; left: 0px; top: 0px; position: absolute; background: white"></div>
        </div>
        <div class="OwnerNameCellSet" style="width: 625px; height: 35px; left: 35px; top: 0px; position: absolute">
          <div class="OwnerNameValueCell" style="width: 523px; height: 35px; left: 102px; top: 0px; position: absolute;  border-left: 0.50px black solid; border-top: 0.50px black solid; border-right: 0.50px black solid; border-bottom: 0.50px black solid"></div>
          <div class="OwnerNameCell" style="width: 102px; height: 35px; left: 0px; top: 0px; position: absolute;  border-top: 0.50px black solid; border-bottom: 0.50px black solid"></div>
        </div>
        <div class="OwnerLabelCell" style="width: 35px; height: 105px; left: 0px; top: 0px; position: absolute;  border-left: 0.50px black solid; border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
      </div>
      <div class="TopNameAddressTellCellSet" style="width: 660px; height: 105px; left: 72px; top: 148px; position: absolute">
        <div class="TaishobutuAddressCellSet" style="width: 660px; height: 35px; left: 0px; top: 35px; position: absolute">
          <div class="TaishobutuAddressValiueCell" style="width: 137px; height: 35px; left: 0px; top: 0px; position: absolute;  border-left: 0.50px black solid; border-top: 0.50px black solid"></div>
          <div class="TaishobutuAddressCell" style="width: 523px; height: 35px; left: 137px; top: 0px; position: absolute;  border-left: 0.50px black solid; border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
        </div>
        <div class="TaishobutuTellCellSet" style="width: 660px; height: 35px; left: 0px; top: 70px; position: absolute">
          <div class="TaishobutuTellValueCell" style="width: 523px; height: 35px; left: 137px; top: 0px; position: absolute;  border-left: 0.50px black solid; border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
          <div class="TaishobutuTellCell" style="width: 137px; height: 35px; left: 0px; top: 0px; position: absolute;  border-left: 0.50px black solid; border-top: 0.50px black solid"></div>
        </div>
        <div class="TaishobutuNameCellSet" style="width: 660px; height: 35px; left: 0px; top: 0px; position: absolute">
          <div class="TaishobutuNameValueCell" style="width: 523px; height: 35px; left: 137px; top: 0px; position: absolute;  border-left: 0.50px black solid; border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
          <div class="TaishobutuNameCell" style="width: 137px; height: 35px; left: 0px; top: 0px; position: absolute;  border-left: 0.50px black solid; border-top: 0.50px black solid"></div>
        </div>
        <div class="TopText" style="width: 208px; height: 90px; left: 38px; top: 8px; position: absolute">
          <div style="left: 118px; top: 72px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">％連絡先％</div>
          <div style="left: 118px; top: 36px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">％所在地％</div>
          <div style="left: 118px; top: 1px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">％対象物名％</div>
          <div style="left: 0px; top: 71px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; letter-spacing: 10.50px; word-wrap: break-word">連絡先</div>
          <div style="left: 0px; top: 35px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; letter-spacing: 10.50px; word-wrap: break-word">所在地</div>
          <div style="left: 0px; top: 0px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; letter-spacing: 3px; word-wrap: break-word">対象物名</div>
        </div>
      </div>
      <div class="AppendixCellSet" style="width: 296px; height: 35px; left: 72px; top: 113px; position: absolute">
        <div class="TokuteiOrHitokuteiCell" style="width: 158px; height: 35px; left: 138px; top: 0px; position: absolute;  border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
        <div class="AppendixNumberCell" style="width: 70px; height: 35px; left: 68px; top: 0px; position: absolute;  border-left: 0.50px black solid; border-top: 0.50px black solid; border-right: 0.50px black solid"></div>
        <div class="AppendixTitleCell" style="width: 68px; height: 35px; left: 0px; top: 0px; position: absolute;  border-left: 0.50px black solid; border-top: 0.50px black solid"></div>
        <div class="AppendixTextSet" style="width: 264px; height: 19px; left: 19px; top: 8px; position: absolute">
          <div class="Appendix" style="left: 0px; top: 1px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">用途</div>
          <div class="AppendixValue" style="left: 63px; top: 0px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">%項%</div>
          <div class="TokuteiValue" style="left: 129px; top: 1px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">％特定防火対象物％</div>
        </div>
      </div>
      <div style="left: 113px; top: 367px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">職務上の地位</div>
      <div style="left: 121px; top: 437px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">選任年月日</div>
      <div style="left: 96px; top: 507px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">新築年月日</div>
      <div style="left: 255px; top: 673px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">１．防火管理者選任状況　→　別紙①  </div>
      <div style="left: 255px; top: 720px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">２．消防用設備点検報告　→　別紙②  </div>
      <div style="left: 255px; top: 767px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">３．消防訓練実施状況　　→　別紙③  </div>
      <div style="left: 255px; top: 814px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">４．立入検査状況　　　　→　別紙④  </div>
      <div style="left: 96px; top: 507px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">新築年月日</div>
      <div style="left: 307px; top: 543px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">内装制限</div>
      <div style="left: 89px; top: 577px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">敷地面積</div>
      <div style="left: 104px; top: 612px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; letter-spacing: 6px; word-wrap: break-word">収容人員</div>
      <div style="left: 402px; top: 508px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">階数</div>
      <div style="left: 237px; top: 508px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">％新築年月日％</div>
      <div style="left: 183px; top: 544px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">％耐火構造％</div>
      <div style="left: 196px; top: 577px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">％○㎡％</div>
      <div style="left: 269px; top: 612px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">％○人％</div>
      <div style="left: 420px; top: 577px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">％○㎡％</div>
      <div style="left: 417px; top: 543px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">％有％</div>
      <div style="left: 614px; top: 612px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">％有％</div>
      <div style="left: 617px; top: 544px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">％○号建築物％</div>
      <div style="left: 121px; top: 472px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; letter-spacing: 4.50px; word-wrap: break-word">消防計画</div>
      <div style="left: 127px; top: 403px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; letter-spacing: 22.50px; word-wrap: break-word">氏名</div>
      <div style="left: 124px; top: 261px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; letter-spacing: 3px; word-wrap: break-word">所有者名</div>
      <div style="left: 228px; top: 262px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; letter-spacing: 3px; word-wrap: break-word">%所有者名%</div>
      <div style="left: 228px; top: 297px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; letter-spacing: 3px; word-wrap: break-word">%所在地%</div>
      <div style="left: 227px; top: 333px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; letter-spacing: 3px; word-wrap: break-word">%連絡先%</div>
      <div style="left: 227px; top: 367px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; letter-spacing: 3px; word-wrap: break-word">%職務上の地位%</div>
      <div style="left: 227px; top: 402px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; letter-spacing: 3px; word-wrap: break-word">%氏名%</div>
      <div style="left: 227px; top: 437px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; letter-spacing: 3px; word-wrap: break-word">%選任年月日%</div>
      <div style="left: 226px; top: 472px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; letter-spacing: 3px; word-wrap: break-word">%消防計画更新日%</div>
      <div style="left: 494px; top: 506px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; letter-spacing: 3px; word-wrap: break-word">%地下○階・地上○階%</div>
      <div style="left: 124px; top: 296px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; letter-spacing: 10.50px; word-wrap: break-word">所在地</div>
      <div style="left: 124px; top: 333px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; letter-spacing: 10.50px; word-wrap: break-word">連絡先</div>
      <div style="left: 82px; top: 268px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">所<br/>有<br/>者</div>
      <div style="left: 82px; top: 371px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">防<br/>火<br/>管<br/>理<br/>者</div>
      <div style="left: 307px; top: 577px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">建築面積</div>
      <div style="left: 519px; top: 543px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">建築物区分</div>
      <div style="left: 527px; top: 577px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">延べ面積</div>
      <div style="left: 89px; top: 543px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">主要構造</div>
      <div style="left: 442px; top: 612px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; letter-spacing: 7.50px; word-wrap: break-word">無窓階</div>
      <div style="left: 637px; top: 577px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">％○㎡％</div>
      <div style="left: 175px; top: 881px; position: absolute; color: black; font-size: 15px; font-family: Inter; font-weight: 400; word-wrap: break-word">備　考　欄(対象物の取り扱いについての取り決め事項などを記入)</div>
  </div>
</body>

</html>


