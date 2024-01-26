<?php
session_start();
session_regenerate_id(true);
$isLoggedIn = isset($_SESSION['name']);  // 例: $_SESSION['name'] にユーザーIDが保存されている場合をログイン済みとみなす
require_once '../../../common/config.php';
include("../../../common/header.php");
require_once '../../../common/db_operation/db_connect.php';
require_once '../../../common/bettpiyo/bettpiyo_array.php';
require_once '../../../common/function.php';

$code = isset($_POST['code']) ? $_POST['code'] : (isset($_GET['code']) ? $_GET['code'] : (isset($_SESSION['code']) ? $_SESSION['code'] : ''));

$_SESSION['flash'] = $_SESSION['flash'] ?? null;

$sql_taishobutu_main = "SELECT * FROM taishobutu_main WHERE code = :code";
$stmt_taishobutu_main = $db_host->prepare($sql_taishobutu_main);
$stmt_taishobutu_main->bindParam(':code', $code, PDO::PARAM_INT);
$stmt_taishobutu_main->execute();

$result_taishobutu_main = $stmt_taishobutu_main->fetch(PDO::FETCH_ASSOC);

$sql_firefighting_equipment_list = "SELECT * FROM firefighting_equipment_list WHERE code = :code";
$stmt_firefighting_equipment_list = $db_host->prepare($sql_firefighting_equipment_list);
$stmt_firefighting_equipment_list->bindParam(':code', $code, PDO::PARAM_INT);
$stmt_firefighting_equipment_list->execute();

$result_firefighting_equipment_list = $stmt_firefighting_equipment_list->fetch(PDO::FETCH_ASSOC);

if(empty($result_firefighting_equipment_list)) {
  echo <<<EOD
      <script>
        if (confirm("まだ消防用設備情報が登録されておりません。登録画面に移動しますか？")) {
            window.location.href = "firefighting_equipment_list_add.php?code=" + {$code};
        }
      </script>
  EOD;
}



?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0,
          maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../common/sass/common/header.css">
    <link rel="stylesheet" href="../../../common/sass/taishobutu/datail/firefighting_equipment_list/firefighting_equipment_list_show.css">


    <title>防火対象物管理アプリ</title>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
          setTimeout(function() {
              var flashMessage = document.getElementById('flashMessage');
              if(flashMessage) {
                  flashMessage.style.opacity = '0';
                  setTimeout(function() {
                      flashMessage.style.display = 'none';
                  }, 1000); // 1秒後に非表示
              }
          }, 5000); // 5秒後に透明度を0に
      });

    </script>
</head>

