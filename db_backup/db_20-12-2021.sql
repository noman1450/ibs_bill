-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2021 at 09:30 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ibs_accounts_mail_version`
--

-- --------------------------------------------------------

--
-- Table structure for table `acc_bank_account_details`
--

CREATE TABLE `acc_bank_account_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_no` varchar(25) NOT NULL,
  `account_name` varchar(100) DEFAULT NULL,
  `branch_name` varchar(45) DEFAULT NULL,
  `bsr_code` varchar(25) DEFAULT NULL,
  `ifs_code` varchar(25) DEFAULT NULL,
  `acc_chart_of_accounts_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `acc_chart_of_accounts`
--

CREATE TABLE `acc_chart_of_accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `acc_chart_of_account_groups_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `cost_centres_status` tinyint(3) UNSIGNED DEFAULT NULL,
  `set_bank_account_details_status` tinyint(3) UNSIGNED DEFAULT NULL,
  `type_of_duty_tax` tinyint(3) UNSIGNED DEFAULT NULL COMMENT '1 for Excise then (Duty Head List show)\n2 for others',
  `acc_duty_heads_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `acc_chart_of_account_groups`
--

CREATE TABLE `acc_chart_of_account_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `nett_debit_credit_balance` int(11) DEFAULT NULL,
  `use_calculation_taxes_discount` int(11) DEFAULT NULL,
  `group_behaves_sub_ledger` int(11) DEFAULT NULL,
  `nature_of_group` int(11) DEFAULT NULL COMMENT '1 for Asset\n2 for Liabilities\n3 for Income\n4 for Expense',
  `group_status` int(11) DEFAULT NULL COMMENT '1 for dactive\n2 for editable\n3 for non editable\n',
  `valid` tinyint(3) UNSIGNED DEFAULT NULL,
  `acc_chart_of_account_groups_id` int(10) UNSIGNED DEFAULT NULL,
  `acc_permanent_group_id` int(10) UNSIGNED DEFAULT NULL,
  `gross_profit` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `company_infos_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `acc_cheque_books`
--

CREATE TABLE `acc_cheque_books` (
  `id` int(10) UNSIGNED NOT NULL,
  `acc_chart_of_accounts_id` int(10) UNSIGNED NOT NULL,
  `number_from` varchar(25) DEFAULT NULL,
  `number_to` varchar(25) DEFAULT NULL,
  `book_number` varchar(15) DEFAULT NULL,
  `number_of_cheques` varchar(15) DEFAULT NULL,
  `last_number` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `acc_cheque_config`
--

CREATE TABLE `acc_cheque_config` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `acc_chart_of_accounts_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `acc_coa_aliass`
--

