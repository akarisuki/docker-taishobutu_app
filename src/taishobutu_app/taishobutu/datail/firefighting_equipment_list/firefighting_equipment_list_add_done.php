<?php

session_start();
session_regenerate_id(true);

require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';



$code = $_POST['code'];


$StorageBatteryEquipmentGR = $_POST['StorageBatteryEquipmentGR'];
$StorageBatteryEquipmentAI = $_POST['StorageBatteryEquipmentAI'];
$StorageBatteryEquipmentNOI = $_POST['StorageBatteryEquipmentNOI'];

$InHousePowerGenerationEquipmentGR = $_POST['InHousePowerGenerationEquipmentGR'];
$InHousePowerGenerationEquipmentAI = $_POST['InHousePowerGenerationEquipmentAI'];
$InHousePowerGenerationEquipmentNOI = $_POST['InHousePowerGenerationEquipmentNOI'];

$ThePowerReceivingFacilityDedicatedToAStandByPowerSourceGR = $_POST['ThePowerReceivingFacilityDedicatedToAStandByPowerSourceGR'];
$ThePowerReceivingFacilityDedicatedToAStandByPowerSourceAI = $_POST['ThePowerReceivingFacilityDedicatedToAStandByPowerSourceAI'];
$ThePowerReceivingFacilityDedicatedToAStandByPowerSourceNOI = $_POST['ThePowerReceivingFacilityDedicatedToAStandByPowerSourceNOI'];

$ConnectingWaterPipeGR = $_POST['ConnectingWaterPipeGR'];
$ConnectingWaterPipeAI = $_POST['ConnectingWaterPipeAI'];
$ConnectingWaterPipeNOI = $_POST['ConnectingWaterPipeNOI'];

$LinkedSprinklerSystemGR = $_POST['LinkedSprinklerSystemGR'] ;
$LinkedSprinklerSystemAI = $_POST['LinkedSprinklerSystemAI'];
$LinkedSprinklerSystemNOI = $_POST['LinkedSprinklerSystemNOI'];

$SmokeExhaustEquipmentGR = $_POST['SmokeExhaustEquipmentGR'] ;
$SmokeExhaustEquipmentAI = $_POST['SmokeExhaustEquipmentAI'];
$SmokeExhaustEquipmentNOI = $_POST['SmokeExhaustEquipmentNOI'];

$EmergencyOutletFacilityGR = $_POST['EmergencyOutletFacilityGR'];
$EmergencyOutletFacilityAI = $_POST['EmergencyOutletFacilityAI'];
$EmergencyOutletFacilityNOI = $_POST['EmergencyOutletFacilityNOI'];

$RadioCommunicationAuxiliaryEquipmentGR = $_POST['RadioCommunicationAuxiliaryEquipmentGR'];
$RadioCommunicationAuxiliaryEquipmentAI = $_POST['RadioCommunicationAuxiliaryEquipmentAI'];
$RadioCommunicationAuxiliaryEquipmentNOI = $_POST['RadioCommunicationAuxiliaryEquipmentNOI'];

$FireTankGR = $_POST['FireTankGR'];
$FireTankAI = $_POST['FireTankAI'];
$FireTankNOI = $_POST['FireTankNOI'];

$GuideLightsGuideSignsGR = $_POST['GuideLightsGuideSignsGR'];
$GuideLightsGuideSignsAI = $_POST['GuideLightsGuideSignsAI'];
$GuideLightsGuideSignsNOI = $_POST['GuideLightsGuideSignsNOI'];

$SlideEscapeLadderRescueBagGR = $_POST['SlideEscapeLadderRescueBagGR'];
$SlideEscapeLadderRescueBagAI = $_POST['SlideEscapeLadderRescueBagAI'];
$SlideEscapeLadderRescueBagNOI = $_POST['SlideEscapeLadderRescueBagNOI'];

$EmergencyAlarmDeviceGR = $_POST['EmergencyAlarmDeviceGR'];
$EmergencyAlarmDeviceAI = $_POST['EmergencyAlarmDeviceAI'];
$EmergencyAlarmDeviceNOI = $_POST['EmergencyAlarmDeviceNOI'];

