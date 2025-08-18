-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2025 at 03:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eata_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `record_id` bigint(20) UNSIGNED DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `iban` varchar(255) DEFAULT NULL,
  `swift_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `bank_name`, `account_number`, `iban`, `swift_code`, `created_at`, `updated_at`, `account_name`) VALUES
(1, 'Alex Bank', '2143243', '24234ytytr', 'Swe3435353', '2024-11-13 21:14:37', '2024-11-13 21:14:37', 'Eata');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiaries`
--

CREATE TABLE `beneficiaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `document_path` varchar(255) NOT NULL,
  `has_diseases` tinyint(1) NOT NULL DEFAULT 0,
  `is_supporting_others` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `marital_status` varchar(255) DEFAULT NULL,
  `family_members_count` int(11) DEFAULT NULL,
  `children_under_10_count` int(11) DEFAULT NULL,
  `critical_surgery_diseases` text DEFAULT NULL,
  `average_monthly_income` decimal(10,2) DEFAULT NULL,
  `id_document` varchar(255) DEFAULT NULL,
  `family_book` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_stories`
--

CREATE TABLE `beneficiary_stories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `author_name` varchar(255) DEFAULT NULL,
  `author_image` varchar(255) DEFAULT NULL,
  `media_type` varchar(255) DEFAULT 'image',
  `media_url` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_story_translations`
--

CREATE TABLE `beneficiary_story_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `beneficiary_story_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(2) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `user_id`, `name`, `email`, `phone`, `message`, `read_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Mohamed Hussein', 'mohamedhussein@gmail.com', '01148951078', 'Hello World', NULL, '2024-11-18 22:07:57', '2024-11-18 22:07:57'),
(2, NULL, 'Mohamed Hussein', 'mohamedhussein@gmail.com', '01148951078', 'Hello World', NULL, '2024-11-18 22:08:15', '2024-11-18 22:08:15'),
(3, NULL, 'أحمد محمد', 'ahmed.contact@example.com', '+963991111111', 'أريد معرفة المزيد عن طرق التبرع وكيف يمكنني المساعدة في مشاريعكم.', NULL, '2025-08-07 23:07:37', '2025-08-07 23:07:37'),
(4, NULL, 'فاطمة علي', 'fatima.contact@example.com', '+963992222222', 'أحتاج مساعدة لعائلتي، هل يمكنكم مساعدتنا في توفير الطعام والملابس؟', NULL, '2025-08-07 23:07:37', '2025-08-07 23:07:37'),
(5, NULL, 'محمد حسن', 'mohammed.contact@example.com', '+963993333333', 'أريد التطوع معكم، ما هي المتطلبات وكيف يمكنني الانضمام؟', NULL, '2025-08-07 23:07:38', '2025-08-07 23:07:38'),
(6, NULL, 'سارة أحمد', 'sara.contact@example.com', '+963994444444', 'أريد معرفة المزيد عن مشروع التعليم وكيف يمكنني دعمه.', NULL, '2025-08-07 23:07:38', '2025-08-07 23:07:38'),
(7, NULL, 'علي محمود', 'ali.contact@example.com', '+963995555555', 'لدي شكوى حول تأخر وصول المساعدات، أرجو التحقق من الأمر.', NULL, '2025-08-07 23:07:38', '2025-08-07 23:07:38'),
(8, NULL, 'نور الدين', 'nour.contact@example.com', '+963996666666', 'أقترح عليكم إضافة مشروع جديد لمساعدة كبار السن، هل يمكن تنفيذه؟', NULL, '2025-08-07 23:07:38', '2025-08-07 23:07:38'),
(9, NULL, 'ليلى كريم', 'layla.contact@example.com', '+963997777777', 'أريد معرفة المزيد عن جمعيتكم وأنشطتكم، هل يمكن إرسال كتيب إعلامي؟', NULL, '2025-08-07 23:07:38', '2025-08-07 23:07:38'),
(10, NULL, 'حسن عبد الله', 'hassan.contact@example.com', '+963998888888', 'أشكركم على المساعدة التي قدمتموها لعائلتي، لقد غيرتم حياتنا للأفضل.', NULL, '2025-08-07 23:07:38', '2025-08-07 23:07:38');

-- --------------------------------------------------------

--
-- Table structure for table `digital_currency_donations`
--

CREATE TABLE `digital_currency_donations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` enum('bank_account','e_wallet') NOT NULL,
  `bank_account_id` bigint(20) UNSIGNED DEFAULT NULL,
  `e_wallet_id` bigint(20) UNSIGNED DEFAULT NULL,
  `currency_type` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `proof_document` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `digital_currency_donations`
--

INSERT INTO `digital_currency_donations` (`id`, `payment_method`, `bank_account_id`, `e_wallet_id`, `currency_type`, `amount`, `user_id`, `created_at`, `updated_at`, `proof_document`, `name`, `email`, `phone`, `status`) VALUES
(1, 'e_wallet', NULL, 1, 'Paypal', 100.00, 1, '2024-11-13 22:44:46', '2024-11-13 22:44:46', NULL, 'Mohamed', 'info.mohamedhussein@gmail.com', '01148951078', 'pending'),
(2, 'e_wallet', NULL, 1, 'Paypal', 100.00, 1, '2024-11-13 22:45:35', '2024-11-18 23:49:04', 'proof_documents/BBc2XDlqWN6ytORIWKwdJSBrXeA41eTAmwWezpdJ.png', 'Mohamed', 'info.mohamedhussein@gmail.com', '01148951078', 'pending'),
(3, 'e_wallet', NULL, 1, 'Paypal', 50.00, 1, '2024-11-18 23:41:19', '2024-11-18 23:49:08', 'proof_documents/hnG1JeJG12GjrWJVnDBgpBCSJe6kHgg1QmvDvaIZ.png', 'محمد حسين', 'mohamedhussein@gmail.com', '01148951078', 'pending'),
(4, 'e_wallet', NULL, 1, 'SYP', 100.00, 8, '2025-08-17 22:46:51', '2025-08-17 22:46:51', '1755481611_Mohamed Hussein Resume.pdf', 'hmo', 'hmo@gmail.com', '01148951078', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `donation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `e_wallets`
--

CREATE TABLE `e_wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider` varchar(255) NOT NULL,
  `account_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency_type` varchar(50) DEFAULT NULL,
  `wallet_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `e_wallets`
--

INSERT INTO `e_wallets` (`id`, `provider`, `account_id`, `created_at`, `updated_at`, `currency_type`, `wallet_link`) VALUES
(1, 'MTN Cash', '21312312312', '2024-11-13 21:15:20', '2024-11-19 00:15:18', 'LY', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_donations`
--

