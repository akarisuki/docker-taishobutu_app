-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: db:3306
-- 生成日時: 2023 年 11 月 27 日 12:55
-- サーバのバージョン： 8.0.28
-- PHP のバージョン: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `taishobutu`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `firedept_staff`
--

CREATE TABLE `firedept_staff` (
  `code` int NOT NULL,
  `staff_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_pass` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fire_dept_code` int NOT NULL COMMENT '消防署コード'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- テーブルのデータのダンプ `firedept_staff`
--

INSERT INTO `firedept_staff` (`code`, `staff_name`, `staff_pass`, `fire_dept_code`) VALUES
(35, 'あかりすき', '$2y$10$UWR8TFTqxSdXJF6wPjRpnO4a8pRxAzd.iigMtEqGINXjNjnV7hW/a', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `firefighting_equipment_list`
--

CREATE TABLE `firefighting_equipment_list` (
  `id` int NOT NULL,
  `code` int NOT NULL,
  `FireExtinguisherNOI` varchar(1) NOT NULL COMMENT '消火器（設置の要否）',
  `FireExtinguisherAI` varchar(1) NOT NULL COMMENT '消火器（実施の設置）',
  `FireExtinguisherGR` varchar(50) NOT NULL COMMENT '消火器（備考）',
  `IndoorFireHydrantNOI` varchar(1) NOT NULL COMMENT '屋内消火栓',
  `IndoorFireHydrantAI` varchar(1) NOT NULL COMMENT '屋内消火栓',
  `IndoorFireHydrantGR` varchar(50) NOT NULL COMMENT '屋内消火栓',
  `OutdoorFireHydrantNOI` varchar(1) NOT NULL COMMENT '屋外消火栓',
  `OutdoorFireHydrantAI` varchar(1) NOT NULL COMMENT '屋外消火栓',
  `OutdoorFireHydrantGR` varchar(50) NOT NULL COMMENT '屋外消火栓',
  `HalideFireExtinguishingEquipmentNOI` varchar(1) NOT NULL COMMENT 'ハロゲン化物消火設備',
  `HalideFireExtinguishingEquipmentAI` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'ハロゲン化物消火設備',
  `HalideFireExtinguishingEquipmentGR` varchar(50) NOT NULL COMMENT 'ハロゲン化物消火設備',
  `InertGasFireExtinguishingEquipmentNOI` varchar(1) NOT NULL COMMENT '不活性ガス消火設備',
  `InertGasFireExtinguishingEquipmentAI` varchar(1) NOT NULL COMMENT '不活性ガス消火設備',
  `InertGasFireExtinguishingEquipmentGR` varchar(50) NOT NULL COMMENT '不活性ガス消火設備',
  `WaterSprayFireExtinguishingEquipmentNOI` varchar(1) NOT NULL COMMENT '水噴霧消火設備',
  `WaterSprayFireExtinguishingEquipmentAI` varchar(1) NOT NULL COMMENT '水噴霧消火設備',
  `WaterSprayFireExtinguishingEquipmentGR` varchar(50) NOT NULL COMMENT '水噴霧消火設備',
  `PowderFireExtinguishingEquipmentNOI` varchar(1) NOT NULL COMMENT '粉末消火設備',
  `PowderFireExtinguishingEquipmentAI` varchar(1) NOT NULL COMMENT '粉末消火設備',
  `PowderFireExtinguishingEquipmentGR` varchar(50) NOT NULL COMMENT '粉末消火設備',
  `FoamFireExtinguisherNOI` varchar(1) NOT NULL COMMENT '泡消火設備',
  `FoamFireExtinguisherAI` varchar(1) NOT NULL COMMENT '泡消火設備',
  `FoamFireExtinguisherGR` varchar(50) NOT NULL COMMENT '泡消火設備',
  `SprinklerEquipmentNOI` varchar(1) NOT NULL COMMENT 'スプリンクラー設備',
  `SprinklerEquipmentAI` varchar(1) NOT NULL COMMENT 'スプリンクラー設備',
  `SprinklerEquipmentGR` varchar(50) NOT NULL COMMENT 'スプリンクラー設備',
  `PowerFirePumpEquipmentNOI` varchar(1) NOT NULL COMMENT '動力消防ポンプ設備',
  `PowerFirePumpEquipmentAI` varchar(1) NOT NULL COMMENT '動力消防ポンプ設備',
  `PowerFirePumpEquipmentGR` varchar(50) NOT NULL COMMENT '動力消防ポンプ設備',
  `SimpleFireExtinguisherNOI` varchar(1) NOT NULL COMMENT '簡易消火用具',
  `SimpleFireExtinguisherAI` varchar(1) NOT NULL COMMENT '簡易消火用具',
  `SimpleFireExtinguisherGR` varchar(50) NOT NULL COMMENT '簡易消火用具',
  `AutomaticFireAlarmSystemNOI` varchar(1) NOT NULL COMMENT '自動火災報知設備',
  `AutomaticFireAlarmSystemAI` varchar(1) NOT NULL COMMENT '自動火災報知設備',
  `AutomaticFireAlarmSystemGR` varchar(50) NOT NULL COMMENT '自動火災報知設備',
  `FireAlarmEquipmentThatNotifiesTheFireDepartmentNOI` varchar(1) NOT NULL COMMENT '消防機関へ通報する火災報知設備',
  `FireAlarmEquipmentThatNotifiesTheFireDepartmentAI` varchar(1) NOT NULL COMMENT '消防機関へ通報する火災報知設備',
  `FireAlarmEquipmentThatNotifiesTheFireDepartmentGR` varchar(50) NOT NULL COMMENT '消防機関へ通報する火災報知設備',
  `EarthLeakageFireAlarmNOI` varchar(1) NOT NULL COMMENT '漏電火災警報器',
  `EarthLeakageFireAlarmAI` varchar(1) NOT NULL COMMENT '漏電火災警報器',
  `EarthLeakageFireAlarmGR` varchar(50) NOT NULL COMMENT '漏電火災警報器',
  `GasLeakFireAlarmNOI` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'ガス漏れ火災警報器',
  `GasLeakFireAlarmAI` varchar(1) NOT NULL COMMENT 'ガス漏れ火災警報器',
  `GasLeakFireAlarmGR` varchar(50) NOT NULL COMMENT 'ガス漏れ火災警報器',
  `EmergencyAlarmDeviceNOI` varchar(1) NOT NULL COMMENT '非常警報器具',
  `EmergencyAlarmDeviceAI` varchar(1) NOT NULL COMMENT '非常警報器具',
  `EmergencyAlarmDeviceGR` varchar(50) NOT NULL COMMENT '非常警報器具',
  `SlideEscapeLadderRescueBagNOI` varchar(1) NOT NULL COMMENT '滑り台、避難はしご、救助袋など',
  `SlideEscapeLadderRescueBagAI` varchar(1) NOT NULL COMMENT '滑り台、避難はしご、救助袋など',
  `SlideEscapeLadderRescueBagGR` varchar(50) NOT NULL COMMENT '滑り台、避難はしご、救助袋など',
  `GuideLightsGuideSignsNOI` varchar(1) NOT NULL COMMENT '誘導灯、誘導標識',
  `GuideLightsGuideSignsAI` varchar(1) NOT NULL COMMENT '誘導灯、誘導標識',
  `GuideLightsGuideSignsGR` varchar(50) NOT NULL COMMENT '誘導灯、誘導標識',
  `FireTankNOI` varchar(1) NOT NULL COMMENT '防火水槽など',
  `FireTankAI` varchar(1) NOT NULL COMMENT '防火水槽など',
  `FireTankGR` varchar(50) NOT NULL COMMENT '防火水槽など',
  `RadioCommunicationAuxiliaryEquipmentNOI` varchar(1) NOT NULL COMMENT '無線通信補助設備',
  `RadioCommunicationAuxiliaryEquipmentAI` varchar(1) NOT NULL COMMENT '無線通信補助設備',
  `RadioCommunicationAuxiliaryEquipmentGR` varchar(50) NOT NULL COMMENT '無線通信補助設備',
  `EmergencyOutletFacilityNOI` varchar(1) NOT NULL COMMENT '非常コンセント設備',
  `EmergencyOutletFacilityAI` varchar(1) NOT NULL COMMENT '非常コンセント設備',
  `EmergencyOutletFacilityGR` varchar(50) NOT NULL COMMENT '非常コンセント設備',
  `SmokeExhaustEquipmentNOI` varchar(1) NOT NULL COMMENT '排煙設備',
  `SmokeExhaustEquipmentAI` varchar(1) NOT NULL COMMENT '排煙設備',
  `SmokeExhaustEquipmentGR` varchar(50) NOT NULL COMMENT '排煙設備',
  `LinkedSprinklerSystemNOI` varchar(1) NOT NULL COMMENT '連結散水設備',
  `LinkedSprinklerSystemAI` varchar(1) NOT NULL COMMENT '連結散水設備',
  `LinkedSprinklerSystemGR` varchar(50) NOT NULL COMMENT '連結散水設備',
  `ConnectingWaterPipeNOI` varchar(1) NOT NULL COMMENT '連結送水管',
  `ConnectingWaterPipeAI` varchar(1) NOT NULL COMMENT '連結送水管',
  `ConnectingWaterPipeGR` varchar(50) NOT NULL COMMENT '連結送水管',
  `ThePowerReceivingFacilityDedicatedToAStandByPowerSourceNOI` varchar(1) NOT NULL COMMENT '非常電源専用受電設備',
  `ThePowerReceivingFacilityDedicatedToAStandByPowerSourceAI` varchar(1) NOT NULL COMMENT '非常電源専用受電設備',
  `ThePowerReceivingFacilityDedicatedToAStandByPowerSourceGR` varchar(50) NOT NULL COMMENT '非常電源専用受電設備',
  `InHousePowerGenerationEquipmentNOI` varchar(1) NOT NULL COMMENT '自家発電設備',
  `InHousePowerGenerationEquipmentAI` varchar(1) NOT NULL COMMENT '自家発電設備',
  `InHousePowerGenerationEquipmentGR` varchar(50) NOT NULL COMMENT '自家発電設備',
  `StorageBatteryEquipmentNOI` varchar(1) NOT NULL COMMENT '蓄電池設備',
  `StorageBatteryEquipmentAI` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '蓄電池設備',
  `StorageBatteryEquipmentGR` varchar(50) NOT NULL COMMENT '蓄電池設備'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- テーブルのデータのダンプ `firefighting_equipment_list`
--

INSERT INTO `firefighting_equipment_list` (`id`, `code`, `FireExtinguisherNOI`, `FireExtinguisherAI`, `FireExtinguisherGR`, `IndoorFireHydrantNOI`, `IndoorFireHydrantAI`, `IndoorFireHydrantGR`, `OutdoorFireHydrantNOI`, `OutdoorFireHydrantAI`, `OutdoorFireHydrantGR`, `HalideFireExtinguishingEquipmentNOI`, `HalideFireExtinguishingEquipmentAI`, `HalideFireExtinguishingEquipmentGR`, `InertGasFireExtinguishingEquipmentNOI`, `InertGasFireExtinguishingEquipmentAI`, `InertGasFireExtinguishingEquipmentGR`, `WaterSprayFireExtinguishingEquipmentNOI`, `WaterSprayFireExtinguishingEquipmentAI`, `WaterSprayFireExtinguishingEquipmentGR`, `PowderFireExtinguishingEquipmentNOI`, `PowderFireExtinguishingEquipmentAI`, `PowderFireExtinguishingEquipmentGR`, `FoamFireExtinguisherNOI`, `FoamFireExtinguisherAI`, `FoamFireExtinguisherGR`, `SprinklerEquipmentNOI`, `SprinklerEquipmentAI`, `SprinklerEquipmentGR`, `PowerFirePumpEquipmentNOI`, `PowerFirePumpEquipmentAI`, `PowerFirePumpEquipmentGR`, `SimpleFireExtinguisherNOI`, `SimpleFireExtinguisherAI`, `SimpleFireExtinguisherGR`, `AutomaticFireAlarmSystemNOI`, `AutomaticFireAlarmSystemAI`, `AutomaticFireAlarmSystemGR`, `FireAlarmEquipmentThatNotifiesTheFireDepartmentNOI`, `FireAlarmEquipmentThatNotifiesTheFireDepartmentAI`, `FireAlarmEquipmentThatNotifiesTheFireDepartmentGR`, `EarthLeakageFireAlarmNOI`, `EarthLeakageFireAlarmAI`, `EarthLeakageFireAlarmGR`, `GasLeakFireAlarmNOI`, `GasLeakFireAlarmAI`, `GasLeakFireAlarmGR`, `EmergencyAlarmDeviceNOI`, `EmergencyAlarmDeviceAI`, `EmergencyAlarmDeviceGR`, `SlideEscapeLadderRescueBagNOI`, `SlideEscapeLadderRescueBagAI`, `SlideEscapeLadderRescueBagGR`, `GuideLightsGuideSignsNOI`, `GuideLightsGuideSignsAI`, `GuideLightsGuideSignsGR`, `FireTankNOI`, `FireTankAI`, `FireTankGR`, `RadioCommunicationAuxiliaryEquipmentNOI`, `RadioCommunicationAuxiliaryEquipmentAI`, `RadioCommunicationAuxiliaryEquipmentGR`, `EmergencyOutletFacilityNOI`, `EmergencyOutletFacilityAI`, `EmergencyOutletFacilityGR`, `SmokeExhaustEquipmentNOI`, `SmokeExhaustEquipmentAI`, `SmokeExhaustEquipmentGR`, `LinkedSprinklerSystemNOI`, `LinkedSprinklerSystemAI`, `LinkedSprinklerSystemGR`, `ConnectingWaterPipeNOI`, `ConnectingWaterPipeAI`, `ConnectingWaterPipeGR`, `ThePowerReceivingFacilityDedicatedToAStandByPowerSourceNOI`, `ThePowerReceivingFacilityDedicatedToAStandByPowerSourceAI`, `ThePowerReceivingFacilityDedicatedToAStandByPowerSourceGR`, `InHousePowerGenerationEquipmentNOI`, `InHousePowerGenerationEquipmentAI`, `InHousePowerGenerationEquipmentGR`, `StorageBatteryEquipmentNOI`, `StorageBatteryEquipmentAI`, `StorageBatteryEquipmentGR`) VALUES
(5, 12, '◯', '×', '', '×', '◯', '', '×', '◯', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', ' ×', ''),
(6, 12, '◯', '×', '', '×', '◯', '', '×', '◯', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', '×', '', '×', ' ×', '');

-- --------------------------------------------------------

--
-- テーブルの構造 `fire_equipment_report`
--

CREATE TABLE `fire_equipment_report` (
  `id` int NOT NULL,
  `code` int NOT NULL,
  `fire_equipment_report_code` int NOT NULL,
  `report_date` varchar(20) NOT NULL,
  `deficiency` varchar(20) NOT NULL,
  `inspector` varchar(20) NOT NULL,
  `remarks` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- テーブルのデータのダンプ `fire_equipment_report`
--

INSERT INTO `fire_equipment_report` (`id`, `code`, `fire_equipment_report_code`, `report_date`, `deficiency`, `inspector`, `remarks`) VALUES
(1, 11, 1, 'R4.4.1', '自動火災報知設備', '総合防災', 'なになについて指導'),
(6, 11, 2, 'R4.4.13', '自動火災報知設備', '総合防災', 'なになについて指導'),
(7, 11, 3, 'R4.4.13', '自動火災報知設備', '総合防災', '');

-- --------------------------------------------------------

--
-- テーブルの構造 `fire_fighting_training`
--

CREATE TABLE `fire_fighting_training` (
  `id` int NOT NULL,
  `code` int NOT NULL,
  `fire_fighting_training_code` int NOT NULL,
  `implementation_date` varchar(20) NOT NULL,
  `training_content` varchar(20) NOT NULL,
  `participation_of_fire_depts` varchar(20) NOT NULL,
  `instructor_name` varchar(20) NOT NULL,
  `remarks` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- テーブルのデータのダンプ `fire_fighting_training`
--

INSERT INTO `fire_fighting_training` (`id`, `code`, `fire_fighting_training_code`, `implementation_date`, `training_content`, `participation_of_fire_depts`, `instructor_name`, `remarks`) VALUES
(4, 11, 1, '5/5/1', '総合訓練', '有', '田村・石崎', 'なになについて'),
(8, 11, 2, '5/5/1', '総合訓練', '有', '田村・石崎', 'なになについて指導'),
(9, 11, 3, '5/5/1', '総合訓練', '有', '田村・石崎', '');

-- --------------------------------------------------------

--
-- テーブルの構造 `fire_safety_manager`
--

CREATE TABLE `fire_safety_manager` (
  `id` int NOT NULL,
  `code` int NOT NULL,
  `fire_safety_manager_code` int NOT NULL,
  `fire_safety_manager_director` varchar(40) DEFAULT NULL,
  `fire_safety_manager_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `appointment_date` varchar(10) DEFAULT NULL,
  `fire_plan_date` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- テーブルのデータのダンプ `fire_safety_manager`
--

INSERT INTO `fire_safety_manager` (`id`, `code`, `fire_safety_manager_code`, `fire_safety_manager_director`, `fire_safety_manager_name`, `appointment_date`, `fire_plan_date`) VALUES
(88, 11, 1, '隊長', '石崎史典', 'R5/4/1', 'R5/4/1変更'),
(93, 11, 2, '隊長', '石崎史典', 'R5/4/1', 'R5/4/1'),
(97, 11, 3, '隊長', '石崎史典', 'R5/4/1', 'R5/4/1変更'),
(98, 12, 1, '隊長', '石崎史典', 'R7/4/19', 'R5/4/1変更');

-- --------------------------------------------------------

--
-- テーブルの構造 `inspection_status`
--

CREATE TABLE `inspection_status` (
  `id` int NOT NULL,
  `code` int NOT NULL,
  `inspection_status_code` int NOT NULL,
  `inspection_date` varchar(20) NOT NULL,
  `inspection_name` varchar(20) NOT NULL,
  `instructions` varchar(20) NOT NULL,
  `remarks` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- テーブルのデータのダンプ `inspection_status`
--

INSERT INTO `inspection_status` (`id`, `code`, `inspection_status_code`, `inspection_date`, `inspection_name`, `instructions`, `remarks`) VALUES
(2, 11, 1, 'R5.6.1', 'da', '有', 'なになについて指導'),
(5, 11, 2, 'R5.6.1', 'da', '有', '');

-- --------------------------------------------------------

--
-- テーブルの構造 `taishobutu_datail`
--

CREATE TABLE `taishobutu_datail` (
  `code` int NOT NULL,
  `windowless_floor` varchar(20) NOT NULL,
  `capacity` varchar(20) NOT NULL,
  `building_structure` varchar(20) NOT NULL,
  `owners_address` varchar(20) NOT NULL,
  `building_area` int NOT NULL,
  `site_area` int NOT NULL,
  `building_classification` varchar(10) NOT NULL,
  `interior_limit` varchar(10) NOT NULL,
  `main_structure` varchar(10) NOT NULL,
  `floor` varchar(10) NOT NULL,
  `new_construction_date` varchar(10) NOT NULL,
  `remarks_column` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- テーブルのデータのダンプ `taishobutu_datail`
--

INSERT INTO `taishobutu_datail` (`code`, `windowless_floor`, `capacity`, `building_structure`, `owners_address`, `building_area`, `site_area`, `building_classification`, `interior_limit`, `main_structure`, `floor`, `new_construction_date`, `remarks_column`) VALUES
(11, '無し', '27', '木造', '浜中町琵琶瀬309番地', 501, 501, '第4号建築物', '有り', '耐火構造', '地上３階・地階１階', ' R6/4/1', 'dfdfadsfdskfaifdifds'),
(11, '無し', '27', '木造', '浜中町琵琶瀬309番地', 501, 501, '第4号建築物', '有り', '耐火構造', '地上３階・地階１階', ' R6/4/1', 'dfdfadsfdskfaifdifds'),
(12, '有り', '27', '木造', '浜中町琵琶瀬309番地', 0, 0, '第4号建築物', '有り', '', '地上３階・地階１', ' R6/4/1', ''),
(12, '有り', '27', '木造', '浜中町琵琶瀬309番地', 0, 0, '第4号建築物', '有り', '', '地上３階・地階１', ' R6/4/1', ''),
(12, '有り', '27', '木造', '浜中町琵琶瀬309番地', 0, 0, '第4号建築物', '有り', '', '地上３階・地階１', ' R6/4/1', ''),
(18, '有り', '27', '木造', '浜中町琵琶瀬309番地', 0, 0, '第4号建築物', '', '', '地上３階・地階１', ' R6/4/19', '');

-- --------------------------------------------------------

--
-- テーブルの構造 `taishobutu_main`
--

CREATE TABLE `taishobutu_main` (
  `code` int NOT NULL,
  `fire_dept_code` int NOT NULL,
  `appendix` int NOT NULL,
  `taishobutu_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `taishobutu_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `taishobutu_tel` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owners_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owners_tel` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_area` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- テーブルのデータのダンプ `taishobutu_main`
--

INSERT INTO `taishobutu_main` (`code`, `fire_dept_code`, `appendix`, `taishobutu_name`, `taishobutu_address`, `taishobutu_tel`, `owners_name`, `owners_tel`, `total_area`) VALUES
(11, 1, 40, '浜中消防署', '浜中町霧多布西1条1丁目23番地', '0153-62-2150', '高野弘', '080-4048-6712', 500),
(14, 2, 9, '居合地位', '浜中町茶内若葉３丁目', '0153-62-2150', '石崎史典', '080-4048-6712', 4321),
(20, 1, 1, '茶内コミュニティセンター', '浜中町霧多布西1条1丁目23番地', '0153-62-2150', '石崎史典', '', 1500);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `firedept_staff`
--
ALTER TABLE `firedept_staff`
  ADD PRIMARY KEY (`code`);

--
-- テーブルのインデックス `firefighting_equipment_list`
--
ALTER TABLE `firefighting_equipment_list`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `fire_equipment_report`
--
ALTER TABLE `fire_equipment_report`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `fire_fighting_training`
--
ALTER TABLE `fire_fighting_training`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `fire_safety_manager`
--
ALTER TABLE `fire_safety_manager`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `inspection_status`
--
ALTER TABLE `inspection_status`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `taishobutu_main`
--
ALTER TABLE `taishobutu_main`
  ADD PRIMARY KEY (`code`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `firedept_staff`
--
ALTER TABLE `firedept_staff`
  MODIFY `code` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- テーブルの AUTO_INCREMENT `firefighting_equipment_list`
--
ALTER TABLE `firefighting_equipment_list`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- テーブルの AUTO_INCREMENT `fire_equipment_report`
--
ALTER TABLE `fire_equipment_report`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- テーブルの AUTO_INCREMENT `fire_fighting_training`
--
ALTER TABLE `fire_fighting_training`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- テーブルの AUTO_INCREMENT `fire_safety_manager`
--
ALTER TABLE `fire_safety_manager`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- テーブルの AUTO_INCREMENT `inspection_status`
--
ALTER TABLE `inspection_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `taishobutu_main`
--
ALTER TABLE `taishobutu_main`
  MODIFY `code` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