$GasLeakFireAlarmGR = $_POST['GasLeakFireAlarmGR'];
$GasLeakFireAlarmAI = $_POST['GasLeakFireAlarmAI'];
$GasLeakFireAlarmNOI = $_POST['GasLeakFireAlarmNOI'];

$EarthLeakageFireAlarmGR = $_POST['EarthLeakageFireAlarmGR'];
$EarthLeakageFireAlarmAI = $_POST['EarthLeakageFireAlarmAI'];
$EarthLeakageFireAlarmNOI = $_POST['EarthLeakageFireAlarmNOI'];

$FireAlarmEquipmentThatNotifiesTheFireDepartmentGR = $_POST['FireAlarmEquipmentThatNotifiesTheFireDepartmentGR'];
$FireAlarmEquipmentThatNotifiesTheFireDepartmentAI = $_POST['FireAlarmEquipmentThatNotifiesTheFireDepartmentAI'];
$FireAlarmEquipmentThatNotifiesTheFireDepartmentNOI = $_POST['FireAlarmEquipmentThatNotifiesTheFireDepartmentNOI'];

$AutomaticFireAlarmSystemGR = $_POST['AutomaticFireAlarmSystemGR'];
$AutomaticFireAlarmSystemAI = $_POST['AutomaticFireAlarmSystemAI'];
$AutomaticFireAlarmSystemNOI = $_POST['AutomaticFireAlarmSystemNOI'];

$SimpleFireExtinguisherGR = $_POST['SimpleFireExtinguisherGR'];
$SimpleFireExtinguisherAI = $_POST['SimpleFireExtinguisherAI'];
$SimpleFireExtinguisherNOI = $_POST['SimpleFireExtinguisherNOI'];

$PowerFirePumpEquipmentGR = $_POST['PowerFirePumpEquipmentGR'];
$PowerFirePumpEquipmentAI = $_POST['PowerFirePumpEquipmentAI'];
$PowerFirePumpEquipmentNOI = $_POST['PowerFirePumpEquipmentNOI'];

$SprinklerEquipmentGR = $_POST['SprinklerEquipmentGR'];
$SprinklerEquipmentAI = $_POST['SprinklerEquipmentAI'];
$SprinklerEquipmentNOI = $_POST['SprinklerEquipmentNOI'];

$FoamFireExtinguisherGR = $_POST['FoamFireExtinguisherGR'];
$FoamFireExtinguisherAI = $_POST['FoamFireExtinguisherAI'];
$FoamFireExtinguisherNOI = $_POST['FoamFireExtinguisherNOI'];

$PowderFireExtinguishingEquipmentGR = $_POST['PowderFireExtinguishingEquipmentGR'];
$PowderFireExtinguishingEquipmentAI = $_POST['PowderFireExtinguishingEquipmentAI'];
$PowderFireExtinguishingEquipmentNOI = $_POST['PowderFireExtinguishingEquipmentNOI'];

$WaterSprayFireExtinguishingEquipmentGR = $_POST['WaterSprayFireExtinguishingEquipmentGR'];
$WaterSprayFireExtinguishingEquipmentAI = $_POST['WaterSprayFireExtinguishingEquipmentAI'];
$WaterSprayFireExtinguishingEquipmentNOI = $_POST['WaterSprayFireExtinguishingEquipmentNOI'];

$InertGasFireExtinguishingEquipmentGR = $_POST['InertGasFireExtinguishingEquipmentGR'];
$InertGasFireExtinguishingEquipmentAI = $_POST['InertGasFireExtinguishingEquipmentAI'];
$InertGasFireExtinguishingEquipmentNOI = $_POST['InertGasFireExtinguishingEquipmentNOI'];

$HalideFireExtinguishingEquipmentGR = $_POST['HalideFireExtinguishingEquipmentGR'];
$HalideFireExtinguishingEquipmentAI = $_POST['HalideFireExtinguishingEquipmentAI'];
$HalideFireExtinguishingEquipmentNOI = $_POST['HalideFireExtinguishingEquipmentNOI'];