<body>
  <?php
   // セッション変数からメッセージを取得し、表示
  if (isset($_SESSION['flash'])) {
    $flash = $_SESSION['flash'];
    echo  "<div id='flashMessage' class='alert alert-{$flash['type']}'>{$flash['message']}</div>";
    $_SESSION['flash'] = null;
  }
  ?>
  <div class="FireEquipmentLimitedQuantity">
    
    <div class="equipment_edit_button">
        <form id="form9" action="firefighting_equipment_list_edit.php" method="post">
            <input type="hidden" name="code" value="<?php echo $code; ?>">
            <a href="#" onclick="submitForm('form9');" class="button" id="equipment_edit_button">消防用設備変更</a>
        </form>
    </div> 
    <h1 class="page_title">消防用設備等設置一覧表</h1>
    <div class="EmergencyPowerSupplyCellset">
      <div class="StorageBatteryEquipment">
        <div class="StorageBatteryEquipmentGR"><p><?php echo $result_firefighting_equipment_list['StorageBatteryEquipmentGR'];?></p></div>
        <div class="StorageBatteryEquipmentAI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['StorageBatteryEquipmentAI'];?></h1></div>
        <div class="StorageBatteryEquipmentNOI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['StorageBatteryEquipmentNOI'];?></h1></div>
        <div class="StorageBatteryEquipmentNameCellset">
          <div class="StorageBatteryEquipmentName"><h1>蓄電池設備</h1></div>
        </div>
      </div>
      <div class="InHousePowerGenerationEquipment">
        <div class="InHousePowerGenerationEquipmentGR"><p><?php echo $result_firefighting_equipment_list['InHousePowerGenerationEquipmentGR'];?></p></div>
        <div class="InHousePowerGenerationEquipmentAI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['InHousePowerGenerationEquipmentAI'];?></h1></div>
        <div class="InHousePowerGenerationEquipmentNOI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['InHousePowerGenerationEquipmentNOI'];?></h1></div>
        <div class="InHousePowerGenerationEquipmentNameCellset">
          <div class="InHousePowerGenerationEquipmentName"><h1>自家発電設備</h1></div>
        </div>
      </div>
      <div class="ThePowerReceivingFacilityDedicatedToAStandByPowerSource">
        <div class="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceGR"><p><?php echo $result_firefighting_equipment_list['ThePowerReceivingFacilityDedicatedToAStandByPowerSourceGR'];?></p></div>
        <div class="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceAI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['ThePowerReceivingFacilityDedicatedToAStandByPowerSourceAI'];?></h1></div>
        <div class="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceNOI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['ThePowerReceivingFacilityDedicatedToAStandByPowerSourceNOI'];?></h1></div>
        <div class="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceNameCellset">
          <div class="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceName"><h1>非常電源専用受電設備</h1></div>
        </div>
      </div>
      <div class="EmergencyPowerSupplyLabel">
        <div class="EmergencyPowerSupplyLabelArea"><h1>非常電源</h1></div>
      </div>
    </div>
    <div class="FireFightingFacilityCellset">
      <div class="ConnectingWaterPipe">
        <div class="ConnectingWaterPipeGR"><p><?php echo $result_firefighting_equipment_list['ConnectingWaterPipeGR'];?></p></div>
        <div class="ConnectingWaterPipeAI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['ConnectingWaterPipeAI'];?></h1></div>
        <div class="ConnectingWaterPipeNOI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['ConnectingWaterPipeNOI'];?></h1></div>
        <div class="ConnectingWaterPipeNameCellset">
          <div class="ConnectingWaterPipeName"><h1>連結送水管</h1></div>
        </div>
      </div>
      <div class="LinkedSprinklerSystem">
        <div class="LinkedSprinklerSystemGR"><p><?php echo $result_firefighting_equipment_list['LinkedSprinklerSystemGR'];?></p></div>
        <div class="LinkedSprinklerSystemAI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['LinkedSprinklerSystemAI'];?></h1></div>
        <div class="LinkedSprinklerSystemNOI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['LinkedSprinklerSystemNOI'];?></h1></div>
        <div class="LinkedSprinklerSystemNameCellset">
          <div class="LinkedSprinklerSystemName"><h1>連結散水設備</h1></div>
        </div>
      </div>
      <div class="SmokeExhaustEquipment">
        <div class="SmokeExhaustEquipmentGR"><p><?php echo $result_firefighting_equipment_list['SmokeExhaustEquipmentGR'];?></p></div>
        <div class="SmokeExhaustEquipmentAI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['SmokeExhaustEquipmentAI'];?></h1></div>
        <div class="SmokeExhaustEquipmentNOI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['SmokeExhaustEquipmentNOI'];?></h1></div>
        <div class="SmokeExhaustEquipmentNameCellset">
          <div class="SmokeExhaustEquipmentName"><h1>排煙設備</h1></div>
        </div>
      </div>
      <div class="EmergencyOutletFacility">
        <div class="EmergencyOutletFacilityGR"><p><?php echo $result_firefighting_equipment_list['EmergencyOutletFacilityGR'];?></p></div>
        <div class="EmergencyOutletFacilityAI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['EmergencyOutletFacilityAI'];?></h1></div>
        <div class="EmergencyOutletFacilityNOI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['EmergencyOutletFacilityNOI'];?></h1></div>
        <div class="EmergencyOutletFacilityNameCellset">
          <div class="EmergencyOutletFacilityName"><h1>非常コンセント設備</h1></div>
        </div>
      </div>
      <div class="RadioCommunicationAuxiliaryEquipment">
        <div class="RadioCommunicationAuxiliaryEquipmentGR"><p><?php echo $result_firefighting_equipment_list['RadioCommunicationAuxiliaryEquipmentGR'];?></p></div>
        <div class="RadioCommunicationAuxiliaryEquipmentAI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['RadioCommunicationAuxiliaryEquipmentAI'];?></h1></div>
        <div class="RadioCommunicationAuxiliaryEquipmentNOI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['RadioCommunicationAuxiliaryEquipmentNOI'];?></h1></div>
        <div class="RadioCommunicationAuxiliaryEquipmentNameCellset">
          <div class="RadioCommunicationAuxiliaryEquipmentName"><h1>無線通信補助設備</h1></div>
        </div>
      </div>
      <div class="FireFightingFacilityLabel">
        <div class="FireFightingFacilityLabelArea"><h1>消火活動<br/>上必要な<br/>　施設</h1></div>
      </div>
    </div>
    <div class="FirefightingWaterCellset">
      <div class="FireTank">
        <div class="FireTankGR"><p><?php echo $result_firefighting_equipment_list['FireTankGR'];?></p></div>
        <div class="FireTankAI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['FireTankAI'];?></h1></div>
        <div class="FireTankNOI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['FireTankNOI'];?></h1></div>
        <div class="FireTankNameCellset">
          <div class="FireTankName"><h1>防火水槽など</h1></div>
        </div>
      </div>
      <div class="FirefightingWaterLabel">
        <div class="FirefightingWaterLabelArea"><h1>消防用水</h1></div>
      </div>
    </div>
    <div class="EvacuationEquipmentCellset">
      <div class="GuideLightsGuideSigns">
        <div class="GuideLightsGuideSignsGR"><p><?php echo $result_firefighting_equipment_list['GuideLightsGuideSignsGR'];?></p></div>
        <div class="GuideLightsGuideSignsAI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['GuideLightsGuideSignsAI'];?></h1></div>
        <div class="GuideLightsGuideSignsNOI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['GuideLightsGuideSignsNOI'];?></h1></div>
        <div class="GuideLightsGuideSignsNameCellset">
          <div class="GuideLightsGuideSignsName"><h1>誘導灯、誘導標識</h1></div>
        </div>
      </div>
      <div class="SlideEscapeLadderRescueBag">
        <div class="SlideEscapeLadderRescueBagGR"><p><?php echo $result_firefighting_equipment_list['SlideEscapeLadderRescueBagGR'];?></p></div>
        <div class="SlideEscapeLadderRescueBagAI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['SlideEscapeLadderRescueBagAI'];?></h1></div>
        <div class="SlideEscapeLadderRescueBagNOI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['SlideEscapeLadderRescueBagNOI'];?></h1></div>
        <div class="SlideEscapeLadderRescueBagNameCellset" >
          <div class="SlideEscapeLadderRescueBagName"><h1>滑り台、避難はしご、救助袋など</h1></div>
        </div>
      </div>
      <div class="EvacuationEquipmentLabel">
        <div class="EvacuationEquipmentLabelArea"><h1>避難設備</h1></div>
      </div>
    </div>
    <div class="AlarmEquipmentCellset">
      <div class="EmergencyAlarmDevice">
        <div class="EmergencyAlarmDeviceGR"><p><?php echo $result_firefighting_equipment_list['EmergencyAlarmDeviceGR'];?></p></div>
        <div class="EmergencyAlarmDeviceAI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['EmergencyAlarmDeviceAI'];?></h1></div>
        <div class="EmergencyAlarmDeviceNOI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['EmergencyAlarmDeviceNOI'];?></h1></div>
        <div class="EmergencyAlarmDeviceNameCellset">
          <div class="EmergencyAlarmDeviceName"><h1>非常警報器具</h1></div>
        </div>
      </div>
      <div class="GasLeakFireAlarmNameCellset">
        <div class="GasLeakFireAlarmGR"><p><?php echo $result_firefighting_equipment_list['GasLeakFireAlarmGR'];?></p></div>
        <div class="GasLeakFireAlarmAI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['GasLeakFireAlarmAI'];?></h1></div>
        <div class="GasLeakFireAlarmNOI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['GasLeakFireAlarmNOI'];?></h1></div>
        <div class="GasLeakFireAlarmNameCellset">
          <div class="GasLeakFireAlarmName"><h1>ガス漏れ火災警報器</h1></div>
        </div>
      </div>
      <div class="EarthLeakageFireAlarm">
        <div class="EarthLeakageFireAlarmGR"><p><?php echo $result_firefighting_equipment_list['EarthLeakageFireAlarmGR'];?></p></div>
        <div class="EarthLeakageFireAlarmAI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['EarthLeakageFireAlarmAI'];?></h1></div>
        <div class="EarthLeakageFireAlarmNOI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['EarthLeakageFireAlarmNOI'];?></h1></div>
        <div class="EarthLeakageFireAlarmNameCellset">
          <div class="EarthLeakageFireAlarmName"><h1>漏電火災警報器</h1></div>
        </div>
      </div>
      <div class="FireAlarmEquipmentThatNotifiesTheFireDepartment">
        <div class="FireAlarmEquipmentThatNotifiesTheFireDepartmentGR"><p><?php echo $result_firefighting_equipment_list['FireAlarmEquipmentThatNotifiesTheFireDepartmentGR'];?></p></div>
        <div class="FireAlarmEquipmentThatNotifiesTheFireDepartmentAI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['FireAlarmEquipmentThatNotifiesTheFireDepartmentAI'];?></h1></div>
        <div class="FireAlarmEquipmentThatNotifiesTheFireDepartmentNOI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['FireAlarmEquipmentThatNotifiesTheFireDepartmentNOI'];?></h1></div>
        <div class="FireAlarmEquipmentThatNotifiesTheFireDepartmentNameCellset">
          <div class="FireAlarmEquipmentThatNotifiesTheFireDepartmentName"><h1>消防機関へ通報する火災報知設備</h1></div>
        </div>
      </div>
      <div class="AutomaticFireAlarmSystem">
        <div class="AutomaticFireAlarmSystemGR"><p><?php echo $result_firefighting_equipment_list['AutomaticFireAlarmSystemGR'];?></p></div>
        <div class="AutomaticFireAlarmSystemAI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['AutomaticFireAlarmSystemAI'];?></h1></div>
        <div class="AutomaticFireAlarmSystemNOI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['AutomaticFireAlarmSystemNOI'];?></h1></div>
        <div class="AutomaticFireAlarmSystemNameCellset">
          <div class="AutomaticFireAlarmSystemName"><h1>自動火災報知設備</h1></div>
        </div>
      </div>
      <div class="AlarmEquipmentLabel">
        <div class="AlarmEquipmentLabelArea"><h1>警報設備</h1></div>
      </div>
    </div>
    <div class="FireExtinguishingEquipmentCellset">
      <div class="SimpleFireExtinguisher">
        <div class="SimpleFireExtinguisherGR"><p><?php echo $result_firefighting_equipment_list['SimpleFireExtinguisherGR'];?></p></div>
        <div class="SimpleFireExtinguisherAI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['SimpleFireExtinguisherAI'];?></h1></div>
        <div class="SimpleFireExtinguisherNOI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['SimpleFireExtinguisherNOI'];?></h1></div>
        <div class="SimpleFireExtinguisherNameCellset">
          <div class="SimpleFireExtinguisherName"><h1>簡易消火用具</h1></div>
        </div>
      </div>
      <div class="PowerFirePumpEquipment">
        <div class="PowerFirePumpEquipmentGR"><p><?php echo $result_firefighting_equipment_list['PowerFirePumpEquipmentGR'];?></p></div>
        <div class="PowerFirePumpEquipmentAI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['PowerFirePumpEquipmentAI'];?></h1></div>
        <div class="PowerFirePumpEquipmentNOI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['PowerFirePumpEquipmentNOI'];?></h1></div>
        <div class="PowerFirePumpEquipmentNameCellset">
          <div class="PowerFirePumpEquipmentName"><h1>動力消防ポンプ設備</h1></div>
        </div>
      </div>
      <div class="SprinklerEquipment">
        <div class="SprinklerEquipmentGR"><p><?php echo $result_firefighting_equipment_list['SprinklerEquipmentGR'];?></p></div>
        <div class="SprinklerEquipmentAI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['SprinklerEquipmentAI'];?></h1></div>
        <div class="SprinklerEquipmentNOI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['SprinklerEquipmentNOI'];?></h1></div>
        <div class="SprinklerEquipmentNameCellset">
          <div class="SprinklerEquipmentName"><h1>スプリンクラー設備</h1></div>
        </div>
      </div>
      <div class="FoamFireExtinguisher">
        <div class="FoamFireExtinguisherGR"><p><?php echo $result_firefighting_equipment_list['FoamFireExtinguisherGR'];?></p></div>
        <div class="FoamFireExtinguisherAI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['FoamFireExtinguisherAI'];?></h1></div>
        <div class="FoamFireExtinguisherNOI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['FoamFireExtinguisherNOI'];?></h1></div>
        <div class="FoamFireExtinguisherNameCellset">
          <div class="FoamFireExtinguisherName"><h1>泡消火設備</h1></div>
        </div>
      </div>
      <div class="PowderFireExtinguishingEquipment">
        <div class="PowderFireExtinguishingEquipmentGR"><p><?php echo $result_firefighting_equipment_list['PowderFireExtinguishingEquipmentGR'];?></p></div>
        <div class="PowderFireExtinguishingEquipmentAI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['PowderFireExtinguishingEquipmentAI'];?></h1></div>
        <div class="PowderFireExtinguishingEquipmentNOI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['PowderFireExtinguishingEquipmentNOI'];?></h1></div>
        <div class="PowderFireExtinguishingEquipmentNameCellset">
          <div class="PowderFireExtinguishingEquipmentName"><h1>粉末消火設備</h1></div>
        </div>
      </div>
      <div class="WaterSprayFireExtinguishingEquipment">
        <div class="WaterSprayFireExtinguishingEquipmentGR"><p><?php echo $result_firefighting_equipment_list['WaterSprayFireExtinguishingEquipmentGR'];?></p></div>
        <div class="WaterSprayFireExtinguishingEquipmentAI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['WaterSprayFireExtinguishingEquipmentAI'];?></h1></div>
        <div class="WaterSprayFireExtinguishingEquipmentNOI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['WaterSprayFireExtinguishingEquipmentNOI'];?></h1></div>
        <div class="WaterSprayFireExtinguishingEquipmentNameCellset">
          <div class="WaterSprayFireExtinguishingEquipmentName"><h1>水噴霧消火設備</h1></div>
        </div>
      </div>
      <div class="InertGasFireExtinguishingEquipment">
        <div class="InertGasFireExtinguishingEquipmentGR"><p><?php echo $result_firefighting_equipment_list['InertGasFireExtinguishingEquipmentGR'];?></p></div>
        <div class="InertGasFireExtinguishingEquipmentAI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['InertGasFireExtinguishingEquipmentAI'];?></h1></div>
        <div class="InertGasFireExtinguishingEquipmentNOI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['InertGasFireExtinguishingEquipmentNOI'];?></h1></div>
        <div class="InertGasFireExtinguishingEquipmentNameCellset">
          <div class="InertGasFireExtinguishingEquipmentName"><h1>不活性ガス消火設備</h1></div>
        </div>
      </div>
      <div class="HalideFireExtinguishingEquipment">
        <div class="HalideFireExtinguishingEquipmentGR"><p><?php echo $result_firefighting_equipment_list['HalideFireExtinguishingEquipmentGR'];?></p></div>
        <div class="HalideFireExtinguishingEquipmentAI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['HalideFireExtinguishingEquipmentAI'];?></h1></div>
        <div class="HalideFireExtinguishingEquipmentNOI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['HalideFireExtinguishingEquipmentNOI'];?></h1></div>
        <div class="HalideFireExtinguishingEquipmentNameCellset">
          <div class="HalideFireExtinguishingEquipmentName"><h1>ハロゲン化物消火設備</h1></div>
        </div>
      </div>
      <div class="OutdoorFireHydrant">
        <div class="OutdoorFireHydrantGR"><p><?php echo $result_firefighting_equipment_list['OutdoorFireHydrantGR'];?></p></div>
        <div class="OutdoorFireHydrantAI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['OutdoorFireHydrantAI'];?></h1></div>
        <div class="OutdoorFireHydrantNOI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['OutdoorFireHydrantNOI'];?></h1></div>
        <div class="OutdoorFireHydrantNameCellset">
          <div class="OutdoorFireHydrantName"><h1>屋外消火栓</h1></div>
        </div>
      </div>
      <div class="IndoorFireHydrant">
        <div class="IndoorFireHydrantGR"><p><?php echo $result_firefighting_equipment_list['IndoorFireHydrantGR'];?></p></div>
        <div class="IndoorFireHydrantAI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['IndoorFireHydrantAI'];?></h1></div>
        <div class="IndoorFireHydrantNOI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['IndoorFireHydrantNOI'];?></h1></div>
        <div class="IndoorFireHydrantNameCellset">
          <div class="IndoorFireHydrantName"><h1>屋内消火栓</h1></div>
        </div>
      </div>
      <div class="FireExtinguisher">
        <div class="FireExtinguisherGR"><p><?php echo $result_firefighting_equipment_list['FireExtinguisherGR'];?></p></div>
        <div class="FireExtinguisherAI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['FireExtinguisherAI'];?></h1></div>
        <div class="FireExtinguisherNOI"><h1 class="AI_NOI"><?php echo $result_firefighting_equipment_list['FireExtinguisherNOI'];?></h1></div>
        <div class="FireExtinguisherNameCellset">
          <div class="FireExtinguisherNameCell"><h1>消火器</h1></div>
        </div>
      </div>
      <div class="FireExtinguishingEquipmentLabel">
        <div class="FireExtinguishingEquipmentLabelArea"><h1>消火設備</h1></div>
      </div>
    </div>
    <div class="Labelcellset">
      <div class="GroundsRemarksCell">
        <div class="GroundsRemarks"></div>
        <h1>根拠・備考</h1>
      </div>
      <div class="ActualInstallationCell">
        <div class="ActualInstallation"></div>
        <h1>実際の設置</h1>
      </div>
      <div class="NecessityOfInstallationCell">
        <div class="NecessityOfInstallation"></div>
        <h1>設置の要否</h1>
      </div>
      <div class="FireEquipmentNameCell">
        <div class="FireEquipmentName"></div>
        <h1>必要な消防設備、届出等</h1>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Modaal/0.4.4/js/modaal.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
  <script src="../../../common/script/header_script.js"></script> 
  <script src="../../../common/script/datail/firefighting_equipment_list/fire_safety_manager_script.js"></script> 
</body>