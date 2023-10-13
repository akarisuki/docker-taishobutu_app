<?php
session_start();
session_regenerate_id(true);

include("/var/www/html/taishobutu_app/common/header.php");
require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';
require_once '/var/www/html/taishobutu_app/common/bettpiyo/bettpiyo_array.php';
require_once '/var/www/html/taishobutu_app/common/function.php';

$code = isset($_POST['code']) ? $_POST['code'] : (isset($_GET['code']) ? $_GET['code'] : (isset($_SESSION['code']) ? $_SESSION['code'] : ''));

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
    <form method="POST" action="http://localhost:50080/taishobutu_app/taishobutu/datail/firefighting_equipment_list/firefighting_equipment_list_add_done.php">
      <h1 class="page_title">消防用設備等設置一覧表</h1>
      <div class="EmergencyPowerSupplyCellset">
        <div class="StorageBatteryEquipment">
          <div class="StorageBatteryEquipmentGR">
            <input type="text" name="StorageBatteryEquipmentGR" id="StorageBatteryEquipmentGR">
          </div>
          <div class="StorageBatteryEquipmentAI">
            <label class="toggle-switch">
                <input type="checkbox" id="StorageBatteryEquipmentAI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="StorageBatteryEquipmentAILabel">×</span>
                <input type="hidden" id="StorageBatteryEquipmentAIHidden" name="StorageBatteryEquipmentAI" value="×">
            </label>

          </div>
          <div class="StorageBatteryEquipmentNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="StorageBatteryEquipmentNOI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="StorageBatteryEquipmentNOILabel">×</span>
                <input type="hidden" id="StorageBatteryEquipmentNOIHidden" name="StorageBatteryEquipmentNOI" value="×">
            </label>
          </div>
          <div class="StorageBatteryEquipmentNameCellset">
            <div class="StorageBatteryEquipmentName"><h1>蓄電池設備</h1></div>
          </div>
        </div>
        <div class="InHousePowerGenerationEquipment">
          <div class="InHousePowerGenerationEquipmentGR">
            <input type="text" name="InHousePowerGenerationEquipmentGR" id="InHousePowerGenerationEquipmentGR">
          </div>
          <div class="InHousePowerGenerationEquipmentAI">
            <label class="toggle-switch">
                <input type="checkbox" id="InHousePowerGenerationEquipmentAI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="InHousePowerGenerationEquipmentAILabel">×</span>
                <input type="hidden" id="InHousePowerGenerationEquipmentAIHidden" name="InHousePowerGenerationEquipmentAI" value="×">
            </label>
          </div>
          <div class="InHousePowerGenerationEquipmentNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="InHousePowerGenerationEquipmentNOI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="InHousePowerGenerationEquipmentNOILabel">×</span>
                <input type="hidden" id="InHousePowerGenerationEquipmentNOIHidden" name="InHousePowerGenerationEquipmentNOI" value="×">
            </label>
          </div>
          <div class="InHousePowerGenerationEquipmentNameCellset">
            <div class="InHousePowerGenerationEquipmentName"><h1>自家発電設備</h1></div>
          </div>
        </div>
        <div class="ThePowerReceivingFacilityDedicatedToAStandByPowerSource">
          <div class="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceGR">
            <input type="text" name="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceGR" id="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceGR">　
          </div>
          <div class="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceAI">
            <label class="toggle-switch">
                <input type="checkbox" id="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceAI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="IThePowerReceivingFacilityDedicatedToAStandByPowerSourceAILabel">×</span>
                <input type="hidden" id="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceAIHidden" name="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceAI" value="×">
            </label>
          </div>
          <div class="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceNOI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceNOILabel">×</span>
                <input type="hidden" id="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceNOIHidden" name="ThePowerReceivingFacilityDedicatedToAStandByPowerSourceNOI" value="×">
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
            <input type="text" name="ConnectingWaterPipeGR" id="ConnectingWaterPipeGR">
          </div>
          <div class="ConnectingWaterPipeAI">
            <label class="toggle-switch">
                <input type="checkbox" id="ConnectingWaterPipeAI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="ConnectingWaterPipeAILabel">×</span>
                <input type="hidden" id="ConnectingWaterPipeAIHidden" name="ConnectingWaterPipeAI" value="×">
            </label>
          </div>
          <div class="ConnectingWaterPipeNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="ConnectingWaterPipeNOI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="ConnectingWaterPipeNOILabel">×</span>
                <input type="hidden" id="ConnectingWaterPipeNOIHidden" name="ConnectingWaterPipeNOI" value="×">
            </label>
          </div>
          <div class="ConnectingWaterPipeNameCellset">
            <div class="ConnectingWaterPipeName"><h1>連結送水管</h1></div>
          </div>
        </div>
        <div class="LinkedSprinklerSystem">
          <div class="LinkedSprinklerSystemGR">
            <input type="text" name="LinkedSprinklerSystemGR" id="LinkedSprinklerSystemGR">
          </div>
          <div class="LinkedSprinklerSystemAI">
            <label class="toggle-switch">
                <input type="checkbox" id="LinkedSprinklerSystemAI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="LinkedSprinklerSystemAILabel">×</span>
                <input type="hidden" id="LinkedSprinklerSystemAIHidden" name="LinkedSprinklerSystemAI" value="×">
            </label>
          </div>
          <div class="LinkedSprinklerSystemNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="LinkedSprinklerSystemNOI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="LinkedSprinklerSystemNOILabel">×</span>
                <input type="hidden" id="LinkedSprinklerSystemNOIHidden" name="LinkedSprinklerSystemNOI" value="×">
            </label>
          </div>
          <div class="LinkedSprinklerSystemNameCellset">
            <div class="LinkedSprinklerSystemName"><h1>連結散水設備</h1></div>
          </div>
        </div>
        <div class="SmokeExhaustEquipment">
          <div class="SmokeExhaustEquipmentGR">
            <input type="text" name="SmokeExhaustEquipmentGR" id="SmokeExhaustEquipmentGR">
          </div>
          <div class="SmokeExhaustEquipmentAI">
            <label class="toggle-switch">
                <input type="checkbox" id="SmokeExhaustEquipmentAI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="SmokeExhaustEquipmentAILabel">×</span>
                <input type="hidden" id="SmokeExhaustEquipmentAIHidden" name="SmokeExhaustEquipmentAI" value="×">
            </label>
          </div>
          <div class="SmokeExhaustEquipmentNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="SmokeExhaustEquipmentNOI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="SmokeExhaustEquipmentNOILabel">×</span>
                <input type="hidden" id="SmokeExhaustEquipmentNOIHidden" name="SmokeExhaustEquipmentNOI" value="×">
            </label>
          </div>
          <div class="SmokeExhaustEquipmentNameCellset">
            <div class="SmokeExhaustEquipmentName"><h1>排煙設備</h1></div>
          </div>
        </div>
        <div class="EmergencyOutletFacility">
          <div class="EmergencyOutletFacilityGR">
            <input type="text" name="EmergencyOutletFacilityGR" id="EmergencyOutletFacilityGR">
          </div>
          <div class="EmergencyOutletFacilityAI">
            <label class="toggle-switch">
                <input type="checkbox" id="EmergencyOutletFacilityAI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="EmergencyOutletFacilityAILabel">×</span>
                <input type="hidden" id="EmergencyOutletFacilityAIHidden" name="EmergencyOutletFacilityAI" value="×">
            </label>
          </div>
          <div class="EmergencyOutletFacilityNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="EmergencyOutletFacilityNOI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="EmergencyOutletFacilityNOILabel">×</span>
                <input type="hidden" id="EmergencyOutletFacilityNOIHidden" name="EmergencyOutletFacilityNOI" value="×">
            </label>
          </div>
          <div class="EmergencyOutletFacilityNameCellset">
            <div class="EmergencyOutletFacilityName"><h1>非常コンセント設備</h1></div>
          </div>
        </div>
        <div class="RadioCommunicationAuxiliaryEquipment">
          <div class="RadioCommunicationAuxiliaryEquipmentGR">
            <input type="text" name="RadioCommunicationAuxiliaryEquipmentGR" id="RadioCommunicationAuxiliaryEquipmentGR">
          </div>
          <div class="RadioCommunicationAuxiliaryEquipmentAI">
            <label class="toggle-switch">
                <input type="checkbox" id="RadioCommunicationAuxiliaryEquipmentAI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="RadioCommunicationAuxiliaryEquipmentAILabel">×</span>
                <input type="hidden" id="RadioCommunicationAuxiliaryEquipmentAIHidden" name="RadioCommunicationAuxiliaryEquipmentAI" value="×">
            </label>
          </div>
          <div class="RadioCommunicationAuxiliaryEquipmentNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="RadioCommunicationAuxiliaryEquipmentNOI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="RadioCommunicationAuxiliaryEquipmentNOILabel">×</span>
                <input type="hidden" id="RadioCommunicationAuxiliaryEquipmentNOIHidden" name="RadioCommunicationAuxiliaryEquipmentNOI" value="×">
            </label>
          </div>
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
          <div class="FireTankGR">
            <input type="text" name="FireTankGR" id="FireTankGR">
          </div>
          <div class="FireTankAI">
            <label class="toggle-switch">
                <input type="checkbox" id="FireTankAI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="FireTankAILabel">×</span>
                <input type="hidden" id="FireTankAIHidden" name="FireTankAI" value="×">
            </label>
          </div>
          <div class="FireTankNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="FireTankNOI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="FireTankNOILabel">×</span>
                <input type="hidden" id="FireTankNOIHidden" name="FireTankNOI" value="×">
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
          <div class="GuideLightsGuideSignsGR">
            <input type="text" name="GuideLightsGuideSignsGR" id="GuideLightsGuideSignsGR">
          </div>
          <div class="GuideLightsGuideSignsAI">
            <label class="toggle-switch">
                <input type="checkbox" id="GuideLightsGuideSignsAI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="GuideLightsGuideSignsAILabel">×</span>
                <input type="hidden" id="GuideLightsGuideSignsAIHidden" name="GuideLightsGuideSignsAI" value="×">
            </label>
          </div>
          <div class="GuideLightsGuideSignsNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="GuideLightsGuideSignsNOI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="GuideLightsGuideSignsNOILabel">×</span>
                <input type="hidden" id="GuideLightsGuideSignsNOIHidden" name="GuideLightsGuideSignsNOI" value="×">
            </label>
          </div>
          <div class="GuideLightsGuideSignsNameCellset">
            <div class="GuideLightsGuideSignsName"><h1>誘導灯、誘導標識</h1></div>
          </div>
        </div>
        <div class="SlideEscapeLadderRescueBag">
          <div class="SlideEscapeLadderRescueBagGR">
            <input type="text" name="SlideEscapeLadderRescueBagGR" id="SlideEscapeLadderRescueBagGR">
          </div>
          <div class="SlideEscapeLadderRescueBagAI">
            <label class="toggle-switch">
                <input type="checkbox" id="SlideEscapeLadderRescueBagAI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="SlideEscapeLadderRescueBagAILabel">×</span>
                <input type="hidden" id="SlideEscapeLadderRescueBagAIHidden" name="SlideEscapeLadderRescueBagAI" value="×">
            </label>
          </div>
          <div class="SlideEscapeLadderRescueBagNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="SlideEscapeLadderRescueBagNOI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="SlideEscapeLadderRescueBagNOILabel">×</span>
                <input type="hidden" id="SlideEscapeLadderRescueBagNOIHidden" name="SlideEscapeLadderRescueBagNOI" value="×">
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
            <input type="text" name="EmergencyAlarmDeviceGR" id="EmergencyAlarmDeviceGR">
          </div>
          <div class="EmergencyAlarmDeviceAI">
            <label class="toggle-switch">
                <input type="checkbox" id="EmergencyAlarmDeviceAI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="EmergencyAlarmDeviceAILabel">×</span>
                <input type="hidden" id="EmergencyAlarmDeviceAIHidden" name="EmergencyAlarmDeviceAI" value="×">
            </label>
          </div>
          <div class="EmergencyAlarmDeviceNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="EmergencyAlarmDeviceNOI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="EmergencyAlarmDeviceNOILabel">×</span>
                <input type="hidden" id="EmergencyAlarmDeviceNOIHidden" name="EmergencyAlarmDeviceNOI" value="×">
            </label>
          </div>
          <div class="EmergencyAlarmDeviceNameCellset">
            <div class="EmergencyAlarmDeviceName"><h1>非常警報器具</h1></div>
          </div>
        </div>
        <div class="GasLeakFireAlarmNameCellset">
          <div class="GasLeakFireAlarmGR">
            <input type="text" name="GasLeakFireAlarmGR" id="GasLeakFireAlarmGR">
          </div>
          <div class="GasLeakFireAlarmAI">
            <label class="toggle-switch">
                <input type="checkbox" id="GasLeakFireAlarmAI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="asLeakFireAlarmAILabel">×</span>
                <input type="hidden" id="GasLeakFireAlarmAIHidden" name="GasLeakFireAlarmAI" value="×">
            </label>
          </div>
          <div class="GasLeakFireAlarmNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="GasLeakFireAlarmNOI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="GasLeakFireAlarmNOILabel">×</span>
                <input type="hidden" id="GasLeakFireAlarmNOIHidden" name="GasLeakFireAlarmNOI" value="×">
            </label>
          </div>
          <div class="GasLeakFireAlarmNameCellset">
            <div class="GasLeakFireAlarmName"><h1>ガス漏れ火災警報器</h1></div>
          </div>
        </div>
        <div class="EarthLeakageFireAlarm">
          <div class="EarthLeakageFireAlarmGR">
            <input type="text" name="EarthLeakageFireAlarmGR" id="EarthLeakageFireAlarmGR">
          </div>
          <div class="EarthLeakageFireAlarmAI">
            <label class="toggle-switch">
                <input type="checkbox" id="EarthLeakageFireAlarmAI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="EarthLeakageFireAlarmAILabel">×</span>
                <input type="hidden" id="EarthLeakageFireAlarmAIHidden" name="EarthLeakageFireAlarmAI" value="×">
            </label>
          </div>
          <div class="EarthLeakageFireAlarmNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="EarthLeakageFireAlarmNOI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="EarthLeakageFireAlarmNOILabel">×</span>
                <input type="hidden" id="EarthLeakageFireAlarmNOIHidden" name="EarthLeakageFireAlarmNOI" value="×">
            </label>
          </div>
          <div class="EarthLeakageFireAlarmNameCellset">
            <div class="EarthLeakageFireAlarmName"><h1>漏電火災警報器</h1></div>
          </div>
        </div>
        <div class="FireAlarmEquipmentThatNotifiesTheFireDepartment">
          <div class="FireAlarmEquipmentThatNotifiesTheFireDepartmentGR">
            <input type="text" name="FireAlarmEquipmentThatNotifiesTheFireDepartmentGR" id="FireAlarmEquipmentThatNotifiesTheFireDepartmentGR">
          </div>
          <div class="FireAlarmEquipmentThatNotifiesTheFireDepartmentAI">
            <label class="toggle-switch">
                <input type="checkbox" id="FireAlarmEquipmentThatNotifiesTheFireDepartmentAI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="FireAlarmEquipmentThatNotifiesTheFireDepartmentAILabel">×</span>
                <input type="hidden" id="FireAlarmEquipmentThatNotifiesTheFireDepartmentAIHidden" name="FireAlarmEquipmentThatNotifiesTheFireDepartmentAI" value="×">
            </label>
          </div>
          <div class="FireAlarmEquipmentThatNotifiesTheFireDepartmentNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="FireAlarmEquipmentThatNotifiesTheFireDepartmentNOI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="FireAlarmEquipmentThatNotifiesTheFireDepartmentNOILabel">×</span>
                <input type="hidden" id="FireAlarmEquipmentThatNotifiesTheFireDepartmentNOIHidden" name="FireAlarmEquipmentThatNotifiesTheFireDepartmentNOI" value="×">
            </label>
          </div>
          <div class="FireAlarmEquipmentThatNotifiesTheFireDepartmentNameCellset">
            <div class="FireAlarmEquipmentThatNotifiesTheFireDepartmentName"><h1>消防機関へ通報する火災報知設備</h1></div>
          </div>
        </div>
        <div class="AutomaticFireAlarmSystem">
          <div class="AutomaticFireAlarmSystemGR">
            <input type="text" name="AutomaticFireAlarmSystemGR" id="AutomaticFireAlarmSystemGR">
          </div>
          <div class="AutomaticFireAlarmSystemAI">
            <label class="toggle-switch">
                <input type="checkbox" id="AutomaticFireAlarmSystemAI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="AutomaticFireAlarmSystemAILabel">×</span>
                <input type="hidden" id="AutomaticFireAlarmSystemAIHidden" name="AutomaticFireAlarmSystemAI" value="×">
            </label>
          </div>
          <div class="AutomaticFireAlarmSystemNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="AutomaticFireAlarmSystemNOI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="AutomaticFireAlarmSystemNOILabel">×</span>
                <input type="hidden" id="AutomaticFireAlarmSystemNOIHidden" name="AutomaticFireAlarmSystemNOI" value="×">
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
            <input type="text" name="SimpleFireExtinguisherGR" id="SimpleFireExtinguisherGR">
          </div>
          <div class="SimpleFireExtinguisherAI">
            <label class="toggle-switch">
                <input type="checkbox" id="SimpleFireExtinguisherAI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="SimpleFireExtinguisherAILabel">×</span>
                <input type="hidden" id="SimpleFireExtinguisherAIHidden" name="SimpleFireExtinguisherAI" value="×">
            </label>
          </div>
          <div class="SimpleFireExtinguisherNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="SimpleFireExtinguisherNOI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="SimpleFireExtinguisherNOILabel">×</span>
                <input type="hidden" id="SimpleFireExtinguisherNOIHidden" name="SimpleFireExtinguisherNOI" value="×">
            </label>
          </div>
          <div class="SimpleFireExtinguisherNameCellset">
            <div class="SimpleFireExtinguisherName"><h1>簡易消火用具</h1></div>
          </div>
        </div>
        <div class="PowerFirePumpEquipment">
          <div class="PowerFirePumpEquipmentGR">
            <input type="text" name="PowerFirePumpEquipmentGR" id="PowerFirePumpEquipmentGR">
          </div>
          <div class="PowerFirePumpEquipmentAI">
            <label class="toggle-switch">
                <input type="checkbox" id="PowerFirePumpEquipmentAI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="PowerFirePumpEquipmentAILabel">×</span>
                <input type="hidden" id="PowerFirePumpEquipmentAIHidden" name="PowerFirePumpEquipmentAI" value="×">
            </label>
          </div>
          <div class="PowerFirePumpEquipmentNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="PowerFirePumpEquipmentNOI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="PowerFirePumpEquipmentNOILabel">×</span>
                <input type="hidden" id="PowerFirePumpEquipmentNOIHidden" name="PowerFirePumpEquipmentNOI" value="×">
            </label>
          </div>
          <div class="PowerFirePumpEquipmentNameCellset">
            <div class="PowerFirePumpEquipmentName"><h1>動力消防ポンプ設備</h1></div>
          </div>
        </div>
        <div class="SprinklerEquipment">
          <div class="SprinklerEquipmentGR">
            <input type="text" name="SprinklerEquipmentGR" id="SprinklerEquipmentGR">
          </div>
          <div class="SprinklerEquipmentAI">
            <label class="toggle-switch">
                <input type="checkbox" id="SprinklerEquipmentAI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="SprinklerEquipmentAILabel">×</span>
                <input type="hidden" id="SprinklerEquipmentAIHidden" name="SprinklerEquipmentAI" value="×">
            </label>
          </div>
          <div class="SprinklerEquipmentNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="SprinklerEquipmentNOI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="SprinklerEquipmentNOILabel">×</span>
                <input type="hidden" id="SprinklerEquipmentNOIHidden" name="SprinklerEquipmentNOI" value="×">
            </label>
          </div>
          <div class="SprinklerEquipmentNameCellset">
            <div class="SprinklerEquipmentName"><h1>スプリンクラー設備</h1></div>
          </div>
        </div>
        <div class="FoamFireExtinguisher">
          <div class="FoamFireExtinguisherGR">
            <input type="text" name="FoamFireExtinguisherGR" id="FoamFireExtinguisherGR">
          </div>
          <div class="FoamFireExtinguisherAI">
            <label class="toggle-switch">
                <input type="checkbox" id="FoamFireExtinguisherAI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="FoamFireExtinguisherAILabel">×</span>
                <input type="hidden" id="FoamFireExtinguisherAIHidden" name="FoamFireExtinguisherAI" value="×">
            </label>
          </div>
          <div class="FoamFireExtinguisherNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="FoamFireExtinguisherNOI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="FoamFireExtinguisherNOILabel">×</span>
                <input type="hidden" id="FoamFireExtinguisherNOIHidden" name="FoamFireExtinguisherNOI" value="×">
            </label>
          </div>
          <div class="FoamFireExtinguisherNameCellset">
            <div class="FoamFireExtinguisherName"><h1>泡消火設備</h1></div>
          </div>
        </div>
        <div class="PowderFireExtinguishingEquipment">
          <div class="PowderFireExtinguishingEquipmentGR">
            <input type="text" name="PowderFireExtinguishingEquipmentGR" id="PowderFireExtinguishingEquipmentGR">
          </div>
          <div class="PowderFireExtinguishingEquipmentAI">
            <label class="toggle-switch">
                <input type="checkbox" id="PowderFireExtinguishingEquipmentAI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="PowderFireExtinguishingEquipmentAILabel">×</span>
                <input type="hidden" id="PowderFireExtinguishingEquipmentAIHidden" name="PowderFireExtinguishingEquipmentAI" value="×">
            </label>
          </div>
          <div class="PowderFireExtinguishingEquipmentNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="PowderFireExtinguishingEquipmentNOI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="PowderFireExtinguishingEquipmentNOILabel">×</span>
                <input type="hidden" id="PowderFireExtinguishingEquipmentNOIHidden" name="PowderFireExtinguishingEquipmentNOI" value="×">
            </label>
          </div>
          <div class="PowderFireExtinguishingEquipmentNameCellset">
            <div class="PowderFireExtinguishingEquipmentName"><h1>粉末消火設備</h1></div>
          </div>
        </div>
        <div class="WaterSprayFireExtinguishingEquipment">
          <div class="WaterSprayFireExtinguishingEquipmentGR">
            <input type="text" name="WaterSprayFireExtinguishingEquipmentGR" id="WaterSprayFireExtinguishingEquipmentGR">
          </div>
          <div class="WaterSprayFireExtinguishingEquipmentAI">
            <label class="toggle-switch">
                <input type="checkbox" id="WaterSprayFireExtinguishingEquipmentAI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="WaterSprayFireExtinguishingEquipmentAILabel">×</span>
                <input type="hidden" id="WaterSprayFireExtinguishingEquipmentAIHidden" name="WaterSprayFireExtinguishingEquipmentAI" value="×">
            </label>
          </div>
          <div class="WaterSprayFireExtinguishingEquipmentNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="WaterSprayFireExtinguishingEquipmentNOI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="WaterSprayFireExtinguishingEquipmentNOILabel">×</span>
                <input type="hidden" id="WaterSprayFireExtinguishingEquipmentNOIHidden" name="WaterSprayFireExtinguishingEquipmentNOI" value="×">
            </label>
          </div>
          <div class="WaterSprayFireExtinguishingEquipmentNameCellset">
            <div class="WaterSprayFireExtinguishingEquipmentName"><h1>水噴霧消火設備</h1></div>
          </div>
        </div>
        <div class="InertGasFireExtinguishingEquipment">
          <div class="InertGasFireExtinguishingEquipmentGR">
            <input type="text" name="InertGasFireExtinguishingEquipmentGR" id="InertGasFireExtinguishingEquipmentGR">
          </div>
          <div class="InertGasFireExtinguishingEquipmentAI">
            <label class="toggle-switch">
                <input type="checkbox" id="InertGasFireExtinguishingEquipmentAI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="InertGasFireExtinguishingEquipmentAILabel">×</span>
                <input type="hidden" id="InertGasFireExtinguishingEquipmentAIHidden" name="InertGasFireExtinguishingEquipmentAI" value="×">
            </label>
          </div>
          <div class="InertGasFireExtinguishingEquipmentNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="InertGasFireExtinguishingEquipmentNOI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="InertGasFireExtinguishingEquipmentNOILabel">×</span>
                <input type="hidden" id="InertGasFireExtinguishingEquipmentNOIHidden" name="InertGasFireExtinguishingEquipmentNOI" value="×">
            </label>
          </div>
          <div class="InertGasFireExtinguishingEquipmentNameCellset">
            <div class="InertGasFireExtinguishingEquipmentName"><h1>不活性ガス消火設備</h1></div>
          </div>
        </div>
        <div class="HalideFireExtinguishingEquipment">
          <div class="HalideFireExtinguishingEquipmentGR">
            <input type="text" name="HalideFireExtinguishingEquipmentGR" id="HalideFireExtinguishingEquipmentGR">
          </div>
          <div class="HalideFireExtinguishingEquipmentAI">
            <label class="toggle-switch">
                <input type="checkbox" id="HalideFireExtinguishingEquipmentAI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="HalideFireExtinguishingEquipmentAILabel">×</span>
                <input type="hidden" id="HalideFireExtinguishingEquipmentAIHidden" name="HalideFireExtinguishingEquipmentAI" value="×">
            </label>
          </div>
          <div class="HalideFireExtinguishingEquipmentNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="HalideFireExtinguishingEquipmentNOI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="HalideFireExtinguishingEquipmentNOILabel">×</span>
                <input type="hidden" id="HalideFireExtinguishingEquipmentNOIHidden" name="HalideFireExtinguishingEquipmentNOI" value="×">
            </label>
          </div>
          <div class="HalideFireExtinguishingEquipmentNameCellset">
            <div class="HalideFireExtinguishingEquipmentName"><h1>ハロゲン化物消火設備</h1></div>
          </div>
        </div>
        <div class="OutdoorFireHydrant">
          <div class="OutdoorFireHydrantGR">
            <input type="text" name="OutdoorFireHydrantGR" id="OutdoorFireHydrantGR">
          </div>
          <div class="OutdoorFireHydrantAI">
            <label class="toggle-switch">
                <input type="checkbox" id="OutdoorFireHydrantAI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="OutdoorFireHydrantAILabel">×</span>
                <input type="hidden" id="OutdoorFireHydrantAIHidden" name="OutdoorFireHydrantAI" value="×">
            </label>
          </div>
          <div class="OutdoorFireHydrantNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="OutdoorFireHydrantNOI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="OutdoorFireHydrantNOILabel">×</span>
                <input type="hidden" id="OutdoorFireHydrantNOIHidden" name="OutdoorFireHydrantNOI" value="×">
            </label>
          </div>
          <div class="OutdoorFireHydrantNameCellset">
            <div class="OutdoorFireHydrantName"><h1>屋外消火栓</h1></div>
          </div>
        </div>
        <div class="IndoorFireHydrant">
          <div class="IndoorFireHydrantGR">
            <input type="text" name="IndoorFireHydrantGR" id="IndoorFireHydrantGR">
          </div>
          <div class="IndoorFireHydrantAI">
            <label class="toggle-switch">
                <input type="checkbox" id="IndoorFireHydrantAI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="IndoorFireHydrantAILabel">×</span>
                <input type="hidden" id="IndoorFireHydrantAIHidden" name="IndoorFireHydrantAI" value="×">
            </label>
          </div>
          <div class="IndoorFireHydrantNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="IndoorFireHydrantNOI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="IndoorFireHydrantNOILabel">×</span>
                <input type="hidden" id="IndoorFireHydrantNOIHidden" name="IndoorFireHydrantNOI" value="×">
            </label>
          </div>
          <div class="IndoorFireHydrantNameCellset">
            <div class="IndoorFireHydrantName"><h1>屋内消火栓</h1></div>
          </div>
        </div>
        <div class="FireExtinguisher">
          <div class="FireExtinguisherGR">
            <input type="text" name="FireExtinguisherGR" id="FireExtinguisherGR">
          </div>
          <div class="FireExtinguisherAI">
            <label class="toggle-switch">
                <input type="checkbox" id="FireExtinguisherAI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="FireExtinguisherAILabel">×</span>
                <input type="hidden" id="FireExtinguisherAIHidden" name="FireExtinguisherAI" value="×">
            </label>
          </div>
          <div class="FireExtinguisherNOI">
            <label class="toggle-switch">
                <input type="checkbox" id="FireExtinguisherNOI" onclick="toggleValue(this)">
                <span class="toggle-slider"></span>
                <span id="FireExtinguisherNOILabel">×</span>
                <input type="hidden" id="FireExtinguisherNOIHidden" name="FireExtinguisherNOI" value="×">
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