$OutdoorFireHydrantGR = $_POST['OutdoorFireHydrantGR'];
$OutdoorFireHydrantAI = $_POST['OutdoorFireHydrantAI'];
$OutdoorFireHydrantNOI = $_POST['OutdoorFireHydrantNOI'];

$IndoorFireHydrantGR = $_POST['IndoorFireHydrantGR'];
$IndoorFireHydrantAI = $_POST['IndoorFireHydrantAI'];
$IndoorFireHydrantNOI = $_POST['IndoorFireHydrantNOI'];

$FireExtinguisherGR = $_POST['FireExtinguisherGR'];
$FireExtinguisherAI = $_POST['FireExtinguisherAI'];
$FireExtinguisherNOI = $_POST['FireExtinguisherNOI'];



$sql = <<<EOD
  INSERT INTO firefighting_equipment_list SET code = :code , StorageBatteryEquipmentGR = :StorageBatteryEquipmentGR ,StorageBatteryEquipmentAI = :StorageBatteryEquipmentAI, StorageBatteryEquipmentNOI = :StorageBatteryEquipmentNOI,
  InHousePowerGenerationEquipmentGR = :InHousePowerGenerationEquipmentGR,InHousePowerGenerationEquipmentAI = :InHousePowerGenerationEquipmentAI ,InHousePowerGenerationEquipmentNOI = :InHousePowerGenerationEquipmentNOI,
  ThePowerReceivingFacilityDedicatedToAStandByPowerSourceGR = :ThePowerReceivingFacilityDedicatedToAStandByPowerSourceGR,ThePowerReceivingFacilityDedicatedToAStandByPowerSourceAI = :ThePowerReceivingFacilityDedicatedToAStandByPowerSourceAI , ThePowerReceivingFacilityDedicatedToAStandByPowerSourceNOI = :ThePowerReceivingFacilityDedicatedToAStandByPowerSourceNOI,
  ConnectingWaterPipeGR = :ConnectingWaterPipeGR, ConnectingWaterPipeAI = :ConnectingWaterPipeAI, ConnectingWaterPipeNOI = :ConnectingWaterPipeNOI,
  LinkedSprinklerSystemGR = :LinkedSprinklerSystemGR, LinkedSprinklerSystemAI = :LinkedSprinklerSystemAI, LinkedSprinklerSystemNOI = :LinkedSprinklerSystemNOI,
  SmokeExhaustEquipmentGR = :SmokeExhaustEquipmentGR, SmokeExhaustEquipmentAI = :SmokeExhaustEquipmentAI, SmokeExhaustEquipmentNOI = :SmokeExhaustEquipmentNOI,
  EmergencyOutletFacilityGR = :EmergencyOutletFacilityGR ,EmergencyOutletFacilityAI = :EmergencyOutletFacilityAI, EmergencyOutletFacilityNOI = :EmergencyOutletFacilityNOI,
  RadioCommunicationAuxiliaryEquipmentGR = :RadioCommunicationAuxiliaryEquipmentGR, RadioCommunicationAuxiliaryEquipmentAI = :RadioCommunicationAuxiliaryEquipmentAI, RadioCommunicationAuxiliaryEquipmentNOI = :RadioCommunicationAuxiliaryEquipmentNOI,
  FireTankGR = :FireTankGR, FireTankAI = :FireTankAI, FireTankNOI = :FireTankNOI,
  GuideLightsGuideSignsGR = :GuideLightsGuideSignsGR, GuideLightsGuideSignsAI = :GuideLightsGuideSignsAI, GuideLightsGuideSignsNOI = :GuideLightsGuideSignsNOI,
  SlideEscapeLadderRescueBagGR = :SlideEscapeLadderRescueBagGR, SlideEscapeLadderRescueBagAI = :SlideEscapeLadderRescueBagAI, SlideEscapeLadderRescueBagNOI = :SlideEscapeLadderRescueBagNOI,
  EmergencyAlarmDeviceGR = :EmergencyAlarmDeviceGR, EmergencyAlarmDeviceAI = :EmergencyAlarmDeviceAI, EmergencyAlarmDeviceNOI = :EmergencyAlarmDeviceNOI,
  GasLeakFireAlarmGR = :GasLeakFireAlarmGR, GasLeakFireAlarmAI = :GasLeakFireAlarmAI, GasLeakFireAlarmNOI = :GasLeakFireAlarmNOI,
  EarthLeakageFireAlarmGR = :EarthLeakageFireAlarmGR, EarthLeakageFireAlarmAI = :EarthLeakageFireAlarmAI, EarthLeakageFireAlarmNOI = :EarthLeakageFireAlarmNOI,
  FireAlarmEquipmentThatNotifiesTheFireDepartmentGR = :FireAlarmEquipmentThatNotifiesTheFireDepartmentGR, FireAlarmEquipmentThatNotifiesTheFireDepartmentAI = :FireAlarmEquipmentThatNotifiesTheFireDepartmentAI, FireAlarmEquipmentThatNotifiesTheFireDepartmentNOI = :FireAlarmEquipmentThatNotifiesTheFireDepartmentNOI,
  AutomaticFireAlarmSystemGR = :AutomaticFireAlarmSystemGR, AutomaticFireAlarmSystemAI = :AutomaticFireAlarmSystemAI, AutomaticFireAlarmSystemNOI = :AutomaticFireAlarmSystemNOI,
  SimpleFireExtinguisherGR = :SimpleFireExtinguisherGR, SimpleFireExtinguisherAI = :SimpleFireExtinguisherAI, SimpleFireExtinguisherNOI = :SimpleFireExtinguisherNOI,
  PowerFirePumpEquipmentGR = :PowerFirePumpEquipmentGR, PowerFirePumpEquipmentAI = :PowerFirePumpEquipmentAI, PowerFirePumpEquipmentNOI = :PowerFirePumpEquipmentNOI,
  SprinklerEquipmentGR = :SprinklerEquipmentGR, SprinklerEquipmentAI = :SprinklerEquipmentAI, SprinklerEquipmentNOI = :SprinklerEquipmentNOI,
  FoamFireExtinguisherGR = :FoamFireExtinguisherGR, FoamFireExtinguisherAI = :FoamFireExtinguisherAI, FoamFireExtinguisherNOI = :FoamFireExtinguisherNOI,
  PowderFireExtinguishingEquipmentGR = :PowderFireExtinguishingEquipmentGR, PowderFireExtinguishingEquipmentAI = :PowderFireExtinguishingEquipmentAI, PowderFireExtinguishingEquipmentNOI = :PowderFireExtinguishingEquipmentNOI,
  WaterSprayFireExtinguishingEquipmentGR = :WaterSprayFireExtinguishingEquipmentGR, WaterSprayFireExtinguishingEquipmentAI = :WaterSprayFireExtinguishingEquipmentAI, WaterSprayFireExtinguishingEquipmentNOI = :WaterSprayFireExtinguishingEquipmentNOI,
  InertGasFireExtinguishingEquipmentGR = :InertGasFireExtinguishingEquipmentGR, InertGasFireExtinguishingEquipmentAI = :InertGasFireExtinguishingEquipmentAI, InertGasFireExtinguishingEquipmentNOI = :InertGasFireExtinguishingEquipmentNOI,
  HalideFireExtinguishingEquipmentGR = :HalideFireExtinguishingEquipmentGR, HalideFireExtinguishingEquipmentAI = :HalideFireExtinguishingEquipmentAI, HalideFireExtinguishingEquipmentNOI = :HalideFireExtinguishingEquipmentNOI,
  OutdoorFireHydrantGR = :OutdoorFireHydrantGR, OutdoorFireHydrantAI = :OutdoorFireHydrantAI, OutdoorFireHydrantNOI = :OutdoorFireHydrantNOI,
  IndoorFireHydrantGR = :IndoorFireHydrantGR, IndoorFireHydrantAI = :IndoorFireHydrantAI, IndoorFireHydrantNOI = :IndoorFireHydrantNOI,
  FireExtinguisherGR = :FireExtinguisherGR, FireExtinguisherAI = :FireExtinguisherAI, FireExtinguisherNOI = :FireExtinguisherNOI
