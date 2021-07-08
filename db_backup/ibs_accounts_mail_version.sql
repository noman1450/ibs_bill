-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2021 at 10:32 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

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
  `email` varchar(45) DEFAULT NULL,
  `activity` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `client_category_id` int(11) DEFAULT NULL,
  `acc_chart_of_account_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client_information`
--

INSERT INTO `client_information` (`id`, `client_code`, `client_name`, `contact_person`, `address`, `email`, `activity`, `city_id`, `client_category_id`, `acc_chart_of_account_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'qfl', 'quality feed limited', 'shuvo', 'dhaka', 'qfl@gmail.com', 1, NULL, NULL, NULL, NULL, '2021-07-07 06:29:29', '2021-07-07 06:29:29'),
(2, 'amg', 'al mostafa geroup', 'dfdfd', 'dhaka', 'amg@gmail.com', NULL, NULL, NULL, NULL, NULL, '2021-07-07 06:29:29', '2021-07-07 06:29:29');

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

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, 'database', 'default', '{\"uuid\":\"c3bed5e9-45e3-437e-ba3b-44788f3b0865\",\"displayName\":\"App\\\\Jobs\\\\SendMailToClientJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendMailToClientJob\",\"command\":\"O:28:\\\"App\\\\Jobs\\\\SendMailToClientJob\\\":9:{s:17:\\\"sendMailToClients\\\";O:29:\\\"Illuminate\\\\Support\\\\Collection\\\":1:{s:8:\\\"\\u0000*\\u0000items\\\";a:2:{i:0;O:8:\\\"stdClass\\\":12:{s:7:\\\"address\\\";s:5:\\\"dhaka\\\";s:11:\\\"client_name\\\";s:20:\\\"quality feed limited\\\";s:11:\\\"client_code\\\";s:3:\\\"qfl\\\";s:14:\\\"contact_person\\\";s:5:\\\"shuvo\\\";s:5:\\\"email\\\";s:13:\\\"qfl@gmail.com\\\";s:10:\\\"created_at\\\";s:19:\\\"2021-07-07 06:29:29\\\";s:2:\\\"id\\\";i:1;s:14:\\\"to_information\\\";s:21:\\\"saifsabbir4@gmail.com\\\";s:16:\\\"from_information\\\";s:16:\\\"Accounts Manager\\\";s:13:\\\"software_name\\\";s:12:\\\"HRM Software\\\";s:7:\\\"send_to\\\";s:18:\\\"Account Department\\\";s:6:\\\"amount\\\";d:8000;}i:1;O:8:\\\"stdClass\\\":12:{s:7:\\\"address\\\";s:5:\\\"dhaka\\\";s:11:\\\"client_name\\\";s:17:\\\"al mostafa geroup\\\";s:11:\\\"client_code\\\";s:3:\\\"amg\\\";s:14:\\\"contact_person\\\";s:5:\\\"dfdfd\\\";s:5:\\\"email\\\";s:13:\\\"amg@gmail.com\\\";s:10:\\\"created_at\\\";s:19:\\\"2021-07-07 06:29:29\\\";s:2:\\\"id\\\";i:2;s:14:\\\"to_information\\\";s:21:\\\"noman27.ibs@gmail.com\\\";s:16:\\\"from_information\\\";s:16:\\\"Accounts Manager\\\";s:13:\\\"software_name\\\";s:12:\\\"HRM Software\\\";s:7:\\\"send_to\\\";s:16:\\\"Managin Director\\\";s:6:\\\"amount\\\";d:5000;}}}s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'ErrorException: Invalid argument supplied for foreach() in C:\\work\\ibs_accounts_mail_version\\app\\Jobs\\SendMailToClientJob.php:35\nStack trace:\n#0 C:\\work\\ibs_accounts_mail_version\\app\\Jobs\\SendMailToClientJob.php(35): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(2, \'Invalid argumen...\', \'C:\\\\work\\\\ibs_acc...\', 35, Array)\n#1 [internal function]: App\\Jobs\\SendMailToClientJob->handle()\n#2 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): call_user_func_array(Array, Array)\n#3 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#4 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#5 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(39): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#6 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#7 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(94): Illuminate\\Container\\Container->call(Array)\n#8 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\SendMailToClientJob))\n#9 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendMailToClientJob))\n#10 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#11 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\SendMailToClientJob), false)\n#12 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\SendMailToClientJob))\n#13 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendMailToClientJob))\n#14 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#15 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\SendMailToClientJob))\n#16 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#17 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(356): Illuminate\\Queue\\Jobs\\Job->fire()\n#18 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(306): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#19 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(132): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#20 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#21 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#22 [internal function]: Illuminate\\Queue\\Console\\WorkCommand->handle()\n#23 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): call_user_func_array(Array, Array)\n#24 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#25 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#26 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(39): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#27 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#28 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(134): Illuminate\\Container\\Container->call(Array)\n#29 C:\\work\\ibs_accounts_mail_version\\vendor\\symfony\\console\\Command\\Command.php(258): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#30 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#31 C:\\work\\ibs_accounts_mail_version\\vendor\\symfony\\console\\Application.php(911): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#32 C:\\work\\ibs_accounts_mail_version\\vendor\\symfony\\console\\Application.php(264): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#33 C:\\work\\ibs_accounts_mail_version\\vendor\\symfony\\console\\Application.php(140): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#34 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#35 C:\\work\\ibs_accounts_mail_version\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#36 C:\\work\\ibs_accounts_mail_version\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#37 {main}', '2021-07-07 20:18:09');

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
  `service_confiq_id` int(10) UNSIGNED NOT NULL,
  `year_id` int(11) DEFAULT NULL,
  `month_id` int(11) DEFAULT NULL,
  `bill_no` varchar(45) DEFAULT NULL,
  `amount` varchar(45) DEFAULT NULL,
  `send_to` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `maintenace_bill`
--

INSERT INTO `maintenace_bill` (`id`, `service_confiq_id`, `year_id`, `month_id`, `bill_no`, `amount`, `send_to`, `created_at`, `updated_at`) VALUES
(1, 1, 2021, 1, 'IBS-21070001', '8000', 'Account Department', '2021-07-08 02:26:08', '2021-07-08 02:26:08'),
(2, 2, 2021, 1, 'IBS-21070002', '5000', 'Managin Director', '2021-07-08 02:26:08', '2021-07-08 02:26:08');

-- --------------------------------------------------------

--
-- Table structure for table `maintenace_bill_ledger`
--

CREATE TABLE `maintenace_bill_ledger` (
  `id` int(10) UNSIGNED NOT NULL,
  `maintenace_bill_id` int(10) UNSIGNED NOT NULL,
  `payableamount` varchar(45) DEFAULT NULL,
  `receiving_amount` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `maintenace_bill_ledger`
--

INSERT INTO `maintenace_bill_ledger` (`id`, `maintenace_bill_id`, `payableamount`, `receiving_amount`, `created_at`, `updated_at`) VALUES
(1, 1, '8000', '0', '2021-07-08 02:26:08', '2021-07-08 02:26:08'),
(2, 2, '5000', '0', '2021-07-08 02:26:08', '2021-07-08 02:26:08');

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
(2, 2, 'noman27.ibs@gmail.com', 'Accounts Manager', 'HRM Software', 5000, 1, '2021-07-07 10:34:46', '2021-07-07 10:34:46', 'Managin Director');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ma_service_confiq1_idx` (`service_confiq_id`);

--
-- Indexes for table `maintenace_bill_ledger`
--
ALTER TABLE `maintenace_bill_ledger`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_maintenace_bill_ledger_maintenace_bill1_idx` (`maintenace_bill_id`);

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
  ADD KEY `fk_service_confiq_client_information1_idx` (`client_information_id`);

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
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_information`
--
ALTER TABLE `client_information`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `company_infos`
--
ALTER TABLE `company_infos`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `maintenace_bill`
--
ALTER TABLE `maintenace_bill`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `maintenace_bill_ledger`
--
ALTER TABLE `maintenace_bill_ledger`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Constraints for table `maintenace_bill`
--
ALTER TABLE `maintenace_bill`
  ADD CONSTRAINT `fk_ma_service_confiq1` FOREIGN KEY (`service_confiq_id`) REFERENCES `service_confiq` (`id`);

--
-- Constraints for table `maintenace_bill_ledger`
--
ALTER TABLE `maintenace_bill_ledger`
  ADD CONSTRAINT `fk_maintenace_bill_ledger_maintenace_bill1` FOREIGN KEY (`maintenace_bill_id`) REFERENCES `maintenace_bill` (`id`);

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
