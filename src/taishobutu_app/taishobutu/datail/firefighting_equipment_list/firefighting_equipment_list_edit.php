<?php
session_start();
session_regenerate_id(true);

include("/var/www/html/taishobutu_app/common/header.php");
require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';
require_once '/var/www/html/taishobutu_app/common/bettpiyo/bettpiyo_array.php';
require_once '/var/www/html/taishobutu_app/common/function.php';

$code = $_POST['code'];


$sql_firefighting_equipment_list = "SELECT * FROM firefighting_equipment_list WHERE code = :code";
$stmt_firefighting_equipment_list = $db_host->prepare($sql_firefighting_equipment_list);
$stmt_firefighting_equipment_list->bindParam(':code', $code, PDO::PARAM_INT);
$stmt_firefighting_equipment_list->execute();

$result_firefighting_equipment_list = $stmt_firefighting_equipment_list->fetch(PDO::FETCH_ASSOC);

extract($result_firefighting_equipment_list);

$equipments = [
  'StorageBatteryEquipmentAI' => $StorageBatteryEquipmentAI,
  'StorageBatteryEquipmentNOI' => $StorageBatteryEquipmentNOI,
  'InHousePowerGenerationEquipmentAI' => $InHousePowerGenerationEquipmentAI,
  'InHousePowerGenerationEquipmentNOI'=> $InHousePowerGenerationEquipmentNOI,
  'ThePowerReceivingFacilityDedicatedToAStandByPowerSourceAI' => $ThePowerReceivingFacilityDedicatedToAStandByPowerSourceAI,
  'ThePowerReceivingFacilityDedicatedToAStandByPowerSourceNOI' => $ThePowerReceivingFacilityDedicatedToAStandByPowerSourceNOI,
  'ConnectingWaterPipeAI' => $ConnectingWaterPipeAI,
  'ConnectingWaterPipeNOI'=> $ConnectingWaterPipeNOI,
  'LinkedSprinklerSystemAI' => $LinkedSprinklerSystemAI,
  'LinkedSprinklerSystemNOI' => $LinkedSprinklerSystemNOI,
  'SmokeExhaustEquipmentAI' => $SmokeExhaustEquipmentAI,
  'SmokeExhaustEquipmentNOI' => $SmokeExhaustEquipmentNOI,
  'EmergencyOutletFacilityAI' => $EmergencyOutletFacilityAI,
  'EmergencyOutletFacilityNOI' => $EmergencyOutletFacilityNOI,
  'RadioCommunicationAuxiliaryEquipmentAI'=> $RadioCommunicationAuxiliaryEquipmentAI,
  'RadioCommunicationAuxiliaryEquipmentNOI'=> $RadioCommunicationAuxiliaryEquipmentNOI,
  'FireTankAI' => $FireTankAI,
  'FireTankNOI' => $FireTankNOI,
  'GuideLightsGuideSignsAI' => $GuideLightsGuideSignsAI,
  'GuideLightsGuideSignsNOI' => $GuideLightsGuideSignsNOI,
  'SlideEscapeLadderRescueBagAI'=> $SlideEscapeLadderRescueBagAI,
  'SlideEscapeLadderRescueBagNOI' => $SlideEscapeLadderRescueBagNOI,
  'EmergencyAlarmDeviceAI'=> $EmergencyAlarmDeviceAI,
  'EmergencyAlarmDeviceNOI' => $EmergencyAlarmDeviceNOI,
  'GasLeakFireAlarmAI' => $GasLeakFireAlarmAI,
  'GasLeakFireAlarmNOI'=> $GasLeakFireAlarmNOI,
  'EarthLeakageFireAlarmAI' => $EarthLeakageFireAlarmAI,
  'EarthLeakageFireAlarmNOI' => $EarthLeakageFireAlarmNOI,
  'FireAlarmEquipmentThatNotifiesTheFireDepartmentAI' => $FireAlarmEquipmentThatNotifiesTheFireDepartmentAI,
  'FireAlarmEquipmentThatNotifiesTheFireDepartmentNOI' => $FireAlarmEquipmentThatNotifiesTheFireDepartmentNOI,
  'AutomaticFireAlarmSystemAI' => $AutomaticFireAlarmSystemAI,
  'AutomaticFireAlarmSystemNOI' => $AutomaticFireAlarmSystemNOI,
  'SimpleFireExtinguisherAI' => $SimpleFireExtinguisherAI,
  'SimpleFireExtinguisherNOI' => $SimpleFireExtinguisherNOI,
  'PowerFirePumpEquipmentAI' => $PowerFirePumpEquipmentAI,
  'PowerFirePumpEquipmentNOI' => $PowerFirePumpEquipmentNOI,
  'SprinklerEquipmentAI' => $SprinklerEquipmentAI,
  'SprinklerEquipmentNOI' => $SprinklerEquipmentNOI,
  'FoamFireExtinguisherAI' => $FoamFireExtinguisherAI,
  'FoamFireExtinguisherNOI' => $FoamFireExtinguisherNOI,
  'PowderFireExtinguishingEquipmentAI' => $PowderFireExtinguishingEquipmentAI,
  'PowderFireExtinguishingEquipmentNOI' => $PowderFireExtinguishingEquipmentNOI,
  'WaterSprayFireExtinguishingEquipmentAI' => $WaterSprayFireExtinguishingEquipmentAI,
  'WaterSprayFireExtinguishingEquipmentNOI' => $WaterSprayFireExtinguishingEquipmentNOI,
  'InertGasFireExtinguishingEquipmentAI' => $InertGasFireExtinguishingEquipmentAI,
  'InertGasFireExtinguishingEquipmentNOI' => $InertGasFireExtinguishingEquipmentNOI,
  'HalideFireExtinguishingEquipmentAI' => $HalideFireExtinguishingEquipmentAI,
  'HalideFireExtinguishingEquipmentNOI' => $HalideFireExtinguishingEquipmentNOI,
  'OutdoorFireHydrantAI' => $OutdoorFireHydrantAI,
  'OutdoorFireHydrantNOI' => $OutdoorFireHydrantNOI,
  'IndoorFireHydrantAI' => $IndoorFireHydrantAI,
  'IndoorFireHydrantNOI' => $IndoorFireHydrantNOI,
  'FireExtinguisherAI' => $FireExtinguisherAI,
  'FireExtinguisherNOI' => $FireExtinguisherNOI
];

$checkedAttributes = [];