EOD;


$stmt = $db_host->prepare($sql);
$stmt->bindValue(':code', $code, PDO::PARAM_INT);

$stmt->bindValue(':StorageBatteryEquipmentGR',$StorageBatteryEquipmentGR, PDO::PARAM_STR);
$stmt->bindValue(':StorageBatteryEquipmentAI',$StorageBatteryEquipmentAI, PDO::PARAM_STR);
$stmt->bindValue(':StorageBatteryEquipmentNOI',$StorageBatteryEquipmentNOI, PDO::PARAM_STR);

$stmt->bindValue(':InHousePowerGenerationEquipmentGR',$InHousePowerGenerationEquipmentGR, PDO::PARAM_STR);
$stmt->bindValue(':InHousePowerGenerationEquipmentAI',$InHousePowerGenerationEquipmentAI, PDO::PARAM_STR);
$stmt->bindValue(':InHousePowerGenerationEquipmentNOI',$InHousePowerGenerationEquipmentNOI, PDO::PARAM_STR);

$stmt->bindValue(':ThePowerReceivingFacilityDedicatedToAStandByPowerSourceGR',$ThePowerReceivingFacilityDedicatedToAStandByPowerSourceGR, PDO::PARAM_STR);
$stmt->bindValue(':ThePowerReceivingFacilityDedicatedToAStandByPowerSourceAI',$ThePowerReceivingFacilityDedicatedToAStandByPowerSourceAI, PDO::PARAM_STR);
$stmt->bindValue(':ThePowerReceivingFacilityDedicatedToAStandByPowerSourceNOI',$ThePowerReceivingFacilityDedicatedToAStandByPowerSourceNOI, PDO::PARAM_STR);