CREATE TABLE `acc_coa_aliass` (
  `id` int(10) UNSIGNED NOT NULL,
  `alias_name` varchar(100) NOT NULL,
  `valid` tinyint(3) UNSIGNED DEFAULT NULL,
  `acc_chart_of_accounts_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `acc_coa_bank_details`
--

CREATE TABLE `acc_coa_bank_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `nick_name` varchar(100) DEFAULT NULL,
  `favouring_name` varchar(150) DEFAULT NULL,
  `acc_transaction_types_id` smallint(5) UNSIGNED NOT NULL,
  `acc_chart_of_accounts_id` int(10) UNSIGNED NOT NULL,
  `set_default` tinyint(4) DEFAULT NULL,
  `account_no` varchar(20) DEFAULT NULL,
  `ifs_code` varchar(15) DEFAULT NULL,
  `bank` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `acc_coa_mailing_details`
--

CREATE TABLE `acc_coa_mailing_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `acc_chart_of_accounts_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `acc_coa_tax_infos`
--

CREATE TABLE `acc_coa_tax_infos` (
  `id` int(10) UNSIGNED NOT NULL,
  `pan_it_no` varchar(45) DEFAULT NULL,
  `sales_tax_no` varchar(45) DEFAULT NULL,
  `cst_no` varchar(45) DEFAULT NULL,
  `acc_chart_of_accounts_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `acc_duty_heads`
--

CREATE TABLE `acc_duty_heads` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `acc_group_aliass`
--

CREATE TABLE `acc_group_aliass` (
  `id` int(10) UNSIGNED NOT NULL,
  `alias_name` varchar(150) DEFAULT NULL,
  `valid` tinyint(3) UNSIGNED DEFAULT NULL,
  `acc_chart_of_account_groups_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `acc_permanent_group`
--

CREATE TABLE `acc_permanent_group` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `group_behaves_sub_ledger` int(11) DEFAULT NULL,
  `use_calculation_taxes_discount` int(11) DEFAULT NULL,
  `nett_debit_credit_balance` int(11) DEFAULT NULL,
  `nature_of_group` int(11) DEFAULT NULL COMMENT '1 for Asset\n2 for Liabilities\n3 for Income\n4 for Expense',
  `group_status` int(11) DEFAULT NULL,
  `acc_permanent_group_id` int(10) UNSIGNED DEFAULT NULL,
  `gross_profit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `acc_transaction_types`
--

CREATE TABLE `acc_transaction_types` (
  `id` smallint(5) UNSIGNED NOT NULL COMMENT 'id 4 for need acc_no,IFS_code, Bank\nid 6 for need acc_no only',
  `description` varchar(100) NOT NULL,
  `company_infos_id` smallint(5) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `assigned_roles`
--

CREATE TABLE `assigned_roles` (
  `id` int(11) NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `roles_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `branchs`
--

CREATE TABLE `branchs` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `branch_name` varchar(250) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `contact_number` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `valid` tinyint(3) UNSIGNED DEFAULT NULL,
  `branch_type` tinyint(3) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `company_infos_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `branchs`
--

INSERT INTO `branchs` (`id`, `branch_name`, `address`, `contact_number`, `email`, `valid`, `branch_type`, `created_at`, `updated_at`, `company_infos_id`) VALUES
(1, 'Branch One', 'gdfgdfgdfgdfgdfg', '16699932962', 'branch@gmail.com', 1, 1, '2021-12-05 03:44:53', '2021-12-05 03:44:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `client_information`
--

CREATE TABLE `client_information` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_code` varchar(45) DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `activity` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `client_category_id` int(11) DEFAULT NULL,
  `acc_chart_of_account_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `from_email` varchar(100) DEFAULT NULL,
  `cc_email` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client_information`
--

INSERT INTO `client_information` (`id`, `client_code`, `client_name`, `contact_person`, `address`, `email`, `activity`, `city_id`, `client_category_id`, `acc_chart_of_account_id`, `user_id`, `from_email`, `cc_email`, `created_at`, `updated_at`) VALUES
(1, 'qfl', 'Quality Feed Limited', 'shuvo', 'Dhaka, Bangladesh', 'qfl@gmail.com', 1, NULL, NULL, NULL, 1, 'nomandiu1450@gmail.com', 'saifsabbir4@gmail.com;nomandiu1450@gmail.com', '2021-07-07 06:29:29', '2021-12-18 10:07:14'),
(2, 'amg', 'al mostafa group', 'dfdfd', 'dhaka', 'amg@gmail.com', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-07 06:29:29', '2021-07-07 06:29:29'),
(3, 'dddd', 'Porta tincidunt', 'Nurullah', 'Nisi dignissimos ut', 'gove@mailinator.com', 1, NULL, NULL, NULL, 1, NULL, NULL, '2021-12-13 12:36:46', '2021-12-13 12:45:16'),
(4, 'Bro', 'Buro Bangladesh', 'sdfsdfsdfsdfsd', 'fsdfsdfsdfsdfsAddress *', 'buro@gmail.com', 1, NULL, NULL, NULL, 1, 'info@gmail.com', 'saifsabbir4@gmail.com;nomandiu1450@gmail.com', '2021-12-13 12:46:17', '2021-12-18 10:48:09'),
(5, 'qbl', 'Quality Breders Ltd.', 'Helal', 'house-01,Road-01,Dhaka housing, adabor-01 Dhaka-1207', 'info@i-infotechsolution.com', 1, NULL, NULL, NULL, 1, 'iinfotechbs@gmail.com', 'saifsabbir4@gmail.com;nomandiu1450@gmail.com', '2021-12-15 12:40:05', '2021-12-18 13:41:21'),
(6, 'hello', 'Hello Company', 'Shuvo', 'Explicabo dolore quis, natus. Aliquid', 'mail@hellocompany.com', 1, NULL, NULL, NULL, 1, 'hi1234@gmail.com', 'partner1@hellocompany.com;partner2@hellocompany.com;partner3@hellocompany.com;partner4@hellocompany.com;', '2021-12-18 10:09:32', '2021-12-18 10:19:49');

-- --------------------------------------------------------

--
-- Table structure for table `company_infos`
--

CREATE TABLE `company_infos` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `full_name` varchar(250) DEFAULT NULL,
  `short_name` varchar(45) DEFAULT NULL,
  `contact_number` varchar(45) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `reg_date` date DEFAULT NULL,
  `valid` tinyint(3) UNSIGNED DEFAULT NULL COMMENT '1 for active\n0 for dactive',
  `compay_type` smallint(5) UNSIGNED DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `web_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `company_infos_id` smallint(5) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company_infos`
--

INSERT INTO `company_infos` (`id`, `full_name`, `short_name`, `contact_number`, `address`, `reg_date`, `valid`, `compay_type`, `email`, `web_address`, `created_at`, `updated_at`, `company_infos_id`) VALUES
(1, 'I-infotech Business Solution', 'IBS', '012365478', 'asdfsdfsdfsdfsdfsdf', '2020-10-05', 1, 1, 'ibs@gmail.com', 'i-infotech.com', '2021-12-05 03:42:19', '2021-12-05 03:42:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text DEFAULT NULL,
  `queue` text DEFAULT NULL,
  `payload` longtext DEFAULT NULL,
  `exception` longtext DEFAULT NULL,
  `failed_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `maintenace_bill`
--

CREATE TABLE `maintenace_bill` (
  `id` int(10) UNSIGNED NOT NULL,
  `year_id` int(11) DEFAULT NULL,
  `month_id` int(11) DEFAULT NULL,
  `bill_no` varchar(45) DEFAULT NULL,
  `send_to` varchar(50) DEFAULT NULL,
  `client_information_id` int(10) DEFAULT NULL,
  `mail_count` int(10) UNSIGNED DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `maintenace_bill`
--

INSERT INTO `maintenace_bill` (`id`, `year_id`, `month_id`, `bill_no`, `send_to`, `client_information_id`, `mail_count`, `created_at`, `updated_at`) VALUES
(1, 2021, 11, 'IBS-21120001', 'Account Department', 1, 2, '2021-12-15 15:45:45', '2021-12-15 15:45:45'),
(2, 2021, 11, 'IBS-21120002', 'Managin Director', 2, 0, '2021-12-15 15:45:45', '2021-12-15 15:45:45'),
(3, 2021, 11, 'IBS-21120003', 'Managing Director', 4, 0, '2021-12-15 15:45:45', '2021-12-15 15:45:45'),
(4, 2021, 11, 'IBS-21120005', 'Vice Chairman', 5, 22, '2021-12-15 00:00:00', '2021-12-15 16:39:03'),
(5, 2021, 10, 'IBS-21120005', 'Account Department', 1, 0, '2021-12-15 00:00:00', '2021-12-15 16:35:58'),
(6, 2021, 10, 'IBS-21120006', 'Managin Director', 2, 0, '2021-12-15 16:18:17', '2021-12-15 16:18:17'),
(7, 2021, 10, 'IBS-21120007', 'Managing Director', 4, 0, '2021-12-15 16:18:17', '2021-12-15 16:18:17'),
(8, 2021, 10, 'IBS-21120008', 'Vice Chairman', 5, 0, '2021-12-15 16:18:17', '2021-12-15 16:18:17'),
(9, 2021, 12, 'IBS-21120009', 'Account Department', 1, 0, '2021-12-15 17:18:55', '2021-12-15 17:18:55'),
(10, 2021, 12, 'IBS-21120010', 'Managin Director', 2, 0, '2021-12-15 17:18:55', '2021-12-15 17:18:55'),
(11, 2021, 12, 'IBS-21120011', 'Managing Director', 4, 0, '2021-12-15 17:18:55', '2021-12-15 17:18:55'),
(12, 2021, 12, 'IBS-21120012', 'Vice Chairman', 5, 0, '2021-12-15 00:00:00', '2021-12-15 17:20:05'),
(13, 2022, 1, 'IBS-21120013', 'Account Department', 1, 0, '2021-12-18 12:52:28', '2021-12-18 12:52:28'),
(14, 2022, 1, 'IBS-21120014', 'Managin Director', 2, 0, '2021-12-18 12:52:28', '2021-12-18 12:52:28'),
(15, 2022, 1, 'IBS-21120015', 'Managing Director', 4, 0, '2021-12-18 12:52:28', '2021-12-18 12:52:28'),
(16, 2022, 1, 'IBS-21120016', 'Vice Chairman', 5, 0, '2021-12-18 12:52:28', '2021-12-18 12:52:28'),
(17, 2021, 3, 'IBS-21120017', 'Account Department', 1, 0, '2021-12-19 12:07:28', '2021-12-19 12:07:28'),
(18, 2021, 3, 'IBS-21120018', 'Managin Director', 2, 0, '2021-12-19 12:07:28', '2021-12-19 12:07:28'),
(19, 2021, 3, 'IBS-21120019', 'Managing Director', 4, 0, '2021-12-19 12:07:28', '2021-12-19 12:07:28'),
(20, 2021, 3, 'IBS-21120020', 'Vice Chairman', 5, 0, '2021-12-19 12:07:28', '2021-12-19 12:07:28');

-- --------------------------------------------------------

--
-- Table structure for table `maintenace_bill_ledger`
--

CREATE TABLE `maintenace_bill_ledger` (
  `id` int(10) UNSIGNED NOT NULL,
  `maintenace_bill_id` int(10) UNSIGNED NOT NULL,
  `payableamount` varchar(45) DEFAULT NULL,
  `receiving_amount` varchar(45) DEFAULT NULL,
  `software_name` varchar(100) DEFAULT NULL,
  `service_confiq_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `maintenace_bill_ledger`
--

INSERT INTO `maintenace_bill_ledger` (`id`, `maintenace_bill_id`, `payableamount`, `receiving_amount`, `software_name`, `service_confiq_id`, `created_at`, `updated_at`) VALUES
(47, 1, '8000', '0', 'HRM Software', 1, '2021-12-15 15:45:45', '2021-12-15 15:45:45'),
(48, 2, '5000', '0', 'HRM Software', 2, '2021-12-15 15:45:45', '2021-12-15 15:45:45'),
(49, 2, '6000', '0', 'Ecommerce', 3, '2021-12-15 15:45:45', '2021-12-15 15:45:45'),
(50, 3, '5000', '0', 'Buro CHRD', 4, '2021-12-15 15:45:45', '2021-12-15 15:45:45'),
(51, 4, '5000', '0', 'ERP System', 5, '2021-12-15 15:45:45', '2021-12-15 15:45:45'),
(52, 4, '3000', '0', 'Attendance System', 6, '2021-12-15 15:45:45', '2021-12-15 15:45:45'),
(53, 4, '7000', '0', 'Attendance Mobile App User-100@70 tk', 7, '2021-12-15 15:45:45', '2021-12-15 16:38:42'),
(54, 5, '10000', '0', 'HRM Software update', 1, '2021-12-15 16:18:17', '2021-12-15 16:35:58'),
(55, 6, '5000', '0', 'HRM Software', 2, '2021-12-15 16:18:17', '2021-12-15 16:18:17'),
(56, 6, '6000', '0', 'Ecommerce', 3, '2021-12-15 16:18:17', '2021-12-15 16:18:17'),
(57, 7, '5000', '0', 'Buro CHRD', 4, '2021-12-15 16:18:17', '2021-12-15 16:18:17'),
(58, 8, '5000', '0', 'ERP System', 5, '2021-12-15 16:18:18', '2021-12-15 16:18:18'),
(59, 8, '3000', '0', 'Attendance System', 6, '2021-12-15 16:18:18', '2021-12-15 16:18:18'),
(60, 8, '70', '0', 'Attendance Mobile App', 7, '2021-12-15 16:18:18', '2021-12-15 16:18:18'),
(61, 9, '8000', '0', 'HRM Software', 1, '2021-12-15 17:18:55', '2021-12-15 17:18:55'),
(62, 10, '5000', '0', 'HRM Software', 2, '2021-12-15 17:18:55', '2021-12-15 17:18:55'),
(63, 10, '6000', '0', 'Ecommerce', 3, '2021-12-15 17:18:55', '2021-12-15 17:18:55'),
(64, 11, '5000', '0', 'Buro CHRD', 4, '2021-12-15 17:18:55', '2021-12-15 17:18:55'),
(65, 12, '5000', '0', 'ERP System', 5, '2021-12-15 17:18:55', '2021-12-15 17:18:55'),
(66, 12, '3000', '0', 'Attendance System', 6, '2021-12-15 17:18:55', '2021-12-15 17:18:55'),
(67, 12, '7000', '0', 'Attendance Mobile App User-100@70 tk3625', 7, '2021-12-15 17:18:55', '2021-12-15 17:20:04'),
(68, 13, '8000', '0', 'HRM Software', 1, '2021-12-18 12:52:28', '2021-12-18 12:52:28'),
(69, 14, '5000', '0', 'HRM Software', 2, '2021-12-18 12:52:28', '2021-12-18 12:52:28'),
(70, 14, '6000', '0', 'Ecommerce', 3, '2021-12-18 12:52:28', '2021-12-18 12:52:28'),
(71, 15, '5000', '0', 'Buro CHRD', 4, '2021-12-18 12:52:28', '2021-12-18 12:52:28'),
(72, 16, '5000', '0', 'ERP System', 5, '2021-12-18 12:52:28', '2021-12-18 12:52:28'),
(73, 16, '3000', '0', 'Attendance System', 6, '2021-12-18 12:52:28', '2021-12-18 12:52:28'),
(74, 16, '70', '0', 'Attendance Mobile App', 7, '2021-12-18 12:52:28', '2021-12-18 12:52:28'),
(75, 17, '8000', '0', 'HRM Software', 1, '2021-12-19 12:07:28', '2021-12-19 12:07:28'),
(76, 18, '5000', '0', 'HRM Software', 2, '2021-12-19 12:07:28', '2021-12-19 12:07:28'),
(77, 18, '6000', '0', 'Ecommerce', 3, '2021-12-19 12:07:28', '2021-12-19 12:07:28'),
(78, 19, '5000', '0', 'Buro CHRD', 4, '2021-12-19 12:07:28', '2021-12-19 12:07:28'),
(79, 20, '5000', '0', 'ERP System', 5, '2021-12-19 12:07:28', '2021-12-19 12:07:28'),
(80, 20, '3000', '0', 'Attendance System', 6, '2021-12-19 12:07:28', '2021-12-19 12:07:28'),
(81, 20, '70', '0', 'Attendance Mobile App', 7, '2021-12-19 12:07:28', '2021-12-19 12:07:28');

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `money_receipt`
--

CREATE TABLE `money_receipt` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_information_id` int(10) UNSIGNED NOT NULL,
  `receipt_type` varchar(50) DEFAULT NULL,
  `amount` float(8,2) DEFAULT NULL,
  `charge_for` text DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `check_no` varchar(50) DEFAULT NULL,
  `receipt_no` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `users_id` int(10) UNSIGNED DEFAULT NULL,
  `is_send` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=Mail Not Send,\r\n1=Mail Send',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `money_receipt`
--

INSERT INTO `money_receipt` (`id`, `client_information_id`, `receipt_type`, `amount`, `charge_for`, `bank_name`, `check_no`, `receipt_no`, `date`, `users_id`, `is_send`, `created_at`, `updated_at`) VALUES
(1, 5, 'Bank', 7000.00, 'ERP & Attendance System Maintenance Dec-2021', 'IFIC', '54154521218552154542152454', 'MR-21120001', '2021-12-17', 1, 0, '2021-12-19 05:45:22', '2021-12-20 05:29:28'),
(2, 1, 'Cash', 5000.00, 'ERP software Month of January-2022', NULL, NULL, 'MR-21120002', '2021-12-19', 1, 1, '2021-12-19 10:39:58', '2021-12-20 06:25:54');

-- --------------------------------------------------------

--
-- Table structure for table `month`
--

CREATE TABLE `month` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `month`
--

INSERT INTO `month` (`id`, `name`) VALUES
(1, 'January'),
(2, 'February'),
(3, 'March'),
(4, 'April'),
(5, 'May'),
(6, 'June'),
(7, 'July'),
(8, 'August'),
(9, 'September'),
(10, 'October'),
(11, 'November'),
(12, 'December');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(191) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `display_name` varchar(55) CHARACTER SET armscii8 DEFAULT NULL,
  `isActive` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `service_confiq`
--

CREATE TABLE `service_confiq` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_information_id` int(10) UNSIGNED NOT NULL,
  `to_information` varchar(100) DEFAULT NULL,
  `from_information` varchar(45) DEFAULT NULL,
  `software_name` varchar(100) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `valid` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `send_to` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_confiq`
--

INSERT INTO `service_confiq` (`id`, `client_information_id`, `to_information`, `from_information`, `software_name`, `amount`, `valid`, `updated_at`, `created_at`, `send_to`) VALUES
(1, 1, 'saifsabbir4@gmail.com', 'Accounts Manager', 'HRM Software', 8000, 1, '2021-07-07 23:27:01', '2021-07-07 10:34:04', 'Account Department'),
(2, 2, 'noman27.ibs@gmail.com', 'Accounts Manager', 'HRM Software', 5000, 1, '2021-07-07 10:34:46', '2021-07-07 10:34:46', 'Managin Director'),
(3, 2, 'noman27.ibs@gmail.com', 'Accounts Manager', 'Ecommerce', 6000, 1, '2021-07-15 14:54:47', '2021-07-15 14:54:47', 'Managin Director'),
(4, 4, 'buro01@gmail.com', 'From Information*', 'Buro CHRD', 5000, 1, '2021-12-13 12:50:08', '2021-12-13 12:50:08', 'Managing Director'),
(5, 5, 'To Information', 'Noman', 'ERP System', 5000, 1, '2021-12-15 12:41:44', '2021-12-15 12:41:44', 'Vice Chairman'),
(6, 5, 'To Information', 'Noman', 'Attendance System', 3000, 1, '2021-12-15 12:42:31', '2021-12-15 12:42:31', 'Vice Chairman'),
(7, 5, 'saifsabbir4@gmail.com;nomandiu1450@gmail.com;', 'iinfotechbs@gmail.com', 'Attendance Mobile App', 70, 1, '2021-12-15 17:26:13', '2021-12-15 12:43:43', 'Vice Chairman');

-- --------------------------------------------------------

--
-- Table structure for table `temp_maintenace_bill`
--

CREATE TABLE `temp_maintenace_bill` (
  `id` int(10) UNSIGNED NOT NULL,
  `bill_no` varchar(45) NOT NULL,
  `bill_date` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `temp_maintenace_bill`
--

INSERT INTO `temp_maintenace_bill` (`id`, `bill_no`, `bill_date`, `created_at`, `updated_at`) VALUES
(1, 'IBS-21070001', '2021-07-16 12:44:09', '2021-07-16 06:44:09', '2021-07-16 06:44:09'),
(2, 'IBS-21120001', '2021-12-15 12:52:38', '2021-12-15 06:52:38', '2021-12-15 06:52:38');

-- --------------------------------------------------------

--
-- Table structure for table `temp_maintenace_bill_ledger`
--

CREATE TABLE `temp_maintenace_bill_ledger` (
  `id` int(10) UNSIGNED NOT NULL,
  `temp_maintenace_bill_id` int(10) UNSIGNED NOT NULL,
  `maintenace_bill_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `temp_maintenace_bill_ledger`
--

INSERT INTO `temp_maintenace_bill_ledger` (`id`, `temp_maintenace_bill_id`, `maintenace_bill_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2021-07-16 06:44:09', '2021-07-16 06:44:09'),
(2, 1, 4, '2021-07-16 06:44:09', '2021-07-16 06:44:09'),
(3, 1, 6, '2021-07-16 06:44:09', '2021-07-16 06:44:09'),
(4, 1, 8, '2021-07-16 06:44:09', '2021-07-16 06:44:09'),
(5, 2, 37, '2021-12-15 06:52:38', '2021-12-15 06:52:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2b$10$AF8Cqy1SkKPOSHIKSFxxTOxFTgiXKbTSIyOQod7Il5XLdLANlRxuS', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc_bank_account_details`
--
ALTER TABLE `acc_bank_account_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_acc_bank_account_details_acc_chart_of_accounts1_idx` (`acc_chart_of_accounts_id`);

--
-- Indexes for table `acc_chart_of_accounts`
--
ALTER TABLE `acc_chart_of_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_acc_chart_of_accounts_acc_chart_of_account_groups1_idx` (`acc_chart_of_account_groups_id`),
  ADD KEY `fk_acc_chart_of_accounts_acc_duty_heads1_idx` (`acc_duty_heads_id`);

--
-- Indexes for table `acc_chart_of_account_groups`
--
ALTER TABLE `acc_chart_of_account_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`,`company_infos_id`),
  ADD KEY `fk_acc_chart_of_account_groups_acc_chart_of_account_groups1_idx` (`acc_chart_of_account_groups_id`),
  ADD KEY `fk_acc_chart_of_account_groups_acc_permanent_group1_idx` (`acc_permanent_group_id`),
  ADD KEY `fk_acc_chart_of_account_groups_company_infos1_idx` (`company_infos_id`);

--
-- Indexes for table `acc_cheque_books`
--
ALTER TABLE `acc_cheque_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_acc_cheque_books_acc_chart_of_accounts1_idx` (`acc_chart_of_accounts_id`);

--
-- Indexes for table `acc_cheque_config`
--
ALTER TABLE `acc_cheque_config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_acc_cheque_config_acc_chart_of_accounts1_idx` (`acc_chart_of_accounts_id`);

--
-- Indexes for table `acc_coa_aliass`
--
ALTER TABLE `acc_coa_aliass`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_acc_coa_aliass_acc_chart_of_accounts1_idx` (`acc_chart_of_accounts_id`);

--
-- Indexes for table `acc_coa_bank_details`
--
ALTER TABLE `acc_coa_bank_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_acc_coa_bank_details_acc_transaction_types1_idx` (`acc_transaction_types_id`),
  ADD KEY `fk_acc_coa_bank_details_acc_chart_of_accounts1_idx` (`acc_chart_of_accounts_id`);

--
-- Indexes for table `acc_coa_mailing_details`
--
ALTER TABLE `acc_coa_mailing_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_acc_coa_mailing_details_acc_chart_of_accounts1_idx` (`acc_chart_of_accounts_id`);

--
-- Indexes for table `acc_coa_tax_infos`
--
ALTER TABLE `acc_coa_tax_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_acc_coa_tax_infos_acc_chart_of_accounts1_idx` (`acc_chart_of_accounts_id`);

--
-- Indexes for table `acc_duty_heads`
--
ALTER TABLE `acc_duty_heads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acc_group_aliass`
--
ALTER TABLE `acc_group_aliass`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_acc_group_aliass_acc_chart_of_account_groups1_idx` (`acc_chart_of_account_groups_id`);

--
-- Indexes for table `acc_permanent_group`
--
ALTER TABLE `acc_permanent_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_acc_permanent_group_acc_permanent_group1_idx` (`acc_permanent_group_id`);

--
-- Indexes for table `acc_transaction_types`
--
ALTER TABLE `acc_transaction_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_acc_transaction_types_company_infos1_idx` (`company_infos_id`);

--
-- Indexes for table `assigned_roles`
--
ALTER TABLE `assigned_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_assigned_roles_roles1_idx` (`roles_id`),
  ADD KEY `fk_assigned_roles_users1_idx` (`users_id`);

--
-- Indexes for table `branchs`
--
ALTER TABLE `branchs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `branch_name_UNIQUE` (`branch_name`),
  ADD KEY `fk_branchs_company_infos1_idx` (`company_infos_id`);

--
-- Indexes for table `client_information`
--
ALTER TABLE `client_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_infos`
--
ALTER TABLE `company_infos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `full_name_UNIQUE` (`full_name`),
  ADD KEY `fk_company_infos_company_infos_idx` (`company_infos_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `maintenace_bill`
--
ALTER TABLE `maintenace_bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintenace_bill_ledger`
--
ALTER TABLE `maintenace_bill_ledger`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_type`,`model_id`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_type`,`model_id`);

--
-- Indexes for table `money_receipt`
--
ALTER TABLE `money_receipt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `month`
--
ALTER TABLE `month`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD KEY `fk_oauth_access_tokens_users1_idx` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD KEY `fk_oauth_auth_codes_users1_idx` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_oauth_clients_users1_idx` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`,`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `fk_roles_has_permissions_permissions1_idx` (`permission_id`),
  ADD KEY `fk_roles_has_permissions_roles1_idx` (`role_id`);

--
-- Indexes for table `service_confiq`
--
ALTER TABLE `service_confiq`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_service_confiq_client_information1` (`client_information_id`);

--
-- Indexes for table `temp_maintenace_bill`
--
ALTER TABLE `temp_maintenace_bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_maintenace_bill_ledger`
--
ALTER TABLE `temp_maintenace_bill_ledger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acc_bank_account_details`
--
ALTER TABLE `acc_bank_account_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acc_chart_of_accounts`
--
ALTER TABLE `acc_chart_of_accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acc_chart_of_account_groups`
--
ALTER TABLE `acc_chart_of_account_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acc_cheque_books`
--
ALTER TABLE `acc_cheque_books`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acc_cheque_config`
--
ALTER TABLE `acc_cheque_config`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acc_coa_aliass`
--
ALTER TABLE `acc_coa_aliass`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acc_coa_bank_details`
--
ALTER TABLE `acc_coa_bank_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acc_coa_tax_infos`
--
ALTER TABLE `acc_coa_tax_infos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acc_duty_heads`
--
ALTER TABLE `acc_duty_heads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acc_group_aliass`
--
ALTER TABLE `acc_group_aliass`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acc_permanent_group`
--
ALTER TABLE `acc_permanent_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acc_transaction_types`
--
ALTER TABLE `acc_transaction_types`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id 4 for need acc_no,IFS_code, Bank\nid 6 for need acc_no only';

--
-- AUTO_INCREMENT for table `assigned_roles`
--
ALTER TABLE `assigned_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branchs`
--
ALTER TABLE `branchs`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `client_information`
--
ALTER TABLE `client_information`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `company_infos`
--
ALTER TABLE `company_infos`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maintenace_bill`
--
ALTER TABLE `maintenace_bill`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `maintenace_bill_ledger`
--
ALTER TABLE `maintenace_bill_ledger`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `money_receipt`
--
ALTER TABLE `money_receipt`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `month`
--
ALTER TABLE `month`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_confiq`
--
ALTER TABLE `service_confiq`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `temp_maintenace_bill`
--
ALTER TABLE `temp_maintenace_bill`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `temp_maintenace_bill_ledger`
--
ALTER TABLE `temp_maintenace_bill_ledger`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acc_bank_account_details`
--
ALTER TABLE `acc_bank_account_details`
  ADD CONSTRAINT `fk_acc_bank_account_details_acc_chart_of_accounts1` FOREIGN KEY (`acc_chart_of_accounts_id`) REFERENCES `acc_chart_of_accounts` (`id`);

--
-- Constraints for table `acc_chart_of_accounts`
--
ALTER TABLE `acc_chart_of_accounts`
  ADD CONSTRAINT `fk_acc_chart_of_accounts_acc_chart_of_account_groups1` FOREIGN KEY (`acc_chart_of_account_groups_id`) REFERENCES `acc_chart_of_account_groups` (`id`),
  ADD CONSTRAINT `fk_acc_chart_of_accounts_acc_duty_heads1` FOREIGN KEY (`acc_duty_heads_id`) REFERENCES `acc_duty_heads` (`id`);

--
-- Constraints for table `acc_chart_of_account_groups`
--
ALTER TABLE `acc_chart_of_account_groups`
  ADD CONSTRAINT `fk_acc_chart_of_account_groups_acc_chart_of_account_groups1` FOREIGN KEY (`acc_chart_of_account_groups_id`) REFERENCES `acc_chart_of_account_groups` (`id`),
  ADD CONSTRAINT `fk_acc_chart_of_account_groups_acc_permanent_group1` FOREIGN KEY (`acc_permanent_group_id`) REFERENCES `acc_permanent_group` (`id`),
  ADD CONSTRAINT `fk_acc_chart_of_account_groups_company_infos1` FOREIGN KEY (`company_infos_id`) REFERENCES `company_infos` (`id`);

--
-- Constraints for table `acc_cheque_books`
--
ALTER TABLE `acc_cheque_books`
  ADD CONSTRAINT `fk_acc_cheque_books_acc_chart_of_accounts1` FOREIGN KEY (`acc_chart_of_accounts_id`) REFERENCES `acc_chart_of_accounts` (`id`);

--
-- Constraints for table `acc_cheque_config`
--
ALTER TABLE `acc_cheque_config`
  ADD CONSTRAINT `fk_acc_cheque_config_acc_chart_of_accounts1` FOREIGN KEY (`acc_chart_of_accounts_id`) REFERENCES `acc_chart_of_accounts` (`id`);

--
-- Constraints for table `acc_coa_aliass`
--
ALTER TABLE `acc_coa_aliass`
  ADD CONSTRAINT `fk_acc_coa_aliass_acc_chart_of_accounts1` FOREIGN KEY (`acc_chart_of_accounts_id`) REFERENCES `acc_chart_of_accounts` (`id`);

--
-- Constraints for table `acc_coa_bank_details`
--
ALTER TABLE `acc_coa_bank_details`
  ADD CONSTRAINT `fk_acc_coa_bank_details_acc_chart_of_accounts1` FOREIGN KEY (`acc_chart_of_accounts_id`) REFERENCES `acc_chart_of_accounts` (`id`),
  ADD CONSTRAINT `fk_acc_coa_bank_details_acc_transaction_types1` FOREIGN KEY (`acc_transaction_types_id`) REFERENCES `acc_transaction_types` (`id`);

--
-- Constraints for table `acc_coa_mailing_details`
--
ALTER TABLE `acc_coa_mailing_details`
  ADD CONSTRAINT `fk_acc_coa_mailing_details_acc_chart_of_accounts1` FOREIGN KEY (`acc_chart_of_accounts_id`) REFERENCES `acc_chart_of_accounts` (`id`);

--
-- Constraints for table `acc_coa_tax_infos`
--
ALTER TABLE `acc_coa_tax_infos`
  ADD CONSTRAINT `fk_acc_coa_tax_infos_acc_chart_of_accounts1` FOREIGN KEY (`acc_chart_of_accounts_id`) REFERENCES `acc_chart_of_accounts` (`id`);

--
-- Constraints for table `acc_group_aliass`
--
ALTER TABLE `acc_group_aliass`
  ADD CONSTRAINT `fk_acc_group_aliass_acc_chart_of_account_groups1` FOREIGN KEY (`acc_chart_of_account_groups_id`) REFERENCES `acc_chart_of_account_groups` (`id`);

--
-- Constraints for table `acc_permanent_group`
--
ALTER TABLE `acc_permanent_group`
  ADD CONSTRAINT `fk_acc_permanent_group_acc_permanent_group1` FOREIGN KEY (`acc_permanent_group_id`) REFERENCES `acc_permanent_group` (`id`);

--
-- Constraints for table `acc_transaction_types`
--
ALTER TABLE `acc_transaction_types`
  ADD CONSTRAINT `fk_acc_transaction_types_company_infos1` FOREIGN KEY (`company_infos_id`) REFERENCES `company_infos` (`id`);

--
-- Constraints for table `assigned_roles`
--
ALTER TABLE `assigned_roles`
  ADD CONSTRAINT `fk_assigned_roles_roles1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `fk_assigned_roles_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `branchs`
--
ALTER TABLE `branchs`
  ADD CONSTRAINT `fk_branchs_company_infos1` FOREIGN KEY (`company_infos_id`) REFERENCES `company_infos` (`id`);

--
-- Constraints for table `company_infos`
--
ALTER TABLE `company_infos`
  ADD CONSTRAINT `fk_company_infos_company_infos` FOREIGN KEY (`company_infos_id`) REFERENCES `company_infos` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `fk_model_has_permissions_permissions1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`);

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `fk_model_has_roles_roles1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD CONSTRAINT `fk_oauth_access_tokens_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD CONSTRAINT `fk_oauth_auth_codes_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD CONSTRAINT `fk_oauth_clients_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `fk_roles_has_permissions_permissions1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `fk_roles_has_permissions_roles1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `service_confiq`
--
ALTER TABLE `service_confiq`
  ADD CONSTRAINT `fk_service_confiq_client_information1` FOREIGN KEY (`client_information_id`) REFERENCES `client_information` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