CREATE TABLE `food_donations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `donation_type` varchar(255) DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `amount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food_donations`
--

INSERT INTO `food_donations` (`id`, `user_id`, `donation_type`, `is_available`, `amount`, `created_at`, `updated_at`, `name`, `email`, `phone`, `address`, `status`) VALUES
(1, 1, 'food', 1, NULL, '2024-11-13 22:14:27', '2024-11-18 23:38:10', 'Mohamed Hussein', 'mino46114@gmail.com', '01148951078', '6 October', 'pending'),
(2, 1, 'food', 1, NULL, '2024-11-13 22:15:17', '2024-11-13 22:15:17', 'Mohamed Hussein', 'mino46114@gmail.com', '01148951078', '6 October', 'pending'),
(3, 1, 'food', 1, NULL, '2024-11-13 22:16:31', '2024-11-18 23:38:15', 'Mohamed Hussein', 'mino46114@gmail.com', '01148951078', '6 October', 'pending'),
(4, 8, 'food', 1, 44.00, '2025-08-17 21:56:33', '2025-08-17 21:56:33', 'محمد حسين', 'hamo@gmail.com', '01148951078', 'عنوان جديد', 'pending'),
(5, 8, 'food', 1, 44.00, '2025-08-17 21:57:51', '2025-08-17 21:57:51', 'محمد حسين', 'hamo@gmail.com', '01148951078', 'عنوان جديد', 'pending'),
(6, 8, 'food', 1, 44.00, '2025-08-17 21:58:18', '2025-08-17 21:58:18', 'محمد حسين', 'hamo@gmail.com', '01148951078', 'عنوان جديد', 'pending'),
(7, 8, 'food', 1, 44.00, '2025-08-17 21:58:46', '2025-08-17 21:58:46', 'محمد حسين', 'hamo@gmail.com', '01148951078', 'عنوان جديد', 'pending'),
(8, 8, 'food', 1, 44.00, '2025-08-17 21:59:35', '2025-08-17 21:59:35', 'محمد حسين', 'hamo@gmail.com', '01148951078', 'عنوان جديد', 'pending'),
(9, 8, 'food', 1, 44.00, '2025-08-17 21:59:57', '2025-08-17 21:59:57', 'محمد حسين', 'hamo@gmail.com', '01148951078', 'عنوان جديد', 'pending'),
(10, 8, 'food', 1, 44.00, '2025-08-17 22:01:21', '2025-08-17 22:01:21', 'محمد حسين', 'hamo@gmail.com', '01148951078', 'عنوان جديد', 'pending'),
(11, 8, 'food', 1, 44.00, '2025-08-17 22:01:37', '2025-08-17 22:01:37', 'محمد حسين', 'hamo@gmail.com', '01148951078', 'عنوان جديد', 'pending'),
(12, 8, 'food', 1, 44.00, '2025-08-17 22:01:50', '2025-08-17 22:01:50', 'محمد حسين', 'hamo@gmail.com', '01148951078', 'عنوان جديد', 'pending'),
(13, 8, 'food', 1, 44.00, '2025-08-17 22:02:00', '2025-08-17 22:02:00', 'محمد حسين', 'hamo@gmail.com', '01148951078', 'عنوان جديد', 'pending'),
(14, 8, 'food', 1, 44.00, '2025-08-17 22:02:08', '2025-08-17 22:02:08', 'محمد حسين', 'hamo@gmail.com', '01148951078', 'عنوان جديد', 'pending'),
(15, 8, 'food', 1, 100.00, '2025-08-17 22:03:00', '2025-08-17 22:03:00', 'محمد حسين', 'hamo@gmail.com', '01148951078', 'عنوان جديد', 'pending'),
(16, 8, 'food', 1, 100.00, '2025-08-17 22:03:10', '2025-08-17 22:03:10', 'محمد حسين', 'hamo@gmail.com', '01148951078', 'عنوان جديد', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `ticket_id`, `sender_id`, `message`, `created_at`, `updated_at`) VALUES
(4, 2, 1, 'اهلا', '2024-11-13 20:52:57', '2024-11-13 20:52:57'),
(5, 2, 1, 'gg', '2024-11-18 19:56:06', '2024-11-18 19:56:06'),
(6, 2, 1, 'gg', '2024-11-18 19:56:17', '2024-11-18 19:56:17'),
(7, 2, 1, 'gg', '2024-11-18 19:56:23', '2024-11-18 19:56:23'),
(8, 2, 1, 's', '2024-11-18 19:56:26', '2024-11-18 19:56:26'),
(9, 2, 1, 'حبي', '2025-08-07 16:19:33', '2025-08-07 16:19:33'),
(10, 2, 1, 'حبيبي', '2025-08-08 00:55:20', '2025-08-08 00:55:20');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_04_04_203159_create_projects_table', 1),
(7, '2024_04_04_203200_create_donations_table', 1),
(8, '2024_04_04_204656_create_e_wallets_table', 1),
(9, '2024_04_04_204931_create_bank_accounts_table', 1),
(10, '2024_04_04_220104_update_bank_accounts_table', 1),
(11, '2024_04_04_224926_add_type_to_users_table', 1),
(12, '2024_10_25_165425_create_tickets_table', 1),
(13, '2024_10_25_165428_create_ticket_assignments_table', 1),
(14, '2024_10_25_165449_create_messages_table', 1),
(15, '2024_10_25_221942_add_columns_to_donations_table', 1),
(16, '2024_10_25_224525_create_orders_table', 1),
(17, '2024_10_26_004338_create_cart_table', 1),
(18, '2024_10_26_005017_add_columns_to_cart_table', 1),
(19, '2024_10_26_011535_create_payments_table', 1),
(20, '2024_10_26_014834_create_food_donations_table', 1),
(21, '2024_10_26_024325_create_digital_currency_donations_table', 1),
(22, '2024_10_26_024758_add_proof_document_to_digital_currency_donations_table', 1),
(23, '2024_11_13_205800_add_columns_to_payments_and_orders', 1),
(24, '2024_11_13_231129_add_details_to_food_donations_table', 2),
(25, '2024_11_14_003713_add_details_digital_currency_donations_table', 3),
(26, '2024_11_14_005150_create_contacts_table', 4),
(27, '2024_11_18_222743_add_currency_type_and_wallet_link_to_e_wallets_table', 5),
(28, '2024_11_18_222822_create_settings_table', 6),
(29, '2024_11_19_004747_create_notifications_table', 7),
(30, '2024_11_19_014808_add_status_to_digital_currency_donations_table', 8),
(32, '2024_11_19_024517_add_role_to_users_table', 10),
(75, '2025_08_07_235554_add_is_featured_to_projects_table', 11),
(76, '2025_08_07_235350_add_read_at_to_contacts_table', 12),
(77, '2024_06_01_000000_create_sms_donation_records_table', 13),
(78, '2024_06_01_100000_create_admin_notifications_table', 13),
(79, '2024_11_19_020228_add_is_active_to_users_table', 13),
(80, '2024_11_19_025148_create_roles_table', 13),
(81, '2024_11_19_025218_create_role_user_table', 13),
(82, '2024_11_19_030900_add_role_id_to_users_table', 13),
(83, '2024_11_20_134000_create_volunteers_table', 13),
(84, '2024_11_20_134233_create_beneficiaries_table', 13),
(85, '2024_12_10_213255_update_volunteers_table', 13),
(86, '2024_12_10_213308_update_beneficiaries_table', 13),
(87, '2025_05_04_001349_create_sms_donations_table', 13),
(88, '2025_05_04_015012_create_pages_table', 13),
(89, '2025_05_04_021838_create_beneficiary_stories_table', 13),
(90, '2025_05_04_031525_create_testimonials_table', 13),
(91, '2025_08_06_200500_create_project_translations_table', 13),
(92, '2025_08_06_200501_create_page_translations_table', 13),
(93, '2025_08_06_200544_create_testimonial_translations_table', 13),
(94, '2025_08_06_230905_create_remaining_translation_tables', 13),
(95, '2025_08_07_235404_add_read_at_to_admin_notifications_table', 13),
(96, '2025_08_07_235415_add_status_columns_to_various_tables', 13),
(97, '2024_04_05_000000_add_soft_deletes_to_projects_table', 14),
(98, '2024_04_05_000001_add_soft_deletes_to_donations_table', 14),
(99, '2025_08_08_040000_add_content_to_project_translations_table', 15),
(100, '2025_08_08_040001_add_missing_columns_to_page_translations_table', 16),
(101, '2025_08_08_040002_add_missing_columns_to_testimonial_translations_table', 17),
(102, '2025_08_08_040003_fix_testimonial_translations_table', 18),
(103, '2025_08_18_000000_add_user_id_to_volunteers_table', 19),
(104, '2025_08_18_001000_add_user_id_to_sms_tables', 20),
(105, '2025_08_18_002000_create_reward_points_tables', 21);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'المستخدم المستهدف',
  `type` varchar(255) DEFAULT NULL COMMENT 'نوع الإشعار',
  `title` varchar(255) NOT NULL COMMENT 'عنوان الإشعار',
  `message` text NOT NULL COMMENT 'تفاصيل الإشعار',
  `is_read` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'حالة القراءة',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `type`, `title`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 1, 'order', 'تحديث حالة الطلب', 'تم تحديث حالة طلبك إلى: rejected', 0, '2024-11-18 23:08:14', '2024-11-18 23:08:14'),
(2, NULL, 'order', 'تحديث حالة الطلب', 'تم تحديث حالة طلبك إلى: completed', 0, '2024-11-18 23:08:18', '2024-11-18 23:08:18'),
(3, 1, 'order', 'تحديث حالة الطلب', 'تم تحديث حالة طلبك إلى: rejected', 0, '2024-11-18 23:13:54', '2024-11-18 23:13:54'),
(4, 1, 'order', 'تحديث حالة الطلب', 'تم تحديث حالة طلبك إلى: completed', 0, '2024-11-18 23:13:59', '2024-11-18 23:13:59'),
(5, 1, 'order', 'تحديث حالة الطلب', 'تم تحديث حالة طلبك إلى: completed', 0, '2024-11-18 23:35:49', '2024-11-18 23:35:49'),
(6, 1, 'order', 'تحديث حالة الطلب', 'تم تحديث حالة طلبك إلى: rejected', 0, '2024-11-18 23:36:25', '2024-11-18 23:36:25'),
(7, 1, 'order', 'تحديث حالة الطلب', 'تم تحديث حالة طلبك إلى: rejected', 0, '2024-11-18 23:36:47', '2024-11-18 23:36:47'),
(8, 1, 'order', 'تحديث حالة الطلب', 'تم تحديث حالة طلبك إلى: completed', 0, '2024-11-18 23:36:58', '2024-11-18 23:36:58'),
(9, 1, 'order', 'تحديث حالة طلب تبرع بالمستلزمات', 'تم تحديث حالة طلبك إلى: completed', 0, '2024-11-18 23:38:10', '2024-11-18 23:38:10'),
(10, 1, 'order', 'تحديث حالة طلب تبرع بالمستلزمات', 'تم تحديث حالة طلبك إلى: rejected', 0, '2024-11-18 23:38:15', '2024-11-18 23:38:15'),
(11, 1, 'digital_donation', 'تحديث حالة طلب تبرع بالعملات الرقمية', 'تم تحديث حالة طلبك إلى: completed', 0, '2024-11-18 23:49:04', '2024-11-18 23:49:04'),
(12, 1, 'digital_donation', 'تحديث حالة طلب تبرع بالعملات الرقمية', 'تم تحديث حالة طلبك إلى: rejected', 0, '2024-11-18 23:49:08', '2024-11-18 23:49:08');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('pending','completed','cancelled') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `project_id`, `user_id`, `total_price`, `created_at`, `updated_at`, `payment_id`, `status`) VALUES
(1, 1, 1, 50.00, '2024-11-13 20:00:47', '2024-11-13 20:00:47', 2, 'pending'),
(2, 1, 1, 50.00, '2024-11-13 20:02:13', '2024-11-18 23:36:47', 3, 'pending'),
(3, 1, 1, 50.00, '2024-11-13 20:02:13', '2024-11-18 23:36:58', 3, 'pending'),
(4, NULL, NULL, 100.00, '2024-11-20 10:25:43', '2024-11-20 10:25:43', 5, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('draft','published','archived') NOT NULL DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `is_active`, `sort_order`, `meta_title`, `meta_description`, `featured_image`, `created_at`, `updated_at`, `status`) VALUES
(1, 'من نحن', 'about-us', '<h2>من نحن</h2><p>جمعية إحسان هي جمعية خيرية غير ربحية تأسست عام 2020 بهدف مساعدة المحتاجين وتقديم المساعدات الإنسانية في سوريا.</p><p>نحن نعمل على:</p><ul><li>تقديم المساعدات المادية والعينية للمحتاجين</li><li>دعم المشاريع التعليمية والصحية</li><li>مساعدة الأسر المتضررة</li><li>توفير المأوى والطعام للمحتاجين</li></ul>', 1, 0, NULL, 'تعرف على جمعية إحسان وأهدافنا في مساعدة المحتاجين', NULL, '2025-08-07 23:04:29', '2025-08-07 23:04:29', 'draft'),
(2, 'مشاريعنا', 'our-projects', '<h2>مشاريعنا</h2><p>نقوم بتنفيذ العديد من المشاريع الإنسانية المهمة:</p><h3>مشروع المساعدات الغذائية</h3><p>توزيع الطعام والمواد الغذائية الأساسية للأسر المحتاجة.</p><h3>مشروع التعليم</h3><p>دعم التعليم وتوفير الكتب واللوازم المدرسية للأطفال.</p><h3>مشروع الصحة</h3><p>توفير الرعاية الصحية والدواء للمرضى المحتاجين.</p>', 1, 0, NULL, 'تعرف على مشاريعنا الإنسانية المختلفة', NULL, '2025-08-07 23:04:29', '2025-08-07 23:04:29', 'draft'),
(3, 'كيف تتبرع', 'how-to-donate', '<h2>كيف تتبرع</h2><p>يمكنك التبرع لنا بعدة طرق:</p><h3>التحويل البنكي</h3><p>يمكنك تحويل المبلغ إلى حسابنا البنكي المذكور أدناه.</p><h3>التبرع عبر الإنترنت</h3><p>يمكنك التبرع مباشرة عبر موقعنا الإلكتروني.</p><h3>التبرع النقدي</h3><p>يمكنك زيارة مقرنا والتبرع نقداً.</p>', 1, 0, NULL, 'تعرف على طرق التبرع المختلفة', NULL, '2025-08-07 23:04:29', '2025-08-07 23:04:29', 'draft'),
(4, 'تواصل معنا', 'contact-us', '<h2>تواصل معنا</h2><p>يمكنك التواصل معنا عبر:</p><h3>الهاتف</h3><p>+963 11 123 4567</p><h3>البريد الإلكتروني</h3><p>info@ihsan.org</p><h3>العنوان</h3><p>دمشق، سوريا<br>شارع الرئيسي، بناء رقم 123</p>', 1, 0, NULL, 'معلومات التواصل مع جمعية إحسان', NULL, '2025-08-07 23:04:29', '2025-08-07 23:04:29', 'draft'),
(5, 'سياسة الخصوصية', 'privacy-policy', '<h2>سياسة الخصوصية</h2><p>نحن نحترم خصوصيتك ونلتزم بحماية معلوماتك الشخصية.</p><h3>جمع المعلومات</h3><p>نقوم بجمع المعلومات الضرورية فقط لتقديم خدماتنا.</p><h3>استخدام المعلومات</h3><p>نستخدم معلوماتك فقط للأغراض المعلنة.</p>', 1, 0, NULL, 'سياسة الخصوصية لجمعية إحسان', NULL, '2025-08-07 23:04:29', '2025-08-07 23:04:29', 'draft');

-- --------------------------------------------------------

--
-- Table structure for table `page_translations`
--

CREATE TABLE `page_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(2) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_translations`
--

INSERT INTO `page_translations` (`id`, `page_id`, `locale`, `title`, `content`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', '22', '22', NULL, NULL, '2025-08-08 13:48:06', '2025-08-08 13:48:06'),
(2, 2, 'en', 'ww', 'ww', NULL, NULL, '2025-08-08 14:34:38', '2025-08-08 14:34:38');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cart_total` decimal(10,2) NOT NULL,
  `payment_method` enum('bank_account','e_wallet') NOT NULL,
  `account_bank_id` bigint(20) UNSIGNED DEFAULT NULL,
  `e_wallet_id` bigint(20) UNSIGNED DEFAULT NULL,
  `confirmation_document` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `cart_total`, `payment_method`, `account_bank_id`, `e_wallet_id`, `confirmation_document`, `created_at`, `updated_at`, `first_name`, `last_name`, `email`, `phone`, `status`) VALUES