$stmt->bindValue(':ConnectingWaterPipeGR',$ConnectingWaterPipeGR, PDO::PARAM_STR);
$stmt->bindValue(':ConnectingWaterPipeAI',$ConnectingWaterPipeAI, PDO::PARAM_STR);
$stmt->bindValue(':ConnectingWaterPipeNOI',$ConnectingWaterPipeNOI, PDO::PARAM_STR);

$stmt->bindValue(':LinkedSprinklerSystemGR',$LinkedSprinklerSystemGR, PDO::PARAM_STR);
$stmt->bindValue(':LinkedSprinklerSystemAI',$LinkedSprinklerSystemAI, PDO::PARAM_STR);
$stmt->bindValue(':LinkedSprinklerSystemNOI',$LinkedSprinklerSystemNOI, PDO::PARAM_STR);

$stmt->bindValue(':SmokeExhaustEquipmentGR',$SmokeExhaustEquipmentGR, PDO::PARAM_STR);
$stmt->bindValue(':SmokeExhaustEquipmentAI',$SmokeExhaustEquipmentAI, PDO::PARAM_STR);
$stmt->bindValue(':SmokeExhaustEquipmentNOI',$SmokeExhaustEquipmentNOI, PDO::PARAM_STR);

$stmt->bindValue(':EmergencyOutletFacilityGR',$EmergencyOutletFacilityGR, PDO::PARAM_STR);
$stmt->bindValue(':EmergencyOutletFacilityAI',$EmergencyOutletFacilityAI, PDO::PARAM_STR);
$stmt->bindValue(':EmergencyOutletFacilityNOI',$EmergencyOutletFacilityNOI, PDO::PARAM_STR);

$stmt->bindValue(':RadioCommunicationAuxiliaryEquipmentGR',$RadioCommunicationAuxiliaryEquipmentGR, PDO::PARAM_STR);
$stmt->bindValue(':RadioCommunicationAuxiliaryEquipmentAI',$RadioCommunicationAuxiliaryEquipmentAI, PDO::PARAM_STR);
$stmt->bindValue(':RadioCommunicationAuxiliaryEquipmentNOI',$RadioCommunicationAuxiliaryEquipmentNOI, PDO::PARAM_STR);

$stmt->bindValue(':FireTankGR',$FireTankGR, PDO::PARAM_STR);
$stmt->bindValue(':FireTankAI',$FireTankAI, PDO::PARAM_STR);
$stmt->bindValue(':FireTankNOI',$FireTankNOI, PDO::PARAM_STR);