foreach ($equipments as $key => $value) {
  $checkedAttributes[$key] = ($value === "◯") ? 'checked' : '';
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
    <link rel="stylesheet" href="http://localhost:50080/taishobutu_app/common/sass/common/header.css">
    <link rel="stylesheet" href="http://localhost:50080/taishobutu_app/common/sass/taishobutu/datail/firefighting_equipment_list/firefighting_equipment_list_show.css">
    <link rel="stylesheet" href="http://localhost:50080/taishobutu_app/common/sass/taishobutu/datail/firefighting_equipment_list/firefighting_equipment_list_add.css">


    <title>防火対象物管理アプリ</title>
</head>

<body>

  <div class="FireEquipmentLimitedQuantity">
    <form method="POST" action="http://localhost:50080/taishobutu_app/taishobutu/datail/firefighting_equipment_list/firefighting_equipment_list_edit_done.php">
      <h1 class="page_title">消防用設備等設置一覧表</h1>
      <div class="EmergencyPowerSupplyCellset">
        <div class="StorageBatteryEquipment">
          <div class="StorageBatteryEquipmentGR">
            <input type="text" name="StorageBatteryEquipmentGR" id="StorageBatteryEquipmentGR" value="<?php echo htmlspecialchars($StorageBatteryEquipmentGR);?>">
          </div>
          <div class="StorageBatteryEquipmentAI">
            <label class="toggle-switch">
                <input type="checkbox" id="StorageBatteryEquipmentAI" onclick="toggleValue(this)" <?php echo $checkedAttributes['StorageBatteryEquipmentAI']; ?>>
                <span class="toggle-slider"></span>
                <span id="StorageBatteryEquipmentAILabel"><?php echo $equipments['StorageBatteryEquipmentAI']; ?></span>
                <input type="hidden" id="StorageBatteryEquipmentAIHidden" name="StorageBatteryEquipmentAI" value=" <?php echo $equipments['StorageBatteryEquipmentAI']; ?>">
            </label>

          </div>
          <div class="StorageBatteryEquipmentNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="StorageBatteryEquipmentNOI" onclick="toggleValue(this)"<?php echo $checkedAttributes['StorageBatteryEquipmentNOI']; ?>>
                <span class="toggle-slider"></span>
                <span id="StorageBatteryEquipmentNOILabel"><?php echo $equipments['StorageBatteryEquipmentNOI']; ?></span>
                <input type="hidden" id="StorageBatteryEquipmentNOIHidden" name="StorageBatteryEquipmentNOI" value="<?php echo $equipments['StorageBatteryEquipmentNOI']; ?>">
            </label>
          </div>
          <div class="StorageBatteryEquipmentNameCellset">
            <div class="StorageBatteryEquipmentName"><h1>蓄電池設備</h1></div>
          </div>
        </div>
        <div class="InHousePowerGenerationEquipment">
          <div class="InHousePowerGenerationEquipmentGR">
            <input type="text" name="InHousePowerGenerationEquipmentGR" id="InHousePowerGenerationEquipmentGR" value="<?php echo $InHousePowerGenerationEquipmentGR;?>">
          </div>
          <div class="InHousePowerGenerationEquipmentAI">
            <label class="toggle-switch">
                <input type="checkbox" id="InHousePowerGenerationEquipmentAI" onclick="toggleValue(this)"<?php echo $checkedAttributes['InHousePowerGenerationEquipmentAI']; ?>>
                <span class="toggle-slider"></span>
                <span id="InHousePowerGenerationEquipmentAILabel"><?php echo $equipments['InHousePowerGenerationEquipmentAI']; ?></span>
                <input type="hidden" id="InHousePowerGenerationEquipmentAIHidden" name="InHousePowerGenerationEquipmentAI" value="<?php echo $equipments['InHousePowerGenerationEquipmentAI']; ?>">
            </label>
          </div>
          <div class="InHousePowerGenerationEquipmentNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="InHousePowerGenerationEquipmentNOI" onclick="toggleValue(this)"<?php echo $checkedAttributes['InHousePowerGenerationEquipmentNOI']; ?>>
                <span class="toggle-slider"></span>
                <span id="InHousePowerGenerationEquipmentNOILabel"><?php echo $equipments['InHousePowerGenerationEquipmentNOI']; ?></span>
                <input type="hidden" id="InHousePowerGenerationEquipmentNOIHidden" name="InHousePowerGenerationEquipmentNOI" value="<?php echo $equipments['InHousePowerGenerationEquipmentNOI']; ?>">
            </label>
          </div>
          <div class="InHousePowerGenerationEquipmentNameCellset">
            <div class="InHousePowerGenerationEquipmentName"><h1>自家発電設備</h1></div>
          </div>
        </div>
        <div class="ThePowerReceivingFacilityDedicatedToAStandByPowerSource">
          <div class="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceGR">
            <input type="text" name="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceGR" id="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceGR" value ="<?php echo htmlspecialchars($ThePowerReceivingFacilityDedicatedToAStandByPowerSourceGR);?>">　
          </div>
          <div class="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceAI">
            <label class="toggle-switch">
                <input type="checkbox" id="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceAI" onclick="toggleValue(this)"<?php echo $checkedAttributes['ThePowerReceivingFacilityDedicatedToAStandByPowerSourceAI']; ?>>
                <span class="toggle-slider"></span>
                <span id="IThePowerReceivingFacilityDedicatedToAStandByPowerSourceAILabel"><?php echo $equipments['ThePowerReceivingFacilityDedicatedToAStandByPowerSourceAI']; ?></span>
                <input type="hidden" id="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceAIHidden" name="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceAI" value="<?php echo $equipments['ThePowerReceivingFacilityDedicatedToAStandByPowerSourceAI']; ?>">
            </label>
          </div>
          <div class="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceNOI" onclick="toggleValue(this)"<?php echo $checkedAttributes['ThePowerReceivingFacilityDedicatedToAStandByPowerSourceNOI']; ?>>
                <span class="toggle-slider"></span>
                <span id="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceNOILabel"><?php echo $equipments['ThePowerReceivingFacilityDedicatedToAStandByPowerSourceNOI']; ?></span>
                <input type="hidden" id="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceNOIHidden" name="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceNOI" value="<?php echo $equipments['ThePowerReceivingFacilityDedicatedToAStandByPowerSourceNOI']; ?>">
            </label>
          </div>
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
          <div class="ConnectingWaterPipeGR">
            <input type="text" name="ConnectingWaterPipeGR" id="ConnectingWaterPipeGR"value ="<?php echo htmlspecialchars($ConnectingWaterPipeGR);?>">
          </div>
          <div class="ConnectingWaterPipeAI">
            <label class="toggle-switch">
                <input type="checkbox" id="ConnectingWaterPipeAI" onclick="toggleValue(this)"<?php echo $checkedAttributes['ConnectingWaterPipeAI']; ?>>
                <span class="toggle-slider"></span>
                <span id="ConnectingWaterPipeAILabel"><?php echo $equipments['ConnectingWaterPipeAI']; ?></span>
                <input type="hidden" id="ConnectingWaterPipeAIHidden" name="ConnectingWaterPipeAI" value="<?php echo $equipments['ConnectingWaterPipeAI']; ?>">
            </label>
          </div>
          <div class="ConnectingWaterPipeNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="ConnectingWaterPipeNOI" onclick="toggleValue(this)"<?php echo $checkedAttributes['ConnectingWaterPipeNOI']; ?>>
                <span class="toggle-slider"></span>
                <span id="ConnectingWaterPipeNOILabel"><?php echo $equipments['ConnectingWaterPipeNOI']; ?></span>
                <input type="hidden" id="ConnectingWaterPipeNOIHidden" name="ConnectingWaterPipeNOI" value="<?php echo $equipments['ConnectingWaterPipeNOI']; ?>">
            </label>
          </div>
          <div class="ConnectingWaterPipeNameCellset">
            <div class="ConnectingWaterPipeName"><h1>連結送水管</h1></div>
          </div>
        </div>
        <div class="LinkedSprinklerSystem">
          <div class="LinkedSprinklerSystemGR">
            <input type="text" name="LinkedSprinklerSystemGR" id="LinkedSprinklerSystemGR"value ="<?php echo htmlspecialchars($LinkedSprinklerSystemGR);?>">
          </div>
          <div class="LinkedSprinklerSystemAI">
            <label class="toggle-switch">
                <input type="checkbox" id="LinkedSprinklerSystemAI" onclick="toggleValue(this)"<?php echo $checkedAttributes['LinkedSprinklerSystemAI']; ?>>
                <span class="toggle-slider"></span>
                <span id="LinkedSprinklerSystemAILabel"><?php echo $equipments['LinkedSprinklerSystemAI']; ?></span>
                <input type="hidden" id="LinkedSprinklerSystemAIHidden" name="LinkedSprinklerSystemAI" value="<?php echo $equipments['LinkedSprinklerSystemAI']; ?>">
            </label>
          </div>
          <div class="LinkedSprinklerSystemNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="LinkedSprinklerSystemNOI" onclick="toggleValue(this)"<?php echo $checkedAttributes['LinkedSprinklerSystemNOI']; ?>>
                <span class="toggle-slider"></span>
                <span id="LinkedSprinklerSystemNOILabel"><?php echo $equipments['LinkedSprinklerSystemNOI']; ?></span>
                <input type="hidden" id="LinkedSprinklerSystemNOIHidden" name="LinkedSprinklerSystemNOI" value="<?php echo $equipments['LinkedSprinklerSystemNOI']; ?>">
            </label>
          </div>
          <div class="LinkedSprinklerSystemNameCellset">
            <div class="LinkedSprinklerSystemName"><h1>連結散水設備</h1></div>
          </div>
        </div>
        <div class="SmokeExhaustEquipment">
          <div class="SmokeExhaustEquipmentGR">
            <input type="text" name="SmokeExhaustEquipmentGR" id="SmokeExhaustEquipmentGR"value ="<?php echo htmlspecialchars($SmokeExhaustEquipmentGR);?>">
          </div>
          <div class="SmokeExhaustEquipmentAI">
            <label class="toggle-switch">
                <input type="checkbox" id="SmokeExhaustEquipmentAI" onclick="toggleValue(this)"<?php echo $checkedAttributes['SmokeExhaustEquipmentAI']; ?>>
                <span class="toggle-slider"></span>
                <span id="SmokeExhaustEquipmentAILabel"><?php echo $equipments['SmokeExhaustEquipmentAI']; ?></span>
                <input type="hidden" id="SmokeExhaustEquipmentAIHidden" name="SmokeExhaustEquipmentAI" value="<?php echo $equipments['SmokeExhaustEquipmentAI']; ?>">
            </label>
          </div>
          <div class="SmokeExhaustEquipmentNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="SmokeExhaustEquipmentNOI" onclick="toggleValue(this)"<?php echo $checkedAttributes['SmokeExhaustEquipmentNOI']; ?>>
                <span class="toggle-slider"></span>
                <span id="SmokeExhaustEquipmentNOILabel"><?php echo $equipments['SmokeExhaustEquipmentNOI']; ?></span>
                <input type="hidden" id="SmokeExhaustEquipmentNOIHidden" name="SmokeExhaustEquipmentNOI" value="<?php echo $equipments['SmokeExhaustEquipmentNOI']; ?>">
            </label>
          </div>
          <div class="SmokeExhaustEquipmentNameCellset">
            <div class="SmokeExhaustEquipmentName"><h1>排煙設備</h1></div>
          </div>
        </div>
        <div class="EmergencyOutletFacility">
          <div class="EmergencyOutletFacilityGR">
            <input type="text" name="EmergencyOutletFacilityGR" id="EmergencyOutletFacilityGR"value ="<?php echo htmlspecialchars($EmergencyOutletFacilityGR);?>">
          </div>
          <div class="EmergencyOutletFacilityAI">
            <label class="toggle-switch">
                <input type="checkbox" id="EmergencyOutletFacilityAI" onclick="toggleValue(this)"<?php echo $checkedAttributes['EmergencyOutletFacilityAI']; ?>>
                <span class="toggle-slider"></span>
                <span id="EmergencyOutletFacilityAILabel"><?php echo $equipments['EmergencyOutletFacilityAI']; ?></span>
                <input type="hidden" id="EmergencyOutletFacilityAIHidden" name="EmergencyOutletFacilityAI" value="<?php echo $equipments['EmergencyOutletFacilityAI']; ?>">
            </label>
          </div>
          <div class="EmergencyOutletFacilityNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="EmergencyOutletFacilityNOI" onclick="toggleValue(this)"<?php echo $checkedAttributes['EmergencyOutletFacilityNOI']; ?>>
                <span class="toggle-slider"></span>
                <span id="EmergencyOutletFacilityNOILabel"><?php echo $equipments['EmergencyOutletFacilityNOI']; ?></span>
                <input type="hidden" id="EmergencyOutletFacilityNOIHidden" name="EmergencyOutletFacilityNOI" value="<?php echo $equipments['EmergencyOutletFacilityNOI']; ?>">
            </label>
          </div>
          <div class="EmergencyOutletFacilityNameCellset">
            <div class="EmergencyOutletFacilityName"><h1>非常コンセント設備</h1></div>
          </div>
        </div>
        <div class="RadioCommunicationAuxiliaryEquipment">
          <div class="RadioCommunicationAuxiliaryEquipmentGR">
            <input type="text" name="RadioCommunicationAuxiliaryEquipmentGR" id="RadioCommunicationAuxiliaryEquipmentGR"value ="<?php echo htmlspecialchars($RadioCommunicationAuxiliaryEquipmentGR);?>">
          </div>
          <div class="RadioCommunicationAuxiliaryEquipmentAI">
            <label class="toggle-switch">
                <input type="checkbox" id="RadioCommunicationAuxiliaryEquipmentAI" onclick="toggleValue(this)"<?php echo $checkedAttributes['RadioCommunicationAuxiliaryEquipmentAI']; ?>>
                <span class="toggle-slider"></span>
                <span id="RadioCommunicationAuxiliaryEquipmentAILabel"><?php echo $equipments['RadioCommunicationAuxiliaryEquipmentAI']; ?></span>
                <input type="hidden" id="RadioCommunicationAuxiliaryEquipmentAIHidden" name="RadioCommunicationAuxiliaryEquipmentAI" value="<?php echo $equipments['RadioCommunicationAuxiliaryEquipmentAI']; ?>">
            </label>
          </div>
          <div class="RadioCommunicationAuxiliaryEquipmentNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="RadioCommunicationAuxiliaryEquipmentNOI" onclick="toggleValue(this)"<?php echo $checkedAttributes['RadioCommunicationAuxiliaryEquipmentNOI']; ?>>
                <span class="toggle-slider"></span>
                <span id="RadioCommunicationAuxiliaryEquipmentNOILabel"><?php echo $equipments['RadioCommunicationAuxiliaryEquipmentNOI']; ?></span>
                <input type="hidden" id="RadioCommunicationAuxiliaryEquipmentNOIHidden" name="RadioCommunicationAuxiliaryEquipmentNOI" value="<?php echo $equipments['RadioCommunicationAuxiliaryEquipmentNOI']; ?>">
            </label>
          </div>
          <div class="RadioCommunicationAuxiliaryEquipmentNameCellset">
            <div class="RadioCommunicationAuxiliaryEquipmentName"><h1>無線通信補助設備</h1></div>
          </div>
        </div>
        <div class="FireFightingFacilityLabel">
          <div class="FireFightingFacilityLabelArea"><h1>消火活動<br/>上必要な<br/> 施設</h1></div>
        </div>
      </div>
      <div class="FirefightingWaterCellset">
        <div class="FireTank">
          <div class="FireTankGR">
            <input type="text" name="FireTankGR" id="FireTankGR"value ="<?php echo htmlspecialchars($FireTankGR);?>">
          </div>
          <div class="FireTankAI">
            <label class="toggle-switch">
                <input type="checkbox" id="FireTankAI" onclick="toggleValue(this)"<?php echo $checkedAttributes['FireTankAI']; ?>>
                <span class="toggle-slider"></span>
                <span id="FireTankAILabel"><?php echo $equipments['FireTankAI']; ?></span>
                <input type="hidden" id="FireTankAIHidden" name="FireTankAI" value="<?php echo $equipments['FireTankAI']; ?>">
            </label>
          </div>
          <div class="FireTankNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="FireTankNOI" onclick="toggleValue(this)"<?php echo $checkedAttributes['FireTankNOI']; ?>>
                <span class="toggle-slider"></span>
                <span id="FireTankNOILabel"><?php echo $equipments['FireTankNOI']; ?></span>
                <input type="hidden" id="FireTankNOIHidden" name="FireTankNOI" value="<?php echo $equipments['FireTankNOI']; ?>">
            </label>
          </div>
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
          <div class="GuideLightsGuideSignsGR" >
            <input type="text" name="GuideLightsGuideSignsGR" id="GuideLightsGuideSignsGR"value ="<?php echo htmlspecialchars($GuideLightsGuideSignsGR);?>">
          </div>
          <div class="GuideLightsGuideSignsAI">
            <label class="toggle-switch">
                <input type="checkbox" id="GuideLightsGuideSignsAI" onclick="toggleValue(this)"<?php echo $checkedAttributes['GuideLightsGuideSignsAI']; ?>>
                <span class="toggle-slider"></span>
                <span id="GuideLightsGuideSignsAILabel"><?php echo $equipments['GuideLightsGuideSignsAI']; ?></span>
                <input type="hidden" id="GuideLightsGuideSignsAIHidden" name="GuideLightsGuideSignsAI" value="<?php echo $equipments['GuideLightsGuideSignsAI']; ?>">
            </label>
          </div>
          <div class="GuideLightsGuideSignsNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="GuideLightsGuideSignsNOI" onclick="toggleValue(this)"<?php echo $checkedAttributes['GuideLightsGuideSignsNOI']; ?>>
                <span class="toggle-slider"></span>
                <span id="GuideLightsGuideSignsNOILabel"><?php echo $equipments['GuideLightsGuideSignsNOI']; ?></span>
                <input type="hidden" id="GuideLightsGuideSignsNOIHidden" name="GuideLightsGuideSignsNOI" value="<?php echo $equipments['GuideLightsGuideSignsNOI']; ?>">
            </label>
          </div>
          <div class="GuideLightsGuideSignsNameCellset">
            <div class="GuideLightsGuideSignsName"><h1>誘導灯、誘導標識</h1></div>
          </div>
        </div>
        <div class="SlideEscapeLadderRescueBag">
          <div class="SlideEscapeLadderRescueBagGR">
            <input type="text" name="SlideEscapeLadderRescueBagGR" id="SlideEscapeLadderRescueBagGR"value ="<?php echo htmlspecialchars($SlideEscapeLadderRescueBagGR);?>">
          </div>
          <div class="SlideEscapeLadderRescueBagAI">
            <label class="toggle-switch">
                <input type="checkbox" id="SlideEscapeLadderRescueBagAI" onclick="toggleValue(this)"<?php echo $checkedAttributes['SlideEscapeLadderRescueBagAI']; ?>>
                <span class="toggle-slider"></span>
                <span id="SlideEscapeLadderRescueBagAILabel"><?php echo $equipments['SlideEscapeLadderRescueBagAI']; ?></span>
                <input type="hidden" id="SlideEscapeLadderRescueBagAIHidden" name="SlideEscapeLadderRescueBagAI" value="<?php echo $equipments['SlideEscapeLadderRescueBagAI']; ?>">
            </label>
          </div>
          <div class="SlideEscapeLadderRescueBagNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="SlideEscapeLadderRescueBagNOI" onclick="toggleValue(this)"<?php echo $checkedAttributes['SlideEscapeLadderRescueBagNOI']; ?>>
                <span class="toggle-slider"></span>
                <span id="SlideEscapeLadderRescueBagNOILabel"><?php echo $equipments['SlideEscapeLadderRescueBagNOI']; ?></span>
                <input type="hidden" id="SlideEscapeLadderRescueBagNOIHidden" name="SlideEscapeLadderRescueBagNOI" value="<?php echo $equipments['SlideEscapeLadderRescueBagNOI']; ?>">
            </label>
          </div>
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
          <div class="EmergencyAlarmDeviceGR">
            <input type="text" name="EmergencyAlarmDeviceGR" id="EmergencyAlarmDeviceGR"value ="<?php echo htmlspecialchars($EmergencyAlarmDeviceGR);?>">
          </div>
          <div class="EmergencyAlarmDeviceAI">
            <label class="toggle-switch">
                <input type="checkbox" id="EmergencyAlarmDeviceAI" onclick="toggleValue(this)"<?php echo $checkedAttributes['EmergencyAlarmDeviceAI']; ?>>
                <span class="toggle-slider"></span>
                <span id="EmergencyAlarmDeviceAILabel"><?php echo $equipments['EmergencyAlarmDeviceAI']; ?></span>
                <input type="hidden" id="EmergencyAlarmDeviceAIHidden" name="EmergencyAlarmDeviceAI" value="<?php echo $equipments['EmergencyAlarmDeviceAI']; ?>">
            </label>
          </div>
          <div class="EmergencyAlarmDeviceNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="EmergencyAlarmDeviceNOI" onclick="toggleValue(this)"<?php echo $checkedAttributes['EmergencyAlarmDeviceNOI']; ?>>
                <span class="toggle-slider"></span>
                <span id="EmergencyAlarmDeviceNOILabel"><?php echo $equipments['EmergencyAlarmDeviceNOI']; ?></span>
                <input type="hidden" id="EmergencyAlarmDeviceNOIHidden" name="EmergencyAlarmDeviceNOI" value="<?php echo $equipments['EmergencyAlarmDeviceNOI']; ?>">
            </label>
          </div>
          <div class="EmergencyAlarmDeviceNameCellset">
            <div class="EmergencyAlarmDeviceName"><h1>非常警報器具</h1></div>
          </div>
        </div>
        <div class="GasLeakFireAlarmNameCellset">
          <div class="GasLeakFireAlarmGR">
            <input type="text" name="GasLeakFireAlarmGR" id="GasLeakFireAlarmGR"value="<?php echo htmlspecialchars($GasLeakFireAlarmGR);?>">
          </div>
          <div class="GasLeakFireAlarmAI">
            <label class="toggle-switch">
                <input type="checkbox" id="GasLeakFireAlarmAI" onclick="toggleValue(this)"<?php echo $checkedAttributes['GasLeakFireAlarmAI']; ?>>
                <span class="toggle-slider"></span>
                <span id="asLeakFireAlarmAILabel"><?php echo $equipments['GasLeakFireAlarmAI']; ?></span>
                <input type="hidden" id="GasLeakFireAlarmAIHidden" name="GasLeakFireAlarmAI" value="<?php echo $equipments['GasLeakFireAlarmAI']; ?>">
            </label>
          </div>
          <div class="GasLeakFireAlarmNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="GasLeakFireAlarmNOI" onclick="toggleValue(this)"<?php echo $checkedAttributes['GasLeakFireAlarmNOI']; ?>>
                <span class="toggle-slider"></span>
                <span id="GasLeakFireAlarmNOILabel"><?php echo $equipments['GasLeakFireAlarmNOI']; ?></span>
                <input type="hidden" id="GasLeakFireAlarmNOIHidden" name="GasLeakFireAlarmNOI" value="<?php echo $equipments['GasLeakFireAlarmNOI']; ?>">
            </label>
          </div>
          <div class="GasLeakFireAlarmNameCellset">
            <div class="GasLeakFireAlarmName"><h1>ガス漏れ火災警報器</h1></div>
          </div>
        </div>
        <div class="EarthLeakageFireAlarm">
          <div class="EarthLeakageFireAlarmGR">
            <input type="text" name="EarthLeakageFireAlarmGR" id="EarthLeakageFireAlarmGR"value="<?php echo htmlspecialchars($EarthLeakageFireAlarmGR);?>">
          </div>
          <div class="EarthLeakageFireAlarmAI">
            <label class="toggle-switch">
                <input type="checkbox" id="EarthLeakageFireAlarmAI" onclick="toggleValue(this)"<?php echo $checkedAttributes['EarthLeakageFireAlarmAI']; ?>>
                <span class="toggle-slider"></span>
                <span id="EarthLeakageFireAlarmAILabel"><?php echo $equipments['EarthLeakageFireAlarmAI']; ?></span>
                <input type="hidden" id="EarthLeakageFireAlarmAIHidden" name="EarthLeakageFireAlarmAI" value="<?php echo $equipments['EarthLeakageFireAlarmAI']; ?>">
            </label>
          </div>
          <div class="EarthLeakageFireAlarmNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="EarthLeakageFireAlarmNOI" onclick="toggleValue(this)"<?php echo $checkedAttributes['EarthLeakageFireAlarmNOI']; ?>>
                <span class="toggle-slider"></span>
                <span id="EarthLeakageFireAlarmNOILabel"><?php echo $equipments['EarthLeakageFireAlarmNOI']; ?></span>
                <input type="hidden" id="EarthLeakageFireAlarmNOIHidden" name="EarthLeakageFireAlarmNOI" value="<?php echo $equipments['EarthLeakageFireAlarmNOI']; ?>">
            </label>
          </div>
          <div class="EarthLeakageFireAlarmNameCellset">
            <div class="EarthLeakageFireAlarmName"><h1>漏電火災警報器</h1></div>
          </div>
        </div>
        <div class="FireAlarmEquipmentThatNotifiesTheFireDepartment">
          <div class="FireAlarmEquipmentThatNotifiesTheFireDepartmentGR">
            <input type="text" name="FireAlarmEquipmentThatNotifiesTheFireDepartmentGR" id="FireAlarmEquipmentThatNotifiesTheFireDepartmentGR"value="<?php echo htmlspecialchars($FireAlarmEquipmentThatNotifiesTheFireDepartmentGR);?>">
          </div>
          <div class="FireAlarmEquipmentThatNotifiesTheFireDepartmentAI">
            <label class="toggle-switch">
                <input type="checkbox" id="FireAlarmEquipmentThatNotifiesTheFireDepartmentAI" onclick="toggleValue(this)"<?php echo $checkedAttributes['FireAlarmEquipmentThatNotifiesTheFireDepartmentAI']; ?>>
                <span class="toggle-slider"></span>
                <span id="FireAlarmEquipmentThatNotifiesTheFireDepartmentAILabel"><?php echo $equipments['FireAlarmEquipmentThatNotifiesTheFireDepartmentAI']; ?></span>
                <input type="hidden" id="FireAlarmEquipmentThatNotifiesTheFireDepartmentAIHidden" name="FireAlarmEquipmentThatNotifiesTheFireDepartmentAI" value="<?php echo $equipments['FireAlarmEquipmentThatNotifiesTheFireDepartmentAI']; ?>">
            </label>
          </div>
          <div class="FireAlarmEquipmentThatNotifiesTheFireDepartmentNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="FireAlarmEquipmentThatNotifiesTheFireDepartmentNOI" onclick="toggleValue(this)"<?php echo $checkedAttributes['FireAlarmEquipmentThatNotifiesTheFireDepartmentNOI']; ?>>
                <span class="toggle-slider"></span>
                <span id="FireAlarmEquipmentThatNotifiesTheFireDepartmentNOILabel"><?php echo $equipments['FireAlarmEquipmentThatNotifiesTheFireDepartmentNOI']; ?></span>
                <input type="hidden" id="FireAlarmEquipmentThatNotifiesTheFireDepartmentNOIHidden" name="FireAlarmEquipmentThatNotifiesTheFireDepartmentNOI" value="<?php echo $equipments['FireAlarmEquipmentThatNotifiesTheFireDepartmentNOI']; ?>">
            </label>
          </div>
          <div class="FireAlarmEquipmentThatNotifiesTheFireDepartmentNameCellset">
            <div class="FireAlarmEquipmentThatNotifiesTheFireDepartmentName"><h1>消防機関へ通報する火災報知設備</h1></div>
          </div>
        </div>
        <div class="AutomaticFireAlarmSystem">
          <div class="AutomaticFireAlarmSystemGR">
            <input type="text" name="AutomaticFireAlarmSystemGR" id="AutomaticFireAlarmSystemGR"value="<?php echo htmlspecialchars($AutomaticFireAlarmSystemGR);?>">
          </div>
          <div class="AutomaticFireAlarmSystemAI">
            <label class="toggle-switch">
                <input type="checkbox" id="AutomaticFireAlarmSystemAI" onclick="toggleValue(this)"<?php echo $checkedAttributes['AutomaticFireAlarmSystemAI']; ?>>
                <span class="toggle-slider"></span>
                <span id="AutomaticFireAlarmSystemAILabel"><?php echo $equipments['AutomaticFireAlarmSystemAI']; ?></span>
                <input type="hidden" id="AutomaticFireAlarmSystemAIHidden" name="AutomaticFireAlarmSystemAI" value="<?php echo $equipments['AutomaticFireAlarmSystemAI']; ?>">
            </label>
          </div>
          <div class="AutomaticFireAlarmSystemNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="AutomaticFireAlarmSystemNOI" onclick="toggleValue(this)"<?php echo $checkedAttributes['AutomaticFireAlarmSystemNOI']; ?>>
                <span class="toggle-slider"></span>
                <span id="AutomaticFireAlarmSystemNOILabel"><?php echo $equipments['AutomaticFireAlarmSystemNOI']; ?></span>
                <input type="hidden" id="AutomaticFireAlarmSystemNOIHidden" name="AutomaticFireAlarmSystemNOI" value="<?php echo $equipments['AutomaticFireAlarmSystemNOI']; ?>">
            </label>
          </div>
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
          <div class="SimpleFireExtinguisherGR">
            <input type="text" name="SimpleFireExtinguisherGR" id="SimpleFireExtinguisherGR"value ="<?php echo htmlspecialchars($SimpleFireExtinguisherGR);?>">
          </div>
          <div class="SimpleFireExtinguisherAI">
            <label class="toggle-switch">
                <input type="checkbox" id="SimpleFireExtinguisherAI" onclick="toggleValue(this)"<?php echo $checkedAttributes['SimpleFireExtinguisherAI']; ?>>
                <span class="toggle-slider"></span>
                <span id="SimpleFireExtinguisherAILabel"><?php echo $equipments['SimpleFireExtinguisherAI']; ?></span>
                <input type="hidden" id="SimpleFireExtinguisherAIHidden" name="SimpleFireExtinguisherAI" value="<?php echo $equipments['SimpleFireExtinguisherAI']; ?>">
            </label>
          </div>
          <div class="SimpleFireExtinguisherNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="SimpleFireExtinguisherNOI" onclick="toggleValue(this)"<?php echo $checkedAttributes['SimpleFireExtinguisherNOI']; ?>>
                <span class="toggle-slider"></span>
                <span id="SimpleFireExtinguisherNOILabel"><?php echo $equipments['SimpleFireExtinguisherNOI']; ?></span>
                <input type="hidden" id="SimpleFireExtinguisherNOIHidden" name="SimpleFireExtinguisherNOI" value="<?php echo $equipments['SimpleFireExtinguisherNOI']; ?>">
            </label>
          </div>
          <div class="SimpleFireExtinguisherNameCellset">
            <div class="SimpleFireExtinguisherName"><h1>簡易消火用具</h1></div>
          </div>
        </div>
        <div class="PowerFirePumpEquipment">
          <div class="PowerFirePumpEquipmentGR">
            <input type="text" name="PowerFirePumpEquipmentGR" id="PowerFirePumpEquipmentGR"value ="<?php echo htmlspecialchars($PowerFirePumpEquipmentGR);?>">
          </div>
          <div class="PowerFirePumpEquipmentAI">
            <label class="toggle-switch">
                <input type="checkbox" id="PowerFirePumpEquipmentAI" onclick="toggleValue(this)"<?php echo $checkedAttributes['PowerFirePumpEquipmentAI']; ?>>
                <span class="toggle-slider"></span>
                <span id="PowerFirePumpEquipmentAILabel"><?php echo $equipments['PowerFirePumpEquipmentAI']; ?></span>
                <input type="hidden" id="PowerFirePumpEquipmentAIHidden" name="PowerFirePumpEquipmentAI" value="<?php echo $equipments['PowerFirePumpEquipmentAI']; ?>">
            </label>
          </div>
          <div class="PowerFirePumpEquipmentNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="PowerFirePumpEquipmentNOI" onclick="toggleValue(this)"<?php echo $checkedAttributes['PowerFirePumpEquipmentNOI']; ?>>
                <span class="toggle-slider"></span>
                <span id="PowerFirePumpEquipmentNOILabel"><?php echo $equipments['PowerFirePumpEquipmentNOI']; ?></span>
                <input type="hidden" id="PowerFirePumpEquipmentNOIHidden" name="PowerFirePumpEquipmentNOI" value="<?php echo $equipments['PowerFirePumpEquipmentNOI']; ?>">
            </label>
          </div>
          <div class="PowerFirePumpEquipmentNameCellset">
            <div class="PowerFirePumpEquipmentName"><h1>動力消防ポンプ設備</h1></div>
          </div>
        </div>
        <div class="SprinklerEquipment">
          <div class="SprinklerEquipmentGR">
            <input type="text" name="SprinklerEquipmentGR" id="SprinklerEquipmentGR"value ="<?php echo htmlspecialchars($SprinklerEquipmentGR);?>">
          </div>
          <div class="SprinklerEquipmentAI">
            <label class="toggle-switch">
                <input type="checkbox" id="SprinklerEquipmentAI" onclick="toggleValue(this)"<?php echo $checkedAttributes['SprinklerEquipmentAI']; ?>>
                <span class="toggle-slider"></span>
                <span id="SprinklerEquipmentAILabel"><?php echo $equipments['SprinklerEquipmentAI']; ?></span>
                <input type="hidden" id="SprinklerEquipmentAIHidden" name="SprinklerEquipmentAI" value="<?php echo $equipments['SprinklerEquipmentAI']; ?>">
            </label>
          </div>
          <div class="SprinklerEquipmentNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="SprinklerEquipmentNOI" onclick="toggleValue(this)"<?php echo $checkedAttributes['SprinklerEquipmentNOI']; ?>>
                <span class="toggle-slider"></span>
                <span id="SprinklerEquipmentNOILabel"><?php echo $equipments['SprinklerEquipmentNOI']; ?></span>
                <input type="hidden" id="SprinklerEquipmentNOIHidden" name="SprinklerEquipmentNOI" value="<?php echo $equipments['SprinklerEquipmentNOI']; ?>">
            </label>
          </div>
          <div class="SprinklerEquipmentNameCellset">
            <div class="SprinklerEquipmentName"><h1>スプリンクラー設備</h1></div>
          </div>
        </div>
        <div class="FoamFireExtinguisher">
          <div class="FoamFireExtinguisherGR">
            <input type="text" name="FoamFireExtinguisherGR" id="FoamFireExtinguisherGR"value ="<?php echo htmlspecialchars($FoamFireExtinguisherGR);?>">
          </div>
          <div class="FoamFireExtinguisherAI">
            <label class="toggle-switch">
                <input type="checkbox" id="FoamFireExtinguisherAI" onclick="toggleValue(this)"<?php echo $checkedAttributes['FoamFireExtinguisherAI']; ?>>
                <span class="toggle-slider"></span>
                <span id="FoamFireExtinguisherAILabel"><?php echo $equipments['FoamFireExtinguisherAI']; ?></span>
                <input type="hidden" id="FoamFireExtinguisherAIHidden" name="FoamFireExtinguisherAI" value="<?php echo $equipments['FoamFireExtinguisherAI']; ?>">
            </label>
          </div>
          <div class="FoamFireExtinguisherNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="FoamFireExtinguisherNOI" onclick="toggleValue(this)"<?php echo $checkedAttributes['FoamFireExtinguisherNOI']; ?>>
                <span class="toggle-slider"></span>
                <span id="FoamFireExtinguisherNOILabel"><?php echo $equipments['FoamFireExtinguisherNOI']; ?></span>
                <input type="hidden" id="FoamFireExtinguisherNOIHidden" name="FoamFireExtinguisherNOI" value="<?php echo $equipments['FoamFireExtinguisherNOI']; ?>">
            </label>
          </div>
          <div class="FoamFireExtinguisherNameCellset">
            <div class="FoamFireExtinguisherName"><h1>泡消火設備</h1></div>
          </div>
        </div>
        <div class="PowderFireExtinguishingEquipment">
          <div class="PowderFireExtinguishingEquipmentGR">
            <input type="text" name="PowderFireExtinguishingEquipmentGR" id="PowderFireExtinguishingEquipmentGR"value ="<?php echo htmlspecialchars($PowderFireExtinguishingEquipmentGR);?>">
          </div>
          <div class="PowderFireExtinguishingEquipmentAI">
            <label class="toggle-switch">
                <input type="checkbox" id="PowderFireExtinguishingEquipmentAI" onclick="toggleValue(this)"<?php echo $checkedAttributes['PowderFireExtinguishingEquipmentAI']; ?>>
                <span class="toggle-slider"></span>
                <span id="PowderFireExtinguishingEquipmentAILabel"><?php echo $equipments['PowderFireExtinguishingEquipmentAI']; ?></span>
                <input type="hidden" id="PowderFireExtinguishingEquipmentAIHidden" name="PowderFireExtinguishingEquipmentAI" value="<?php echo $equipments['PowderFireExtinguishingEquipmentAI']; ?>">
            </label>
          </div>
          <div class="PowderFireExtinguishingEquipmentNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="PowderFireExtinguishingEquipmentNOI" onclick="toggleValue(this)"<?php echo $checkedAttributes['PowderFireExtinguishingEquipmentNOI']; ?>>
                <span class="toggle-slider"></span>
                <span id="PowderFireExtinguishingEquipmentNOILabel"><?php echo $equipments['PowderFireExtinguishingEquipmentNOI']; ?></span>
                <input type="hidden" id="PowderFireExtinguishingEquipmentNOIHidden" name="PowderFireExtinguishingEquipmentNOI" value="<?php echo $equipments['PowderFireExtinguishingEquipmentNOI']; ?>">
            </label>
          </div>
          <div class="PowderFireExtinguishingEquipmentNameCellset">
            <div class="PowderFireExtinguishingEquipmentName"><h1>粉末消火設備</h1></div>
          </div>
        </div>
        <div class="WaterSprayFireExtinguishingEquipment">
          <div class="WaterSprayFireExtinguishingEquipmentGR">
            <input type="text" name="WaterSprayFireExtinguishingEquipmentGR" id="WaterSprayFireExtinguishingEquipmentGR"value ="<?php echo htmlspecialchars($WaterSprayFireExtinguishingEquipmentGR);?>">
          </div>
          <div class="WaterSprayFireExtinguishingEquipmentAI">
            <label class="toggle-switch">
                <input type="checkbox" id="WaterSprayFireExtinguishingEquipmentAI" onclick="toggleValue(this)"<?php echo $checkedAttributes['WaterSprayFireExtinguishingEquipmentAI']; ?>>
                <span class="toggle-slider"></span>
                <span id="WaterSprayFireExtinguishingEquipmentAILabel"><?php echo $equipments['WaterSprayFireExtinguishingEquipmentAI']; ?></span>
                <input type="hidden" id="WaterSprayFireExtinguishingEquipmentAIHidden" name="WaterSprayFireExtinguishingEquipmentAI" value="<?php echo $equipments['WaterSprayFireExtinguishingEquipmentAI']; ?>">
            </label>
          </div>
          <div class="WaterSprayFireExtinguishingEquipmentNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="WaterSprayFireExtinguishingEquipmentNOI" onclick="toggleValue(this)"<?php echo $checkedAttributes['WaterSprayFireExtinguishingEquipmentNOI']; ?>>
                <span class="toggle-slider"></span>
                <span id="WaterSprayFireExtinguishingEquipmentNOILabel"><?php echo $equipments['WaterSprayFireExtinguishingEquipmentNOI']; ?></span>
                <input type="hidden" id="WaterSprayFireExtinguishingEquipmentNOIHidden" name="WaterSprayFireExtinguishingEquipmentNOI" value="<?php echo $equipments['WaterSprayFireExtinguishingEquipmentNOI']; ?>">
            </label>
          </div>
          <div class="WaterSprayFireExtinguishingEquipmentNameCellset">
            <div class="WaterSprayFireExtinguishingEquipmentName"><h1>水噴霧消火設備</h1></div>
          </div>
        </div>
        <div class="InertGasFireExtinguishingEquipment">
          <div class="InertGasFireExtinguishingEquipmentGR">
            <input type="text" name="InertGasFireExtinguishingEquipmentGR" id="InertGasFireExtinguishingEquipmentGR"value ="<?php echo htmlspecialchars($InertGasFireExtinguishingEquipmentGR);?>">
          </div>
          <div class="InertGasFireExtinguishingEquipmentAI">
            <label class="toggle-switch">
                <input type="checkbox" id="InertGasFireExtinguishingEquipmentAI" onclick="toggleValue(this)"<?php echo $checkedAttributes['InertGasFireExtinguishingEquipmentAI']; ?>>
                <span class="toggle-slider"></span>
                <span id="InertGasFireExtinguishingEquipmentAILabel"><?php echo $equipments['InertGasFireExtinguishingEquipmentAI']; ?></span>
                <input type="hidden" id="InertGasFireExtinguishingEquipmentAIHidden" name="InertGasFireExtinguishingEquipmentAI" value="<?php echo $equipments['InertGasFireExtinguishingEquipmentAI']; ?>">
            </label>
          </div>
          <div class="InertGasFireExtinguishingEquipmentNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="InertGasFireExtinguishingEquipmentNOI" onclick="toggleValue(this)"<?php echo $checkedAttributes['InertGasFireExtinguishingEquipmentNOI']; ?>>
                <span class="toggle-slider"></span>
                <span id="InertGasFireExtinguishingEquipmentNOILabel"><?php echo $equipments['InertGasFireExtinguishingEquipmentNOI']; ?></span>
                <input type="hidden" id="InertGasFireExtinguishingEquipmentNOIHidden" name="InertGasFireExtinguishingEquipmentNOI" value="<?php echo $equipments['InertGasFireExtinguishingEquipmentNOI']; ?>">
            </label>
          </div>
          <div class="InertGasFireExtinguishingEquipmentNameCellset">
            <div class="InertGasFireExtinguishingEquipmentName"><h1>不活性ガス消火設備</h1></div>
          </div>
        </div>
        <div class="HalideFireExtinguishingEquipment">
          <div class="HalideFireExtinguishingEquipmentGR">
            <input type="text" name="HalideFireExtinguishingEquipmentGR" id="HalideFireExtinguishingEquipmentGR"value ="<?php echo htmlspecialchars($HalideFireExtinguishingEquipmentGR);?>">
          </div>
          <div class="HalideFireExtinguishingEquipmentAI">
            <label class="toggle-switch">
                <input type="checkbox" id="HalideFireExtinguishingEquipmentAI" onclick="toggleValue(this)"<?php echo $checkedAttributes['HalideFireExtinguishingEquipmentAI']; ?>>
                <span class="toggle-slider"></span>
                <span id="HalideFireExtinguishingEquipmentAILabel"><?php echo $equipments['HalideFireExtinguishingEquipmentAI']; ?></span>
                <input type="hidden" id="HalideFireExtinguishingEquipmentAIHidden" name="HalideFireExtinguishingEquipmentAI" value="<?php echo $equipments['HalideFireExtinguishingEquipmentAI']; ?>">
            </label>
          </div>
          <div class="HalideFireExtinguishingEquipmentNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="HalideFireExtinguishingEquipmentNOI" onclick="toggleValue(this)"<?php echo $checkedAttributes['HalideFireExtinguishingEquipmentNOI']; ?>>
                <span class="toggle-slider"></span>
                <span id="HalideFireExtinguishingEquipmentNOILabel"><?php echo $equipments['HalideFireExtinguishingEquipmentNOI']; ?></span>
                <input type="hidden" id="HalideFireExtinguishingEquipmentNOIHidden" name="HalideFireExtinguishingEquipmentNOI" value="<?php echo $equipments['HalideFireExtinguishingEquipmentNOI']; ?>">
            </label>
          </div>
          <div class="HalideFireExtinguishingEquipmentNameCellset">
            <div class="HalideFireExtinguishingEquipmentName"><h1>ハロゲン化物消火設備</h1></div>
          </div>
        </div>
        <div class="OutdoorFireHydrant">
          <div class="OutdoorFireHydrantGR">
            <input type="text" name="OutdoorFireHydrantGR" id="OutdoorFireHydrantGR"value ="<?php echo htmlspecialchars($OutdoorFireHydrantGR);?>">
          </div>
          <div class="OutdoorFireHydrantAI">
            <label class="toggle-switch">
                <input type="checkbox" id="OutdoorFireHydrantAI" onclick="toggleValue(this)"<?php echo $checkedAttributes['OutdoorFireHydrantAI']; ?>>
                <span class="toggle-slider"></span>
                <span id="OutdoorFireHydrantAILabel"><?php echo $equipments['OutdoorFireHydrantAI']; ?></span>
                <input type="hidden" id="OutdoorFireHydrantAIHidden" name="OutdoorFireHydrantAI" value="<?php echo $equipments['OutdoorFireHydrantAI']; ?>">
            </label>
          </div>
          <div class="OutdoorFireHydrantNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="OutdoorFireHydrantNOI" onclick="toggleValue(this)"<?php echo $checkedAttributes['OutdoorFireHydrantNOI']; ?>>
                <span class="toggle-slider"></span>
                <span id="OutdoorFireHydrantNOILabel"><?php echo $equipments['OutdoorFireHydrantNOI']; ?></span>
                <input type="hidden" id="OutdoorFireHydrantNOIHidden" name="OutdoorFireHydrantNOI" value="<?php echo $equipments['OutdoorFireHydrantNOI']; ?>">
            </label>
          </div>
          <div class="OutdoorFireHydrantNameCellset">
            <div class="OutdoorFireHydrantName"><h1>屋外消火栓</h1></div>
          </div>
        </div>
        <div class="IndoorFireHydrant">
          <div class="IndoorFireHydrantGR">
            <input type="text" name="IndoorFireHydrantGR" id="IndoorFireHydrantGR"value ="<?php echo htmlspecialchars($IndoorFireHydrantGR);?>">
          </div>
          <div class="IndoorFireHydrantAI">
            <label class="toggle-switch">
                <input type="checkbox" id="IndoorFireHydrantAI" onclick="toggleValue(this)"<?php echo $checkedAttributes['IndoorFireHydrantAI']; ?>>
                <span class="toggle-slider"></span>
                <span id="IndoorFireHydrantAILabel"><?php echo $equipments['IndoorFireHydrantAI']; ?></span>
                <input type="hidden" id="IndoorFireHydrantAIHidden" name="IndoorFireHydrantAI" value="<?php echo $equipments['IndoorFireHydrantAI']; ?>">
            </label>
          </div>
          <div class="IndoorFireHydrantNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="IndoorFireHydrantNOI" onclick="toggleValue(this)"<?php echo $checkedAttributes['IndoorFireHydrantNOI']; ?>>
                <span class="toggle-slider"></span>
                <span id="IndoorFireHydrantNOILabel"><?php echo $equipments['IndoorFireHydrantNOI']; ?></span>
                <input type="hidden" id="IndoorFireHydrantNOIHidden" name="IndoorFireHydrantNOI" value="<?php echo $equipments['IndoorFireHydrantNOI']; ?>">
            </label>
          </div>
          <div class="IndoorFireHydrantNameCellset">
            <div class="IndoorFireHydrantName"><h1>屋内消火栓</h1></div>
          </div>
        </div>
        <div class="FireExtinguisher">
          <div class="FireExtinguisherGR">
            <input type="text" name="FireExtinguisherGR" id="FireExtinguisherGR"value ="<?php echo htmlspecialchars($FireExtinguisherGR);?>">
          </div>
          <div class="FireExtinguisherAI">
            <label class="toggle-switch">
                <input type="checkbox" id="FireExtinguisherAI" onclick="toggleValue(this)"<?php echo $checkedAttributes['FireExtinguisherAI']; ?>>
                <span class="toggle-slider"></span>
                <span id="FireExtinguisherAILabel"><?php echo $equipments['FireExtinguisherAI']; ?></span>
                <input type="hidden" id="FireExtinguisherAIHidden" name="FireExtinguisherAI" value="<?php echo $equipments['FireExtinguisherAI']; ?>">
            </label>
          </div>
          <div class="FireExtinguisherNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="FireExtinguisherNOI" onclick="toggleValue(this)"<?php echo $checkedAttributes['FireExtinguisherNOI']; ?>>
                <span class="toggle-slider"></span>
                <span id="FireExtinguisherNOILabel"><?php echo $equipments['FireExtinguisherNOI']; ?></span>
                <input type="hidden" id="FireExtinguisherNOIHidden" name="FireExtinguisherNOI" value="<?php echo $equipments['FireExtinguisherNOI']; ?>">
            </label>
          </div>
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
      <input type="hidden" name="code" value="<?php echo $code; ?>">
      <button type="submit" class="button_submit"id="equipment_add_done_button">送信</button>
    </form>
  </div>

</body>