(2, NULL, 50.00, 'e_wallet', NULL, 1, NULL, '2024-11-13 20:00:47', '2024-11-18 23:08:14', 'Mohamed', 'Hussein', 'mino46114@gmail.com', '01148951078', 'pending'),
(3, NULL, 50.00, 'e_wallet', NULL, 1, 'confirmation_documents/gkWMRtR5wvrbJ8Q48zGCbEBRRzg3jaiwhGtD1deg.png', '2024-11-13 20:02:13', '2024-11-18 23:36:58', 'Mohamed', 'Hussein', 'mino46114@gmail.com', '01148951078', 'pending'),
(5, NULL, 100.00, 'e_wallet', NULL, 1, 'confirmation_documents/FOiOqlqrrAWgHhAnmndUptrvh8yCqjOQjIeZQhyh.png', '2024-11-20 10:25:43', '2024-11-20 10:25:43', 'thecharimgdaisy', 'S', 'thecharimgdaisy@gmail.com', '01148951078', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `point_settings`
--

CREATE TABLE `point_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `donation_type` varchar(255) NOT NULL,
  `points_per_amount` int(11) NOT NULL,
  `amount_threshold` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `point_settings`
--

INSERT INTO `point_settings` (`id`, `donation_type`, `points_per_amount`, `amount_threshold`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'food_donation', 10, 100.00, 'نقاط التبرعات الغذائية', 1, '2025-08-17 20:46:29', '2025-08-17 20:46:29'),
(2, 'regular_donation', 15, 100.00, 'نقاط التبرعات العادية', 1, '2025-08-17 20:46:29', '2025-08-17 20:46:29'),
(3, 'sms_donation', 20, 50.00, 'نقاط تبرعات الرسائل', 1, '2025-08-17 20:46:29', '2025-08-17 20:46:29'),
(4, 'digital_currency_donation', 25, 100.00, 'نقاط التبرعات الرقمية', 1, '2025-08-17 20:46:29', '2025-08-17 20:46:29'),
(5, 'food_donation', 10, 100.00, 'نقاط التبرعات الغذائية', 1, '2025-08-17 22:01:14', '2025-08-17 22:01:14'),
(6, 'regular_donation', 15, 100.00, 'نقاط التبرعات العادية', 1, '2025-08-17 22:01:14', '2025-08-17 22:01:14'),
(7, 'sms_donation', 20, 50.00, 'نقاط تبرعات الرسائل', 1, '2025-08-17 22:01:14', '2025-08-17 22:01:14'),
(8, 'digital_currency_donation', 25, 100.00, 'نقاط التبرعات الرقمية', 1, '2025-08-17 22:01:14', '2025-08-17 22:01:14');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `remaining_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `image_or_video` varchar(255) DEFAULT NULL,
  `visits` int(11) NOT NULL DEFAULT 0,
  `donation_count` int(11) NOT NULL DEFAULT 0,
  `beneficiaries_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('active','inactive','completed') NOT NULL DEFAULT 'active',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `total_amount`, `remaining_amount`, `image_or_video`, `visits`, `donation_count`, `beneficiaries_count`, `created_at`, `updated_at`, `is_featured`, `status`, `deleted_at`) VALUES
(1, 'مشروع جديد', 'مشروع جديد 2025', 500.00, 500.00, 'I4XksxASDp6tJTRNIhesyPsGtWrnrvyFQyjGdzrQ.jpg', 0, 8, 0, '2024-11-13 21:13:54', '2024-11-13 21:13:54', 0, 'active', NULL),
(2, 'مساعدة الأسر المحتاجة', 'مشروع لتقديم المساعدة المادية والعينية للأسر المحتاجة في مختلف المناطق', 5000000.00, 2500000.00, NULL, 150, 25, 50, '2025-08-07 23:03:39', '2025-08-07 23:03:39', 0, 'active', NULL),
(3, 'بناء مدرسة في الريف', 'مشروع لبناء مدرسة في المناطق الريفية لتوفير التعليم للأطفال', 10000000.00, 7000000.00, NULL, 200, 40, 200, '2025-08-07 23:03:39', '2025-08-07 23:03:39', 0, 'active', NULL),
(4, 'توفير المياه النظيفة', 'مشروع لحفر آبار وتوفير المياه النظيفة للمناطق المحرومة', 3000000.00, 1500000.00, NULL, 100, 15, 300, '2025-08-07 23:03:39', '2025-08-07 23:03:39', 0, 'active', NULL),
(5, 'مساعدة المرضى', 'مشروع لتوفير العلاج والدواء للمرضى المحتاجين', 2000000.00, 1200000.00, NULL, 80, 12, 100, '2025-08-07 23:03:39', '2025-08-07 23:03:39', 0, 'active', NULL),
(6, 'إعادة تأهيل المنازل', 'مشروع لإعادة تأهيل المنازل المتضررة وتوفير المأوى للأسر', 8000000.00, 4000000.00, NULL, 300, 60, 80, '2025-08-07 23:03:39', '2025-08-07 23:03:39', 0, 'completed', NULL),
(7, 'مساعدة الأسر المحتاجة', 'مشروع لتقديم المساعدة المادية والعينية للأسر المحتاجة في مختلف المناطق', 5000000.00, 2500000.00, NULL, 150, 25, 50, '2025-08-07 23:08:01', '2025-08-07 23:08:01', 0, 'active', NULL),
(8, 'بناء مدرسة في الريف', 'مشروع لبناء مدرسة في المناطق الريفية لتوفير التعليم للأطفال', 10000000.00, 7000000.00, NULL, 200, 40, 200, '2025-08-07 23:08:01', '2025-08-07 23:08:01', 0, 'active', NULL),
(9, 'توفير المياه النظيفة', 'مشروع لحفر آبار وتوفير المياه النظيفة للمناطق المحرومة', 3000000.00, 1500000.00, NULL, 100, 15, 300, '2025-08-07 23:08:01', '2025-08-07 23:08:01', 0, 'active', NULL),
(10, 'مساعدة المرضى', 'مشروع لتوفير العلاج والدواء للمرضى المحتاجين', 2000000.00, 1200000.00, NULL, 80, 12, 100, '2025-08-07 23:08:01', '2025-08-07 23:08:01', 0, 'active', NULL),
(11, 'إعادة تأهيل المنازل', 'مشروع لإعادة تأهيل المنازل المتضررة وتوفير المأوى للأسر', 8000000.00, 4000000.00, NULL, 300, 60, 80, '2025-08-07 23:08:01', '2025-08-07 23:08:01', 0, 'completed', NULL),
(12, 'مساعدة الأسر المحتاجة', 'مشروع لتقديم المساعدة المادية والعينية للأسر المحتاجة في مختلف المناطق', 5000000.00, 2500000.00, NULL, 172, 25, 50, '2025-08-07 23:08:26', '2025-08-08 00:33:43', 0, 'active', NULL),
(13, 'بناء مدرسة في الريف', 'مشروع لبناء مدرسة في المناطق الريفية لتوفير التعليم للأطفال', 10000000.00, 7000000.00, NULL, 202, 40, 200, '2025-08-07 23:08:26', '2025-08-08 00:42:41', 0, 'active', NULL),
(14, 'توفير المياه النظيفة', 'مشروع لحفر آبار وتوفير المياه النظيفة للمناطق المحرومة', 3000000.00, 1500000.00, NULL, 100, 15, 300, '2025-08-07 23:08:26', '2025-08-07 23:08:26', 0, 'active', NULL),
(15, 'مساعدة المرضى', 'مشروع لتوفير العلاج والدواء للمرضى المحتاجين', 2000000.00, 1200000.00, NULL, 80, 12, 100, '2025-08-07 23:08:26', '2025-08-07 23:08:26', 0, 'active', NULL),
(16, 'إعادة تأهيل المنازل', 'مشروع لإعادة تأهيل المنازل المتضررة وتوفير المأوى للأسر', 8000000.00, 4000000.00, NULL, 300, 60, 80, '2025-08-07 23:08:26', '2025-08-07 23:08:26', 0, 'completed', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_translations`
--

CREATE TABLE `project_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(2) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_translations`
--

INSERT INTO `project_translations` (`id`, `project_id`, `locale`, `title`, `description`, `content`, `created_at`, `updated_at`) VALUES
(2, 1, 'en', 'test', 'test 2', NULL, '2025-08-08 01:00:10', '2025-08-08 01:00:10'),
(3, 12, 'en', '22', '22', NULL, '2025-08-08 13:47:23', '2025-08-08 13:47:23');

-- --------------------------------------------------------

--
-- Table structure for table `reward_points`
--

CREATE TABLE `reward_points` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `points` int(11) NOT NULL,
  `donation_type` enum('food_donation','regular_donation','sms_donation','digital_currency_donation','sms_record') NOT NULL,
  `donation_amount` decimal(10,2) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `donatable_type` varchar(255) NOT NULL,
  `donatable_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reward_points`
--

INSERT INTO `reward_points` (`id`, `user_id`, `points`, `donation_type`, `donation_amount`, `description`, `donatable_type`, `donatable_id`, `created_at`, `updated_at`) VALUES
(1, 8, 10, 'food_donation', 100.00, 'نقاط مكافأة على التبرع الغذائي', 'App\\Models\\FoodDonation', 16, '2025-08-17 22:03:10', '2025-08-17 22:03:10'),
(2, 8, 25, 'digital_currency_donation', 100.00, 'نقاط مكافأة على تبرع العملات الرقمية', 'App\\Models\\DigitalCurrencyDonation', 4, '2025-08-17 22:46:51', '2025-08-17 22:46:51');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2025-08-08 00:46:14', '2025-08-08 00:46:14');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `facebook_link` varchar(255) DEFAULT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `youtube_link` varchar(255) DEFAULT NULL,
  `linkedin_link` varchar(255) DEFAULT NULL,
  `copyright` text DEFAULT NULL,
  `footer_description` text DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `email`, `phone`, `address`, `logo`, `facebook_link`, `twitter_link`, `youtube_link`, `linkedin_link`, `copyright`, `footer_description`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
(1, 'إعطاء22', 'eata@email.com', '1234567890', '123 شارع رئيسي، المدينة', 'logos/8R87FZYDhRK71PazyP3bUtjcmwxeb3pUNHIe0Sxk.png', 'https://facebook.com', 'https://twitter.com', 'https://youtube.com', 'https://linkedin.com', 'حقوق الطبع والنشر 2024 Eata. جميع الحقوق محفوظة.', 'تتيح لك منصة التبرع الآمنة عبر الإنترنت الخاصة بنا تقديم المساهمات بسرعة وأمان. اختر من بين مختلف.', NULL, NULL, NULL, '2024-11-18 21:24:06', '2025-08-07 21:41:18'),
(2, 'اسم الموقع', 'example@example.com', '1234567890', '123 شارع رئيسي، المدينة', 'default-logo.png', 'https://facebook.com', 'https://twitter.com', 'https://youtube.com', 'https://linkedin.com', 'جميع الحقوق محفوظة © 2024', 'هذا هو وصف الفوتر الافتراضي.', NULL, NULL, NULL, '2024-11-18 21:24:31', '2024-11-18 21:24:31'),
(3, 'اسم الموقع', 'example@example.com', '1234567890', '123 شارع رئيسي، المدينة', 'default-logo.png', 'https://facebook.com', 'https://twitter.com', 'https://youtube.com', 'https://linkedin.com', 'جميع الحقوق محفوظة © 2024', 'هذا هو وصف الفوتر الافتراضي.', NULL, NULL, NULL, '2025-08-07 23:01:37', '2025-08-07 23:01:37'),
(4, 'اسم الموقع', 'example@example.com', '1234567890', '123 شارع رئيسي، المدينة', 'default-logo.png', 'https://facebook.com', 'https://twitter.com', 'https://youtube.com', 'https://linkedin.com', 'جميع الحقوق محفوظة © 2024', 'هذا هو وصف الفوتر الافتراضي.', NULL, NULL, NULL, '2025-08-07 23:02:57', '2025-08-07 23:02:57'),
(5, 'اسم الموقع', 'example@example.com', '1234567890', '123 شارع رئيسي، المدينة', 'default-logo.png', 'https://facebook.com', 'https://twitter.com', 'https://youtube.com', 'https://linkedin.com', 'جميع الحقوق محفوظة © 2024', 'هذا هو وصف الفوتر الافتراضي.', NULL, NULL, NULL, '2025-08-07 23:08:01', '2025-08-07 23:08:01'),
(6, 'اسم الموقع', 'example@example.com', '1234567890', '123 شارع رئيسي، المدينة', 'default-logo.png', 'https://facebook.com', 'https://twitter.com', 'https://youtube.com', 'https://linkedin.com', 'جميع الحقوق محفوظة © 2024', 'هذا هو وصف الفوتر الافتراضي.', NULL, NULL, NULL, '2025-08-07 23:08:26', '2025-08-07 23:08:26');

-- --------------------------------------------------------

--
-- Table structure for table `setting_translations`
--

CREATE TABLE `setting_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `setting_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(2) NOT NULL,
  `site_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `copyright` text DEFAULT NULL,
  `footer_description` text DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms_donations`
--

CREATE TABLE `sms_donations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `sms_code` varchar(255) DEFAULT NULL,
  `message_text` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_donations`
--

INSERT INTO `sms_donations` (`id`, `user_id`, `amount`, `sms_code`, `message_text`, `phone_number`, `created_at`, `updated_at`, `status`) VALUES
(1, NULL, NULL, NULL, 'eee', '0123213', '2025-08-17 22:47:21', '2025-08-17 22:47:21', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `sms_donation_records`
--

CREATE TABLE `sms_donation_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `sms_code` varchar(255) NOT NULL,
  `message_text` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `rating` int(11) NOT NULL DEFAULT 5,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `approved_at` timestamp NULL DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `title`, `content`, `image`, `rating`, `is_approved`, `approved_at`, `is_featured`, `user_id`, `order`, `created_at`, `updated_at`) VALUES
(1, 'أحمد محمد', 'مستفيد من مشروع المساعدة', 'أشكركم كثيراً على المساعدة التي قدمتموها لعائلتي. لقد غيرتم حياتنا للأفضل وساعدتمونا في تخطي الأوقات الصعبة.', NULL, 5, 1, NULL, 0, NULL, 0, '2025-08-07 23:03:43', '2025-08-07 23:03:43'),
(2, 'فاطمة علي', 'أم لثلاثة أطفال', 'بفضل مساعدتكم استطعت توفير الطعام والملابس لأطفالي. أنتم ملائكة الرحمة وأدعو لكم بالخير دائماً.', NULL, 5, 1, NULL, 0, NULL, 0, '2025-08-07 23:03:43', '2025-08-07 23:03:43'),
(3, 'محمد حسن', 'متطوع في الجمعية', 'أعمل متطوعاً مع الجمعية منذ عامين وأشهد على مدى تأثير مساعداتكم الإيجابي على حياة الناس. العمل معكم شرف كبير.', NULL, 5, 1, NULL, 0, NULL, 0, '2025-08-07 23:03:43', '2025-08-07 23:03:43'),
(4, 'سارة أحمد', 'مستفيدة من مشروع التعليم', 'بفضل مشروع التعليم استطعت العودة إلى المدرسة وإكمال دراستي. شكراً لكم على إعطائي فرصة ثانية في الحياة.', NULL, 4, 1, NULL, 0, NULL, 0, '2025-08-07 23:03:43', '2025-08-07 23:03:43'),
(5, 'علي محمود', 'أب لأسرة مكونة من 6 أفراد', 'كنت أعاني من صعوبة في توفير احتياجات أسرتي، ولكن بفضل مساعدتكم استطعت تخطي هذه الأزمة. شكراً لكم من القلب.', NULL, 5, 1, NULL, 0, NULL, 0, '2025-08-07 23:03:43', '2025-08-07 23:03:43'),
(6, 'نور الدين', 'مستفيد من مشروع المياه', 'كانت مشكلة المياه من أكبر المشاكل التي نواجهها، ولكن بفضل مشروعكم أصبح لدينا مياه نظيفة وصالحة للشرب.', NULL, 4, 0, NULL, 0, NULL, 0, '2025-08-07 23:03:43', '2025-08-07 23:03:43'),
(7, 'ليلى كريم', 'معلمة متطوعة', 'أعمل معلمة متطوعة في مشروع التعليم وأرى يومياً كيف تغير هذه المشاريع حياة الأطفال. شكراً لكم على دعمكم.', NULL, 5, 1, NULL, 0, NULL, 0, '2025-08-07 23:03:43', '2025-08-07 23:03:43'),
(8, 'أحمد محمد', 'مستفيد من مشروع المساعدة', 'أشكركم كثيراً على المساعدة التي قدمتموها لعائلتي. لقد غيرتم حياتنا للأفضل وساعدتمونا في تخطي الأوقات الصعبة.', NULL, 5, 1, NULL, 0, NULL, 0, '2025-08-07 23:08:01', '2025-08-07 23:08:01'),
(9, 'فاطمة علي', 'أم لثلاثة أطفال', 'بفضل مساعدتكم استطعت توفير الطعام والملابس لأطفالي. أنتم ملائكة الرحمة وأدعو لكم بالخير دائماً.', NULL, 5, 1, NULL, 0, NULL, 0, '2025-08-07 23:08:01', '2025-08-07 23:08:01'),
(10, 'محمد حسن', 'متطوع في الجمعية', 'أعمل متطوعاً مع الجمعية منذ عامين وأشهد على مدى تأثير مساعداتكم الإيجابي على حياة الناس. العمل معكم شرف كبير.', NULL, 5, 1, NULL, 0, NULL, 0, '2025-08-07 23:08:01', '2025-08-07 23:08:01'),
(11, 'سارة أحمد', 'مستفيدة من مشروع التعليم', 'بفضل مشروع التعليم استطعت العودة إلى المدرسة وإكمال دراستي. شكراً لكم على إعطائي فرصة ثانية في الحياة.', NULL, 4, 1, NULL, 0, NULL, 0, '2025-08-07 23:08:01', '2025-08-07 23:08:01'),
(12, 'علي محمود', 'أب لأسرة مكونة من 6 أفراد', 'كنت أعاني من صعوبة في توفير احتياجات أسرتي، ولكن بفضل مساعدتكم استطعت تخطي هذه الأزمة. شكراً لكم من القلب.', NULL, 5, 1, NULL, 0, NULL, 0, '2025-08-07 23:08:01', '2025-08-07 23:08:01'),
(13, 'نور الدين', 'مستفيد من مشروع المياه', 'كانت مشكلة المياه من أكبر المشاكل التي نواجهها، ولكن بفضل مشروعكم أصبح لدينا مياه نظيفة وصالحة للشرب.', NULL, 4, 0, NULL, 0, NULL, 0, '2025-08-07 23:08:01', '2025-08-07 23:08:01'),
(14, 'ليلى كريم', 'معلمة متطوعة', 'أعمل معلمة متطوعة في مشروع التعليم وأرى يومياً كيف تغير هذه المشاريع حياة الأطفال. شكراً لكم على دعمكم.', NULL, 5, 1, NULL, 0, NULL, 0, '2025-08-07 23:08:01', '2025-08-07 23:08:01'),
(15, 'أحمد محمد', 'مستفيد من مشروع المساعدة', 'أشكركم كثيراً على المساعدة التي قدمتموها لعائلتي. لقد غيرتم حياتنا للأفضل وساعدتمونا في تخطي الأوقات الصعبة.', NULL, 5, 1, NULL, 0, NULL, 0, '2025-08-07 23:08:26', '2025-08-07 23:08:26'),
(16, 'فاطمة علي', 'أم لثلاثة أطفال', 'بفضل مساعدتكم استطعت توفير الطعام والملابس لأطفالي. أنتم ملائكة الرحمة وأدعو لكم بالخير دائماً.', NULL, 5, 1, NULL, 0, NULL, 0, '2025-08-07 23:08:26', '2025-08-07 23:08:26'),
(17, 'محمد حسن', 'متطوع في الجمعية', 'أعمل متطوعاً مع الجمعية منذ عامين وأشهد على مدى تأثير مساعداتكم الإيجابي على حياة الناس. العمل معكم شرف كبير.', NULL, 5, 1, NULL, 0, NULL, 0, '2025-08-07 23:08:26', '2025-08-07 23:08:26'),
(18, 'سارة أحمد', 'مستفيدة من مشروع التعليم', 'بفضل مشروع التعليم استطعت العودة إلى المدرسة وإكمال دراستي. شكراً لكم على إعطائي فرصة ثانية في الحياة.', NULL, 4, 1, NULL, 0, NULL, 0, '2025-08-07 23:08:26', '2025-08-07 23:08:26'),
(19, 'علي محمود', 'أب لأسرة مكونة من 6 أفراد', 'كنت أعاني من صعوبة في توفير احتياجات أسرتي، ولكن بفضل مساعدتكم استطعت تخطي هذه الأزمة. شكراً لكم من القلب.', NULL, 5, 1, NULL, 0, NULL, 0, '2025-08-07 23:08:26', '2025-08-07 23:08:26'),
(20, 'نور الدين', 'مستفيد من مشروع المياه', 'كانت مشكلة المياه من أكبر المشاكل التي نواجهها، ولكن بفضل مشروعكم أصبح لدينا مياه نظيفة وصالحة للشرب.', NULL, 4, 0, NULL, 0, NULL, 0, '2025-08-07 23:08:26', '2025-08-07 23:08:26'),
(21, 'ليلى كريم', 'معلمة متطوعة', 'أعمل معلمة متطوعة في مشروع التعليم وأرى يومياً كيف تغير هذه المشاريع حياة الأطفال. شكراً لكم على دعمكم.', NULL, 5, 1, NULL, 0, NULL, 0, '2025-08-07 23:08:26', '2025-08-07 23:08:26');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial_translations`
--

CREATE TABLE `testimonial_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `testimonial_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonial_translations`
--

INSERT INTO `testimonial_translations` (`id`, `testimonial_id`, `locale`, `name`, `content`, `created_at`, `updated_at`) VALUES
(1, 15, 'en', 'احمد محمد', 'سس', '2025-08-08 14:39:57', '2025-08-08 14:39:57');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('open','closed','pending') NOT NULL DEFAULT 'open'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `subject`, `created_at`, `updated_at`, `status`) VALUES
(2, 1, 'اهلا', '2024-11-13 20:52:57', '2024-11-13 20:52:57', 'open');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_assignments`
--

CREATE TABLE `ticket_assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'user',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `age`, `email`, `gender`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `type`, `is_active`, `role_id`) VALUES
(1, 'Admin2', '0123456789', 18, 'admin@email.com', 'male', NULL, '$2y$10$uUtxqFxEbYHCFRDW.wJX4.j2MVNWYUJfJiShpr9L.ZS8VAp6Rs.tu', NULL, '2024-11-13 21:12:38', '2024-11-18 22:28:36', 'admin', 1, 1),
(2, 'Mohamed Hussein', '01148951078', 18, 'mohamedhussein@gmail.com', 'male', NULL, '$2y$10$CGiwqjobVvnN1z3WsY6EruOdVc0q4cH6Agp16accy9v83XpUos2Tq', NULL, '2024-11-18 23:56:16', '2024-11-19 00:05:10', 'volunteer', 1, NULL),
(6, 'Hassan Hussein', '01148951078', 14, 'hassanhussei232n@gmail.com', 'male', NULL, '$2y$10$1zRv4owv8R1fgcPpHLf5/uA6r7/OxBJAXyZrsUB//N7WXiH2gKWGu', NULL, '2024-11-19 00:01:17', '2024-11-19 00:05:06', 'beneficiary', 1, NULL),
(7, 'Valco', '01148951078', 18, 'valco@gmail.com', 'male', NULL, '$2y$10$u8TUfjcnpoWkkPzERa4UTeAW3eIVp/TzI5MfGp8v7QIT0GVfCcWgC', NULL, '2024-11-19 01:09:32', '2024-11-19 01:14:52', 'admin', 1, NULL),
(8, 'حمودي2', '01148951078', 19, 'mino46114@gmail.com', 'male', NULL, '$2y$10$MTpPlYdKQJx/050dB9wf8u93dKUBRd3sevqH4.ZYRDQ7/5NoQ7dGy', NULL, '2025-08-17 21:16:18', '2025-08-17 22:03:32', 'volunteer', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `volunteers`
--

CREATE TABLE `volunteers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `document_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `charity_experience` text DEFAULT NULL,
  `academic_degree` varchar(255) DEFAULT NULL,
  `id_document` varchar(255) DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `volunteers`
--

INSERT INTO `volunteers` (`id`, `user_id`, `name`, `email`, `phone`, `address`, `age`, `document_path`, `created_at`, `updated_at`, `charity_experience`, `academic_degree`, `id_document`, `cv`) VALUES
(10, NULL, 'أحمد محمد', 'ahmed.volunteer@example.com', '+963991111111', 'دمشق، سوريا', 25, 'volunteer_documents/ahmed_cv.pdf', '2025-08-07 23:08:26', '2025-08-07 23:08:26', 'عملت متطوعاً لمدة 3 سنوات في جمعيات خيرية مختلفة', 'بكالوريوس في العمل الاجتماعي', NULL, NULL),
(11, NULL, 'فاطمة علي', 'fatima.volunteer@example.com', '+963992222222', 'حلب، سوريا', 30, 'volunteer_documents/fatima_cv.pdf', '2025-08-07 23:08:26', '2025-08-07 23:08:26', 'معلمة متطوعة في مشاريع التعليم لمدة 5 سنوات', 'بكالوريوس في التربية', NULL, NULL),
(12, NULL, 'محمد حسن', 'mohammed.volunteer@example.com', '+963993333333', 'حمص، سوريا', 28, 'volunteer_documents/mohammed_cv.pdf', '2025-08-07 23:08:26', '2025-08-07 23:08:26', 'متطوع في مشاريع توزيع الطعام والمساعدات الإنسانية', 'دبلوم في إدارة الأعمال', NULL, NULL),
(13, NULL, 'سارة أحمد', 'sara.volunteer@example.com', '+963994444444', 'حماة، سوريا', 22, 'volunteer_documents/sara_cv.pdf', '2025-08-07 23:08:26', '2025-08-07 23:08:26', 'متطوعة جديدة في مجال التصميم والاتصال', 'بكالوريوس في التصميم الجرافيكي', NULL, NULL),
(14, NULL, 'علي محمود', 'ali.volunteer@example.com', '+963995555555', 'اللاذقية، سوريا', 35, 'volunteer_documents/ali_cv.pdf', '2025-08-07 23:08:26', '2025-08-07 23:08:26', 'طبيب متطوع في العيادات الميدانية لمدة 8 سنوات', 'دكتوراه في الطب', NULL, NULL),
(15, NULL, 'نور الدين', 'nour.volunteer@example.com', '+963996666666', 'طرطوس، سوريا', 27, 'volunteer_documents/nour_cv.pdf', '2025-08-07 23:08:26', '2025-08-07 23:08:26', 'متطوع في مشاريع إعادة الإعمار وبناء المنازل', 'بكالوريوس في الهندسة المدنية', NULL, NULL),
(16, NULL, 'ليلى كريم', 'layla.volunteer@example.com', '+963997777777', 'دير الزور، سوريا', 24, 'volunteer_documents/layla_cv.pdf', '2025-08-07 23:08:26', '2025-08-07 23:08:26', 'متطوعة في مراكز الشباب ومشاريع التعليم', 'بكالوريوس في علم النفس', NULL, NULL),
(17, NULL, 'حسن عبد الله', 'hassan.volunteer@example.com', '+963998888888', 'إدلب، سوريا', 32, 'volunteer_documents/hassan_cv.pdf', '2025-08-07 23:08:26', '2025-08-07 23:08:26', 'قائد فريق متطوعين في مشاريع إنسانية مختلفة', 'ماجستير في إدارة المشاريع', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `beneficiaries_email_unique` (`email`);

--
-- Indexes for table `beneficiary_stories`
--
ALTER TABLE `beneficiary_stories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_stories_user_id_foreign` (`user_id`);

--
-- Indexes for table `beneficiary_story_translations`
--
ALTER TABLE `beneficiary_story_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `story_trans_unique` (`beneficiary_story_id`,`locale`),
  ADD KEY `beneficiary_story_translations_locale_index` (`locale`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_project_id_foreign` (`project_id`),
  ADD KEY `cart_user_id_foreign` (`user_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_user_id_foreign` (`user_id`);

--
-- Indexes for table `digital_currency_donations`
--
ALTER TABLE `digital_currency_donations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `digital_currency_donations_bank_account_id_foreign` (`bank_account_id`),
  ADD KEY `digital_currency_donations_e_wallet_id_foreign` (`e_wallet_id`),
  ADD KEY `digital_currency_donations_user_id_foreign` (`user_id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donations_user_id_foreign` (`user_id`),
  ADD KEY `donations_project_id_foreign` (`project_id`);

--
-- Indexes for table `e_wallets`
--
ALTER TABLE `e_wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `food_donations`
--
ALTER TABLE `food_donations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `food_donations_user_id_foreign` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_ticket_id_foreign` (`ticket_id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_project_id_foreign` (`project_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_payment_id_foreign` (`payment_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `page_translations`
--
ALTER TABLE `page_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_translations_page_id_locale_unique` (`page_id`,`locale`),
  ADD KEY `page_translations_locale_index` (`locale`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_user_id_foreign` (`user_id`),
  ADD KEY `payments_account_bank_id_foreign` (`account_bank_id`),
  ADD KEY `payments_e_wallet_id_foreign` (`e_wallet_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `point_settings`
--
ALTER TABLE `point_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_translations`
--
ALTER TABLE `project_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `project_translations_project_id_locale_unique` (`project_id`,`locale`),
  ADD KEY `project_translations_locale_index` (`locale`);

--
-- Indexes for table `reward_points`
--
ALTER TABLE `reward_points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reward_points_user_id_foreign` (`user_id`),
  ADD KEY `reward_points_donatable_type_donatable_id_index` (`donatable_type`,`donatable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting_translations`
--
ALTER TABLE `setting_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_trans_unique` (`setting_id`,`locale`),
  ADD KEY `setting_translations_locale_index` (`locale`);

--
-- Indexes for table `sms_donations`
--
ALTER TABLE `sms_donations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sms_donations_user_id_foreign` (`user_id`);

--
-- Indexes for table `sms_donation_records`
--
ALTER TABLE `sms_donation_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sms_donation_records_user_id_foreign` (`user_id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `testimonials_user_id_foreign` (`user_id`);

--
-- Indexes for table `testimonial_translations`
--
ALTER TABLE `testimonial_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `testimonial_translations_testimonial_id_locale_unique` (`testimonial_id`,`locale`),
  ADD KEY `testimonial_translations_locale_index` (`locale`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_user_id_foreign` (`user_id`);

--
-- Indexes for table `ticket_assignments`
--
ALTER TABLE `ticket_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_assignments_ticket_id_foreign` (`ticket_id`),
  ADD KEY `ticket_assignments_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `volunteers`
--
ALTER TABLE `volunteers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `volunteers_email_unique` (`email`),
  ADD KEY `volunteers_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `beneficiary_stories`
--
ALTER TABLE `beneficiary_stories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `beneficiary_story_translations`
--
ALTER TABLE `beneficiary_story_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `digital_currency_donations`
--
ALTER TABLE `digital_currency_donations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `e_wallets`
--
ALTER TABLE `e_wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_donations`
--
ALTER TABLE `food_donations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `page_translations`
--
ALTER TABLE `page_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `point_settings`
--
ALTER TABLE `point_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `project_translations`
--
ALTER TABLE `project_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reward_points`
--
ALTER TABLE `reward_points`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `setting_translations`
--
ALTER TABLE `setting_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_donations`
--
ALTER TABLE `sms_donations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sms_donation_records`
--
ALTER TABLE `sms_donation_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `testimonial_translations`
--
ALTER TABLE `testimonial_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ticket_assignments`
--
ALTER TABLE `ticket_assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `volunteers`
--
ALTER TABLE `volunteers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beneficiary_stories`
--
ALTER TABLE `beneficiary_stories`
  ADD CONSTRAINT `beneficiary_stories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `beneficiary_story_translations`
--
ALTER TABLE `beneficiary_story_translations`
  ADD CONSTRAINT `beneficiary_story_translations_beneficiary_story_id_foreign` FOREIGN KEY (`beneficiary_story_id`) REFERENCES `beneficiary_stories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `digital_currency_donations`
--
ALTER TABLE `digital_currency_donations`
  ADD CONSTRAINT `digital_currency_donations_bank_account_id_foreign` FOREIGN KEY (`bank_account_id`) REFERENCES `bank_accounts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `digital_currency_donations_e_wallet_id_foreign` FOREIGN KEY (`e_wallet_id`) REFERENCES `e_wallets` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `digital_currency_donations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `donations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `food_donations`
--
ALTER TABLE `food_donations`
  ADD CONSTRAINT `food_donations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `page_translations`
--
ALTER TABLE `page_translations`
  ADD CONSTRAINT `page_translations_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_account_bank_id_foreign` FOREIGN KEY (`account_bank_id`) REFERENCES `bank_accounts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `payments_e_wallet_id_foreign` FOREIGN KEY (`e_wallet_id`) REFERENCES `e_wallets` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_translations`
--
ALTER TABLE `project_translations`
  ADD CONSTRAINT `project_translations_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reward_points`
--
ALTER TABLE `reward_points`
  ADD CONSTRAINT `reward_points_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `setting_translations`
--
ALTER TABLE `setting_translations`
  ADD CONSTRAINT `setting_translations_setting_id_foreign` FOREIGN KEY (`setting_id`) REFERENCES `settings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sms_donations`
--
ALTER TABLE `sms_donations`
  ADD CONSTRAINT `sms_donations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `sms_donation_records`
--
ALTER TABLE `sms_donation_records`
  ADD CONSTRAINT `sms_donation_records_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD CONSTRAINT `testimonials_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `testimonial_translations`
--
ALTER TABLE `testimonial_translations`
  ADD CONSTRAINT `testimonial_translations_testimonial_id_foreign` FOREIGN KEY (`testimonial_id`) REFERENCES `testimonials` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ticket_assignments`
--
ALTER TABLE `ticket_assignments`
  ADD CONSTRAINT `ticket_assignments_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ticket_assignments_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `volunteers`
--
ALTER TABLE `volunteers`
  ADD CONSTRAINT `volunteers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