$stmt->bindValue(':GuideLightsGuideSignsGR',$GuideLightsGuideSignsGR, PDO::PARAM_STR);
$stmt->bindValue(':GuideLightsGuideSignsAI',$GuideLightsGuideSignsAI, PDO::PARAM_STR);
$stmt->bindValue(':GuideLightsGuideSignsNOI',$GuideLightsGuideSignsNOI, PDO::PARAM_STR);

$stmt->bindValue(':SlideEscapeLadderRescueBagGR',$SlideEscapeLadderRescueBagGR, PDO::PARAM_STR);
$stmt->bindValue(':SlideEscapeLadderRescueBagAI',$SlideEscapeLadderRescueBagAI, PDO::PARAM_STR);
$stmt->bindValue(':SlideEscapeLadderRescueBagNOI',$SlideEscapeLadderRescueBagNOI, PDO::PARAM_STR);

$stmt->bindValue(':EmergencyAlarmDeviceGR',$EmergencyAlarmDeviceGR, PDO::PARAM_STR);
$stmt->bindValue(':EmergencyAlarmDeviceAI',$EmergencyAlarmDeviceAI, PDO::PARAM_STR);
$stmt->bindValue(':EmergencyAlarmDeviceNOI',$EmergencyAlarmDeviceNOI, PDO::PARAM_STR);

$stmt->bindValue(':GasLeakFireAlarmGR',$GasLeakFireAlarmGR, PDO::PARAM_STR);
$stmt->bindValue(':GasLeakFireAlarmAI',$GasLeakFireAlarmAI, PDO::PARAM_STR);
$stmt->bindValue(':GasLeakFireAlarmNOI',$GasLeakFireAlarmNOI, PDO::PARAM_STR);

$stmt->bindValue(':EarthLeakageFireAlarmGR',$EarthLeakageFireAlarmGR, PDO::PARAM_STR);
$stmt->bindValue(':EarthLeakageFireAlarmAI',$EarthLeakageFireAlarmAI, PDO::PARAM_STR);
$stmt->bindValue(':EarthLeakageFireAlarmNOI',$EarthLeakageFireAlarmNOI, PDO::PARAM_STR);

$stmt->bindValue(':FireAlarmEquipmentThatNotifiesTheFireDepartmentGR',$FireAlarmEquipmentThatNotifiesTheFireDepartmentGR, PDO::PARAM_STR);
$stmt->bindValue(':FireAlarmEquipmentThatNotifiesTheFireDepartmentAI',$FireAlarmEquipmentThatNotifiesTheFireDepartmentAI, PDO::PARAM_STR);
$stmt->bindValue(':FireAlarmEquipmentThatNotifiesTheFireDepartmentNOI',$FireAlarmEquipmentThatNotifiesTheFireDepartmentNOI, PDO::PARAM_STR);

$stmt->bindValue(':AutomaticFireAlarmSystemGR',$AutomaticFireAlarmSystemGR, PDO::PARAM_STR);
$stmt->bindValue(':AutomaticFireAlarmSystemAI',$AutomaticFireAlarmSystemAI, PDO::PARAM_STR);
$stmt->bindValue(':AutomaticFireAlarmSystemNOI',$AutomaticFireAlarmSystemNOI, PDO::PARAM_STR);

$stmt->bindValue(':SimpleFireExtinguisherGR',$SimpleFireExtinguisherGR, PDO::PARAM_STR);
$stmt->bindValue(':SimpleFireExtinguisherAI',$SimpleFireExtinguisherAI, PDO::PARAM_STR);
$stmt->bindValue(':SimpleFireExtinguisherNOI',$SimpleFireExtinguisherNOI, PDO::PARAM_STR);

$stmt->bindValue(':PowerFirePumpEquipmentGR',$PowerFirePumpEquipmentGR, PDO::PARAM_STR);
$stmt->bindValue(':PowerFirePumpEquipmentAI',$PowerFirePumpEquipmentAI, PDO::PARAM_STR);
$stmt->bindValue(':PowerFirePumpEquipmentNOI',$PowerFirePumpEquipmentNOI, PDO::PARAM_STR);

$stmt->bindValue(':SprinklerEquipmentGR',$SprinklerEquipmentGR, PDO::PARAM_STR);
$stmt->bindValue(':SprinklerEquipmentAI',$SprinklerEquipmentAI, PDO::PARAM_STR);
$stmt->bindValue(':SprinklerEquipmentNOI',$SprinklerEquipmentNOI, PDO::PARAM_STR);

$stmt->bindValue(':FoamFireExtinguisherGR',$FoamFireExtinguisherGR, PDO::PARAM_STR);
$stmt->bindValue(':FoamFireExtinguisherAI',$FoamFireExtinguisherAI, PDO::PARAM_STR);
$stmt->bindValue(':FoamFireExtinguisherNOI',$FoamFireExtinguisherNOI, PDO::PARAM_STR);

$stmt->bindValue(':PowderFireExtinguishingEquipmentGR',$PowderFireExtinguishingEquipmentGR, PDO::PARAM_STR);
$stmt->bindValue(':PowderFireExtinguishingEquipmentAI',$PowderFireExtinguishingEquipmentAI, PDO::PARAM_STR);
$stmt->bindValue(':PowderFireExtinguishingEquipmentNOI',$PowderFireExtinguishingEquipmentNOI, PDO::PARAM_STR);

$stmt->bindValue(':WaterSprayFireExtinguishingEquipmentGR',$WaterSprayFireExtinguishingEquipmentGR, PDO::PARAM_STR);
$stmt->bindValue(':WaterSprayFireExtinguishingEquipmentAI',$WaterSprayFireExtinguishingEquipmentAI, PDO::PARAM_STR);
$stmt->bindValue(':WaterSprayFireExtinguishingEquipmentNOI',$WaterSprayFireExtinguishingEquipmentNOI, PDO::PARAM_STR);

$stmt->bindValue(':InertGasFireExtinguishingEquipmentGR',$InertGasFireExtinguishingEquipmentGR, PDO::PARAM_STR);
$stmt->bindValue(':InertGasFireExtinguishingEquipmentAI',$InertGasFireExtinguishingEquipmentAI, PDO::PARAM_STR);
$stmt->bindValue(':InertGasFireExtinguishingEquipmentNOI',$InertGasFireExtinguishingEquipmentNOI, PDO::PARAM_STR);

$stmt->bindValue(':HalideFireExtinguishingEquipmentGR',$HalideFireExtinguishingEquipmentGR, PDO::PARAM_STR);
$stmt->bindValue(':HalideFireExtinguishingEquipmentAI',$HalideFireExtinguishingEquipmentAI, PDO::PARAM_STR);
$stmt->bindValue(':HalideFireExtinguishingEquipmentNOI',$HalideFireExtinguishingEquipmentNOI, PDO::PARAM_STR);

$stmt->bindValue(':OutdoorFireHydrantGR',$OutdoorFireHydrantGR, PDO::PARAM_STR);
$stmt->bindValue(':OutdoorFireHydrantAI',$OutdoorFireHydrantAI, PDO::PARAM_STR);
$stmt->bindValue(':OutdoorFireHydrantNOI',$OutdoorFireHydrantNOI, PDO::PARAM_STR);

$stmt->bindValue(':IndoorFireHydrantGR',$IndoorFireHydrantGR, PDO::PARAM_STR);
$stmt->bindValue(':IndoorFireHydrantAI',$IndoorFireHydrantAI, PDO::PARAM_STR);
$stmt->bindValue(':IndoorFireHydrantNOI',$IndoorFireHydrantNOI, PDO::PARAM_STR);

$stmt->bindValue(':FireExtinguisherGR',$FireExtinguisherGR, PDO::PARAM_STR);
$stmt->bindValue(':FireExtinguisherAI',$FireExtinguisherAI, PDO::PARAM_STR);
$stmt->bindValue(':FireExtinguisherNOI',$FireExtinguisherNOI, PDO::PARAM_STR);

$stmt->execute();

$_SESSION['flash'] = [
  'type' => 'success',
  'message' => '追加が完了しました。'
];
$_SESSION['code'] = $code;
header('Location: http://localhost:50080/taishobutu_app/taishobutu/datail/firefighting_equipment_list/firefighting_equipment_list_show.php?code=' . urldecode($code));
exit();



?>