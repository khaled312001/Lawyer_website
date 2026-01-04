-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2026 at 09:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `law`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us_pages`
--

CREATE TABLE `about_us_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `about_image` varchar(255) DEFAULT NULL,
  `background_image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `mission_image` varchar(255) DEFAULT NULL,
  `mission_status` tinyint(1) NOT NULL DEFAULT 1,
  `vision_image` varchar(255) DEFAULT NULL,
  `vision_status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us_pages`
--

INSERT INTO `about_us_pages` (`id`, `about_image`, `background_image`, `status`, `mission_image`, `mission_status`, `vision_image`, `vision_status`, `created_at`, `updated_at`) VALUES
(1, 'uploads/website-images/dummy/about_image.webp', 'uploads/website-images/dummy/background_image.webp', 1, 'uploads/website-images/dummy/mission_image.webp', 1, 'uploads/website-images/dummy/vision_image.webp', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(2, 'uploads/website-images/dummy/about_image.webp', 'uploads/website-images/dummy/background_image.webp', 1, 'uploads/website-images/dummy/mission_image.webp', 1, 'uploads/website-images/dummy/vision_image.webp', 1, '2025-12-20 11:34:23', '2025-12-20 11:34:23');

-- --------------------------------------------------------

--
-- Table structure for table `about_us_page_translations`
--

CREATE TABLE `about_us_page_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `about_us_page_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `about_description` longtext DEFAULT NULL,
  `mission_description` longtext DEFAULT NULL,
  `vision_description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us_page_translations`
--

INSERT INTO `about_us_page_translations` (`id`, `about_us_page_id`, `lang_code`, `about_description`, `mission_description`, `vision_description`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', '<h1>Experienced Syrian Lawyers Committed to Justice</h1><p>We are a leading Syrian law firm providing expert legal services with integrity, professionalism, and a client-first approach. Our team of skilled attorneys specializes in Syrian law and is dedicated to helping individuals and businesses navigate complex legal challenges in Syria effectively.</p>', '<h1><strong>Our Mission</strong></h1><p>To uphold justice and provide reliable legal solutions that protect the rights and interests of our clients under Syrian law.</p>', '<h1>Our Vision</h1><p>To be the leading Syrian law firm recognized for legal excellence, client satisfaction, and expertise in Syrian legislation.</p>', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(2, 1, 'ar', '<h1>محامون سوريون ذو خبرة ملتزمون بتحقيق العدالة</h1><p>نحن مكتب محاماة سوري رائد نقدم خدمات قانونية احترافية تعتمد على النزاهة والمهنية ونهج يركز على العميل.</p>', '<h1><strong>مهمتنا</strong></h1><p>الدفاع عن العدالة وتقديم حلول قانونية موثوقة تحمي حقوق ومصالح عملائنا وفقاً للقانون السوري.</p>', '<h1>رؤيتنا</h1><p>أن نكون مكتب المحاماة السوري الرائد المعترف به بالتميز القانوني ورضا العملاء والخبرة في التشريعات السورية.</p>', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(3, 2, 'en', '<h1>Experienced Syrian Lawyers Committed to Justice</h1><p>We are a leading Syrian law firm providing expert legal services with integrity, professionalism, and a client-first approach. Our team of skilled attorneys specializes in Syrian law and is dedicated to helping individuals and businesses navigate complex legal challenges in Syria effectively.</p>', '<h1><strong>Our Mission</strong></h1><p>To uphold justice and provide reliable legal solutions that protect the rights and interests of our clients under Syrian law.</p>', '<h1>Our Vision</h1><p>To be the leading Syrian law firm recognized for legal excellence, client satisfaction, and expertise in Syrian legislation.</p>', '2025-12-20 11:34:23', '2025-12-20 11:34:23'),
(4, 2, 'ar', '<h1>محامون سوريون ذو خبرة ملتزمون بتحقيق العدالة</h1><p>نحن مكتب محاماة سوري رائد نقدم خدمات قانونية احترافية تعتمد على النزاهة والمهنية ونهج يركز على العميل.</p>', '<h1><strong>مهمتنا</strong></h1><p>الدفاع عن العدالة وتقديم حلول قانونية موثوقة تحمي حقوق ومصالح عملائنا وفقاً للقانون السوري.</p>', '<h1>رؤيتنا</h1><p>أن نكون مكتب المحاماة السوري الرائد المعترف به بالتميز القانوني ورضا العملاء والخبرة في التشريعات السورية.</p>', '2025-12-20 11:34:23', '2025-12-20 11:34:23');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_super_admin` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `forget_password_token` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `image`, `password`, `is_super_admin`, `status`, `forget_password_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Khaled', 'khaledahmedhaggagy@gmail.com', 'uploads/website-images/admin.jpg', '$2y$12$S02Rxmuv4jNyzbs0QWGAHOFfYCwCbztdxUDn6radM9UmoO7RWZQoq', 1, 'active', NULL, 'bzyt2q827Q2oIkHt5kXVeYzVx3GGS9JbJ14oNnF2Uk9y60QZOV17Q0Kd524n', '2025-12-20 04:09:32', '2025-12-20 10:10:09'),
(2, 'John Doe', 'admin@gmail.com', 'uploads/website-images/admin.jpg', '$2y$12$lrQLVO7HMNjUonFPSLYcIefRljE6s5NQKqZrWwiF85V4Ax2KfIi4e', 1, 'active', NULL, NULL, '2025-12-31 11:13:06', '2025-12-31 11:13:06');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `day_id` bigint(20) UNSIGNED NOT NULL,
  `schedule_id` bigint(20) UNSIGNED NOT NULL,
  `lawyer_id` bigint(20) UNSIGNED NOT NULL,
  `already_treated` tinyint(1) NOT NULL DEFAULT 0,
  `date` date NOT NULL,
  `appointment_fee_usd` double NOT NULL,
  `appointment_fee` varchar(255) NOT NULL,
  `payable_currency` varchar(255) DEFAULT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT 0,
  `payment_transaction_id` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `payment_description` text DEFAULT NULL,
  `subject` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `order_id`, `day_id`, `schedule_id`, `lawyer_id`, `already_treated`, `date`, `appointment_fee_usd`, `appointment_fee`, `payable_currency`, `payment_status`, `payment_transaction_id`, `payment_method`, `payment_description`, `subject`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1000, 1, 5, 12, 2, 1, '2025-12-20', 420, '420', 'USD', 1, 'HUR3FNQ2XCB2U', 'Paypal', '{\"payments_captures_id\":\"185193442H1060322\",\"amount\":\"420.00\",\"currency\":\"USD\",\"paid\":\"420.00\",\"paypal_fee\":\"15.15\",\"net_amount\":\"404.85\",\"status\":\"COMPLETED\"}', 'Lorem ipsum dolor sit amet', '<p>Lorem ipsum dolor sit amet, qui assum oblique praesent te. Quo ei erant essent scaevola, est ut clita dolorem, ei est mazim fuisset scribentur. Mel ut decore salutandi intellegam. Labitur epicurei vis cu, in mei rationibus consequuntur. Duo eu modus periculis, inermis detracto expetendis ius eu. Mel ludus viderer noluisse cu, te virtute constituam vix, et eos justo mucius salutatus. Nam illum dicant laudem no</p><p>Lorem ipsum dolor sit amet, qui assum oblique praesent te. Quo ei erant essent scaevola, est ut clita dolorem, ei est mazim fuisset scribentur. Mel ut decore salutandi intellegam. Labitur epicurei vis cu, in mei rationibus consequuntur. Duo eu modus periculis, inermis detracto expetendis ius eu. Mel ludus viderer noluisse cu, te virtute constituam vix, et eos justo mucius salutatus. Nam illum dicant laudem no</p>', 0, '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(2, 1000, 2, 1, 16, 3, 1, '2025-12-20', 12, '960', 'BDT', 1, 'tran_2408082735', 'Direct Bank', '{\"transaction_id\":\"tran_2408082735\",\"amount\":\"960.00\",\"currency\":\"BDT\",\"payment_status\":\"VALID\",\"created\":\"2024-08-08 09:27:36\"}', 'Lorem ipsum dolor sit amet', '<p>Lorem ipsum dolor sit amet, qui assum oblique praesent te. Quo ei erant essent scaevola, est ut clita dolorem, ei est mazim fuisset scribentur. Mel ut decore salutandi intellegam. Labitur epicurei vis cu, in mei rationibus consequuntur. Duo eu modus periculis, inermis detracto expetendis ius eu. Mel ludus viderer noluisse cu, te virtute constituam vix, et eos justo mucius salutatus. Nam illum dicant laudem no</p><p>Lorem ipsum dolor sit amet, qui assum oblique praesent te. Quo ei erant essent scaevola, est ut clita dolorem, ei est mazim fuisset scribentur. Mel ut decore salutandi intellegam. Labitur epicurei vis cu, in mei rationibus consequuntur. Duo eu modus periculis, inermis detracto expetendis ius eu. Mel ludus viderer noluisse cu, te virtute constituam vix, et eos justo mucius salutatus. Nam illum dicant laudem no</p>', 0, '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(3, 1000, 3, 2, 2, 1, 1, '2025-12-20', 10, '4173.5', 'NGN', 1, 'pi_3PlN3xF56Pb8BOOX0GW1ZBzZ', 'Stripe', '{\"transaction_id\":\"pi_3PlN3xF56Pb8BOOX0GW1ZBzZ\",\"amount\":417350,\"currency\":\"ngn\",\"payment_status\":\"paid\",\"created\":1723087824}', 'Lorem ipsum dolor sit amet', '<p>Lorem ipsum dolor sit amet, qui assum oblique praesent te. Quo ei erant essent scaevola, est ut clita dolorem, ei est mazim fuisset scribentur. Mel ut decore salutandi intellegam. Labitur epicurei vis cu, in mei rationibus consequuntur. Duo eu modus periculis, inermis detracto expetendis ius eu. Mel ludus viderer noluisse cu, te virtute constituam vix, et eos justo mucius salutatus. Nam illum dicant laudem no</p><p>Lorem ipsum dolor sit amet, qui assum oblique praesent te. Quo ei erant essent scaevola, est ut clita dolorem, ei est mazim fuisset scribentur. Mel ut decore salutandi intellegam. Labitur epicurei vis cu, in mei rationibus consequuntur. Duo eu modus periculis, inermis detracto expetendis ius eu. Mel ludus viderer noluisse cu, te virtute constituam vix, et eos justo mucius salutatus. Nam illum dicant laudem no</p>', 0, '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(4, 1000, 4, 2, 2, 1, 0, '2025-12-20', 10, '10', 'USD', 0, 'GB29NWBK60161331926819', 'Direct Bank', '{\"bank_name\":\"Brac Bank\",\"account_number\":\"1234567890\",\"routing_number\":\"021000021\",\"branch\":\"Dhaka\",\"transaction\":\"GB29NWBK60161331926819\"}', NULL, NULL, 0, '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(5, 1000, 5, 2, 9, 2, 0, '2026-01-07', 198, '198.00', 'USD', 0, NULL, 'bank', NULL, NULL, NULL, 0, '2026-01-04 20:48:50', '2026-01-04 20:48:50'),
(6, 1000, 5, 6, 84, 4, 0, '2026-01-21', 75, '75.00', 'USD', 0, NULL, 'bank', NULL, NULL, NULL, 0, '2026-01-04 20:48:50', '2026-01-04 20:48:50'),
(7, 1000, 6, 2, 9, 2, 0, '2026-01-07', 198, '198.00', 'USD', 0, NULL, 'bank', NULL, NULL, NULL, 0, '2026-01-04 20:49:58', '2026-01-04 20:49:58'),
(8, 1000, 6, 6, 84, 4, 0, '2026-01-21', 75, '75.00', 'USD', 0, NULL, 'bank', NULL, NULL, NULL, 0, '2026-01-04 20:49:58', '2026-01-04 20:49:58');

-- --------------------------------------------------------

--
-- Table structure for table `banned_histories`
--

CREATE TABLE `banned_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `reasone` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `basic_payments`
--

CREATE TABLE `basic_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `basic_payments`
--

INSERT INTO `basic_payments` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'stripe_key', 'stripe_key', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(2, 'stripe_secret', 'stripe_secret', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(3, 'stripe_currency_id', '1', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(4, 'stripe_status', 'inactive', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(5, 'stripe_charge', '0', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(6, 'stripe_image', 'uploads/website-images/stripe.png', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(7, 'paypal_client_id', 'paypal_client_id', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(8, 'paypal_secret_key', 'paypal_secret_key', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(9, 'paypal_account_mode', 'sandbox', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(10, 'paypal_currency_id', '1', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(11, 'paypal_charge', '0', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(12, 'paypal_status', 'inactive', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(13, 'paypal_image', 'uploads/website-images/paypal.png', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(14, 'bank_information', 'Bank Name => Your bank name\r\nAccount Number =>  Your bank account number\r\nRouting Number => Your bank routing number\r\nBranch => Your bank branch name', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(15, 'bank_status', 'active', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(16, 'bank_image', 'uploads/website-images/bank-pay.png', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(17, 'bank_charge', '0', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(18, 'bank_currency_id', '1', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(19, 'razorpay_key', 'razorpay_key', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(20, 'razorpay_secret', 'razorpay_secret', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(21, 'razorpay_name', 'LawMent', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(22, 'razorpay_description', 'This is test payment window', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(23, 'razorpay_charge', '0', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(24, 'razorpay_theme_color', '#6d0ce4', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(25, 'razorpay_status', 'inactive', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(26, 'razorpay_currency_id', '1', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(27, 'razorpay_image', 'uploads/website-images/razorpay.png', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(28, 'flutterwave_public_key', 'flutterwave_public_key', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(29, 'flutterwave_secret_key', 'flutterwave_secret_key', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(30, 'flutterwave_app_name', 'LawMent', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(31, 'flutterwave_charge', '0', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(32, 'flutterwave_currency_id', '1', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(33, 'flutterwave_status', 'inactive', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(34, 'flutterwave_image', 'uploads/website-images/flutterwave.png', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(35, 'paystack_public_key', 'paystack_public_key', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(36, 'paystack_secret_key', 'paystack_secret_key', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(37, 'paystack_status', 'inactive', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(38, 'paystack_charge', '0', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(39, 'paystack_image', 'uploads/website-images/paystack.png', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(40, 'paystack_currency_id', '1', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(41, 'mollie_key', 'mollie_key', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(42, 'mollie_charge', '0', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(43, 'mollie_image', 'uploads/website-images/mollie.png', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(44, 'mollie_status', 'inactive', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(45, 'mollie_currency_id', '1', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(46, 'instamojo_account_mode', 'Sandbox', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(47, 'instamojo_api_key', 'instamojo_api_key', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(48, 'instamojo_auth_token', 'instamojo_auth_token', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(49, 'instamojo_charge', '0', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(50, 'instamojo_image', 'uploads/website-images/instamojo.png', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(51, 'instamojo_currency_id', '1', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(52, 'instamojo_status', 'inactive', '2025-12-20 04:09:29', '2025-12-20 04:09:29');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `blog_category_id` bigint(20) UNSIGNED NOT NULL,
  `slug` text NOT NULL,
  `thumbnail_image` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `show_homepage` tinyint(1) NOT NULL DEFAULT 0,
  `is_feature` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `admin_id`, `blog_category_id`, `slug`, `thumbnail_image`, `image`, `show_homepage`, `is_feature`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'knowing-and-understanding-your-legal-rights', 'uploads/website-images/dummy/blog-thumbnail-1.webp', 'uploads/website-images/dummy/blog-1.webp', 0, 1, 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(2, 1, 2, 'the-importance-of-legal-consultation', 'uploads/website-images/dummy/blog-thumbnail-2.webp', 'uploads/website-images/dummy/blog-2.webp', 0, 0, 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(3, 1, 2, 'steps-to-take-after-a-car-accident', 'uploads/website-images/dummy/blog-thumbnail-3.webp', 'uploads/website-images/dummy/blog-3.webp', 0, 0, 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(4, 1, 3, 'what-to-know-before-signing-a-contract', 'uploads/website-images/dummy/blog-thumbnail-4.webp', 'uploads/website-images/dummy/blog-4.webp', 1, 0, 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(5, 1, 2, 'family-law-navigating-divorce-and-custody', 'uploads/website-images/dummy/blog-thumbnail-5.webp', 'uploads/website-images/dummy/blog-5.webp', 0, 0, 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(6, 1, 4, 'starting-a-business-legal-requirements-you-must-know', 'uploads/website-images/dummy/blog-thumbnail-6.webp', 'uploads/website-images/dummy/blog-6.webp', 1, 0, 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(7, 1, 4, 'cyber-law-protecting-your-online-business', 'uploads/website-images/dummy/blog-thumbnail-7.webp', 'uploads/website-images/dummy/blog-7.webp', 1, 1, 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(8, 1, 1, 'tenant-rights-what-every-renter-should-know', 'uploads/website-images/dummy/blog-thumbnail-8.webp', 'uploads/website-images/dummy/blog-8.webp', 1, 0, 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(9, 1, 4, 'learn-how-to-legally-respond-to-workplace-harassment', 'uploads/website-images/dummy/blog-thumbnail-9.webp', 'uploads/website-images/dummy/blog-9.webp', 1, 0, 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(10, 1, 3, 'when-to-hire-a-criminal-defense-lawyer', 'uploads/website-images/dummy/blog-thumbnail-10.webp', 'uploads/website-images/dummy/blog-10.webp', 0, 1, 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(11, 1, 1, 'understanding-power-of-attorney-what-you-need-to-know', 'uploads/website-images/dummy/blog-thumbnail-11.webp', 'uploads/website-images/dummy/blog-11.webp', 0, 1, 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(12, 1, 3, 'a-guide-to-legal-steps-after-a-car-accident', 'uploads/website-images/dummy/blog-thumbnail-12.webp', 'uploads/website-images/dummy/blog-12.webp', 1, 0, 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'corporate-law', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(2, 'family-law', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(3, 'criminal-defense', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(4, 'intellectual-property', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34');

-- --------------------------------------------------------

--
-- Table structure for table `blog_category_translations`
--

CREATE TABLE `blog_category_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_category_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_category_translations`
--

INSERT INTO `blog_category_translations` (`id`, `blog_category_id`, `lang_code`, `title`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Corporate Law', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(2, 1, 'ar', 'القانون التجاري', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(3, 2, 'en', 'Family Law', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(4, 2, 'ar', 'قانون الأسرة', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(5, 3, 'en', 'Criminal Defense', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(6, 3, 'ar', 'الدفاع الجنائي', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(7, 4, 'en', 'Intellectual Property', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(8, 4, 'ar', 'الملكية الفكرية', '2025-12-20 04:09:34', '2025-12-20 04:09:34');

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `comment` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_comments`
--

INSERT INTO `blog_comments` (`id`, `blog_id`, `name`, `email`, `phone`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Marguerite Conn MD', 'madonna01@yahoo.com', '+1-402-994-8061', 'Vel occaecati dolores optio aut. Aut similique odit eum molestiae. Nihil expedita et error numquam ullam.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(2, 1, 'Yasmine Gleichner Jr.', 'farrell.jenifer@pfannerstill.com', '+1.432.814.3399', 'Non dicta doloremque facere in recusandae impedit. Voluptate nihil in quam dolorem vel quisquam. Et rerum eveniet occaecati aut aut est consequatur ad. Et fugit sed et.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(3, 1, 'Chloe Schaden', 'wilhelmine69@gmail.com', '+14439587876', 'Ullam praesentium autem est officiis. Itaque dicta ut voluptas unde eligendi ad. Suscipit sunt est nihil rerum sequi doloribus consequatur.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(4, 2, 'Dr. Kelli Weimann', 'jbartoletti@hotmail.com', '+1.872.818.8470', 'Impedit sapiente est explicabo facilis. Voluptas ab dolor sed aut rerum voluptate. Nihil in nobis magnam qui impedit adipisci quia. Non eligendi totam fugiat qui exercitationem labore.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(5, 2, 'Rickey Kihn', 'nichole.schowalter@gmail.com', '1-984-659-8456', 'Distinctio voluptas minima velit itaque. Qui reprehenderit molestiae minus et eaque ea.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(6, 2, 'Dr. Ed Schulist', 'obeahan@hotmail.com', '+1.626.296.7655', 'Iure ut ea maxime id deserunt. Voluptatem consectetur aut reiciendis error.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(7, 3, 'Domenico McClure', 'sam.baumbach@parker.biz', '425-599-1502', 'Esse sint voluptatem natus dolorem. Alias et voluptate perspiciatis molestiae aut. Non iusto harum eius autem. Quis quaerat quisquam aspernatur iusto.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(8, 3, 'Dr. Colt Steuber', 'monahan.beth@hotmail.com', '785.642.2671', 'Vel soluta et quia occaecati. Doloremque in fugit doloribus. Quas rerum unde consequatur delectus rem suscipit dicta.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(9, 3, 'Prof. Marcia Hahn I', 'ida70@leannon.com', '(484) 624-2506', 'Quas et fugiat ducimus quasi sunt sapiente et at. Commodi quam laborum minima. Ipsum aut error ab impedit. Nam magnam veniam natus. Dicta repellendus quis architecto eos dolore nobis voluptate.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(10, 4, 'Martina Upton V', 'oscar.dietrich@gmail.com', '714-551-1416', 'Accusamus impedit reprehenderit sit consequatur adipisci. Nisi dolore sapiente velit non repellat exercitationem illum. Tempore tenetur enim occaecati eligendi ut accusantium.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(11, 4, 'Damien Prosacco', 'olin.reichert@gmail.com', '+1 (312) 610-7869', 'Tenetur cumque ut tempora adipisci eligendi culpa ut. Laborum velit in aut earum et culpa vel minima. Aut sit vero nulla quo adipisci incidunt ratione. Adipisci delectus blanditiis adipisci saepe.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(12, 4, 'Willow Bosco Sr.', 'spencer.adrien@buckridge.com', '978.817.5801', 'Omnis aut incidunt non minus. Labore sed soluta ut rerum omnis consequatur. Saepe molestias ex et.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(13, 5, 'German Konopelski DDS', 'leonor06@beatty.com', '+14808332857', 'Dolores libero placeat aliquam ea. Quaerat corrupti architecto laboriosam voluptas voluptatem voluptatibus. Iure voluptates ullam quas aut et.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(14, 5, 'Arvid Grimes Jr.', 'dallas09@gmail.com', '+1-640-634-5920', 'Quia suscipit praesentium maiores. Occaecati est quis repellendus nemo eaque. Voluptates omnis aperiam accusamus qui adipisci.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(15, 5, 'Sandrine Pfeffer', 'gnienow@gmail.com', '+1 (689) 208-9830', 'Deleniti minima ullam ut esse nobis pariatur unde. Mollitia error quae a est fugiat. Veritatis voluptates nihil voluptatem tenetur.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(16, 6, 'Prof. Kay Abshire', 'xkuvalis@volkman.info', '+1-781-810-7508', 'At quidem ut ab iste amet nostrum eos ea. Omnis qui nihil esse soluta in vel. Sapiente iste aspernatur qui iusto possimus sit. Facere labore eos ipsum corrupti autem nostrum.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(17, 6, 'Prof. Herman Eichmann', 'beryl44@hotmail.com', '212-817-9249', 'Ut quae quo labore repellendus explicabo quo in enim. Molestiae nihil recusandae ut molestiae. Non magnam qui laboriosam mollitia. Qui et dolores eius voluptatem saepe.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(18, 6, 'Braxton Nolan', 'cullen.bednar@yahoo.com', '(623) 952-9261', 'Dolorem eos sunt excepturi officia soluta velit sit. Doloremque commodi aut vel in deleniti autem.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(19, 7, 'Enola Greenholt Jr.', 'ebradtke@leffler.net', '(630) 736-3323', 'Aut est cumque nihil dolores impedit praesentium ex non. Numquam ea deleniti et et aut harum consectetur. Et vitae commodi iure sit facilis quia. Quae voluptatibus molestiae totam amet ea sint est laudantium.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(20, 7, 'Whitney Goodwin', 'velda70@effertz.info', '(901) 337-6412', 'Id iure est aspernatur sed. Deserunt dolor voluptate dicta iure et est qui. Et perferendis necessitatibus quia possimus autem.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(21, 7, 'Margarette Langosh', 'rpfeffer@shields.org', '+15204016170', 'Doloremque aut id aut. Dolorum ut id maxime cumque. Culpa minus sequi molestiae cum reiciendis. Aperiam quos praesentium doloribus delectus culpa. Aspernatur rerum explicabo aut voluptatum nesciunt ratione dolore.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(22, 8, 'Prof. Jaclyn Schroeder', 'margarett52@hotmail.com', '+1-703-920-2144', 'Illum consequuntur asperiores numquam aut. Beatae quos ex voluptatem mollitia quisquam voluptates. Id sunt perspiciatis rerum consequatur voluptatem.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(23, 8, 'Jessika McClure', 'jast.juvenal@boyle.biz', '1-520-568-7339', 'Rerum beatae reiciendis omnis sit enim. Est quia maiores ratione quaerat nostrum. Amet animi qui aut qui dolores.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(24, 8, 'Shania Cole I', 'kaitlin.collins@hotmail.com', '405-388-9743', 'Asperiores quia maxime eos quia autem hic sed voluptatem. Veritatis dignissimos libero cupiditate eius ut consequatur ab modi. Illum libero tempore impedit est optio sequi est.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(25, 9, 'Prof. Earnest Marquardt II', 'chase60@bartell.com', '+18384248316', 'Eum recusandae cumque laborum aut possimus sed voluptatem. Ea laboriosam sint velit. Iure error atque quia. Qui consectetur deserunt et occaecati beatae cumque excepturi.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(26, 9, 'Mr. Erwin Weber', 'jermey.witting@hotmail.com', '+1-283-479-5260', 'Molestiae vel ipsa a esse omnis dolor quia. Maiores nostrum ut libero quo. Voluptatem temporibus qui modi et sed nemo qui.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(27, 9, 'Javier Rice', 'margarette.daugherty@gmail.com', '+17603967721', 'Sit rerum magnam error labore nihil. Reprehenderit est molestias est sapiente quod rerum veritatis. Assumenda quam quo reiciendis recusandae ut repellat tenetur. Fuga vel aut alias deserunt eaque.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(28, 10, 'Tyra Pouros MD', 'schulist.selina@yahoo.com', '+17436704202', 'Sapiente occaecati voluptas dolore sapiente repellendus. Et dolorum ut qui atque eius porro laboriosam. Nesciunt et rerum necessitatibus nulla.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(29, 10, 'Lavonne Hessel', 'irohan@hammes.com', '+1-223-818-0218', 'Corrupti sint officia quo veritatis sequi et. Voluptas explicabo nihil exercitationem aspernatur facere. Omnis iure iure fuga quos voluptatem.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(30, 10, 'Guiseppe O\'Keefe', 'madeline.dietrich@yahoo.com', '304.423.7050', 'Blanditiis eos in aut sint sed sed dolorem. Dignissimos repudiandae deserunt nemo ducimus quia est sit. Exercitationem quaerat at labore blanditiis ad. Suscipit aliquid et iure id.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(31, 11, 'Dario Purdy', 'gonzalo.blick@hotmail.com', '510.727.8591', 'Voluptates beatae ut dicta aut voluptatibus magni. Minus vitae perferendis quia quae id quia. Dolor porro ex beatae et. Qui pariatur consectetur nesciunt vel aut voluptatibus.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(32, 11, 'Tristin Pfannerstill', 'cassin.gerry@gmail.com', '+1 (678) 765-3970', 'Unde nobis aut quasi aut distinctio maxime numquam vitae. Non iste consequatur est omnis aut. Aut in vitae dicta rem porro est voluptatem.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(33, 11, 'Jazmyn Herman', 'hermiston.damien@hotmail.com', '+1-775-262-3737', 'Mollitia vel et voluptatem minus fugit. Totam atque voluptatibus quia dignissimos possimus rerum voluptates. Voluptatem atque itaque mollitia voluptatum consectetur. Eligendi amet provident dolorem aut ut accusantium.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(34, 12, 'Maverick Rippin', 'kdickinson@hotmail.com', '+17079123155', 'Recusandae voluptate ipsa qui est eos. Magni fuga voluptatem quae molestiae. Vel odit illum itaque nam voluptatum et optio.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(35, 12, 'Dr. Onie Altenwerth I', 'mraz.kale@mckenzie.com', '+19564238423', 'Excepturi quam sed sint. Temporibus soluta consequatur nulla doloremque est. Consequatur voluptatem similique repellat quisquam consequatur et. Quod iusto dolorem consequatur.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(36, 12, 'Ms. Constance Willms II', 'prosacco.ava@hotmail.com', '845.234.2790', 'Dicta expedita mollitia nulla quo. Possimus tempore pariatur similique eum. Aut enim tempora quia animi aliquam assumenda hic nostrum. Aut blanditiis omnis placeat quibusdam maxime quo.', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34');

-- --------------------------------------------------------

--
-- Table structure for table `blog_translations`
--

CREATE TABLE `blog_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sort_description` text DEFAULT NULL,
  `description` longtext NOT NULL,
  `seo_title` text DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_translations`
--

INSERT INTO `blog_translations` (`id`, `blog_id`, `lang_code`, `title`, `sort_description`, `description`, `seo_title`, `seo_description`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Knowing and Understanding Your Legal Rights', 'Learn the fundamentals of your legal rights and how to protect them.', '<p>Knowing your legal rights is essential when dealing with law enforcement, contracts, or disputes. This article covers:<br><br>1. What are your basic rights?<br>2. How to assert your rights respectfully.<br>3. When to contact a lawyer.<br>4. Rights in the workplace.<br>5. Legal protections for consumers.<br></p>', 'Knowing and Understanding Your Legal Rights', 'Learn the fundamentals of your legal rights and how to protect them.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(2, 1, 'ar', 'فهم حقوقك القانونية', 'تعرف على أساسيات حقوقك القانونية وكيفية حمايتها.', '<p>معرفة حقوقك القانونية أمر ضروري عند التعامل مع الجهات القانونية أو العقود أو النزاعات. في هذا المقال نناقش:<br><br>1. ما هي حقوقك الأساسية؟<br>2. كيفية المطالبة بحقوقك باحترام.<br>3. متى يجب التواصل مع محامٍ.<br>4. الحقوق في مكان العمل.<br>5. الحماية القانونية للمستهلكين.<br></p>', 'فهم حقوقك القانونية', 'تعرف على أساسيات حقوقك القانونية وكيفية حمايتها.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(3, 2, 'en', 'The Importance of Legal Consultation', 'Discover why seeking legal advice early can save you time and money.', '<p>Legal consultation can prevent costly mistakes. Here’s why you should always consult a lawyer:<br><br>1. Clarifying legal obligations.<br>2. Reviewing contracts before signing.<br>3. Avoiding litigation.<br>4. Understanding potential legal risks.<br>5. Gaining peace of mind.<br></p>', 'The Importance of Legal Consultation', 'Discover why seeking legal advice early can save you time and money.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(4, 2, 'ar', 'أهمية الاستشارة القانونية', 'اكتشف لماذا يمكن أن توفر الاستشارة القانونية الوقت والمال.', '<p>الاستشارة القانونية يمكن أن تمنع أخطاء مكلفة. إليك أسباب التواصل مع محامٍ:<br><br>1. توضيح الالتزامات القانونية.<br>2. مراجعة العقود قبل التوقيع.<br>3. تجنب الدعاوى القضائية.<br>4. فهم المخاطر القانونية المحتملة.<br>5. الشعور بالاطمئنان.<br></p>', 'أهمية الاستشارة القانونية', 'اكتشف لماذا يمكن أن توفر الاستشارة القانونية الوقت والمال.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(5, 3, 'en', 'Steps to Take After a Car Accident', 'Ensure your legal and personal safety after an accident with these steps.', '<p>In the aftermath of a car accident, taking the right steps is crucial. Here\'s what you should do:<br><br>1. Call emergency services.<br>2. Document the scene.<br>3. Avoid admitting fault.<br>4. Contact your insurance provider.<br>5. Speak with a personal injury lawyer.<br></p>', 'Steps to Take After a Car Accident', 'Ensure your legal and personal safety after an accident with these steps.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(6, 3, 'ar', 'الخطوات التي يجب اتخاذها بعد حادث سيارة', 'احمِ سلامتك القانونية والشخصية بعد الحادث من خلال هذه الخطوات.', '<p>بعد وقوع حادث سيارة، من الضروري اتخاذ الخطوات الصحيحة. إليك ما يجب فعله:<br><br>1. الاتصال بخدمات الطوارئ.<br>2. توثيق الحادث.<br>3. تجنب الاعتراف بالذنب.<br>4. الاتصال بشركة التأمين الخاصة بك.<br>5. التواصل مع محامٍ متخصص في إصابات الحوادث.<br></p>', 'الخطوات التي يجب اتخاذها بعد حادث سيارة', 'احمِ سلامتك القانونية والشخصية بعد الحادث من خلال هذه الخطوات.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(7, 4, 'en', 'What to Know Before Signing a Contract', 'Understand the key elements of a legally binding contract.', '<p>Signing a contract without understanding it can lead to legal trouble. Here are tips to protect yourself:<br><br>1. Read every clause.<br>2. Look out for penalties and obligations.<br>3. Check for exit clauses.<br>4. Confirm all terms are accurate.<br>5. Seek legal review if unsure.<br></p>', 'What to Know Before Signing a Contract', 'Understand the key elements of a legally binding contract.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(8, 4, 'ar', 'ما يجب معرفته قبل توقيع العقد', 'افهم العناصر الأساسية للعقد القانوني الملزم.', '<p>توقيع عقد دون فهمه قد يؤدي إلى مشاكل قانونية. إليك بعض النصائح:<br><br>1. قراءة كل بند بعناية.<br>2. الانتباه للعقوبات والالتزامات.<br>3. التحقق من شروط الإنهاء.<br>4. التأكد من دقة جميع البنود.<br>5. استشارة محامٍ إذا كنت غير متأكد.<br></p>', 'ما يجب معرفته قبل توقيع العقد', 'افهم العناصر الأساسية للعقد القانوني الملزم.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(9, 5, 'en', 'Family Law: Navigating Divorce and Custody', 'Get familiar with the legal process of divorce and child custody.', '<p>Family legal matters are emotional and complex. Here\'s what to know:<br><br>1. Understanding divorce proceedings.<br>2. Legal grounds for divorce.<br>3. Child custody arrangements.<br>4. Financial and property division.<br>5. Mediation and court alternatives.<br></p>', 'Family Law: Navigating Divorce and Custody', 'Get familiar with the legal process of divorce and child custody.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(10, 5, 'ar', 'قانون الأسرة: التعامل مع الطلاق والحضانة', 'تعرف على الإجراءات القانونية المتعلقة بالطلاق وحضانة الأطفال.', '<p>قضايا الأسرة عاطفية ومعقدة. إليك ما يجب معرفته:<br><br>1. فهم إجراءات الطلاق.<br>2. الأسباب القانونية للطلاق.<br>3. ترتيبات حضانة الأطفال.<br>4. تقسيم المال والممتلكات.<br>5. الوساطة كبديل للمحكمة.<br></p>', 'قانون الأسرة: التعامل مع الطلاق والحضانة', 'تعرف على الإجراءات القانونية المتعلقة بالطلاق وحضانة الأطفال.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(11, 6, 'en', 'Starting a Business: Legal Requirements You Must Know', 'Learn the legal steps and documents required to start your business.', '<p>Before launching a business, it\'s essential to comply with legal obligations:<br><br>1. Choosing the right business structure (LLC, sole proprietorship, etc.).<br>2. Registering your business name.<br>3. Getting the necessary licenses and permits.<br>4. Drafting legal agreements.<br>5. Understanding tax obligations.<br></p>', 'Starting a Business: Legal Requirements You Must Know', 'Learn the legal steps and documents required to start your business.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(12, 6, 'ar', 'بدء عمل تجاري: المتطلبات القانونية التي يجب معرفتها', 'تعرف على الخطوات القانونية والمستندات المطلوبة لبدء عملك.', '<p>قبل بدء مشروعك، من الضروري الامتثال للمتطلبات القانونية:<br><br>1. اختيار الهيكل القانوني المناسب (شركة ذات مسؤولية محدودة، ملكية فردية، إلخ).<br>2. تسجيل اسم النشاط التجاري.<br>3. الحصول على التراخيص والتصاريح اللازمة.<br>4. إعداد الاتفاقيات القانونية.<br>5. فهم الالتزامات الضريبية.<br></p>', 'بدء عمل تجاري: المتطلبات القانونية التي يجب معرفتها', 'تعرف على الخطوات القانونية والمستندات المطلوبة لبدء عملك.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(13, 7, 'en', 'Cyber Law: Protecting Your Online Business', 'Understand your legal responsibilities and rights in the digital world.', '<p>Online businesses must follow specific cyber laws to avoid penalties:<br><br>1. Data protection regulations (GDPR, etc.).<br>2. Terms and privacy policy compliance.<br>3. Intellectual property rights online.<br>4. Cybersecurity obligations.<br>5. Handling customer data legally.<br></p>', 'Cyber Law: Protecting Your Online Business', 'Understand your legal responsibilities and rights in the digital world.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(14, 7, 'ar', 'القانون الإلكتروني: حماية نشاطك التجاري عبر الإنترنت', 'افهم مسؤولياتك وحقوقك القانونية في العالم الرقمي.', '<p>يجب أن تمتثل الأنشطة التجارية عبر الإنترنت لقوانين معينة:<br><br>1. قوانين حماية البيانات (مثل GDPR).<br>2. الالتزام بسياسات الخصوصية والشروط.<br>3. حماية حقوق الملكية الفكرية على الإنترنت.<br>4. الالتزامات المتعلقة بالأمن السيبراني.<br>5. التعامل القانوني مع بيانات العملاء.<br></p>', 'القانون الإلكتروني: حماية نشاطك التجاري عبر الإنترنت', 'افهم مسؤولياتك وحقوقك القانونية في العالم الرقمي.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(15, 8, 'en', 'Tenant Rights: What Every Renter Should Know', 'A guide to tenant protections, lease agreements, and dispute resolution.', '<p>If you\'re renting a property, understanding your rights is vital:<br><br>1. Lease agreement basics.<br>2. Security deposit laws.<br>3. Right to a habitable home.<br>4. What to do during landlord disputes.<br>5. When to involve a lawyer.<br></p>', 'Tenant Rights: What Every Renter Should Know', 'A guide to tenant protections, lease agreements, and dispute resolution.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(16, 8, 'ar', 'حقوق المستأجر: ما يجب أن يعرفه كل مستأجر', 'دليل لحماية المستأجر، واتفاقيات الإيجار، وتسوية النزاعات.', '<p>إذا كنت تستأجر عقارًا، فمعرفة حقوقك أمر ضروري:<br><br>1. أساسيات اتفاق الإيجار.<br>2. قوانين التأمين المالي.<br>3. الحق في السكن المناسب.<br>4. كيفية التعامل مع نزاعات المالك.<br>5. متى يجب استشارة محامٍ.<br></p>', 'حقوق المستأجر: ما يجب أن يعرفه كل مستأجر', 'دليل لحماية المستأجر، واتفاقيات الإيجار، وتسوية النزاعات.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(17, 9, 'en', 'Learn how to legally respond to workplace harassment', 'Learn how to legally respond to workplace harassment or discrimination.', '<p>Workplace rights include protection from harassment and discrimination:<br><br>1. What counts as workplace harassment?<br>2. Steps to document and report.<br>3. Legal protections under labor laws.<br>4. Filing a formal complaint.<br>5. Seeking compensation or legal action.<br></p>', 'Learn how to legally respond to workplace harassment', 'Learn how to legally respond to workplace harassment or discrimination.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(18, 9, 'ar', 'التحرش في مكان العمل: خياراتك القانونية', 'تعرف على كيفية الرد قانونيًا على التحرش أو التمييز في العمل.', '<p>تشمل حقوق العمل الحماية من التحرش والتمييز:<br><br>1. ما الذي يُعتبر تحرشًا في العمل؟<br>2. خطوات التوثيق والإبلاغ.<br>3. الحماية القانونية بموجب قوانين العمل.<br>4. تقديم شكوى رسمية.<br>5. المطالبة بالتعويض أو اتخاذ إجراء قانوني.<br></p>', 'التحرش في مكان العمل: خياراتك القانونية', 'تعرف على كيفية الرد قانونيًا على التحرش أو التمييز في العمل.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(19, 10, 'en', 'When to Hire a Criminal Defense Lawyer', 'Understand the situations where legal defense is crucial to protect your freedom.', '<p>If you\'re accused of a crime, hiring a defense attorney is critical:<br><br>1. What does a criminal defense lawyer do?<br>2. Your rights during arrest and questioning.<br>3. Preparing your defense.<br>4. Negotiating plea deals.<br>5. Representing you in court.<br></p>', 'When to Hire a Criminal Defense Lawyer', 'Understand the situations where legal defense is crucial to protect your freedom.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(20, 10, 'ar', 'متى يجب تعيين محامٍ للدفاع الجنائي؟', 'افهم الحالات التي يكون فيها الدفاع القانوني ضروريًا لحماية حريتك.', '<p>إذا تم اتهامك بجريمة، فإن تعيين محامٍ أمر بالغ الأهمية:<br><br>1. ما الذي يفعله محامي الدفاع الجنائي؟<br>2. حقوقك أثناء التوقيف والاستجواب.<br>3. إعداد الدفاع الخاص بك.<br>4. التفاوض على اتفاقيات الاعتراف بالذنب.<br>5. تمثيلك أمام المحكمة.<br></p>', 'متى يجب تعيين محامٍ للدفاع الجنائي؟', 'افهم الحالات التي يكون فيها الدفاع القانوني ضروريًا لحماية حريتك.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(21, 11, 'en', 'Understanding Power of Attorney: What You Need to Know', 'Learn what a power of attorney is, when to use it, and the types available.', '<p>A Power of Attorney (POA) is a legal document that allows someone to act on your behalf:<br><br>1. Types of POA: General, Special, Medical.<br>2. When is POA useful? (e.g. travel, illness, business).<br>3. Legal requirements to draft a valid POA.<br>4. Responsibilities and limits of an attorney-in-fact.<br>5. How to revoke or change a POA.<br></p>', 'Understanding Power of Attorney: What You Need to Know', 'Learn what a power of attorney is, when to use it, and the types available.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(22, 11, 'ar', 'فهم التوكيل الرسمي: ما تحتاج إلى معرفته', 'تعرف على ما هو التوكيل الرسمي، ومتى يتم استخدامه، وأنواعه المختلفة.', '<p>التوكيل الرسمي هو مستند قانوني يسمح لشخص بالتصرف نيابة عنك:<br><br>1. أنواع التوكيل: عام، خاص، طبي.<br>2. متى يكون التوكيل مفيدًا؟ (مثل السفر، المرض، الأعمال).<br>3. المتطلبات القانونية لإنشاء توكيل رسمي صحيح.<br>4. مسؤوليات وحدود الممثل القانوني.<br>5. كيفية إلغاء أو تعديل التوكيل.<br></p>', 'فهم التوكيل الرسمي: ما تحتاج إلى معرفته', 'تعرف على ما هو التوكيل الرسمي، ومتى يتم استخدامه، وأنواعه المختلفة.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(23, 12, 'en', 'A guide to Legal Steps After a Car Accident', 'A guide to what to do legally after being involved in a traffic accident.', '<p>Being involved in a car accident can be stressful, but knowing your legal options helps:<br><br>1. Call the authorities and get a police report.<br>2. Collect evidence (photos, witness contacts).<br>3. Notify your insurance provider.<br>4. Know when to contact a lawyer.<br>5. Filing claims for damages or injuries.<br></p>', 'A guide to Legal Steps After a Car Accident', 'A guide to what to do legally after being involved in a traffic accident.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(24, 12, 'ar', 'الخطوات القانونية بعد وقوع حادث سيارة', 'دليل لما يجب فعله قانونيًا بعد التعرض لحادث مروري.', '<p>التعرض لحادث سيارة قد يكون مرهقًا، ولكن معرفتك بحقوقك القانونية أمر مهم:<br><br>1. الاتصال بالشرطة والحصول على تقرير رسمي.<br>2. جمع الأدلة (صور، شهود).<br>3. إبلاغ شركة التأمين.<br>4. معرفة متى يجب استشارة محامٍ.<br>5. تقديم مطالبات التعويض عن الأضرار أو الإصابات.<br></p>', 'الخطوات القانونية بعد وقوع حادث سيارة', 'دليل لما يجب فعله قانونيًا بعد التعرض لحادث مروري.', '2025-12-20 04:09:34', '2025-12-20 04:09:34');

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

CREATE TABLE `configurations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `config` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`id`, `config`, `value`, `created_at`, `updated_at`) VALUES
(1, 'setup_stage', '5', '2025-12-20 04:09:28', '2025-12-20 10:10:39'),
(2, 'setup_complete', '1', '2025-12-20 04:09:28', '2025-12-20 10:10:39'),
(3, 'setup_stage', '1', '2025-12-28 11:48:35', '2025-12-28 11:48:35'),
(4, 'setup_complete', '0', '2025-12-28 11:48:35', '2025-12-28 11:48:35');

-- --------------------------------------------------------

--
-- Table structure for table `contact_infos`
--

CREATE TABLE `contact_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `top_bar_email` varchar(255) DEFAULT NULL,
  `top_bar_phone` varchar(255) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `map_embed_code` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_infos`
--

INSERT INTO `contact_infos` (`id`, `top_bar_email`, `top_bar_phone`, `email`, `phone`, `address`, `map_embed_code`, `created_at`, `updated_at`) VALUES
(1, 'info@syrianlaw.com', '+963-11-123-4567', 'contact@syrianlaw.com', '+963-11-234-5678', 'شارع المحاكم، دمشق، سوريا', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3026.929848957016!2d-73.65008138515348!3d40.65347674913173!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c27b4c1cf34df7%3A0x83ce632b88556b58!2zOTUgUyBQYXJrIEF2ZSwgUm9ja3ZpbGxlIENlbnRyZSwgTlkgMTE1NzAsIOCmruCmvuCmsOCnjeCmleCmv-CmqCDgpq_gp4HgppXgp43gpqTgprDgpr7gprfgp43gpp_gp43gprA!5e0!3m2!1sbn!2sbd!4v1626145586281!5m2!1sbn!2sbd\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', '2025-12-20 04:09:34', '2025-12-20 04:09:34');

-- --------------------------------------------------------

--
-- Table structure for table `contact_info_translations`
--

CREATE TABLE `contact_info_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_info_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `header` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `about` text DEFAULT NULL,
  `copyright` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_info_translations`
--

INSERT INTO `contact_info_translations` (`id`, `contact_info_id`, `lang_code`, `header`, `description`, `about`, `copyright`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Contact Us', 'Please fill in the following form to contact us quickly.', 'We provide expert legal services in Syria with professional legal representation and consultation. Our experienced legal team specializes in all areas of Syrian law and ensures personalized, dedicated representation for your legal matters. Book your consultation today for trusted legal support.', 'Copyright 2025, Syrian Law Firm. All Rights Reserved.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(2, 1, 'ar', 'اتصل بنا', 'يرجى ملء النموذج التالي للتواصل معنا بسرعة.', 'نقدم خدمات قانونية متخصصة في سوريا مع تمثيل واستشارات قانونية احترافية. فريقنا القانوني المتمرس متخصص في جميع مجالات القانون السوري ويضمن لك التمثيل القانوني المخصص والمتفاني لجميع قضاياك القانونية. احجز استشارتك اليوم للحصول على دعم قانوني موثوق.', 'حقوق النشر 2025، مكتب المحاماة السوري. جميع الحقوق محفوظة.', '2025-12-20 04:09:34', '2025-12-20 04:09:34');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `sender_type` varchar(255) NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_type` varchar(255) NOT NULL,
  `last_message_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `sender_id`, `sender_type`, `receiver_id`, `receiver_type`, `last_message_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1003, 'App\\Models\\User', 12, 'Modules\\Lawyer\\app\\Models\\Lawyer', 4, 'active', '2025-12-28 11:54:35', '2025-12-28 13:10:37');

-- --------------------------------------------------------

--
-- Table structure for table `counters`
--

CREATE TABLE `counters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `counters`
--

INSERT INTO `counters` (`id`, `icon`, `qty`, `status`, `created_at`, `updated_at`) VALUES
(1, 'fas fa-smile', '500', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(2, 'fas fa-hospital-user', '16', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(3, 'fas fa-balance-scale', '50', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(4, 'fas fa-award', '300', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `counter_translations`
--

CREATE TABLE `counter_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `counter_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `counter_translations`
--

INSERT INTO `counter_translations` (`id`, `counter_id`, `lang_code`, `title`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Happy Clients', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(2, 1, 'ar', 'عملاء سعداء', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(3, 2, 'en', 'Departments', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(4, 2, 'ar', 'الأقسام', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(5, 3, 'en', 'Expert Lawyers', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(6, 3, 'ar', 'محامون خبراء', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(7, 4, 'en', 'Total Awards', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(8, 4, 'ar', 'إجمالي الجوائز', '2025-12-20 04:09:35', '2025-12-20 04:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `customizable_page_translations`
--

CREATE TABLE `customizable_page_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customizeable_page_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customizable_page_translations`
--

INSERT INTO `customizable_page_translations` (`id`, `customizeable_page_id`, `lang_code`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Terms & Conditions', '<h3 class=\"title\">Who we are</h3>\n                    <p><b>Suggested text:</b> Our website address is: https://yourwebsite.com</p>\n                    <h3 class=\"title\">Comments</h3>\n                    <p><b>Suggested text:</b> When visitors leave comments on the site we collect the data shown\n                        in the comments form, and also the visitor’s IP address and browser user agent string to\n                        help spam detection.</p>\n                    <p>An anonymized string created from your email address (also called a hash) may be provided\n                        to the Gravatar service to see if you are using it. The Gravatar service privacy policy\n                        is available here: https://automattic.com/privacy/. After approval of your comment, your\n                        profile picture is visible to the public in the context of your comment.</p>\n                    <h3 class=\"title\">Media</h3>\n                    <p><b>Suggested text:</b> If you upload images to the website, you should avoid uploading\n                        images with embedded location data (EXIF GPS) included. Visitors to the website can\n                        download and extract any location data from images on the website.</p>\n                    <h3 class=\"title\">Cookies</h3>\n                    <p><b>Suggested text:</b> If you leave a comment on our site you may opt-in to saving your\n                        name, email address and website in\n                        cookies. These are for your convenience so that you do not have to fill in your details\n                        again when you leave another\n                        comment. These cookies will last for one year.</p>\n                    <p>If you visit our login page, we will set a temporary cookie to determine if your browser\n                        accepts cookies. This cookie\n                        contains no personal data and is discarded when you close your browser.</p>\n                    <p>When you log in, we will also set up several cookies to save your login information and\n                        your screen display choices.\n                        Login cookies last for two days, and screen options cookies last for a year. If you\n                        select \"Remember Me\", your login\n                        will persist for two weeks. If you log out of your account, the login cookies will be\n                        removed.</p>\n                    <p>If you edit or publish an article, an additional cookie will be saved in your browser.\n                        This cookie includes no personal\n                        data and simply indicates the post ID of the article you just edited. It expires after 1\n                        day.</p>\n                    <h3 class=\"title\">Embedded content from other websites</h3>\n                    <p><b>Suggested text:</b> Articles on this site may include embedded content (e.g. videos,\n                        images, articles, etc.). Embedded\n                        content from other websites behaves in the exact same way as if the visitor has visited\n                        the other website.</p>\n                    <p>These websites may collect data about you, use cookies, embed additional third-party\n                        tracking, and monitor your\n                        interaction with that embedded content, including tracking your interaction with the\n                        embedded content if you have an\n                        account and are logged in to that website.</p>\n                    <p>For users that register on our website (if any), we also store the personal information\n                        they provide in their user\n                        profile. All users can see, edit, or delete their personal information at any time\n                        (except they cannot change their\n                        username). Website administrators can also see and edit that information. browser user\n                        agent string to help spam detection.</p>', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(2, 1, 'ar', 'Terms & Conditions', '<h3 class=\"title\">Who we are</h3>\n                    <p><b>Suggested text:</b> Our website address is: https://yourwebsite.com</p>\n                    <h3 class=\"title\">Comments</h3>\n                    <p><b>Suggested text:</b> When visitors leave comments on the site we collect the data shown\n                        in the comments form, and also the visitor’s IP address and browser user agent string to\n                        help spam detection.</p>\n                    <p>An anonymized string created from your email address (also called a hash) may be provided\n                        to the Gravatar service to see if you are using it. The Gravatar service privacy policy\n                        is available here: https://automattic.com/privacy/. After approval of your comment, your\n                        profile picture is visible to the public in the context of your comment.</p>\n                    <h3 class=\"title\">Media</h3>\n                    <p><b>Suggested text:</b> If you upload images to the website, you should avoid uploading\n                        images with embedded location data (EXIF GPS) included. Visitors to the website can\n                        download and extract any location data from images on the website.</p>\n                    <h3 class=\"title\">Cookies</h3>\n                    <p><b>Suggested text:</b> If you leave a comment on our site you may opt-in to saving your\n                        name, email address and website in\n                        cookies. These are for your convenience so that you do not have to fill in your details\n                        again when you leave another\n                        comment. These cookies will last for one year.</p>\n                    <p>If you visit our login page, we will set a temporary cookie to determine if your browser\n                        accepts cookies. This cookie\n                        contains no personal data and is discarded when you close your browser.</p>\n                    <p>When you log in, we will also set up several cookies to save your login information and\n                        your screen display choices.\n                        Login cookies last for two days, and screen options cookies last for a year. If you\n                        select \"Remember Me\", your login\n                        will persist for two weeks. If you log out of your account, the login cookies will be\n                        removed.</p>\n                    <p>If you edit or publish an article, an additional cookie will be saved in your browser.\n                        This cookie includes no personal\n                        data and simply indicates the post ID of the article you just edited. It expires after 1\n                        day.</p>\n                    <h3 class=\"title\">Embedded content from other websites</h3>\n                    <p><b>Suggested text:</b> Articles on this site may include embedded content (e.g. videos,\n                        images, articles, etc.). Embedded\n                        content from other websites behaves in the exact same way as if the visitor has visited\n                        the other website.</p>\n                    <p>These websites may collect data about you, use cookies, embed additional third-party\n                        tracking, and monitor your\n                        interaction with that embedded content, including tracking your interaction with the\n                        embedded content if you have an\n                        account and are logged in to that website.</p>\n                    <p>For users that register on our website (if any), we also store the personal information\n                        they provide in their user\n                        profile. All users can see, edit, or delete their personal information at any time\n                        (except they cannot change their\n                        username). Website administrators can also see and edit that information. browser user\n                        agent string to help spam detection.</p>', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(3, 2, 'en', 'Privacy Policy', '<h3 class=\"title\">Who we are</h3>\n                    <p><b>Suggested text:</b> Our website address is: https://yourwebsite.com</p>\n                    <h3 class=\"title\">Comments</h3>\n                    <p><b>Suggested text:</b> When visitors leave comments on the site we collect the data shown\n                        in the comments form, and also the visitor’s IP address and browser user agent string to\n                        help spam detection.</p>\n                    <p>An anonymized string created from your email address (also called a hash) may be provided\n                        to the Gravatar service to see if you are using it. The Gravatar service privacy policy\n                        is available here: https://automattic.com/privacy/. After approval of your comment, your\n                        profile picture is visible to the public in the context of your comment.</p>\n                    <h3 class=\"title\">Media</h3>\n                    <p><b>Suggested text:</b> If you upload images to the website, you should avoid uploading\n                        images with embedded location data (EXIF GPS) included. Visitors to the website can\n                        download and extract any location data from images on the website.</p>\n                    <h3 class=\"title\">Cookies</h3>\n                    <p><b>Suggested text:</b> If you leave a comment on our site you may opt-in to saving your\n                        name, email address and website in\n                        cookies. These are for your convenience so that you do not have to fill in your details\n                        again when you leave another\n                        comment. These cookies will last for one year.</p>\n                    <p>If you visit our login page, we will set a temporary cookie to determine if your browser\n                        accepts cookies. This cookie\n                        contains no personal data and is discarded when you close your browser.</p>\n                    <p>When you log in, we will also set up several cookies to save your login information and\n                        your screen display choices.\n                        Login cookies last for two days, and screen options cookies last for a year. If you\n                        select \"Remember Me\", your login\n                        will persist for two weeks. If you log out of your account, the login cookies will be\n                        removed.</p>\n                    <p>If you edit or publish an article, an additional cookie will be saved in your browser.\n                        This cookie includes no personal\n                        data and simply indicates the post ID of the article you just edited. It expires after 1\n                        day.</p>\n                    <h3 class=\"title\">Embedded content from other websites</h3>\n                    <p><b>Suggested text:</b> Articles on this site may include embedded content (e.g. videos,\n                        images, articles, etc.). Embedded\n                        content from other websites behaves in the exact same way as if the visitor has visited\n                        the other website.</p>\n                    <p>These websites may collect data about you, use cookies, embed additional third-party\n                        tracking, and monitor your\n                        interaction with that embedded content, including tracking your interaction with the\n                        embedded content if you have an\n                        account and are logged in to that website.</p>\n                    <p>For users that register on our website (if any), we also store the personal information\n                        they provide in their user\n                        profile. All users can see, edit, or delete their personal information at any time\n                        (except they cannot change their\n                        username). Website administrators can also see and edit that information. browser user\n                        agent string to help spam detection.</p>', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(4, 2, 'ar', 'Privacy Policy', '<h3 class=\"title\">Who we are</h3>\n                    <p><b>Suggested text:</b> Our website address is: https://yourwebsite.com</p>\n                    <h3 class=\"title\">Comments</h3>\n                    <p><b>Suggested text:</b> When visitors leave comments on the site we collect the data shown\n                        in the comments form, and also the visitor’s IP address and browser user agent string to\n                        help spam detection.</p>\n                    <p>An anonymized string created from your email address (also called a hash) may be provided\n                        to the Gravatar service to see if you are using it. The Gravatar service privacy policy\n                        is available here: https://automattic.com/privacy/. After approval of your comment, your\n                        profile picture is visible to the public in the context of your comment.</p>\n                    <h3 class=\"title\">Media</h3>\n                    <p><b>Suggested text:</b> If you upload images to the website, you should avoid uploading\n                        images with embedded location data (EXIF GPS) included. Visitors to the website can\n                        download and extract any location data from images on the website.</p>\n                    <h3 class=\"title\">Cookies</h3>\n                    <p><b>Suggested text:</b> If you leave a comment on our site you may opt-in to saving your\n                        name, email address and website in\n                        cookies. These are for your convenience so that you do not have to fill in your details\n                        again when you leave another\n                        comment. These cookies will last for one year.</p>\n                    <p>If you visit our login page, we will set a temporary cookie to determine if your browser\n                        accepts cookies. This cookie\n                        contains no personal data and is discarded when you close your browser.</p>\n                    <p>When you log in, we will also set up several cookies to save your login information and\n                        your screen display choices.\n                        Login cookies last for two days, and screen options cookies last for a year. If you\n                        select \"Remember Me\", your login\n                        will persist for two weeks. If you log out of your account, the login cookies will be\n                        removed.</p>\n                    <p>If you edit or publish an article, an additional cookie will be saved in your browser.\n                        This cookie includes no personal\n                        data and simply indicates the post ID of the article you just edited. It expires after 1\n                        day.</p>\n                    <h3 class=\"title\">Embedded content from other websites</h3>\n                    <p><b>Suggested text:</b> Articles on this site may include embedded content (e.g. videos,\n                        images, articles, etc.). Embedded\n                        content from other websites behaves in the exact same way as if the visitor has visited\n                        the other website.</p>\n                    <p>These websites may collect data about you, use cookies, embed additional third-party\n                        tracking, and monitor your\n                        interaction with that embedded content, including tracking your interaction with the\n                        embedded content if you have an\n                        account and are logged in to that website.</p>\n                    <p>For users that register on our website (if any), we also store the personal information\n                        they provide in their user\n                        profile. All users can see, edit, or delete their personal information at any time\n                        (except they cannot change their\n                        username). Website administrators can also see and edit that information. browser user\n                        agent string to help spam detection.</p>', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(5, 3, 'en', 'Example Page', '<h3 class=\"title\">Who we are</h3>\n                    <p><b>Suggested text:</b> Our website address is: https://yourwebsite.com</p>\n                    <h3 class=\"title\">Comments</h3>\n                    <p><b>Suggested text:</b> When visitors leave comments on the site we collect the data shown\n                        in the comments form, and also the visitor’s IP address and browser user agent string to\n                        help spam detection.</p>\n                    <p>An anonymized string created from your email address (also called a hash) may be provided\n                        to the Gravatar service to see if you are using it. The Gravatar service privacy policy\n                        is available here: https://automattic.com/privacy/. After approval of your comment, your\n                        profile picture is visible to the public in the context of your comment.</p>\n                    <h3 class=\"title\">Media</h3>\n                    <p><b>Suggested text:</b> If you upload images to the website, you should avoid uploading\n                        images with embedded location data (EXIF GPS) included. Visitors to the website can\n                        download and extract any location data from images on the website.</p>\n                    <h3 class=\"title\">Cookies</h3>\n                    <p><b>Suggested text:</b> If you leave a comment on our site you may opt-in to saving your\n                        name, email address and website in\n                        cookies. These are for your convenience so that you do not have to fill in your details\n                        again when you leave another\n                        comment. These cookies will last for one year.</p>\n                    <p>If you visit our login page, we will set a temporary cookie to determine if your browser\n                        accepts cookies. This cookie\n                        contains no personal data and is discarded when you close your browser.</p>\n                    <p>When you log in, we will also set up several cookies to save your login information and\n                        your screen display choices.\n                        Login cookies last for two days, and screen options cookies last for a year. If you\n                        select \"Remember Me\", your login\n                        will persist for two weeks. If you log out of your account, the login cookies will be\n                        removed.</p>\n                    <p>If you edit or publish an article, an additional cookie will be saved in your browser.\n                        This cookie includes no personal\n                        data and simply indicates the post ID of the article you just edited. It expires after 1\n                        day.</p>\n                    <h3 class=\"title\">Embedded content from other websites</h3>\n                    <p><b>Suggested text:</b> Articles on this site may include embedded content (e.g. videos,\n                        images, articles, etc.). Embedded\n                        content from other websites behaves in the exact same way as if the visitor has visited\n                        the other website.</p>\n                    <p>These websites may collect data about you, use cookies, embed additional third-party\n                        tracking, and monitor your\n                        interaction with that embedded content, including tracking your interaction with the\n                        embedded content if you have an\n                        account and are logged in to that website.</p>\n                    <p>For users that register on our website (if any), we also store the personal information\n                        they provide in their user\n                        profile. All users can see, edit, or delete their personal information at any time\n                        (except they cannot change their\n                        username). Website administrators can also see and edit that information. browser user\n                        agent string to help spam detection.</p>', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(6, 3, 'ar', 'Example Page', '<h3 class=\"title\">Who we are</h3>\n                    <p><b>Suggested text:</b> Our website address is: https://yourwebsite.com</p>\n                    <h3 class=\"title\">Comments</h3>\n                    <p><b>Suggested text:</b> When visitors leave comments on the site we collect the data shown\n                        in the comments form, and also the visitor’s IP address and browser user agent string to\n                        help spam detection.</p>\n                    <p>An anonymized string created from your email address (also called a hash) may be provided\n                        to the Gravatar service to see if you are using it. The Gravatar service privacy policy\n                        is available here: https://automattic.com/privacy/. After approval of your comment, your\n                        profile picture is visible to the public in the context of your comment.</p>\n                    <h3 class=\"title\">Media</h3>\n                    <p><b>Suggested text:</b> If you upload images to the website, you should avoid uploading\n                        images with embedded location data (EXIF GPS) included. Visitors to the website can\n                        download and extract any location data from images on the website.</p>\n                    <h3 class=\"title\">Cookies</h3>\n                    <p><b>Suggested text:</b> If you leave a comment on our site you may opt-in to saving your\n                        name, email address and website in\n                        cookies. These are for your convenience so that you do not have to fill in your details\n                        again when you leave another\n                        comment. These cookies will last for one year.</p>\n                    <p>If you visit our login page, we will set a temporary cookie to determine if your browser\n                        accepts cookies. This cookie\n                        contains no personal data and is discarded when you close your browser.</p>\n                    <p>When you log in, we will also set up several cookies to save your login information and\n                        your screen display choices.\n                        Login cookies last for two days, and screen options cookies last for a year. If you\n                        select \"Remember Me\", your login\n                        will persist for two weeks. If you log out of your account, the login cookies will be\n                        removed.</p>\n                    <p>If you edit or publish an article, an additional cookie will be saved in your browser.\n                        This cookie includes no personal\n                        data and simply indicates the post ID of the article you just edited. It expires after 1\n                        day.</p>\n                    <h3 class=\"title\">Embedded content from other websites</h3>\n                    <p><b>Suggested text:</b> Articles on this site may include embedded content (e.g. videos,\n                        images, articles, etc.). Embedded\n                        content from other websites behaves in the exact same way as if the visitor has visited\n                        the other website.</p>\n                    <p>These websites may collect data about you, use cookies, embed additional third-party\n                        tracking, and monitor your\n                        interaction with that embedded content, including tracking your interaction with the\n                        embedded content if you have an\n                        account and are logged in to that website.</p>\n                    <p>For users that register on our website (if any), we also store the personal information\n                        they provide in their user\n                        profile. All users can see, edit, or delete their personal information at any time\n                        (except they cannot change their\n                        username). Website administrators can also see and edit that information. browser user\n                        agent string to help spam detection.</p>', '2025-12-20 04:09:33', '2025-12-20 04:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `customizeable_pages`
--

CREATE TABLE `customizeable_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customizeable_pages`
--

INSERT INTO `customizeable_pages` (`id`, `slug`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'terms-contidions', NULL, 1, '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(2, 'privacy-policy', NULL, 1, '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(3, 'example', NULL, 1, '2025-12-20 04:09:33', '2025-12-20 04:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `custom_addons`
--

CREATE TABLE `custom_addons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `isPaid` tinyint(1) NOT NULL DEFAULT 1,
  `description` text DEFAULT NULL,
  `author` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`author`)),
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`options`)),
  `icon` varchar(255) DEFAULT NULL,
  `license` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `version` varchar(255) DEFAULT NULL,
  `last_update` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_codes`
--

CREATE TABLE `custom_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `css` text DEFAULT NULL,
  `header_javascript` text DEFAULT NULL,
  `body_javascript` text DEFAULT NULL,
  `footer_javascript` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_paginations`
--

CREATE TABLE `custom_paginations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `item_qty` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `custom_paginations`
--

INSERT INTO `custom_paginations` (`id`, `section_name`, `item_qty`, `created_at`, `updated_at`) VALUES
(1, 'Blog', 6, '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(2, 'Blog Comment', 10, '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(3, 'Lawyer', 8, '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(4, 'Department', 6, '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(5, 'Service', 6, '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(6, 'Testimonial', 6, '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(7, 'Language List', 200, '2025-12-20 04:09:29', '2025-12-20 04:09:29');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'friday', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(2, 'saturday', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(3, 'sunday', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(4, 'monday', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(5, 'tuesday', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(6, 'wednesday', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(7, 'thursday', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `day_translations`
--

CREATE TABLE `day_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `day_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `day_translations`
--

INSERT INTO `day_translations` (`id`, `day_id`, `lang_code`, `title`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Friday', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(2, 1, 'ar', 'Friday', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(3, 2, 'en', 'Saturday', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(4, 2, 'ar', 'Saturday', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(5, 3, 'en', 'Sunday', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(6, 3, 'ar', 'Sunday', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(7, 4, 'en', 'Monday', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(8, 4, 'ar', 'Monday', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(9, 5, 'en', 'Tuesday', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(10, 5, 'ar', 'Tuesday', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(11, 6, 'en', 'Wednesday', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(12, 6, 'ar', 'Wednesday', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(13, 7, 'en', 'Thursday', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(14, 7, 'ar', 'Thursday', '2025-12-20 04:09:35', '2025-12-20 04:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` text NOT NULL,
  `thumbnail_image` varchar(255) DEFAULT NULL,
  `show_homepage` tinyint(1) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `slug`, `thumbnail_image`, `show_homepage`, `status`, `created_at`, `updated_at`) VALUES
(1, 'civil-rights-law', 'uploads/website-images/dummy/department-thumbnail-1.webp', 1, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(2, 'entertainment-law', 'uploads/website-images/dummy/department-thumbnail-2.webp', 1, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(3, 'health-law', 'uploads/website-images/dummy/department-thumbnail-3.webp', 1, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(4, 'immigration-law', 'uploads/website-images/dummy/department-thumbnail-4.webp', 1, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(5, 'international-law', 'uploads/website-images/dummy/department-thumbnail-5.webp', 1, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(6, 'military-law', 'uploads/website-images/dummy/department-thumbnail-6.webp', 1, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `department_faqs`
--

CREATE TABLE `department_faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department_faqs`
--

INSERT INTO `department_faqs` (`id`, `department_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(2, 1, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(3, 2, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(4, 2, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(5, 3, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(6, 3, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(7, 4, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(8, 4, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(9, 5, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(10, 5, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(11, 6, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(12, 6, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `department_faq_translations`
--

CREATE TABLE `department_faq_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_faq_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department_faq_translations`
--

INSERT INTO `department_faq_translations` (`id`, `department_faq_id`, `lang_code`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Lorem ipsum dolor sit amet per mollis?', 'Lorem ipsum dolor sit amet, per mollis aeterno nostrud in, nam timeam fastidii eu. Commodo nonumes vim eu. Quo indoctum voluptatibus delicatissimi no. Eu cum dico melius. Cum impetus scribentur ad.', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(2, 1, 'ar', 'لوريم إيبسوم دولور الجلوس أميت لكل موليس؟', 'لوريم إيبسوم دولور الجلوس أميت لكل موليس؟لوريم إيبسوم دولور الجلوس أميت لكل موليس؟لوريم إيبسوم دولور الجلوس أميت لكل موليس؟', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(3, 2, 'en', 'Ut alterum dissentiunt eam nobis audire?', 'Ut alterum dissentiunt eam, nobis audire verterem ut vel. Vidisse persius mea no. Melius imperdiet his at. Ex has zril convenire, cu eos eros dolor, omittam adversarium suscipiantur mea ea.', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(4, 2, 'ar', 'هل من الممكن أن أختلف مع أي شخص آخر؟', 'هل من الممكن أن أختلف مع أي شخص آخرهل من الممكن أن أختلف مع أي شخص آخرهل من الممكن أن أختلف مع أي شخص آخر', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(5, 3, 'en', 'Lorem ipsum dolor sit amet per mollis?', 'Lorem ipsum dolor sit amet, per mollis aeterno nostrud in, nam timeam fastidii eu. Commodo nonumes vim eu. Quo indoctum voluptatibus delicatissimi no. Eu cum dico melius. Cum impetus scribentur ad.', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(6, 3, 'ar', 'لوريم إيبسوم دولور الجلوس أميت لكل موليس؟', 'لوريم إيبسوم دولور الجلوس أميت لكل موليس؟لوريم إيبسوم دولور الجلوس أميت لكل موليس؟لوريم إيبسوم دولور الجلوس أميت لكل موليس؟', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(7, 4, 'en', 'Ut alterum dissentiunt eam nobis audire?', 'Ut alterum dissentiunt eam, nobis audire verterem ut vel. Vidisse persius mea no. Melius imperdiet his at. Ex has zril convenire, cu eos eros dolor, omittam adversarium suscipiantur mea ea.', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(8, 4, 'ar', 'هل من الممكن أن أختلف مع أي شخص آخر؟', 'هل من الممكن أن أختلف مع أي شخص آخرهل من الممكن أن أختلف مع أي شخص آخرهل من الممكن أن أختلف مع أي شخص آخر', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(9, 5, 'en', 'Lorem ipsum dolor sit amet per mollis?', 'Lorem ipsum dolor sit amet, per mollis aeterno nostrud in, nam timeam fastidii eu. Commodo nonumes vim eu. Quo indoctum voluptatibus delicatissimi no. Eu cum dico melius. Cum impetus scribentur ad.', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(10, 5, 'ar', 'لوريم إيبسوم دولور الجلوس أميت لكل موليس؟', 'لوريم إيبسوم دولور الجلوس أميت لكل موليس؟لوريم إيبسوم دولور الجلوس أميت لكل موليس؟لوريم إيبسوم دولور الجلوس أميت لكل موليس؟', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(11, 6, 'en', 'Ut alterum dissentiunt eam nobis audire?', 'Ut alterum dissentiunt eam, nobis audire verterem ut vel. Vidisse persius mea no. Melius imperdiet his at. Ex has zril convenire, cu eos eros dolor, omittam adversarium suscipiantur mea ea.', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(12, 6, 'ar', 'هل من الممكن أن أختلف مع أي شخص آخر؟', 'هل من الممكن أن أختلف مع أي شخص آخرهل من الممكن أن أختلف مع أي شخص آخرهل من الممكن أن أختلف مع أي شخص آخر', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(13, 7, 'en', 'Lorem ipsum dolor sit amet per mollis?', 'Lorem ipsum dolor sit amet, per mollis aeterno nostrud in, nam timeam fastidii eu. Commodo nonumes vim eu. Quo indoctum voluptatibus delicatissimi no. Eu cum dico melius. Cum impetus scribentur ad.', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(14, 7, 'ar', 'لوريم إيبسوم دولور الجلوس أميت لكل موليس؟', 'لوريم إيبسوم دولور الجلوس أميت لكل موليس؟لوريم إيبسوم دولور الجلوس أميت لكل موليس؟لوريم إيبسوم دولور الجلوس أميت لكل موليس؟', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(15, 8, 'en', 'Ut alterum dissentiunt eam nobis audire?', 'Ut alterum dissentiunt eam, nobis audire verterem ut vel. Vidisse persius mea no. Melius imperdiet his at. Ex has zril convenire, cu eos eros dolor, omittam adversarium suscipiantur mea ea.', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(16, 8, 'ar', 'هل من الممكن أن أختلف مع أي شخص آخر؟', 'هل من الممكن أن أختلف مع أي شخص آخرهل من الممكن أن أختلف مع أي شخص آخرهل من الممكن أن أختلف مع أي شخص آخر', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(17, 9, 'en', 'Lorem ipsum dolor sit amet per mollis?', 'Lorem ipsum dolor sit amet, per mollis aeterno nostrud in, nam timeam fastidii eu. Commodo nonumes vim eu. Quo indoctum voluptatibus delicatissimi no. Eu cum dico melius. Cum impetus scribentur ad.', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(18, 9, 'ar', 'لوريم إيبسوم دولور الجلوس أميت لكل موليس؟', 'لوريم إيبسوم دولور الجلوس أميت لكل موليس؟لوريم إيبسوم دولور الجلوس أميت لكل موليس؟لوريم إيبسوم دولور الجلوس أميت لكل موليس؟', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(19, 10, 'en', 'Ut alterum dissentiunt eam nobis audire?', 'Ut alterum dissentiunt eam, nobis audire verterem ut vel. Vidisse persius mea no. Melius imperdiet his at. Ex has zril convenire, cu eos eros dolor, omittam adversarium suscipiantur mea ea.', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(20, 10, 'ar', 'هل من الممكن أن أختلف مع أي شخص آخر؟', 'هل من الممكن أن أختلف مع أي شخص آخرهل من الممكن أن أختلف مع أي شخص آخرهل من الممكن أن أختلف مع أي شخص آخر', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(21, 11, 'en', 'Lorem ipsum dolor sit amet per mollis?', 'Lorem ipsum dolor sit amet, per mollis aeterno nostrud in, nam timeam fastidii eu. Commodo nonumes vim eu. Quo indoctum voluptatibus delicatissimi no. Eu cum dico melius. Cum impetus scribentur ad.', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(22, 11, 'ar', 'لوريم إيبسوم دولور الجلوس أميت لكل موليس؟', 'لوريم إيبسوم دولور الجلوس أميت لكل موليس؟لوريم إيبسوم دولور الجلوس أميت لكل موليس؟لوريم إيبسوم دولور الجلوس أميت لكل موليس؟', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(23, 12, 'en', 'Ut alterum dissentiunt eam nobis audire?', 'Ut alterum dissentiunt eam, nobis audire verterem ut vel. Vidisse persius mea no. Melius imperdiet his at. Ex has zril convenire, cu eos eros dolor, omittam adversarium suscipiantur mea ea.', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(24, 12, 'ar', 'هل من الممكن أن أختلف مع أي شخص آخر؟', 'هل من الممكن أن أختلف مع أي شخص آخرهل من الممكن أن أختلف مع أي شخص آخرهل من الممكن أن أختلف مع أي شخص آخر', '2025-12-20 04:09:36', '2025-12-20 04:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `department_images`
--

CREATE TABLE `department_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `small_image` varchar(255) NOT NULL,
  `large_image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department_images`
--

INSERT INTO `department_images` (`id`, `department_id`, `small_image`, `large_image`, `created_at`, `updated_at`) VALUES
(1, 1, 'uploads/website-images/dummy/department-small-1.webp', 'uploads/website-images/dummy/department-large-1.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(2, 1, 'uploads/website-images/dummy/department-small-2.webp', 'uploads/website-images/dummy/department-large-2.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(3, 1, 'uploads/website-images/dummy/department-small-3.webp', 'uploads/website-images/dummy/department-large-3.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(4, 1, 'uploads/website-images/dummy/department-small-4.webp', 'uploads/website-images/dummy/department-large-4.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(5, 2, 'uploads/website-images/dummy/department-small-1.webp', 'uploads/website-images/dummy/department-large-1.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(6, 2, 'uploads/website-images/dummy/department-small-2.webp', 'uploads/website-images/dummy/department-large-2.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(7, 2, 'uploads/website-images/dummy/department-small-3.webp', 'uploads/website-images/dummy/department-large-3.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(8, 2, 'uploads/website-images/dummy/department-small-4.webp', 'uploads/website-images/dummy/department-large-4.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(9, 3, 'uploads/website-images/dummy/department-small-1.webp', 'uploads/website-images/dummy/department-large-1.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(10, 3, 'uploads/website-images/dummy/department-small-2.webp', 'uploads/website-images/dummy/department-large-2.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(11, 3, 'uploads/website-images/dummy/department-small-3.webp', 'uploads/website-images/dummy/department-large-3.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(12, 3, 'uploads/website-images/dummy/department-small-4.webp', 'uploads/website-images/dummy/department-large-4.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(13, 4, 'uploads/website-images/dummy/department-small-1.webp', 'uploads/website-images/dummy/department-large-1.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(14, 4, 'uploads/website-images/dummy/department-small-2.webp', 'uploads/website-images/dummy/department-large-2.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(15, 4, 'uploads/website-images/dummy/department-small-3.webp', 'uploads/website-images/dummy/department-large-3.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(16, 4, 'uploads/website-images/dummy/department-small-4.webp', 'uploads/website-images/dummy/department-large-4.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(17, 5, 'uploads/website-images/dummy/department-small-1.webp', 'uploads/website-images/dummy/department-large-1.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(18, 5, 'uploads/website-images/dummy/department-small-2.webp', 'uploads/website-images/dummy/department-large-2.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(19, 5, 'uploads/website-images/dummy/department-small-3.webp', 'uploads/website-images/dummy/department-large-3.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(20, 5, 'uploads/website-images/dummy/department-small-4.webp', 'uploads/website-images/dummy/department-large-4.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(21, 6, 'uploads/website-images/dummy/department-small-1.webp', 'uploads/website-images/dummy/department-large-1.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(22, 6, 'uploads/website-images/dummy/department-small-2.webp', 'uploads/website-images/dummy/department-large-2.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(23, 6, 'uploads/website-images/dummy/department-small-3.webp', 'uploads/website-images/dummy/department-large-3.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(24, 6, 'uploads/website-images/dummy/department-small-4.webp', 'uploads/website-images/dummy/department-large-4.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `department_translations`
--

CREATE TABLE `department_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `seo_title` text DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department_translations`
--

INSERT INTO `department_translations` (`id`, `department_id`, `lang_code`, `name`, `description`, `seo_title`, `seo_description`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Civil and Commercial Law', '<p>We provide comprehensive legal services in civil and commercial matters including contracts, property rights, and business transactions under Syrian law.</p>', 'Civil and Commercial Law', 'Civil and Commercial Law', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(2, 1, 'ar', 'القانون المدني والتجاري', '<p>نقدم خدمات قانونية شاملة في القضايا المدنية والتجارية بما في ذلك العقود وحقوق الملكية والمعاملات التجارية وفقاً للقانون السوري.</p>', 'القانون المدني والتجاري', 'القانون المدني والتجاري', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(3, 2, 'en', 'Family and Personal Status Law', '<p>Specialized legal representation in family law matters including marriage, divorce, custody, inheritance, and personal status issues according to Syrian legislation.</p>', 'Family and Personal Status Law', 'Family and Personal Status Law', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(4, 2, 'ar', 'قانون الأحوال الشخصية والأسرة', '<p>تمثيل قانوني متخصص في قضايا الأحوال الشخصية بما في ذلك الزواج والطلاق والحضانة والميراث وفقاً للتشريعات السورية.</p>', 'قانون الأحوال الشخصية والأسرة', 'قانون الأحوال الشخصية والأسرة', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(5, 3, 'en', 'Criminal Law', '<p>Expert defense in criminal cases with comprehensive understanding of Syrian criminal code and procedures, protecting your rights throughout the legal process.</p>', 'Criminal Law', 'Criminal Law', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(6, 3, 'ar', 'القانون الجنائي', '<p>دفاع متخصص في القضايا الجنائية مع فهم شامل لقانون العقوبات السوري والإجراءات الجزائية، لحماية حقوقك في جميع مراحل العملية القانونية.</p>', 'القانون الجنائي', 'القانون الجنائي', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(7, 4, 'en', 'Real Estate and Property Law', '<p>Comprehensive legal services for real estate transactions, property disputes, and land registration matters in accordance with Syrian property laws.</p>', 'Real Estate and Property Law', 'Real Estate and Property Law', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(8, 4, 'ar', 'قانون العقارات والملكية', '<p>خدمات قانونية شاملة للمعاملات العقارية ونزاعات الملكية وقضايا تسجيل الأراضي وفقاً لقوانين الملكية السورية.</p>', 'قانون العقارات والملكية', 'قانون العقارات والملكية', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(9, 5, 'en', 'Labor and Employment Law', '<p>Legal consultation and representation in labor disputes, employment contracts, and workplace rights under Syrian labor law.</p>', 'Labor and Employment Law', 'Labor and Employment Law', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(10, 5, 'ar', 'قانون العمل والتوظيف', '<p>استشارات قانونية وتمثيل في نزاعات العمل وعقود التوظيف وحقوق العمال وفقاً لقانون العمل السوري.</p>', 'قانون العمل والتوظيف', 'قانون العمل والتوظيف', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(11, 6, 'en', 'Administrative Law', '<p>Expert legal services in administrative law matters including government contracts, licensing, and administrative disputes before Syrian courts.</p>', 'Administrative Law', 'Administrative Law', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(12, 6, 'ar', 'القانون الإداري', '<p>خدمات قانونية متخصصة في القانون الإداري بما في ذلك العقود الحكومية والتراخيص والنزاعات الإدارية أمام المحاكم السورية.</p>', 'القانون الإداري', 'القانون الإداري', '2025-12-20 04:09:36', '2025-12-20 04:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `department_videos`
--

CREATE TABLE `department_videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `link` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department_videos`
--

INSERT INTO `department_videos` (`id`, `department_id`, `link`, `code`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'https://www.youtube.com/watch?v=6_aWI8JgRCs', '6_aWI8JgRCs', 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(2, 1, 'https://www.youtube.com/watch?v=SzXbRCVy4r0', 'SzXbRCVy4r0', 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(3, 2, 'https://www.youtube.com/watch?v=6_aWI8JgRCs', '6_aWI8JgRCs', 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(4, 2, 'https://www.youtube.com/watch?v=SzXbRCVy4r0', 'SzXbRCVy4r0', 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(5, 3, 'https://www.youtube.com/watch?v=6_aWI8JgRCs', '6_aWI8JgRCs', 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(6, 3, 'https://www.youtube.com/watch?v=SzXbRCVy4r0', 'SzXbRCVy4r0', 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(7, 4, 'https://www.youtube.com/watch?v=6_aWI8JgRCs', '6_aWI8JgRCs', 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(8, 4, 'https://www.youtube.com/watch?v=SzXbRCVy4r0', 'SzXbRCVy4r0', 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(9, 5, 'https://www.youtube.com/watch?v=6_aWI8JgRCs', '6_aWI8JgRCs', 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(10, 5, 'https://www.youtube.com/watch?v=SzXbRCVy4r0', 'SzXbRCVy4r0', 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(11, 6, 'https://www.youtube.com/watch?v=6_aWI8JgRCs', '6_aWI8JgRCs', 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(12, 6, 'https://www.youtube.com/watch?v=SzXbRCVy4r0', 'SzXbRCVy4r0', 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `name`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'password_reset', 'Password Reset', '<p>Dear {{user_name}},</p>\n                <p>Do you want to reset your password? Please Click the following link and Reset Your Password.</p>', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(2, 'contact_mail', 'Contact Email', '<p>Hello there,</p>\n                <p>&nbsp;Mr. {{name}} has sent a new message. you can see the message details below.&nbsp;</p>\n                <p>Email: {{email}}</p>\n                <p>Phone: {{phone}}</p>\n                <p>Subject: {{subject}}</p>\n                <p>Message: {{message}}</p>', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(3, 'lawyer_login', 'Lawyer Login', '<h4>Hi, <b>{{lawyer_name}}</b></h4>\n                <p>Your Account has been created successfully. Your login info here</p>\n                <p>Email: <b>{{email}}</b></p>\n                <p>Password: <b>{{password}}</b></p>\n                <p>You can log in to your account at <a href=\"{{login_url}}\">{{login_url}}</a></p>', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(4, 'order_mail', 'Order Confirmation Mail', '<h4>Dear <b>{{client_name}}</b>,</h4><p> Thanks for your new order. Your order id is <b>{{orderId}}</b>.</p>\n                <p>Payment Method :<b> {{payment_method}}</b></p>\n                <p>Total amount:<b> {{amount}}</b></p>\n                <p>Payment Status:<b> {{payment_status}}</b></p>\n                <p>Status:<b> {{status}}</b></p>\n                <p><b>{{order_details}}</b></p><p><b><br></b></p>', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(5, 'approve_payment', 'Approve Payment', '<h4>Dear <b>{{client_name}}</b>,</h4><p>Your payment for the order <b>{{orderId}}</b> has been successfully approved. Thank you for choosing our service.</p>', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(6, 'subscribe_notification', 'Subscribe Notification', '<p>Hi there, Congratulations! Your Subscription has been created successfully. Please Click the following link and Verified Your Subscription. If you will not approve this link, you can not get any newsletter from us.</p>', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(7, 'social_login', 'Social Login', '<p>Hello {{user_name}},</p>\n                <p>Welcome to {{app_name}}! Your account has been created successfully.</p>\n                <p>Your email: {{email}}</p>\n                <p>Your password: {{password}}</p>\n                <p>You can log in to your account at <a href=\"{{login_url}}\">{{login_url}}</a></p>\n                <p>Thank you for joining us.</p>', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(8, 'blog_comment', 'Blog Comment', '<p>Hello, {{admin_name}},</p>\n                <p>A new pending comment has been added by {{user_name}}</p>', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(9, 'user_verification', 'User Verification', '<p>Dear {{user_name}},</p>\n                <p>Congratulations! Your account has been created successfully. Please click the following link to activate your account.</p>', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(10, 'approved_withdraw', 'Withdraw Request Approval', '<p>Dear {{user_name}},</p>\n                <p>We are happy to say that, we have send a withdraw amount to your provided bank information.</p>\n                <p>Thanks &amp; Regards</p>\n                <p>LawMent</p>', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(11, 'zoom_meeting', 'Zoom Meeting', '<p>Hi {{client_name}},</p><p>{{lawyer_name}} has created a zoom meeting. if you want to join the meeting, please click here</p><p>Meeting Schedule: {{meeting_schedule}}</p>', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(12, 'pre_notification', 'Pre Notification for Appointment', '<p>Hi {{client_name}},</p><p>Your schedule time is&nbsp; {{schedule}}</p><p>Date:&nbsp;{{date}}</p><p>Lawyer: {{lawyer_name}}</p>', '2025-12-20 04:09:29', '2025-12-20 04:09:29');

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
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faq_category_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `faq_category_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(2, 1, 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(3, 2, 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(4, 2, 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(5, 3, 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(6, 3, 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `faq_categories`
--

CREATE TABLE `faq_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq_categories`
--

INSERT INTO `faq_categories` (`id`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'general-questions', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(2, 'payment-related-questions', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(3, 'appointment-related-questions', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `faq_category_translations`
--

CREATE TABLE `faq_category_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faq_category_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq_category_translations`
--

INSERT INTO `faq_category_translations` (`id`, `faq_category_id`, `lang_code`, `title`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'General Questions', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(2, 1, 'ar', 'أسئلة عامة', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(3, 2, 'en', 'Payment Related Questions', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(4, 2, 'ar', 'أسئلة متعلقة بالدفع', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(5, 3, 'en', 'Appointment Related Questions', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(6, 3, 'ar', 'أسئلة متعلقة بالمواعيد', '2025-12-20 04:09:35', '2025-12-20 04:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `faq_pages`
--

CREATE TABLE `faq_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq_pages`
--

INSERT INTO `faq_pages` (`id`, `image`, `created_at`, `updated_at`) VALUES
(1, 'uploads/website-images/faq_page.png', '2025-12-20 04:09:34', '2025-12-20 04:09:34');

-- --------------------------------------------------------

--
-- Table structure for table `faq_translations`
--

CREATE TABLE `faq_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faq_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq_translations`
--

INSERT INTO `faq_translations` (`id`, `faq_id`, `lang_code`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'What is your refund policy?', 'Our refund policy allows for returns within 30 days of purchase. Please ensure the product is in its original condition.', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(2, 1, 'ar', 'ما هي سياسة الاسترداد الخاصة بكم؟', 'تسمح سياسة الاسترداد لدينا بإرجاع المنتجات خلال 30 يومًا من الشراء. يرجى التأكد من أن المنتج في حالته الأصلية.', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(3, 2, 'en', 'How can I track my order?', 'You can track your order using the tracking number provided in your shipping confirmation email.', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(4, 2, 'ar', 'كيف يمكنني تتبع طلبي؟', 'يمكنك تتبع طلبك باستخدام رقم التتبع المقدم في بريد التأكيد على الشحن.', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(5, 3, 'en', 'What payment methods do you accept?', 'We accept Visa, MasterCard, PayPal, and bank transfers.', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(6, 3, 'ar', 'ما هي طرق الدفع التي تقبلونها؟', 'نقبل فيزا، ماستركارد، باي بال، والتحويلات البنكية.', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(7, 4, 'en', 'Is it safe to use my credit card on your website?', 'Yes, we use industry-standard encryption to protect your information.', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(8, 4, 'ar', 'هل من الآمن استخدام بطاقتي الائتمانية على موقعكم؟', 'نعم، نستخدم تشفيراً وفق المعايير الصناعية لحماية معلوماتك.', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(9, 5, 'en', 'How do I schedule an appointment?', 'You can schedule an appointment through our website or by calling our customer service.', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(10, 5, 'ar', 'كيف يمكنني تحديد موعد؟', 'يمكنك تحديد موعد من خلال موقعنا الإلكتروني أو بالاتصال بخدمة العملاء.', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(11, 6, 'en', 'Can I reschedule my appointment?', 'Yes, you can reschedule your appointment by contacting our customer service at least 24 hours in advance.', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(12, 6, 'ar', 'هل يمكنني إعادة جدولة موعدي؟', 'نعم، يمكنك إعادة جدولة موعدك عن طريق الاتصال بخدمة العملاء قبل 24 ساعة على الأقل.', '2025-12-20 04:09:35', '2025-12-20 04:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `image`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'uploads/website-images/dummy/featur-1.webp', 'fab fa-quinscape', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(2, 'uploads/website-images/dummy/featur-2.webp', 'fas fa-smile', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(3, 'uploads/website-images/dummy/featur-3.webp', 'fas fa-chess-queen', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34');

-- --------------------------------------------------------

--
-- Table structure for table `feature_translations`
--

CREATE TABLE `feature_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feature_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feature_translations`
--

INSERT INTO `feature_translations` (`id`, `feature_id`, `lang_code`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Expert Legal Counsel', 'Our experienced Syrian lawyers provide expert legal guidance in all areas of law.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(2, 1, 'ar', 'استشارة قانونية متخصصة', 'يقدم محامونا السوريون ذوو الخبرة إرشادات قانونية متخصصة في جميع مجالات القانون.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(3, 2, 'en', 'Client Rights Protection', 'We are committed to protecting your legal rights throughout the entire legal process.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(4, 2, 'ar', 'حماية حقوق الموكلين', 'نلتزم بحماية حقوقك القانونية طوال العملية القانونية بأكملها.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(5, 3, 'en', 'Professional Representation', 'Professional legal representation in Syrian courts with proven track record of success.', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(6, 3, 'ar', 'تمثيل قانوني احترافي', 'تمثيل قانوني احترافي في المحاكم السورية مع سجل حافل بالنجاحات.', '2025-12-20 04:09:35', '2025-12-20 04:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `direction` varchar(255) NOT NULL DEFAULT 'ltr',
  `status` varchar(255) NOT NULL DEFAULT '1',
  `is_default` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `direction`, `status`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 'ltr', '1', '1', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(2, 'Arabic', 'ar', 'rtl', '1', '0', '2025-12-20 04:09:28', '2025-12-20 04:09:28');

-- --------------------------------------------------------

--
-- Table structure for table `lawyers`
--

CREATE TABLE `lawyers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `years_of_experience` varchar(255) DEFAULT NULL,
  `fee` decimal(8,2) NOT NULL DEFAULT 0.00,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `show_homepage` tinyint(1) NOT NULL DEFAULT 1,
  `forget_password_token` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `email_verified_token` varchar(255) DEFAULT NULL,
  `wallet_balance` decimal(8,2) NOT NULL DEFAULT 0.00,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lawyers`
--

INSERT INTO `lawyers` (`id`, `department_id`, `location_id`, `name`, `slug`, `email`, `password`, `phone`, `years_of_experience`, `fee`, `image`, `status`, `show_homepage`, `forget_password_token`, `email_verified_at`, `email_verified_token`, `wallet_balance`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'James Anderson', 'james-anderson', 'ahmad.hassan@syrianlaw.com', '$2y$12$8Ydv8iHQCsFejbelw47uz.Pru/fDfpzjOfaejVwL9Xsen.TeBSBHe', '+1 (628) 734-0740', '5', 79.00, 'uploads/website-images/dummy/lawyer-1.webp', 1, 1, NULL, '2025-12-20 04:09:36', NULL, 10.00, NULL, '2025-12-20 04:09:36', '2026-01-04 20:20:00'),
(2, 2, 1, 'Sarah Mitchell', 'sarah-mitchell', 'fatima.sayed@syrianlaw.com', '$2y$12$Gh9bCzOJ0Ym09Y2tCxtEpucNy6eCXvf6Q1p5dXiPcYCri1qgJDzCm', '+1.520.965.0548', '5', 198.00, 'uploads/website-images/dummy/lawyer-2.webp', 1, 1, NULL, '2025-12-20 04:09:37', NULL, 420.00, NULL, '2025-12-20 04:09:37', '2026-01-04 20:20:00'),
(3, 3, 1, 'Robert Thompson', 'robert-thompson', 'mohammad.khatib@syrianlaw.com', '$2y$12$Tk69rOyFR5ZMKQ52HKxlMeLep7KAb4HNZWTS9zsOed/apYXQQMwie', '318.794.7382', '4', 163.00, 'uploads/website-images/dummy/lawyer-3.webp', 1, 1, NULL, '2025-12-20 04:09:37', NULL, 10.00, NULL, '2025-12-20 04:09:37', '2026-01-04 20:20:00'),
(4, 4, 1, 'Miguel Silva', 'miguel-silva', 'silva@gmail.com', '$2y$12$VWeIAWN1y0GcVUp8uFWw0OMRkMKEnaVwKgHfPqB3NvyiYcwYx8ZRu', '(445) 368-0990', '4', 75.00, 'uploads/website-images/dummy/lawyer-4.webp', 1, 1, NULL, '2025-12-20 04:09:38', NULL, 0.00, NULL, '2025-12-20 04:09:38', '2025-12-20 04:09:38'),
(5, 1, 2, 'John M Brown', 'john-m-brown', 'john@gmail.com', '$2y$12$7XFl7B9K3HaKriHIvaH3GO6frQTSKclwybRR2iWXLjxQZubUCLyKa', '+1-662-945-2524', '3', 132.00, 'uploads/website-images/dummy/lawyer-5.webp', 1, 1, NULL, '2025-12-20 04:09:38', NULL, 0.00, NULL, '2025-12-20 04:09:38', '2025-12-20 04:09:38'),
(6, 6, 2, 'Nicholas Fox', 'nicholas-fox', 'nicholas@gmail.com', '$2y$12$ZjFLPSlLk.1L/tGfVTay0uM3XD9KeUODR5N5ueLrkPPgc2O8HfdW6', '+1-315-331-5392', '4', 85.00, 'uploads/website-images/dummy/lawyer-6.webp', 1, 1, NULL, '2025-12-20 04:09:38', NULL, 0.00, NULL, '2025-12-20 04:09:38', '2025-12-20 13:50:29'),
(7, 4, 3, 'Sarah Adams', 'sarah-adams', 'sarah@gmail.com', '$2y$12$ywn90/PXLpEUlTCC17db7uqfNSC3J3/2UjCx/UNubx4vHNRIZRDH6', '(760) 819-7375', '1', 48.00, 'uploads/website-images/dummy/lawyer-7.webp', 1, 1, NULL, '2025-12-20 04:09:39', NULL, 0.00, NULL, '2025-12-20 04:09:39', '2025-12-20 04:09:39'),
(8, 3, 3, 'Emily Johnson', 'emily-johnson', 'emily@gmail.com', '$2y$12$VfSaouyG44fafWu74sf0k.PX9OtckxmjT23JGU28foeHv8akcPWX6', '+1-737-475-8678', '2', 34.00, 'uploads/website-images/dummy/lawyer-8.webp', 1, 1, NULL, '2025-12-20 04:09:39', NULL, 0.00, NULL, '2025-12-20 04:09:39', '2025-12-20 04:09:39'),
(9, 2, 4, 'William Green', 'william-green', 'william@gmail.com', '$2y$12$cv2SUAuDymjnNU0lw.zse.bnT437mjKtQqRiTlzzyXploeNyJwYuy', '815.360.5876', '3', 101.00, 'uploads/website-images/dummy/lawyer-9.webp', 1, 1, NULL, '2025-12-20 04:09:39', NULL, 0.00, NULL, '2025-12-20 04:09:39', '2025-12-20 04:09:39'),
(10, 5, 4, 'Jessica Roberts', 'jessica-roberts', 'jessica@gmail.com', '$2y$12$64jy0QJi3Z01cLTl0STJTuC77hWy/oG3B6ONwU/7ug/3BFgkLn8Ra', '1-641-812-7443', '5', 195.00, 'uploads/website-images/dummy/lawyer-10.webp', 1, 1, NULL, '2025-12-20 04:09:40', NULL, 0.00, NULL, '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(12, 1, 1, 'Jennifer White', 'jennifer-white', 'lawyer@test.com', '$2y$12$Taim.CPgStBpBdGG2VpB1.M5PA.Hdcnw7dP7mTbFGqpW6cMOl5c7W', '+963-11-999-8888', '10', 5000.00, NULL, 0, 1, NULL, '2025-12-28 11:46:14', NULL, 0.00, NULL, '2025-12-28 11:46:14', '2026-01-04 20:20:22');

-- --------------------------------------------------------

--
-- Table structure for table `lawyer_social_media`
--

CREATE TABLE `lawyer_social_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lawyer_id` bigint(20) UNSIGNED NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lawyer_social_media`
--

INSERT INTO `lawyer_social_media` (`id`, `lawyer_id`, `link`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'https://www.facebook.com', 'fab fa-facebook-f', 1, NULL, NULL),
(2, 1, 'https://www.twitter.com', 'fab fa-twitter', 1, NULL, NULL),
(3, 1, 'https://www.linkedin.com', 'fab fa-linkedin-in', 1, NULL, NULL),
(4, 1, 'https://www.instagram.com', 'fab fa-instagram', 1, NULL, NULL),
(5, 1, 'https://www.yourwebsite.com', 'fas fa-globe', 1, NULL, NULL),
(6, 2, 'https://www.facebook.com', 'fab fa-facebook-f', 1, NULL, NULL),
(7, 2, 'https://www.twitter.com', 'fab fa-twitter', 1, NULL, NULL),
(8, 2, 'https://www.linkedin.com', 'fab fa-linkedin-in', 1, NULL, NULL),
(9, 2, 'https://www.instagram.com', 'fab fa-instagram', 1, NULL, NULL),
(10, 2, 'https://www.yourwebsite.com', 'fas fa-globe', 1, NULL, NULL),
(11, 3, 'https://www.facebook.com', 'fab fa-facebook-f', 1, NULL, NULL),
(12, 3, 'https://www.twitter.com', 'fab fa-twitter', 1, NULL, NULL),
(13, 3, 'https://www.linkedin.com', 'fab fa-linkedin-in', 1, NULL, NULL),
(14, 3, 'https://www.instagram.com', 'fab fa-instagram', 1, NULL, NULL),
(15, 3, 'https://www.yourwebsite.com', 'fas fa-globe', 1, NULL, NULL),
(16, 4, 'https://www.facebook.com', 'fab fa-facebook-f', 1, NULL, NULL),
(17, 4, 'https://www.twitter.com', 'fab fa-twitter', 1, NULL, NULL),
(18, 4, 'https://www.linkedin.com', 'fab fa-linkedin-in', 1, NULL, NULL),
(19, 4, 'https://www.instagram.com', 'fab fa-instagram', 1, NULL, NULL),
(20, 4, 'https://www.yourwebsite.com', 'fas fa-globe', 1, NULL, NULL),
(21, 5, 'https://www.facebook.com', 'fab fa-facebook-f', 1, NULL, NULL),
(22, 5, 'https://www.twitter.com', 'fab fa-twitter', 1, NULL, NULL),
(23, 5, 'https://www.linkedin.com', 'fab fa-linkedin-in', 1, NULL, NULL),
(24, 5, 'https://www.instagram.com', 'fab fa-instagram', 1, NULL, NULL),
(25, 5, 'https://www.yourwebsite.com', 'fas fa-globe', 1, NULL, NULL),
(26, 6, 'https://www.facebook.com', 'fab fa-facebook-f', 1, NULL, NULL),
(27, 6, 'https://www.twitter.com', 'fab fa-twitter', 1, NULL, NULL),
(28, 6, 'https://www.linkedin.com', 'fab fa-linkedin-in', 1, NULL, NULL),
(29, 6, 'https://www.instagram.com', 'fab fa-instagram', 1, NULL, NULL),
(30, 6, 'https://www.yourwebsite.com', 'fas fa-globe', 1, NULL, NULL),
(31, 7, 'https://www.facebook.com', 'fab fa-facebook-f', 1, NULL, NULL),
(32, 7, 'https://www.twitter.com', 'fab fa-twitter', 1, NULL, NULL),
(33, 7, 'https://www.linkedin.com', 'fab fa-linkedin-in', 1, NULL, NULL),
(34, 7, 'https://www.instagram.com', 'fab fa-instagram', 1, NULL, NULL),
(35, 7, 'https://www.yourwebsite.com', 'fas fa-globe', 1, NULL, NULL),
(36, 8, 'https://www.facebook.com', 'fab fa-facebook-f', 1, NULL, NULL),
(37, 8, 'https://www.twitter.com', 'fab fa-twitter', 1, NULL, NULL),
(38, 8, 'https://www.linkedin.com', 'fab fa-linkedin-in', 1, NULL, NULL),
(39, 8, 'https://www.instagram.com', 'fab fa-instagram', 1, NULL, NULL),
(40, 8, 'https://www.yourwebsite.com', 'fas fa-globe', 1, NULL, NULL),
(41, 9, 'https://www.facebook.com', 'fab fa-facebook-f', 1, NULL, NULL),
(42, 9, 'https://www.twitter.com', 'fab fa-twitter', 1, NULL, NULL),
(43, 9, 'https://www.linkedin.com', 'fab fa-linkedin-in', 1, NULL, NULL),
(44, 9, 'https://www.instagram.com', 'fab fa-instagram', 1, NULL, NULL),
(45, 9, 'https://www.yourwebsite.com', 'fas fa-globe', 1, NULL, NULL),
(46, 10, 'https://www.facebook.com', 'fab fa-facebook-f', 1, NULL, NULL),
(47, 10, 'https://www.twitter.com', 'fab fa-twitter', 1, NULL, NULL),
(48, 10, 'https://www.linkedin.com', 'fab fa-linkedin-in', 1, NULL, NULL),
(49, 10, 'https://www.instagram.com', 'fab fa-instagram', 1, NULL, NULL),
(50, 10, 'https://www.yourwebsite.com', 'fas fa-globe', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lawyer_translations`
--

CREATE TABLE `lawyer_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lawyer_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `designations` varchar(255) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `educations` longtext DEFAULT NULL,
  `experience` longtext DEFAULT NULL,
  `qualifications` longtext DEFAULT NULL,
  `seo_title` text DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lawyer_translations`
--

INSERT INTO `lawyer_translations` (`id`, `lawyer_id`, `lang_code`, `designations`, `about`, `address`, `educations`, `experience`, `qualifications`, `seo_title`, `seo_description`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Civil and Commercial Law', 'المحامي أحمد الحسن متخصص في القانون المدني والتجاري السوري مع خبرة واسعة في القضايا المدنية والعقود التجارية.', 'شارع المحاكم، دمشق، سوريا', '<ul><li>إجازة في الحقوق - جامعة دمشق (2006)</li><li>دبلوم دراسات عليا في القانون المدني - جامعة دمشق (2011)</li><li>عضو نقابة المحامين السورية (2007)</li></ul>', '<ul><li>محامي متدرب - مكتب الأستاذ محمد العلي (2006-2011)</li><li>محامي أول - مكتب الحسن للمحاماة، دمشق (2011-حتى الآن)</li></ul>', '<ul><li>متخصص في القانون المدني والتجاري السوري</li><li>عضو نقابة المحامين السورية</li><li>خبرة في المرافعات أمام محاكم الاستئناف</li></ul>', 'Tommy Shank', 'Tommy Shank', '2025-12-20 04:09:37', '2025-12-20 04:09:37'),
(2, 1, 'ar', 'القانون المدني والتجاري', 'المحامي أحمد الحسن متخصص في القانون المدني والتجاري السوري مع خبرة واسعة في القضايا المدنية والعقود التجارية.', 'شارع المحاكم، دمشق، سوريا', '<ul><li>إجازة في الحقوق - جامعة دمشق (2006)</li><li>دبلوم دراسات عليا في القانون المدني - جامعة دمشق (2011)</li><li>عضو نقابة المحامين السورية (2007)</li></ul>', '<ul><li>محامي متدرب - مكتب الأستاذ محمد العلي (2006-2011)</li><li>محامي أول - مكتب الحسن للمحاماة، دمشق (2011-حتى الآن)</li></ul>', '<ul><li>متخصص في القانون المدني والتجاري السوري</li><li>عضو نقابة المحامين السورية</li><li>خبرة في المرافعات أمام محاكم الاستئناف</li></ul>', 'James Anderson', 'تومي شانك', '2025-12-20 04:09:37', '2026-01-04 20:20:00'),
(3, 2, 'en', 'Family and Personal Status Law', 'المحامية فاطمة السيد محامية متخصصة في قانون الأحوال الشخصية والأسرة السوري.', 'شارع بغداد، دمشق، سوريا', '<ul><li>إجازة في الحقوق - جامعة دمشق (2004)</li><li>دبلوم دراسات عليا في قانون الأحوال الشخصية - جامعة دمشق (2009)</li><li>عضو نقابة المحامين السورية (2005)</li></ul>', '<ul><li>محامي متدرب - مكتب الأستاذة ليلى الأحمد (2004-2009)</li><li>شريك - مكتب السيد للاستشارات القانونية (2009-حتى الآن)</li></ul>', '<ul><li>متخصصة في قانون الأحوال الشخصية السوري</li><li>عضو نقابة المحامين السورية</li><li>خبيرة في قضايا الأسرة والميراث</li></ul>', 'Aaron Bemis', 'Aaron Bemis', '2025-12-20 04:09:37', '2025-12-20 04:09:37'),
(4, 2, 'ar', 'قانون الأحوال الشخصية والأسرة', 'المحامية فاطمة السيد محامية متخصصة في قانون الأحوال الشخصية والأسرة السوري.', 'شارع بغداد، دمشق، سوريا', '<ul><li>إجازة في الحقوق - جامعة دمشق (2004)</li><li>دبلوم دراسات عليا في قانون الأحوال الشخصية - جامعة دمشق (2009)</li><li>عضو نقابة المحامين السورية (2005)</li></ul>', '<ul><li>محامي متدرب - مكتب الأستاذة ليلى الأحمد (2004-2009)</li><li>شريك - مكتب السيد للاستشارات القانونية (2009-حتى الآن)</li></ul>', '<ul><li>متخصصة في قانون الأحوال الشخصية السوري</li><li>عضو نقابة المحامين السورية</li><li>خبيرة في قضايا الأسرة والميراث</li></ul>', 'Sarah Mitchell', 'آرون بيميس', '2025-12-20 04:09:37', '2026-01-04 20:20:00'),
(5, 3, 'en', 'Criminal Law', 'المحامي محمد الخطيب محامي جنائي متمرس متخصص في الدفاع عن المتهمين في القضايا الجزائية.', 'ساحة العباسيين، دمشق، سوريا', '<ul><li>إجازة في الحقوق - جامعة حلب (2005)</li><li>دبلوم دراسات عليا في القانون الجنائي - جامعة دمشق (2010)</li><li>عضو نقابة المحامين السورية (2006)</li></ul>', '<ul><li>محامي متدرب - المحاكم الجنائية (2005-2010)</li><li>محامي أول - مكتب الخطيب للمحاماة (2010-حتى الآن)</li></ul>', '<ul><li>متخصص في القانون الجنائي السوري</li><li>عضو نقابة المحامين السورية</li><li>خبرة واسعة في المحاكمات الجنائية</li></ul>', 'Jesse Moran', 'Jesse Moran', '2025-12-20 04:09:37', '2025-12-20 04:09:37'),
(6, 3, 'ar', 'القانون الجنائي', 'المحامي محمد الخطيب محامي جنائي متمرس متخصص في الدفاع عن المتهمين في القضايا الجزائية.', 'ساحة العباسيين، دمشق، سوريا', '<ul><li>إجازة في الحقوق - جامعة حلب (2005)</li><li>دبلوم دراسات عليا في القانون الجنائي - جامعة دمشق (2010)</li><li>عضو نقابة المحامين السورية (2006)</li></ul>', '<ul><li>محامي متدرب - المحاكم الجنائية (2005-2010)</li><li>محامي أول - مكتب الخطيب للمحاماة (2010-حتى الآن)</li></ul>', '<ul><li>متخصص في القانون الجنائي السوري</li><li>عضو نقابة المحامين السورية</li><li>خبرة واسعة في المحاكمات الجنائية</li></ul>', 'Robert Thompson', 'جيسي موران', '2025-12-20 04:09:38', '2026-01-04 20:20:00'),
(7, 4, 'en', 'Business Law', 'Miguel Silva is a compassionate family law attorney with a special interest in child custody, divorce, and adoption cases. He is skilled in negotiating and litigating a wide range of family law matters, with a focus on amicable resolutions and child welfare.', '123 Family Law Lane, New York, NY, 10001, USA', '\n                    <ul>\n                        <li>JD - New York University School of Law (2007)</li>\n                        <li>LLM (Family Law) - Fordham University School of Law (2012)</li>\n                        <li>Bar Admission - New York State Bar Association (2008)</li>\n                    </ul>', '\n                    <ul>\n                        <li>Family Law Associate - Greenberg Traurig (2007-2012)</li>\n                        <li>Partner - Silva Family Law Practice (2012-Present)</li>\n                    </ul>', '\n                    <ul>\n                        <li>Certified Family Law Specialist</li>\n                        <li>Member of the American Academy of Matrimonial Lawyers</li>\n                        <li>Court-Approved Family Mediator</li>\n                    </ul>', 'Miguel Silva', 'Miguel Silva', '2025-12-20 04:09:38', '2025-12-20 04:09:38'),
(8, 4, 'ar', 'Business Law', 'Miguel Silva is a compassionate family law attorney with a special interest in child custody, divorce, and adoption cases. He is skilled in negotiating and litigating a wide range of family law matters, with a focus on amicable resolutions and child welfare.', '123 Family Law Lane, New York, NY, 10001, USA', '\n                    <ul>\n                        <li>JD - New York University School of Law (2007)</li>\n                        <li>LLM (Family Law) - Fordham University School of Law (2012)</li>\n                        <li>Bar Admission - New York State Bar Association (2008)</li>\n                    </ul>', '\n                    <ul>\n                        <li>Family Law Associate - Greenberg Traurig (2007-2012)</li>\n                        <li>Partner - Silva Family Law Practice (2012-Present)</li>\n                    </ul>', '\n                    <ul>\n                        <li>Certified Family Law Specialist</li>\n                        <li>Member of the American Academy of Matrimonial Lawyers</li>\n                        <li>Court-Approved Family Mediator</li>\n                    </ul>', 'ميغيل سيلفا', 'ميغيل سيلفا', '2025-12-20 04:09:38', '2025-12-20 04:09:38'),
(9, 5, 'en', 'Bachelor of Laws', 'John M Brown is a distinguished personal injury attorney with expertise in handling cases related to auto accidents, workplace injuries, and medical malpractice. His extensive experience in the field allows him to offer personalized legal representation to his clients seeking compensation.', '101 Injury Claims Drive, Chicago, IL, 60601, USA', '\n                    <ul>\n                        <li>JD - University of Chicago Law School (2004)</li>\n                        <li>LLM (Trial Advocacy) - Northwestern University School of Law (2009)</li>\n                        <li>Bar Admission - Illinois State Bar Association (2005)</li>\n                    </ul>', '\n                    <ul>\n                        <li>Associate Attorney - Morgan & Morgan (2004-2009)</li>\n                        <li>Senior Partner - Brown Injury Law Group (2009-Present)</li>\n                    </ul>', '\n                    <ul>\n                        <li>Certified Civil Trial Specialist</li>\n                        <li>Member of the American Association for Justice</li>\n                        <li>Board Certified in Personal Injury Law</li>\n                    </ul>', 'John M Brown', 'John M Brown', '2025-12-20 04:09:38', '2025-12-20 04:09:38'),
(10, 5, 'ar', 'Bachelor of Laws', 'John M Brown is a distinguished personal injury attorney with expertise in handling cases related to auto accidents, workplace injuries, and medical malpractice. His extensive experience in the field allows him to offer personalized legal representation to his clients seeking compensation.', '101 Injury Claims Drive, Chicago, IL, 60601, USA', '\n                    <ul>\n                        <li>JD - University of Chicago Law School (2004)</li>\n                        <li>LLM (Trial Advocacy) - Northwestern University School of Law (2009)</li>\n                        <li>Bar Admission - Illinois State Bar Association (2005)</li>\n                    </ul>', '\n                    <ul>\n                        <li>Associate Attorney - Morgan & Morgan (2004-2009)</li>\n                        <li>Senior Partner - Brown Injury Law Group (2009-Present)</li>\n                    </ul>', '\n                    <ul>\n                        <li>Certified Civil Trial Specialist</li>\n                        <li>Member of the American Association for Justice</li>\n                        <li>Board Certified in Personal Injury Law</li>\n                    </ul>', 'جون إم براون', 'جون إم براون', '2025-12-20 04:09:38', '2025-12-20 04:09:38'),
(11, 6, 'en', 'JD, LLM', 'Nicholas Fox is a highly skilled real estate attorney with years of experience in property transactions, leasing, and land use regulations. He specializes in commercial real estate deals, property disputes, and title issues, providing comprehensive legal services to his clients.', '<p>456 Real Estate Street, Chicago, IL, 60611, USA</p>', '<ul>\r\n<li>JD - University of Chicago Law School (2005)</li>\r\n<li>LLM (Real Estate Law) - John Marshall Law School (2010)</li>\r\n<li>Bar Admission - Illinois State Bar Association (2006)</li>\r\n</ul>', '<ul>\r\n<li>Real Estate Associate - Kirkland &amp; Ellis LLP (2005-2010)</li>\r\n<li>Partner - Fox Real Estate Law Group (2010-Present)</li>\r\n</ul>', '<ul>\r\n<li>Certified Real Estate Law Specialist</li>\r\n<li>Member of the American Land Title Association</li>\r\n<li>Licensed Real Estate Broker</li>\r\n</ul>', 'Nicholas Fox', 'Nicholas Fox', '2025-12-20 04:09:39', '2025-12-20 13:50:29'),
(12, 6, 'ar', 'JD, LLM', 'Nicholas Fox is a highly skilled real estate attorney with years of experience in property transactions, leasing, and land use regulations. He specializes in commercial real estate deals, property disputes, and title issues, providing comprehensive legal services to his clients.', '456 Real Estate Street, Chicago, IL, 60611, USA', '\n                    <ul>\n                        <li>JD - University of Chicago Law School (2005)</li>\n                        <li>LLM (Real Estate Law) - John Marshall Law School (2010)</li>\n                        <li>Bar Admission - Illinois State Bar Association (2006)</li>\n                    </ul>', '\n                    <ul>\n                        <li>Real Estate Associate - Kirkland & Ellis LLP (2005-2010)</li>\n                        <li>Partner - Fox Real Estate Law Group (2010-Present)</li>\n                    </ul>', '\n                    <ul>\n                        <li>Certified Real Estate Law Specialist</li>\n                        <li>Member of the American Land Title Association</li>\n                        <li>Licensed Real Estate Broker</li>\n                    </ul>', 'نيكولاس فوكس', 'نيكولاس فوكس', '2025-12-20 04:09:39', '2025-12-20 04:09:39'),
(13, 7, 'en', 'QC / KC', 'Sarah Adams is a dedicated family law attorney specializing in divorce, child custody, and adoption cases. She focuses on collaborative divorce solutions, child support arrangements, and ensuring the best interests of children, providing personalized and comprehensive legal support to families.', '789 Family Court Avenue, Boston, MA, 02115, USA', '\n                    <ul>\n                        <li>JD - Harvard Law School (2008)</li>\n                        <li>LLM (Family Law) - Boston University School of Law (2013)</li>\n                        <li>Bar Admission - Massachusetts State Bar Association (2009)</li>\n                    </ul>', '\n                    <ul>\n                        <li>Family Law Associate - Mintz Levin (2008-2013)</li>\n                        <li>Partner - Adams Family Law (2013-Present)</li>\n                    </ul>', '\n                    <ul>\n                        <li>Certified Family Law Specialist</li>\n                        <li>Member of the American Academy of Matrimonial Lawyers</li>\n                        <li>Certified Divorce Mediator</li>\n                    </ul>', 'Sarah Adams', 'Sarah Adams', '2025-12-20 04:09:39', '2025-12-20 04:09:39'),
(14, 7, 'ar', 'QC / KC', 'Sarah Adams is a dedicated family law attorney specializing in divorce, child custody, and adoption cases. She focuses on collaborative divorce solutions, child support arrangements, and ensuring the best interests of children, providing personalized and comprehensive legal support to families.', '789 Family Court Avenue, Boston, MA, 02115, USA', '\n                    <ul>\n                        <li>JD - Harvard Law School (2008)</li>\n                        <li>LLM (Family Law) - Boston University School of Law (2013)</li>\n                        <li>Bar Admission - Massachusetts State Bar Association (2009)</li>\n                    </ul>', '\n                    <ul>\n                        <li>Family Law Associate - Mintz Levin (2008-2013)</li>\n                        <li>Partner - Adams Family Law (2013-Present)</li>\n                    </ul>', '\n                    <ul>\n                        <li>Certified Family Law Specialist</li>\n                        <li>Member of the American Academy of Matrimonial Lawyers</li>\n                        <li>Certified Divorce Mediator</li>\n                    </ul>', 'سارة آدامز', 'سارة آدامز', '2025-12-20 04:09:39', '2025-12-20 04:09:39'),
(15, 8, 'en', 'Master of Laws', 'Emily Johnson is a renowned intellectual property attorney with a focus on patent litigation and trademark protection. Her dedication to safeguarding creative works and innovations has made her a leader in the IP law field.', '321 Innovation Avenue, Boston, MA, 02108, USA', '\n                    <ul>\n                        <li>JD - Harvard Law School (2003)</li>\n                        <li>LLM (Intellectual Property) - Boston College Law School (2008)</li>\n                        <li>Bar Admission - Massachusetts State Bar Association (2004)</li>\n                    </ul>', '\n                    <ul>\n                        <li>IP Associate - Fish & Richardson P.C. (2003-2008)</li>\n                        <li>Senior IP Partner - Johnson IP Law Group (2008-Present)</li>\n                    </ul>', '\n                    <ul>\n                        <li>Registered Patent Attorney - USPTO</li>\n                        <li>Member of the International Trademark Association</li>\n                        <li>Certified Copyright Specialist</li>\n                    </ul>', 'Emily Johnson', 'Emily Johnson', '2025-12-20 04:09:39', '2025-12-20 04:09:39'),
(16, 8, 'ar', 'Master of Laws', 'Emily Johnson is a renowned intellectual property attorney with a focus on patent litigation and trademark protection. Her dedication to safeguarding creative works and innovations has made her a leader in the IP law field.', '321 Innovation Avenue, Boston, MA, 02108, USA', '\n                    <ul>\n                        <li>JD - Harvard Law School (2003)</li>\n                        <li>LLM (Intellectual Property) - Boston College Law School (2008)</li>\n                        <li>Bar Admission - Massachusetts State Bar Association (2004)</li>\n                    </ul>', '\n                    <ul>\n                        <li>IP Associate - Fish & Richardson P.C. (2003-2008)</li>\n                        <li>Senior IP Partner - Johnson IP Law Group (2008-Present)</li>\n                    </ul>', '\n                    <ul>\n                        <li>Registered Patent Attorney - USPTO</li>\n                        <li>Member of the International Trademark Association</li>\n                        <li>Certified Copyright Specialist</li>\n                    </ul>', 'إميلي جونسون', 'إميلي جونسون', '2025-12-20 04:09:39', '2025-12-20 04:09:39'),
(17, 9, 'en', 'Business Law', 'William Green is a leading corporate attorney with a passion for business law. He specializes in mergers and acquisitions, securities regulations, and corporate governance, offering comprehensive legal strategies to ensure long-term business success for his clients.', '789 Corporate Avenue, Los Angeles, CA, 90001, USA', '\n                    <ul>\n                        <li>JD - UCLA School of Law (2007)</li>\n                        <li>LLM (Business Law) - USC Gould School of Law (2012)</li>\n                        <li>Bar Admission - California State Bar Association (2008)</li>\n                    </ul>', '\n                    <ul>\n                        <li>Corporate Associate - Gibson Dunn (2007-2012)</li>\n                        <li>Partner - Green Corporate Law Group (2012-Present)</li>\n                    </ul>', '\n                    <ul>\n                        <li>Certified Business Law Specialist</li>\n                        <li>Member of the American Bar Association - Business Law Section</li>\n                        <li>Licensed Securities Attorney</li>\n                    </ul>', 'William Green', 'William Green', '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(18, 9, 'ar', 'Business Law', 'William Green is a leading corporate attorney with a passion for business law. He specializes in mergers and acquisitions, securities regulations, and corporate governance, offering comprehensive legal strategies to ensure long-term business success for his clients.', '789 Corporate Avenue, Los Angeles, CA, 90001, USA', '\n                    <ul>\n                        <li>JD - UCLA School of Law (2007)</li>\n                        <li>LLM (Business Law) - USC Gould School of Law (2012)</li>\n                        <li>Bar Admission - California State Bar Association (2008)</li>\n                    </ul>', '\n                    <ul>\n                        <li>Corporate Associate - Gibson Dunn (2007-2012)</li>\n                        <li>Partner - Green Corporate Law Group (2012-Present)</li>\n                    </ul>', '\n                    <ul>\n                        <li>Certified Business Law Specialist</li>\n                        <li>Member of the American Bar Association - Business Law Section</li>\n                        <li>Licensed Securities Attorney</li>\n                    </ul>', 'ويليام غرين', 'ويليام غرين', '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(19, 10, 'en', 'JD, LLM', 'Jessica Roberts is a skilled immigration attorney specializing in visa applications, deportation defense, and citizenship processes. She has a wealth of experience in navigating complex immigration laws to assist clients in achieving their immigration goals and securing their future in the United States.', '789 Immigration Blvd, Los Angeles, CA, 90001, USA', '\n                    <ul>\n                        <li>JD - UCLA School of Law (2006)</li>\n                        <li>LLM (Immigration Law) - Loyola Law School (2011)</li>\n                        <li>Bar Admission - California State Bar Association (2007)</li>\n                    </ul>', '\n                    <ul>\n                        <li>Immigration Associate - Fragomen (2006-2011)</li>\n                        <li>Partner - Roberts Immigration Law Firm (2011-Present)</li>\n                    </ul>', '\n                    <ul>\n                        <li>Certified Immigration Law Specialist</li>\n                        <li>Member of the American Immigration Lawyers Association</li>\n                        <li>Board Certified in Immigration and Nationality Law</li>\n                    </ul>', 'Jessica Roberts', 'Jessica Roberts', '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(20, 10, 'ar', 'JD, LLM', 'Jessica Roberts is a skilled immigration attorney specializing in visa applications, deportation defense, and citizenship processes. She has a wealth of experience in navigating complex immigration laws to assist clients in achieving their immigration goals and securing their future in the United States.', '789 Immigration Blvd, Los Angeles, CA, 90001, USA', '\n                    <ul>\n                        <li>JD - UCLA School of Law (2006)</li>\n                        <li>LLM (Immigration Law) - Loyola Law School (2011)</li>\n                        <li>Bar Admission - California State Bar Association (2007)</li>\n                    </ul>', '\n                    <ul>\n                        <li>Immigration Associate - Fragomen (2006-2011)</li>\n                        <li>Partner - Roberts Immigration Law Firm (2011-Present)</li>\n                    </ul>', '\n                    <ul>\n                        <li>Certified Immigration Law Specialist</li>\n                        <li>Member of the American Immigration Lawyers Association</li>\n                        <li>Board Certified in Immigration and Nationality Law</li>\n                    </ul>', 'جيسيكا روبرتس', 'جيسيكا روبرتس', '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(21, 12, 'en', 'Syrian Law Expert', 'Experienced Syrian lawyer specializing in civil and commercial law.', 'Damascus, Syria', '<ul><li>Law Degree - Damascus University</li></ul>', '<ul><li>Senior Lawyer - 10 years experience</li></ul>', '<ul><li>Member of Syrian Bar Association</li></ul>', 'Omar Syrian - Test Lawyer', 'Test Lawyer Account', NULL, NULL),
(22, 12, 'ar', 'خبير قانوني سوري', 'محامي سوري متمرس متخصص في القانون المدني والتجاري.', 'دمشق، سوريا', '<ul><li>إجازة في الحقوق - جامعة دمشق</li></ul>', '<ul><li>محامي أول - 10 سنوات خبرة</li></ul>', '<ul><li>عضو نقابة المحامين السورية</li></ul>', 'Jennifer White', 'حساب محامي تجريبي', NULL, '2026-01-04 20:20:22');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lawyer_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `lawyer_id`, `date`, `reason`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-07-21', 'Vacation', 1, '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(2, 2, '2021-10-29', 'Personal Leave', 1, '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(3, 1, '2023-11-07', 'Medical Appointment', 1, '2025-12-20 04:09:40', '2025-12-20 04:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(2, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(3, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(4, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(5, 1, '2025-12-20 11:39:17', '2025-12-20 11:39:17'),
(6, 1, '2025-12-20 11:39:17', '2025-12-20 11:39:17');

-- --------------------------------------------------------

--
-- Table structure for table `location_translations`
--

CREATE TABLE `location_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `location_translations`
--

INSERT INTO `location_translations` (`id`, `location_id`, `lang_code`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Damascus', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(2, 1, 'ar', 'دمشق', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(3, 2, 'en', 'Aleppo', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(4, 2, 'ar', 'حلب', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(5, 3, 'en', 'Homs', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(6, 3, 'ar', 'حمص', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(7, 4, 'en', 'Latakia', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(8, 4, 'ar', 'اللاذقية', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(9, 5, 'en', 'Hama', NULL, NULL),
(10, 5, 'ar', 'حماة', NULL, NULL),
(11, 6, 'en', 'Tartus', NULL, NULL),
(12, 6, 'ar', 'طرطوس', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `meeting_histories`
--

CREATE TABLE `meeting_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lawyer_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `meeting_id` varchar(255) NOT NULL,
  `meeting_time` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meeting_histories`
--

INSERT INTO `meeting_histories` (`id`, `lawyer_id`, `user_id`, `meeting_id`, `meeting_time`, `duration`, `created_at`, `updated_at`) VALUES
(1, 1, 1000, '84537088774', '2024-08-30 03:00:12', '60', '2024-08-07 20:16:13', '2024-08-07 20:16:13'),
(2, 1, 1000, '88508347157', '2024-08-08 10:16:32', '15', '2024-08-07 20:17:00', '2024-08-07 20:17:00');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Main Menu', 'main-menu', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(2, 'Footer Menu One', 'footer-first-menu', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(3, 'Footer Menu two', 'footer-second-menu', '2025-12-20 04:09:33', '2025-12-20 04:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `sort` int(11) NOT NULL DEFAULT 0,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `custom_item` tinyint(1) NOT NULL DEFAULT 0,
  `open_new_tab` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `label`, `link`, `parent_id`, `sort`, `menu_id`, `custom_item`, `open_new_tab`, `created_at`, `updated_at`) VALUES
(1, 'Home', '/', 0, 1, 1, 0, 0, '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(2, 'Lawyers', '/lawyers', 0, 2, 1, 0, 0, '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(3, 'Blog', '/blog', 0, 3, 1, 0, 0, '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(4, 'About Us', '/about-us', 0, 4, 1, 0, 0, '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(5, 'Pages', '#', 0, 5, 1, 0, 0, '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(6, 'Department', '/department', 5, 1, 1, 0, 0, '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(7, 'Service', '/service', 5, 2, 1, 0, 0, '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(8, 'Testimonial', '/testimonial', 5, 3, 1, 0, 0, '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(9, 'Contact Us', '/contact-us', 0, 6, 1, 0, 0, '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(10, 'Home', '/', 0, 1, 2, 0, 0, '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(11, 'About Us', '/about-us', 0, 2, 2, 0, 0, '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(12, 'Department', '/department', 0, 3, 2, 0, 0, '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(13, 'Lawyers', '/lawyers', 0, 4, 2, 0, 0, '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(14, 'Service', '/service', 0, 5, 2, 0, 0, '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(15, 'Blog', '/blog', 0, 1, 3, 0, 0, '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(16, 'Faq', '/faq', 0, 2, 3, 0, 0, '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(17, 'Contact Us', '/contact-us', 0, 3, 3, 0, 0, '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(18, 'Privacy Policy', '/privacy-policy', 0, 4, 3, 0, 0, '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(19, 'Terms and Condition', '/terms-condition', 0, 5, 3, 0, 0, '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(20, 'Book Appointment', '/book-appointment', 5, 4, 1, 0, 0, '2026-01-04 20:04:44', '2026-01-04 20:05:11'),
(21, 'Business Subscription', '/business-subscription', 5, 5, 1, 0, 0, '2026-01-04 20:04:44', '2026-01-04 20:05:11'),
(22, 'Partnerships', '/partnerships', 5, 6, 1, 0, 0, '2026-01-04 20:04:44', '2026-01-04 20:05:11'),
(23, 'Legal Aid Check', '/legal-aid-check', 5, 7, 1, 0, 0, '2026-01-04 20:04:44', '2026-01-04 20:05:11');

-- --------------------------------------------------------

--
-- Table structure for table `menu_item_translations`
--

CREATE TABLE `menu_item_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_item_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_item_translations`
--

INSERT INTO `menu_item_translations` (`id`, `menu_item_id`, `lang_code`, `label`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Home', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(2, 1, 'ar', 'الرئيسية', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(3, 2, 'en', 'Lawyers', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(4, 2, 'ar', 'المحامون', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(5, 3, 'en', 'Blog', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(6, 3, 'ar', 'مدونة', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(7, 4, 'en', 'About Us', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(8, 4, 'ar', 'معلومات عنا', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(9, 5, 'en', 'Pages', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(10, 5, 'ar', 'الصفحات', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(11, 6, 'en', 'Department', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(12, 6, 'ar', 'قسم', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(13, 7, 'en', 'Service', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(14, 7, 'ar', 'خدمة', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(15, 8, 'en', 'Testimonial', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(16, 8, 'ar', 'شهادة', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(17, 9, 'en', 'Contact Us', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(18, 9, 'ar', 'اتصل بنا', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(19, 10, 'en', 'Home', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(20, 10, 'ar', 'الرئيسية', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(21, 11, 'en', 'About Us', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(22, 11, 'ar', 'معلومات عنا', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(23, 12, 'en', 'Department', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(24, 12, 'ar', 'قسم', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(25, 13, 'en', 'Lawyers', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(26, 13, 'ar', 'المحامون', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(27, 14, 'en', 'Service', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(28, 14, 'ar', 'خدمة', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(29, 15, 'en', 'Blog', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(30, 15, 'ar', 'مدونة', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(31, 16, 'en', 'Faq', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(32, 16, 'ar', 'التعليمات', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(33, 17, 'en', 'Contact Us', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(34, 17, 'ar', 'اتصل بنا', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(35, 18, 'en', 'Privacy Policy', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(36, 18, 'ar', 'سياسة الخصوصية', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(37, 19, 'en', 'Terms and Condition', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(38, 19, 'ar', 'أحكام وشروط', '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(39, 20, 'en', 'Book Appointment', '2026-01-04 20:04:44', '2026-01-04 20:04:44'),
(40, 20, 'ar', 'حجز موعد', '2026-01-04 20:04:44', '2026-01-04 20:04:44'),
(41, 21, 'en', 'Business Subscription', '2026-01-04 20:04:44', '2026-01-04 20:04:44'),
(42, 21, 'ar', 'اشتراك الأعمال', '2026-01-04 20:04:44', '2026-01-04 20:04:44'),
(43, 22, 'en', 'Partnerships', '2026-01-04 20:04:44', '2026-01-04 20:04:44'),
(44, 22, 'ar', 'الشراكات', '2026-01-04 20:04:44', '2026-01-04 20:04:44'),
(45, 23, 'en', 'Legal Aid Check', '2026-01-04 20:04:44', '2026-01-04 20:04:44'),
(46, 23, 'ar', 'فحص المساعدة القانونية', '2026-01-04 20:04:44', '2026-01-04 20:04:44');

-- --------------------------------------------------------

--
-- Table structure for table `menu_translations`
--

CREATE TABLE `menu_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_translations`
--

INSERT INTO `menu_translations` (`id`, `menu_id`, `lang_code`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Main Menu', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(2, 1, 'ar', 'القائمة الرئيسية', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(3, 2, 'en', 'Footer Menu One', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(4, 2, 'ar', 'قائمة التذييل 1', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(5, 3, 'en', 'Footer Menu two', '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(6, 3, 'ar', 'قائمة التذييل 2', '2025-12-20 04:09:33', '2025-12-20 04:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `conversation_id` bigint(20) UNSIGNED NOT NULL,
  `sender_type` varchar(255) NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `message` text DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `sender_type`, `sender_id`, `message`, `attachment`, `is_read`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'App\\Models\\User', 1003, 'مرحباً، أحتاج إلى استشارة قانونية بخصوص قضية عقارية.', NULL, 1, '2025-12-28 11:54:35', '2025-12-28 11:44:35', '2025-12-28 11:44:35'),
(2, 1, 'Modules\\Lawyer\\app\\Models\\Lawyer', 12, 'مرحباً بك، يسعدني مساعدتك. هل يمكنك تزويدي بتفاصيل أكثر عن القضية؟', NULL, 1, '2025-12-28 12:11:27', '2025-12-28 11:49:35', '2025-12-28 12:11:27'),
(3, 1, 'App\\Models\\User', 1003, '', 'attachments/messages/8TpzdUATEKh5LjVkJP5AqzP4wfphhGvsqZyt7bww.png', 0, NULL, '2025-12-28 12:25:35', '2025-12-28 12:25:35'),
(4, 1, 'App\\Models\\User', 1003, '', 'attachments/messages/G5hthaxVmTqjdcpRidMHqrUMcQ7x48ePj3TfCYDD.png', 0, NULL, '2025-12-28 13:10:37', '2025-12-28 13:10:37');

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_11_05_045420_create_user_details_table', 1),
(6, '2023_11_05_045432_create_admins_table', 1),
(7, '2023_11_05_114814_create_languages_table', 1),
(8, '2023_11_06_043247_create_settings_table', 1),
(9, '2023_11_06_054251_create_seo_settings_table', 1),
(10, '2023_11_06_094842_create_custom_paginations_table', 1),
(11, '2023_11_06_115856_create_email_templates_table', 1),
(12, '2023_11_07_051924_create_multi_currencies_table', 1),
(13, '2023_11_07_103108_create_basic_payments_table', 1),
(14, '2023_11_07_104315_create_blog_categories_table', 1),
(15, '2023_11_07_104328_create_blog_category_translations_table', 1),
(16, '2023_11_07_104336_create_blogs_table', 1),
(17, '2023_11_07_104343_create_blog_translations_table', 1),
(18, '2023_11_07_104546_create_blog_comments_table', 1),
(19, '2023_11_09_100621_create_jobs_table', 1),
(20, '2023_11_19_064341_create_banned_histories_table', 1),
(21, '2023_11_19_091457_create_customizeable_pages_table', 1),
(22, '2023_11_21_043030_create_news_letters_table', 1),
(23, '2023_11_21_094702_create_contact_messages_table', 1),
(24, '2023_11_22_105539_create_permission_tables', 1),
(25, '2023_11_29_055540_create_orders_table', 1),
(26, '2023_11_29_063625_create_days_table', 1),
(27, '2023_11_29_081435_create_day_translations_table', 1),
(28, '2023_11_29_104658_create_testimonials_table', 1),
(29, '2023_11_29_104704_create_testimonial_translations_table', 1),
(30, '2023_11_30_044830_create_faq_categories_table', 1),
(31, '2023_11_30_044831_create_faq_category_translations_table', 1),
(32, '2023_11_30_044838_create_faqs_table', 1),
(33, '2023_11_30_044844_create_faq_translations_table', 1),
(34, '2023_12_13_091706_create_about_us_pages_table', 1),
(35, '2023_12_13_091712_create_about_us_page_translations_table', 1),
(36, '2024_01_01_054644_create_socialite_credentials_table', 1),
(37, '2024_01_03_030857_create_customizable_page_translations_table', 1),
(38, '2024_01_03_092007_create_custom_codes_table', 1),
(39, '2024_02_10_060044_create_configurations_table', 1),
(40, '2024_03_28_095206_create_custom_addons_table', 1),
(41, '2024_03_28_095207_create_menus_wp_table', 1),
(42, '2024_03_28_095208_create_menu_translations_table', 1),
(43, '2024_03_28_095209_create_menu_items_wp_table', 1),
(44, '2024_03_28_095210_create_menu_item_translations_table', 1),
(45, '2024_05_07_042712_create_services_table', 1),
(46, '2024_05_07_042729_create_service_translations_table', 1),
(47, '2024_05_11_081007_create_work_sections_table', 1),
(48, '2024_05_11_081038_create_work_section_translations_table', 1),
(49, '2024_05_11_093117_create_work_section_faqs_table', 1),
(50, '2024_05_11_093138_create_work_section_faq_translations_table', 1),
(51, '2024_05_18_114830_create_counters_table', 1),
(52, '2024_05_18_114850_create_counter_translations_table', 1),
(53, '2024_05_26_065953_create_social_links_table', 1),
(54, '2024_06_21_034949_create_withraw_methods_table', 1),
(55, '2024_07_18_052432_create_service_images_table', 1),
(56, '2024_07_18_070257_create_service_videos_table', 1),
(57, '2024_07_18_083923_create_service_faqs_table', 1),
(58, '2024_07_18_083957_create_service_faq_translations_table', 1),
(59, '2024_07_21_005141_create_departments_table', 1),
(60, '2024_07_21_005207_create_department_translations_table', 1),
(61, '2024_07_21_015257_create_department_images_table', 1),
(62, '2024_07_21_015315_create_department_videos_table', 1),
(63, '2024_07_21_015355_create_department_faqs_table', 1),
(64, '2024_07_21_015411_create_department_faq_translations_table', 1),
(65, '2024_07_21_030306_create_locations_table', 1),
(66, '2024_07_21_030326_create_location_translations_table', 1),
(67, '2024_07_21_034912_create_lawyers_table', 1),
(68, '2024_07_21_034950_create_withdraw_requests_table', 1),
(69, '2024_07_21_035920_create_lawyer_translations_table', 1),
(70, '2024_07_23_050813_create_partners_table', 1),
(71, '2024_07_23_063217_create_sliders_table', 1),
(72, '2024_07_23_070129_create_features_table', 1),
(73, '2024_07_23_070155_create_feature_translations_table', 1),
(74, '2024_07_23_100401_create_section_controls_table', 1),
(75, '2024_07_23_100433_create_section_control_translations_table', 1),
(76, '2024_07_24_092504_create_schedules_table', 1),
(77, '2024_07_24_103743_create_appointments_table', 1),
(78, '2024_07_25_034035_create_subscriber_contents_table', 1),
(79, '2024_07_25_034049_create_subscriber_content_translations_table', 1),
(80, '2024_07_25_042600_create_contact_infos_table', 1),
(81, '2024_07_25_042625_create_contact_info_translations_table', 1),
(82, '2024_07_30_085812_create_messages_table', 1),
(83, '2024_07_30_095501_create_leaves_table', 1),
(84, '2024_08_04_105149_create_zoom_credentials_table', 1),
(85, '2024_08_04_115158_create_zoom_meetings_table', 1),
(86, '2024_08_04_120343_create_meeting_histories_table', 1),
(87, '2024_09_26_054032_create_shopping_carts_table', 1),
(88, '2024_10_08_024914_create_faq_pages_table', 1),
(89, '2024_11_26_111716_create_on_boarding_screens_table', 1),
(90, '2024_12_24_123842_create_doctor_social_media_table', 1),
(92, '2025_05_12_174057_create_documents_table', 2),
(93, '2025_12_28_133254_update_messages_table_for_new_system', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Admin', 1),
(1, 'App\\Models\\Admin', 2);

-- --------------------------------------------------------

--
-- Table structure for table `multi_currencies`
--

CREATE TABLE `multi_currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency_name` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `currency_code` varchar(255) NOT NULL,
  `currency_icon` varchar(255) NOT NULL,
  `is_default` varchar(255) NOT NULL DEFAULT 'no',
  `currency_rate` decimal(8,2) NOT NULL,
  `currency_position` varchar(255) NOT NULL DEFAULT 'before_price',
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `multi_currencies`
--

INSERT INTO `multi_currencies` (`id`, `currency_name`, `country_code`, `currency_code`, `currency_icon`, `is_default`, `currency_rate`, `currency_position`, `status`, `created_at`, `updated_at`) VALUES
(1, '$-USD', 'US', 'USD', '$', 'yes', 1.00, 'before_price', 'active', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(2, '₦-Naira', 'NG', 'NGN', '₦', 'no', 417.35, 'before_price', 'active', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(3, '₹-Rupee', 'IN', 'INR', '₹', 'no', 74.66, 'before_price', 'active', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(4, '₱-Peso', 'PH', 'PHP', '₱', 'no', 55.07, 'before_price', 'active', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(5, '$-CAD', 'CA', 'CAD', '$', 'no', 1.27, 'before_price', 'active', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(6, '৳-Taka', 'BD', 'BDT', '৳', 'no', 80.00, 'before_price', 'active', '2025-12-20 04:09:28', '2025-12-20 04:09:28');

-- --------------------------------------------------------

--
-- Table structure for table `news_letters`
--

CREATE TABLE `news_letters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'not_verified',
  `verify_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `on_boarding_screens`
--

CREATE TABLE `on_boarding_screens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sort_description` varchar(255) DEFAULT NULL,
  `order` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `on_boarding_screens`
--

INSERT INTO `on_boarding_screens` (`id`, `title`, `image`, `sort_description`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Welcome to LawMent', 'uploads/website-images/app/screen_1.png', 'Your trusted partner for effortless healthcare management', '1', 1, '2025-12-20 04:09:41', '2025-12-20 04:09:41'),
(2, 'Easy Appointment Booking', 'uploads/website-images/app/screen_2.png', 'Find lawyers and book appointments with just a few taps.', '2', 1, '2025-12-20 04:09:41', '2025-12-20 04:09:41'),
(3, 'title', 'uploads/website-images/app/screen_3.png', 'sub title', '3', 1, '2025-12-20 04:09:41', '2025-12-20 04:09:41');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `appointment_qty` int(11) NOT NULL,
  `amount_usd` double NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `total_payment` decimal(8,2) NOT NULL,
  `payment_transaction_id` varchar(255) DEFAULT NULL,
  `payment_description` text DEFAULT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT 0,
  `order_status` tinyint(1) NOT NULL DEFAULT 0,
  `show_notification` tinyint(1) NOT NULL DEFAULT 0,
  `gateway_charge` varchar(255) DEFAULT NULL,
  `payable_with_charge` varchar(255) DEFAULT NULL,
  `payable_currency` varchar(255) DEFAULT NULL,
  `paid_amount` varchar(255) NOT NULL,
  `approved_date` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_id`, `appointment_qty`, `amount_usd`, `payment_method`, `total_payment`, `payment_transaction_id`, `payment_description`, `payment_status`, `order_status`, `show_notification`, `gateway_charge`, `payable_with_charge`, `payable_currency`, `paid_amount`, `approved_date`, `created_at`, `updated_at`) VALUES
(1, 1000, '46606080', 1, 420, 'Paypal', 420.00, 'HUR3FNQ2XCB2U', '{\"payments_captures_id\":\"185193442H1060322\",\"amount\":\"420.00\",\"currency\":\"USD\",\"paid\":\"420.00\",\"paypal_fee\":\"15.15\",\"net_amount\":\"404.85\",\"status\":\"COMPLETED\"}', 1, 1, 0, '0', '420.00', 'USD', '420.00', '2025-12-20 06:09:40', '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(2, 1000, '1167789662', 1, 12, 'Bank', 960.00, 'tran_2408082735', '{\"transaction_id\":\"tran_2408082735\",\"amount\":\"960.00\",\"currency\":\"BDT\",\"payment_status\":\"VALID\",\"created\":\"2024-08-08 09:27:36\"}', 1, 1, 0, '0', '960.00', 'BDT', '960.00', '2025-12-20 06:09:40', '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(3, 1000, '1031435644', 1, 4173.5, 'Stripe', 4173.50, 'pi_3PlN3xF56Pb8BOOX0GW1ZBzZ', '{\"transaction_id\":\"pi_3PlN3xF56Pb8BOOX0GW1ZBzZ\",\"amount\":417350,\"currency\":\"NGN\",\"payment_status\":\"paid\",\"created\":1723087824}', 1, 1, 0, '0', '417350', 'NGN', '4173.5', '2025-12-20 06:09:40', '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(4, 1000, '762593755', 1, 10, 'Direct Bank', 10.00, 'GB29NWBK60161331926819', '{\"bank_name\":\"Brac Bank\",\"account_number\":\"1234567890\",\"routing_number\":\"021000021\",\"branch\":\"Dhaka\",\"transaction\":\"GB29NWBK60161331926819\"}', 0, 0, 0, '0', '10.00', 'USD', '10.00', NULL, '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(5, 1000, 'wqHloGNDjQ', 2, 273, 'bank', 273.00, NULL, NULL, 0, 0, 0, '0', '273.00', 'USD', '273', NULL, '2026-01-04 20:48:50', '2026-01-04 20:48:50'),
(6, 1000, 'q4yRfB4cjy', 2, 273, 'bank', 273.00, NULL, NULL, 0, 0, 0, '0', '273.00', 'USD', '273', NULL, '2026-01-04 20:49:58', '2026-01-04 20:49:58');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `image`, `link`, `status`, `created_at`, `updated_at`) VALUES
(1, 'uploads/website-images/dummy/partner-1.webp', 'https://websolutionus.com', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(2, 'uploads/website-images/dummy/partner-2.webp', 'https://websolutionus.com', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(3, 'uploads/website-images/dummy/partner-3.webp', 'https://websolutionus.com', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(4, 'uploads/website-images/dummy/partner-4.webp', 'https://websolutionus.com', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35');

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard.view', 'admin', 'dashboard', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(2, 'admin.profile.view', 'admin', 'admin profile', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(3, 'admin.profile.update', 'admin', 'admin profile', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(4, 'section.view', 'admin', 'section control', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(5, 'section.manage', 'admin', 'section control', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(6, 'admin.view', 'admin', 'admin', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(7, 'admin.create', 'admin', 'admin', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(8, 'admin.store', 'admin', 'admin', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(9, 'admin.edit', 'admin', 'admin', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(10, 'admin.update', 'admin', 'admin', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(11, 'admin.delete', 'admin', 'admin', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(12, 'order.management', 'admin', 'order management', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(13, 'leave.management', 'admin', 'leave management', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(14, 'zoom.meeting', 'admin', 'zoom meeting', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(15, 'withdraw.management', 'admin', 'withdraw management', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(16, 'blog.category.view', 'admin', 'blog category', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(17, 'blog.category.create', 'admin', 'blog category', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(18, 'blog.category.translate', 'admin', 'blog category', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(19, 'blog.category.store', 'admin', 'blog category', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(20, 'blog.category.edit', 'admin', 'blog category', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(21, 'blog.category.update', 'admin', 'blog category', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(22, 'blog.category.delete', 'admin', 'blog category', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(23, 'blog.view', 'admin', 'blog', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(24, 'blog.create', 'admin', 'blog', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(25, 'blog.translate', 'admin', 'blog', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(26, 'blog.store', 'admin', 'blog', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(27, 'blog.edit', 'admin', 'blog', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(28, 'blog.update', 'admin', 'blog', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(29, 'blog.delete', 'admin', 'blog', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(30, 'blog.comment.view', 'admin', 'blog comment', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(31, 'blog.comment.update', 'admin', 'blog comment', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(32, 'blog.comment.delete', 'admin', 'blog comment', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(33, 'department.view', 'admin', 'department', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(34, 'department.create', 'admin', 'department', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(35, 'department.translate', 'admin', 'department', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(36, 'department.store', 'admin', 'department', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(37, 'department.edit', 'admin', 'department', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(38, 'department.update', 'admin', 'department', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(39, 'department.delete', 'admin', 'department', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(40, 'lawyer.view', 'admin', 'lawyer', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(41, 'lawyer.create', 'admin', 'lawyer', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(42, 'lawyer.translate', 'admin', 'lawyer', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(43, 'lawyer.store', 'admin', 'lawyer', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(44, 'lawyer.edit', 'admin', 'lawyer', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(45, 'lawyer.update', 'admin', 'lawyer', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(46, 'lawyer.delete', 'admin', 'lawyer', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(47, 'location.view', 'admin', 'location', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(48, 'location.store', 'admin', 'location', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(49, 'location.update', 'admin', 'location', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(50, 'location.delete', 'admin', 'location', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(51, 'role.view', 'admin', 'role', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(52, 'role.create', 'admin', 'role', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(53, 'role.store', 'admin', 'role', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(54, 'role.assign', 'admin', 'role', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(55, 'role.edit', 'admin', 'role', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(56, 'role.update', 'admin', 'role', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(57, 'role.delete', 'admin', 'role', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(58, 'service.view', 'admin', 'service', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(59, 'service.create', 'admin', 'service', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(60, 'service.translate', 'admin', 'service', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(61, 'service.store', 'admin', 'service', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(62, 'service.edit', 'admin', 'service', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(63, 'service.update', 'admin', 'service', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(64, 'service.delete', 'admin', 'service', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(65, 'setting.view', 'admin', 'setting', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(66, 'setting.update', 'admin', 'setting', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(67, 'basic.payment.view', 'admin', 'basic payment', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(68, 'basic.payment.update', 'admin', 'basic payment', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(69, 'contact.message.view', 'admin', 'contact message', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(70, 'contact.message.delete', 'admin', 'contact message', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(71, 'contact.info.view', 'admin', 'contact message', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(72, 'contact.info.update', 'admin', 'contact message', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(73, 'currency.view', 'admin', 'currency', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(74, 'currency.create', 'admin', 'currency', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(75, 'currency.store', 'admin', 'currency', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(76, 'currency.edit', 'admin', 'currency', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(77, 'currency.update', 'admin', 'currency', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(78, 'currency.delete', 'admin', 'currency', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(79, 'client.view', 'admin', 'customer', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(80, 'client.bulk.mail', 'admin', 'customer', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(81, 'client.update', 'admin', 'customer', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(82, 'client.delete', 'admin', 'customer', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(83, 'language.view', 'admin', 'language', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(84, 'language.create', 'admin', 'language', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(85, 'language.store', 'admin', 'language', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(86, 'language.edit', 'admin', 'language', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(87, 'language.update', 'admin', 'language', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(88, 'language.delete', 'admin', 'language', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(89, 'language.translate', 'admin', 'language', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(90, 'language.single.translate', 'admin', 'language', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(91, 'menu.view', 'admin', 'menu builder', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(92, 'menu.create', 'admin', 'menu builder', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(93, 'menu.update', 'admin', 'menu builder', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(94, 'menu.delete', 'admin', 'menu builder', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(95, 'page.view', 'admin', 'page builder', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(96, 'page.create', 'admin', 'page builder', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(97, 'page.store', 'admin', 'page builder', '2025-12-20 04:09:30', '2025-12-20 04:09:30'),
(98, 'page.edit', 'admin', 'page builder', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(99, 'page.update', 'admin', 'page builder', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(100, 'page.delete', 'admin', 'page builder', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(101, 'page.aboutus.view', 'admin', 'page builder', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(102, 'page.aboutus.manage', 'admin', 'page builder', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(103, 'page.faq.view', 'admin', 'page builder', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(104, 'page.faq.manage', 'admin', 'page builder', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(105, 'payment.view', 'admin', 'payment', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(106, 'payment.update', 'admin', 'payment', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(107, 'social.link.management', 'admin', 'social link management', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(108, 'newsletter.view', 'admin', 'newsletter', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(109, 'newsletter.mail', 'admin', 'newsletter', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(110, 'newsletter.delete', 'admin', 'newsletter', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(111, 'newsletter.content.view', 'admin', 'newsletter', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(112, 'newsletter.content.update', 'admin', 'newsletter', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(113, 'testimonial.view', 'admin', 'testimonial', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(114, 'testimonial.create', 'admin', 'testimonial', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(115, 'testimonial.translate', 'admin', 'testimonial', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(116, 'testimonial.store', 'admin', 'testimonial', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(117, 'testimonial.edit', 'admin', 'testimonial', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(118, 'testimonial.update', 'admin', 'testimonial', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(119, 'testimonial.delete', 'admin', 'testimonial', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(120, 'faq.view', 'admin', 'faq', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(121, 'faq.store', 'admin', 'faq', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(122, 'faq.update', 'admin', 'faq', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(123, 'faq.delete', 'admin', 'faq', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(124, 'faq.category.view', 'admin', 'faq category', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(125, 'faq.category.create', 'admin', 'faq category', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(126, 'faq.category.translate', 'admin', 'faq category', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(127, 'faq.category.store', 'admin', 'faq category', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(128, 'faq.category.edit', 'admin', 'faq category', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(129, 'faq.category.update', 'admin', 'faq category', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(130, 'faq.category.delete', 'admin', 'faq category', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(131, 'work.section.view', 'admin', 'work section', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(132, 'work.section.update', 'admin', 'work section', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(133, 'work.section.faq.view', 'admin', 'work section', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(134, 'work.section.faq.store', 'admin', 'work section', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(135, 'work.section.faq.update', 'admin', 'work section', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(136, 'work.section.faq.delete', 'admin', 'work section', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(137, 'counter.view', 'admin', 'counter', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(138, 'counter.store', 'admin', 'counter', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(139, 'counter.update', 'admin', 'counter', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(140, 'counter.delete', 'admin', 'counter', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(141, 'partner.view', 'admin', 'partner', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(142, 'partner.store', 'admin', 'partner', '2025-12-20 04:09:31', '2025-12-20 04:09:31'),
(143, 'partner.update', 'admin', 'partner', '2025-12-20 04:09:32', '2025-12-20 04:09:32'),
(144, 'partner.delete', 'admin', 'partner', '2025-12-20 04:09:32', '2025-12-20 04:09:32'),
(145, 'schedule.view', 'admin', 'schedule', '2025-12-20 04:09:32', '2025-12-20 04:09:32'),
(146, 'schedule.store', 'admin', 'schedule', '2025-12-20 04:09:32', '2025-12-20 04:09:32'),
(147, 'schedule.update', 'admin', 'schedule', '2025-12-20 04:09:32', '2025-12-20 04:09:32'),
(148, 'schedule.delete', 'admin', 'schedule', '2025-12-20 04:09:32', '2025-12-20 04:09:32'),
(149, 'appointment.view', 'admin', 'appointment', '2025-12-20 04:09:32', '2025-12-20 04:09:32'),
(150, 'app.management', 'admin', 'app management', '2025-12-20 04:09:32', '2025-12-20 04:09:32'),
(151, 'slider.view', 'admin', 'slider', '2025-12-20 04:09:32', '2025-12-20 04:09:32'),
(152, 'slider.store', 'admin', 'slider', '2025-12-20 04:09:32', '2025-12-20 04:09:32'),
(153, 'slider.update', 'admin', 'slider', '2025-12-20 04:09:32', '2025-12-20 04:09:32'),
(154, 'slider.delete', 'admin', 'slider', '2025-12-20 04:09:32', '2025-12-20 04:09:32'),
(155, 'day.view', 'admin', 'day', '2025-12-20 04:09:32', '2025-12-20 04:09:32'),
(156, 'day.update', 'admin', 'day', '2025-12-20 04:09:32', '2025-12-20 04:09:32'),
(157, 'feature.view', 'admin', 'feature', '2025-12-20 04:09:32', '2025-12-20 04:09:32'),
(158, 'feature.store', 'admin', 'feature', '2025-12-20 04:09:32', '2025-12-20 04:09:32'),
(159, 'feature.update', 'admin', 'feature', '2025-12-20 04:09:32', '2025-12-20 04:09:32'),
(160, 'feature.delete', 'admin', 'feature', '2025-12-20 04:09:32', '2025-12-20 04:09:32'),
(161, 'addon.view', 'admin', 'Addons', '2025-12-20 04:09:32', '2025-12-20 04:09:32'),
(162, 'addon.install', 'admin', 'Addons', '2025-12-20 04:09:32', '2025-12-20 04:09:32'),
(163, 'addon.update', 'admin', 'Addons', '2025-12-20 04:09:32', '2025-12-20 04:09:32'),
(164, 'addon.status.change', 'admin', 'Addons', '2025-12-20 04:09:32', '2025-12-20 04:09:32'),
(165, 'addon.remove', 'admin', 'Addons', '2025-12-20 04:09:32', '2025-12-20 04:09:32');

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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin', '2025-12-20 04:09:29', '2025-12-20 04:09:29');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 1),
(131, 1),
(132, 1),
(133, 1),
(134, 1),
(135, 1),
(136, 1),
(137, 1),
(138, 1),
(139, 1),
(140, 1),
(141, 1),
(142, 1),
(143, 1),
(144, 1),
(145, 1),
(146, 1),
(147, 1),
(148, 1),
(149, 1),
(150, 1),
(151, 1),
(152, 1),
(153, 1),
(154, 1),
(155, 1),
(156, 1),
(157, 1),
(158, 1),
(159, 1),
(160, 1),
(161, 1),
(162, 1),
(163, 1),
(164, 1),
(165, 1);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `day_id` bigint(20) UNSIGNED NOT NULL,
  `lawyer_id` bigint(20) UNSIGNED NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `day_id`, `lawyer_id`, `start_time`, `end_time`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '9:00 AM', '11:00 AM', 10, 1, '2021-07-13 16:08:37', '2021-07-13 16:08:37'),
(2, 2, 1, '10:00 AM', '11:00 AM', 10, 1, '2021-07-13 16:08:53', '2021-10-24 02:11:14'),
(3, 3, 1, '10:00 AM', '11:00 AM', 10, 1, '2021-07-13 16:09:03', '2021-10-21 07:57:02'),
(4, 4, 1, '10:00 AM', '11:00 AM', 10, 1, '2021-07-13 16:09:15', '2021-07-13 16:09:15'),
(5, 5, 1, '10:00 AM', '11:00 AM', 10, 1, '2021-07-13 16:09:24', '2021-07-13 16:09:24'),
(6, 6, 1, '10:00 AM', '11:00 AM', 10, 1, '2021-07-13 16:09:36', '2021-07-13 16:09:36'),
(7, 7, 1, '10:00 AM', '11:00 AM', 10, 1, '2021-07-13 16:11:08', '2021-07-13 16:11:08'),
(8, 1, 2, '10:00 AM', '11:00 AM', 10, 1, '2021-07-13 16:11:18', '2021-07-13 16:11:18'),
(9, 2, 2, '10:00 AM', '11:00 AM', 10, 1, '2021-07-13 16:11:26', '2021-07-13 16:11:26'),
(10, 3, 2, '10:00 AM', '11:00 AM', 10, 1, '2021-07-13 16:11:33', '2021-07-13 16:11:33'),
(11, 4, 2, '10:00 AM', '11:00 AM', 10, 1, '2021-07-13 16:11:43', '2021-07-13 16:11:43'),
(12, 5, 2, '10:00 AM', '11:00 AM', 10, 1, '2021-07-13 16:11:50', '2021-07-13 16:11:50'),
(13, 6, 2, '10:00 AM', '11:00 AM', 20, 1, '2021-07-14 13:57:59', '2021-07-14 13:57:59'),
(14, 7, 2, '5:00 PM', '9:00 PM', 30, 1, '2021-07-14 13:58:26', '2021-07-14 13:58:26'),
(16, 1, 3, '10:00 AM', '2:00 PM', 123, 1, '2021-10-23 04:05:05', '2021-10-23 04:05:05'),
(17, 2, 3, '10:00 AM', '11:00 AM', 10, 1, '2023-11-08 01:48:49', '2023-11-08 01:48:49'),
(19, 3, 3, '11:00 AM', '1:00 PM', 20, 1, '2024-07-24 05:07:26', '2024-07-24 05:07:26'),
(20, 5, 3, '10:00 AM', '11:00 AM', 10, 1, '2021-07-13 16:11:26', '2021-07-13 16:11:26'),
(21, 2, 4, '10:00 AM', '11:00 AM', 10, 1, '2021-07-13 16:11:33', '2021-07-13 16:11:33'),
(22, 4, 4, '10:00 AM', '11:00 AM', 10, 1, '2021-07-13 16:11:43', '2021-07-13 16:11:43'),
(23, 2, 5, '10:00 AM', '11:00 AM', 10, 1, '2021-07-13 16:11:50', '2021-07-13 16:11:50'),
(24, 1, 6, '10:00 AM', '11:00 AM', 20, 1, '2021-07-14 13:57:59', '2021-07-14 13:57:59'),
(25, 3, 6, '9:00 AM', '10:00 AM', 10, 1, '2024-07-24 05:08:10', '2024-07-24 05:08:10'),
(26, 2, 7, '9:00 AM', '11:00 AM', 10, 1, '2021-07-13 16:08:37', '2021-07-13 16:08:37'),
(27, 3, 7, '10:00 AM', '11:00 AM', 10, 1, '2021-07-13 16:08:53', '2021-10-24 02:11:14'),
(28, 5, 7, '10:00 AM', '11:00 AM', 10, 1, '2021-07-13 16:09:03', '2021-10-21 07:57:02'),
(29, 6, 7, '10:00 AM', '11:00 AM', 10, 1, '2021-07-13 16:09:15', '2021-07-13 16:09:15'),
(30, 2, 8, '10:00 AM', '11:00 AM', 20, 1, '2021-07-14 13:57:59', '2021-07-14 13:57:59'),
(31, 3, 8, '9:00 AM', '10:00 AM', 10, 1, '2024-07-24 05:08:10', '2024-07-24 05:08:10'),
(32, 1, 9, '10:00 AM', '11:00 AM', 10, 1, '2021-07-13 16:11:33', '2021-07-13 16:11:33'),
(33, 3, 9, '10:00 AM', '11:00 AM', 10, 1, '2021-07-13 16:11:43', '2021-07-13 16:11:43'),
(34, 3, 10, '10:00 AM', '11:00 AM', 10, 1, '2021-07-13 16:11:33', '2021-07-13 16:11:33'),
(35, 5, 10, '10:00 AM', '11:00 AM', 10, 1, '2021-07-13 16:11:43', '2021-07-13 16:11:43'),
(36, 4, 3, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:24', '2026-01-04 20:24:24'),
(37, 4, 3, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:24', '2026-01-04 20:24:24'),
(38, 4, 3, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:24', '2026-01-04 20:24:24'),
(39, 4, 3, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:24', '2026-01-04 20:24:24'),
(40, 4, 3, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:24', '2026-01-04 20:24:24'),
(41, 4, 3, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:24', '2026-01-04 20:24:24'),
(42, 4, 3, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:24', '2026-01-04 20:24:24'),
(43, 4, 3, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:24', '2026-01-04 20:24:24'),
(44, 6, 3, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:24', '2026-01-04 20:24:24'),
(45, 6, 3, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:24', '2026-01-04 20:24:24'),
(46, 6, 3, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(47, 6, 3, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(48, 6, 3, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(49, 6, 3, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(50, 6, 3, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(51, 6, 3, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(52, 7, 3, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(53, 7, 3, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(54, 7, 3, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(55, 7, 3, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(56, 7, 3, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(57, 7, 3, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(58, 7, 3, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(59, 7, 3, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(60, 1, 4, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(61, 1, 4, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(62, 1, 4, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(63, 1, 4, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(64, 1, 4, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(65, 1, 4, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(66, 1, 4, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(67, 1, 4, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(68, 3, 4, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(69, 3, 4, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(70, 3, 4, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(71, 3, 4, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(72, 3, 4, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(73, 3, 4, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(74, 3, 4, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(75, 3, 4, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(76, 5, 4, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(77, 5, 4, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(78, 5, 4, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(79, 5, 4, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(80, 5, 4, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(81, 5, 4, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(82, 5, 4, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(83, 5, 4, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(84, 6, 4, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(85, 6, 4, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(86, 6, 4, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(87, 6, 4, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(88, 6, 4, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(89, 6, 4, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(90, 6, 4, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(91, 6, 4, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(92, 7, 4, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(93, 7, 4, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(94, 7, 4, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(95, 7, 4, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(96, 7, 4, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(97, 7, 4, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(98, 7, 4, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(99, 7, 4, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(100, 1, 5, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(101, 1, 5, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(102, 1, 5, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(103, 1, 5, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(104, 1, 5, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(105, 1, 5, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(106, 1, 5, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(107, 1, 5, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(108, 3, 5, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(109, 3, 5, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(110, 3, 5, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(111, 3, 5, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(112, 3, 5, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(113, 3, 5, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(114, 3, 5, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(115, 3, 5, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(116, 4, 5, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(117, 4, 5, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(118, 4, 5, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(119, 4, 5, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(120, 4, 5, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(121, 4, 5, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(122, 4, 5, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(123, 4, 5, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(124, 5, 5, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(125, 5, 5, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(126, 5, 5, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(127, 5, 5, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(128, 5, 5, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(129, 5, 5, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(130, 5, 5, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(131, 5, 5, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(132, 6, 5, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(133, 6, 5, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(134, 6, 5, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(135, 6, 5, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(136, 6, 5, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(137, 6, 5, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(138, 6, 5, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(139, 6, 5, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(140, 7, 5, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(141, 7, 5, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(142, 7, 5, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(143, 7, 5, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(144, 7, 5, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(145, 7, 5, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(146, 7, 5, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(147, 7, 5, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(148, 2, 6, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(149, 2, 6, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(150, 2, 6, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(151, 2, 6, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(152, 2, 6, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(153, 2, 6, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(154, 2, 6, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(155, 2, 6, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(156, 4, 6, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(157, 4, 6, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(158, 4, 6, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(159, 4, 6, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(160, 4, 6, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(161, 4, 6, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(162, 4, 6, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(163, 4, 6, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(164, 5, 6, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(165, 5, 6, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(166, 5, 6, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(167, 5, 6, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(168, 5, 6, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(169, 5, 6, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(170, 5, 6, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(171, 5, 6, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(172, 6, 6, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(173, 6, 6, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(174, 6, 6, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(175, 6, 6, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(176, 6, 6, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(177, 6, 6, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(178, 6, 6, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(179, 6, 6, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(180, 7, 6, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(181, 7, 6, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(182, 7, 6, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(183, 7, 6, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(184, 7, 6, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(185, 7, 6, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(186, 7, 6, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(187, 7, 6, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(188, 1, 7, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(189, 1, 7, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(190, 1, 7, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(191, 1, 7, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(192, 1, 7, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(193, 1, 7, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(194, 1, 7, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(195, 1, 7, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(196, 4, 7, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(197, 4, 7, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(198, 4, 7, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(199, 4, 7, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(200, 4, 7, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(201, 4, 7, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(202, 4, 7, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(203, 4, 7, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(204, 7, 7, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(205, 7, 7, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(206, 7, 7, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(207, 7, 7, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(208, 7, 7, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(209, 7, 7, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(210, 7, 7, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(211, 7, 7, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(212, 1, 8, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(213, 1, 8, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(214, 1, 8, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(215, 1, 8, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(216, 1, 8, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(217, 1, 8, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(218, 1, 8, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(219, 1, 8, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(220, 4, 8, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(221, 4, 8, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(222, 4, 8, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(223, 4, 8, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(224, 4, 8, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(225, 4, 8, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(226, 4, 8, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(227, 4, 8, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(228, 5, 8, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(229, 5, 8, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(230, 5, 8, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(231, 5, 8, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(232, 5, 8, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(233, 5, 8, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(234, 5, 8, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(235, 5, 8, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(236, 6, 8, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(237, 6, 8, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(238, 6, 8, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(239, 6, 8, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(240, 6, 8, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(241, 6, 8, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(242, 6, 8, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(243, 6, 8, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(244, 7, 8, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(245, 7, 8, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(246, 7, 8, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(247, 7, 8, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(248, 7, 8, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(249, 7, 8, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(250, 7, 8, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(251, 7, 8, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(252, 2, 9, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(253, 2, 9, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(254, 2, 9, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(255, 2, 9, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(256, 2, 9, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(257, 2, 9, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(258, 2, 9, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(259, 2, 9, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(260, 4, 9, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(261, 4, 9, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(262, 4, 9, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(263, 4, 9, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(264, 4, 9, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(265, 4, 9, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(266, 4, 9, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(267, 4, 9, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(268, 5, 9, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(269, 5, 9, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(270, 5, 9, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(271, 5, 9, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(272, 5, 9, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(273, 5, 9, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(274, 5, 9, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(275, 5, 9, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(276, 6, 9, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(277, 6, 9, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(278, 6, 9, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(279, 6, 9, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(280, 6, 9, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(281, 6, 9, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(282, 6, 9, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(283, 6, 9, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(284, 7, 9, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(285, 7, 9, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(286, 7, 9, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(287, 7, 9, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(288, 7, 9, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(289, 7, 9, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(290, 7, 9, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(291, 7, 9, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(292, 1, 10, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(293, 1, 10, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(294, 1, 10, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(295, 1, 10, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(296, 1, 10, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(297, 1, 10, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(298, 1, 10, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(299, 1, 10, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(300, 2, 10, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(301, 2, 10, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(302, 2, 10, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(303, 2, 10, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(304, 2, 10, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(305, 2, 10, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(306, 2, 10, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(307, 2, 10, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(308, 4, 10, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(309, 4, 10, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(310, 4, 10, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(311, 4, 10, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(312, 4, 10, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(313, 4, 10, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(314, 4, 10, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(315, 4, 10, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(316, 6, 10, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(317, 6, 10, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(318, 6, 10, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(319, 6, 10, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(320, 6, 10, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(321, 6, 10, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(322, 6, 10, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(323, 6, 10, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(324, 7, 10, '9:00 AM', '10:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(325, 7, 10, '10:00 AM', '11:00 AM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(326, 7, 10, '11:00 AM', '12:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(327, 7, 10, '12:00 PM', '1:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(328, 7, 10, '1:00 PM', '2:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(329, 7, 10, '2:00 PM', '3:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(330, 7, 10, '3:00 PM', '4:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25'),
(331, 7, 10, '4:00 PM', '5:00 PM', 10, 1, '2026-01-04 20:24:25', '2026-01-04 20:24:25');

-- --------------------------------------------------------

--
-- Table structure for table `section_controls`
--

CREATE TABLE `section_controls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feature_how_many` varchar(255) NOT NULL DEFAULT '3',
  `feature_status` tinyint(1) NOT NULL DEFAULT 1,
  `work_how_many` varchar(255) NOT NULL DEFAULT '3',
  `work_status` tinyint(1) NOT NULL DEFAULT 1,
  `service_how_many` varchar(255) NOT NULL DEFAULT '6',
  `service_status` tinyint(1) NOT NULL DEFAULT 1,
  `department_how_many` varchar(255) NOT NULL DEFAULT '6',
  `department_status` tinyint(1) NOT NULL DEFAULT 1,
  `client_how_many` varchar(255) NOT NULL DEFAULT '4',
  `client_status` tinyint(1) NOT NULL DEFAULT 1,
  `lawyer_how_many` varchar(255) NOT NULL DEFAULT '6',
  `lawyer_status` tinyint(1) NOT NULL DEFAULT 1,
  `blog_how_many` varchar(255) NOT NULL DEFAULT '4',
  `blog_status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section_controls`
--

INSERT INTO `section_controls` (`id`, `feature_how_many`, `feature_status`, `work_how_many`, `work_status`, `service_how_many`, `service_status`, `department_how_many`, `department_status`, `client_how_many`, `client_status`, `lawyer_how_many`, `lawyer_status`, `blog_how_many`, `blog_status`, `created_at`, `updated_at`) VALUES
(1, '3', 1, '3', 1, '6', 1, '6', 1, '4', 1, '6', 1, '4', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `section_control_translations`
--

CREATE TABLE `section_control_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_control_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `work_first_heading` varchar(255) DEFAULT NULL,
  `work_second_heading` text DEFAULT NULL,
  `work_description` longtext DEFAULT NULL,
  `service_first_heading` varchar(255) DEFAULT NULL,
  `service_second_heading` text DEFAULT NULL,
  `service_description` longtext DEFAULT NULL,
  `department_first_heading` varchar(255) DEFAULT NULL,
  `department_second_heading` text DEFAULT NULL,
  `department_description` longtext DEFAULT NULL,
  `client_first_heading` varchar(255) DEFAULT NULL,
  `client_second_heading` text DEFAULT NULL,
  `client_description` longtext DEFAULT NULL,
  `lawyer_first_heading` varchar(255) DEFAULT NULL,
  `lawyer_second_heading` text DEFAULT NULL,
  `lawyer_description` longtext DEFAULT NULL,
  `blog_first_heading` varchar(255) DEFAULT NULL,
  `blog_second_heading` text DEFAULT NULL,
  `blog_description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section_control_translations`
--

INSERT INTO `section_control_translations` (`id`, `section_control_id`, `lang_code`, `work_first_heading`, `work_second_heading`, `work_description`, `service_first_heading`, `service_second_heading`, `service_description`, `department_first_heading`, `department_second_heading`, `department_description`, `client_first_heading`, `client_second_heading`, `client_description`, `lawyer_first_heading`, `lawyer_second_heading`, `lawyer_description`, `blog_first_heading`, `blog_second_heading`, `blog_description`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'How', 'We Work', 'We deliver exceptional results through collaboration, expertise, and continuous improvement. Our process ensures quality and efficiency, with open communication and a commitment to excellence for optimal client satisfaction.', 'Our', 'Service', 'We offer comprehensive, high-quality solutions tailored to meet your unique needs, ensuring satisfaction through expert execution, personalized attention, and continuous support.', 'Our', 'Departments', 'We provide specialized legal services across various practice areas, ensuring comprehensive counsel, expert representation, and personalized solutions for all your legal needs', 'Our', 'Clients', 'We prioritize our clients’ well-being by delivering dedicated legal support, personalized strategies, and ongoing guidance to ensure their rights are protected and their legal needs are met', 'Our', 'Lawyers', 'Our lawyers are highly skilled professionals dedicated to delivering exceptional legal counsel, accurate case assessments, and personalized strategies to achieve the best outcomes for our clients.', 'Our', 'Blog', 'Stay informed with the latest legal insights, case studies, and expert advice. Our blog is dedicated to helping you understand your rights and stay updated on important legal developments.', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(2, 1, 'ar', 'كيفية', 'نحن نعمل', 'نحن نقدم نتائج استثنائية من خلال التعاون والخبرة والتحسين المستمر. تضمن عمليتنا الجودة والكفاءة، مع التواصل المفتوح والالتزام بالتميز لتحقيق الرضا الأمثل للعملاء.', 'خدمتنا', 'خدمات', 'نحن نقدم حلولاً شاملة وعالية الجودة مصممة خصيصًا لتلبية احتياجاتك الفريدة، مع ضمان الرضا من خلال تنفيذ الخبراء والاهتمام الشخصي والدعم المستمر.', 'أقسامنا', 'الأقسام', 'نحن نقدم خدمات قانونية متخصصة في مختلف مجالات الممارسة، ونضمن لك المشورة الشاملة والتمثيل الخبير والحلول الشخصية لجميع احتياجاتك القانونية', 'مرضانا', 'العملاء', 'نحن نعطي الأولوية لرفاهية عملائنا من خلال تقديم الدعم القانوني المخصص والاستراتيجيات الشخصية والتوجيه المستمر لضمان حماية حقوقهم وتلبية احتياجاتهم القانونية', 'أطباؤنا', 'المحامون', 'إن محامينا هم من المحترفين ذوي المهارات العالية والمكرسين لتقديم المشورة القانونية الاستثنائية وتقييمات القضايا الدقيقة والاستراتيجيات الشخصية لتحقيق أفضل النتائج لعملائنا.', 'مدونتنا', 'المدونة', 'ابقَ على اطلاع بأحدث الرؤى القانونية ودراسات الحالة ونصائح الخبراء. مدونتنا مُخصصة لمساعدتك على فهم حقوقك والبقاء على اطلاع دائم بالتطورات القانونية المهمة.', '2025-12-20 04:09:35', '2025-12-20 04:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `seo_settings`
--

CREATE TABLE `seo_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `seo_title` text NOT NULL,
  `seo_description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seo_settings`
--

INSERT INTO `seo_settings` (`id`, `page_name`, `seo_title`, `seo_description`, `created_at`, `updated_at`) VALUES
(1, 'Home', 'الرئيسية || مكتب المحاماة السوري', 'مكتب محاماة متخصص في سوريا - خدمات قانونية احترافية', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(2, 'About', 'من نحن || مكتب المحاماة السوري', 'تعرف على مكتبنا وخدماتنا القانونية في سوريا', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(3, 'Contact', 'اتصل بنا || مكتب المحاماة السوري', 'تواصل معنا للحصول على استشارة قانونية', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(4, 'Blog', 'المدونة || مكتب المحاماة السوري', 'أحدث المقالات القانونية والأخبار', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(5, 'Lawyers', 'المحامون || مكتب المحاماة السوري', 'تعرف على فريق المحامين المتخصصين لدينا', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(6, 'Department', 'الأقسام || مكتب المحاماة السوري', 'تخصصاتنا القانونية المتنوعة', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(7, 'Service', 'الخدمات || مكتب المحاماة السوري', 'خدماتنا القانونية الشاملة', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(8, 'Testimonial', 'آراء العملاء || مكتب المحاماة السوري', 'ماذا يقول عملاؤنا عنا', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(9, 'FaQ', 'الأسئلة الشائعة || مكتب المحاماة السوري', 'أجوبة على الأسئلة الأكثر شيوعاً', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(10, 'Privacy Policy', 'سياسة الخصوصية || مكتب المحاماة السوري', 'سياسة الخصوصية وحماية البيانات', '2025-12-20 04:09:29', '2025-12-20 04:09:29'),
(11, 'Terms Condition', 'الشروط والأحكام || مكتب المحاماة السوري', 'الشروط والأحكام الخاصة بخدماتنا', '2025-12-20 04:09:29', '2025-12-20 04:09:29');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` text NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `show_homepage` tinyint(1) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `slug`, `icon`, `show_homepage`, `status`, `created_at`, `updated_at`) VALUES
(1, 'corporate-law', 'fab fa-fort-awesome', 1, 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(2, 'family-law', 'fas fa-balance-scale', 1, 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(3, 'criminal-law', 'fas fa-anchor', 1, 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(4, 'business-law', 'fas fa-gavel', 1, 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(5, 'insurance-law', 'far fa-snowflake', 1, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(6, 'environmental-law', 'fab fa-envira', 1, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `service_faqs`
--

CREATE TABLE `service_faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_faqs`
--

INSERT INTO `service_faqs` (`id`, `service_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(2, 1, 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(3, 2, 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(4, 2, 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(5, 3, 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(6, 3, 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(7, 4, 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(8, 4, 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(9, 5, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(10, 5, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(11, 6, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(12, 6, 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `service_faq_translations`
--

CREATE TABLE `service_faq_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_faq_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_faq_translations`
--

INSERT INTO `service_faq_translations` (`id`, `service_faq_id`, `lang_code`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Lorem ipsum dolor sit amet per mollis?', 'Lorem ipsum dolor sit amet, per mollis aeterno nostrud in, nam timeam fastidii eu. Commodo nonumes vim eu. Quo indoctum voluptatibus delicatissimi no. Eu cum dico melius. Cum impetus scribentur ad.', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(2, 1, 'ar', 'لوريم إيبسوم دولور الجلوس أميت لكل موليس؟', 'لوريم إيبسوم دولور الجلوس أميت لكل موليس؟لوريم إيبسوم دولور الجلوس أميت لكل موليس؟لوريم إيبسوم دولور الجلوس أميت لكل موليس؟', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(3, 2, 'en', 'Ut alterum dissentiunt eam nobis audire?', 'Ut alterum dissentiunt eam, nobis audire verterem ut vel. Vidisse persius mea no. Melius imperdiet his at. Ex has zril convenire, cu eos eros dolor, omittam adversarium suscipiantur mea ea.', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(4, 2, 'ar', 'هل من الممكن أن أختلف مع أي شخص آخر؟', 'هل من الممكن أن أختلف مع أي شخص آخرهل من الممكن أن أختلف مع أي شخص آخرهل من الممكن أن أختلف مع أي شخص آخر', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(5, 3, 'en', 'Lorem ipsum dolor sit amet per mollis?', 'Lorem ipsum dolor sit amet, per mollis aeterno nostrud in, nam timeam fastidii eu. Commodo nonumes vim eu. Quo indoctum voluptatibus delicatissimi no. Eu cum dico melius. Cum impetus scribentur ad.', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(6, 3, 'ar', 'لوريم إيبسوم دولور الجلوس أميت لكل موليس؟', 'لوريم إيبسوم دولور الجلوس أميت لكل موليس؟لوريم إيبسوم دولور الجلوس أميت لكل موليس؟لوريم إيبسوم دولور الجلوس أميت لكل موليس؟', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(7, 4, 'en', 'Ut alterum dissentiunt eam nobis audire?', 'Ut alterum dissentiunt eam, nobis audire verterem ut vel. Vidisse persius mea no. Melius imperdiet his at. Ex has zril convenire, cu eos eros dolor, omittam adversarium suscipiantur mea ea.', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(8, 4, 'ar', 'هل من الممكن أن أختلف مع أي شخص آخر؟', 'هل من الممكن أن أختلف مع أي شخص آخرهل من الممكن أن أختلف مع أي شخص آخرهل من الممكن أن أختلف مع أي شخص آخر', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(9, 5, 'en', 'Lorem ipsum dolor sit amet per mollis?', 'Lorem ipsum dolor sit amet, per mollis aeterno nostrud in, nam timeam fastidii eu. Commodo nonumes vim eu. Quo indoctum voluptatibus delicatissimi no. Eu cum dico melius. Cum impetus scribentur ad.', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(10, 5, 'ar', 'لوريم إيبسوم دولور الجلوس أميت لكل موليس؟', 'لوريم إيبسوم دولور الجلوس أميت لكل موليس؟لوريم إيبسوم دولور الجلوس أميت لكل موليس؟لوريم إيبسوم دولور الجلوس أميت لكل موليس؟', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(11, 6, 'en', 'Ut alterum dissentiunt eam nobis audire?', 'Ut alterum dissentiunt eam, nobis audire verterem ut vel. Vidisse persius mea no. Melius imperdiet his at. Ex has zril convenire, cu eos eros dolor, omittam adversarium suscipiantur mea ea.', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(12, 6, 'ar', 'هل من الممكن أن أختلف مع أي شخص آخر؟', 'هل من الممكن أن أختلف مع أي شخص آخرهل من الممكن أن أختلف مع أي شخص آخرهل من الممكن أن أختلف مع أي شخص آخر', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(13, 7, 'en', 'Lorem ipsum dolor sit amet per mollis?', 'Lorem ipsum dolor sit amet, per mollis aeterno nostrud in, nam timeam fastidii eu. Commodo nonumes vim eu. Quo indoctum voluptatibus delicatissimi no. Eu cum dico melius. Cum impetus scribentur ad.', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(14, 7, 'ar', 'لوريم إيبسوم دولور الجلوس أميت لكل موليس؟', 'لوريم إيبسوم دولور الجلوس أميت لكل موليس؟لوريم إيبسوم دولور الجلوس أميت لكل موليس؟لوريم إيبسوم دولور الجلوس أميت لكل موليس؟', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(15, 8, 'en', 'Ut alterum dissentiunt eam nobis audire?', 'Ut alterum dissentiunt eam, nobis audire verterem ut vel. Vidisse persius mea no. Melius imperdiet his at. Ex has zril convenire, cu eos eros dolor, omittam adversarium suscipiantur mea ea.', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(16, 8, 'ar', 'هل من الممكن أن أختلف مع أي شخص آخر؟', 'هل من الممكن أن أختلف مع أي شخص آخرهل من الممكن أن أختلف مع أي شخص آخرهل من الممكن أن أختلف مع أي شخص آخر', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(17, 9, 'en', 'Lorem ipsum dolor sit amet per mollis?', 'Lorem ipsum dolor sit amet, per mollis aeterno nostrud in, nam timeam fastidii eu. Commodo nonumes vim eu. Quo indoctum voluptatibus delicatissimi no. Eu cum dico melius. Cum impetus scribentur ad.', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(18, 9, 'ar', 'لوريم إيبسوم دولور الجلوس أميت لكل موليس؟', 'لوريم إيبسوم دولور الجلوس أميت لكل موليس؟لوريم إيبسوم دولور الجلوس أميت لكل موليس؟لوريم إيبسوم دولور الجلوس أميت لكل موليس؟', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(19, 10, 'en', 'Ut alterum dissentiunt eam nobis audire?', 'Ut alterum dissentiunt eam, nobis audire verterem ut vel. Vidisse persius mea no. Melius imperdiet his at. Ex has zril convenire, cu eos eros dolor, omittam adversarium suscipiantur mea ea.', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(20, 10, 'ar', 'هل من الممكن أن أختلف مع أي شخص آخر؟', 'هل من الممكن أن أختلف مع أي شخص آخرهل من الممكن أن أختلف مع أي شخص آخرهل من الممكن أن أختلف مع أي شخص آخر', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(21, 11, 'en', 'Lorem ipsum dolor sit amet per mollis?', 'Lorem ipsum dolor sit amet, per mollis aeterno nostrud in, nam timeam fastidii eu. Commodo nonumes vim eu. Quo indoctum voluptatibus delicatissimi no. Eu cum dico melius. Cum impetus scribentur ad.', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(22, 11, 'ar', 'لوريم إيبسوم دولور الجلوس أميت لكل موليس؟', 'لوريم إيبسوم دولور الجلوس أميت لكل موليس؟لوريم إيبسوم دولور الجلوس أميت لكل موليس؟لوريم إيبسوم دولور الجلوس أميت لكل موليس؟', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(23, 12, 'en', 'Ut alterum dissentiunt eam nobis audire?', 'Ut alterum dissentiunt eam, nobis audire verterem ut vel. Vidisse persius mea no. Melius imperdiet his at. Ex has zril convenire, cu eos eros dolor, omittam adversarium suscipiantur mea ea.', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(24, 12, 'ar', 'هل من الممكن أن أختلف مع أي شخص آخر؟', 'هل من الممكن أن أختلف مع أي شخص آخرهل من الممكن أن أختلف مع أي شخص آخرهل من الممكن أن أختلف مع أي شخص آخر', '2025-12-20 04:09:36', '2025-12-20 04:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `service_images`
--

CREATE TABLE `service_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `small_image` varchar(255) NOT NULL,
  `large_image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_images`
--

INSERT INTO `service_images` (`id`, `service_id`, `small_image`, `large_image`, `created_at`, `updated_at`) VALUES
(1, 1, 'uploads/website-images/dummy/department-small-1.webp', 'uploads/website-images/dummy/department-large-1.webp', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(2, 1, 'uploads/website-images/dummy/department-small-2.webp', 'uploads/website-images/dummy/department-large-2.webp', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(3, 1, 'uploads/website-images/dummy/department-small-3.webp', 'uploads/website-images/dummy/department-large-3.webp', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(4, 1, 'uploads/website-images/dummy/department-small-4.webp', 'uploads/website-images/dummy/department-large-4.webp', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(5, 2, 'uploads/website-images/dummy/department-small-1.webp', 'uploads/website-images/dummy/department-large-1.webp', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(6, 2, 'uploads/website-images/dummy/department-small-2.webp', 'uploads/website-images/dummy/department-large-2.webp', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(7, 2, 'uploads/website-images/dummy/department-small-3.webp', 'uploads/website-images/dummy/department-large-3.webp', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(8, 2, 'uploads/website-images/dummy/department-small-4.webp', 'uploads/website-images/dummy/department-large-4.webp', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(9, 3, 'uploads/website-images/dummy/department-small-1.webp', 'uploads/website-images/dummy/department-large-1.webp', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(10, 3, 'uploads/website-images/dummy/department-small-2.webp', 'uploads/website-images/dummy/department-large-2.webp', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(11, 3, 'uploads/website-images/dummy/department-small-3.webp', 'uploads/website-images/dummy/department-large-3.webp', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(12, 3, 'uploads/website-images/dummy/department-small-4.webp', 'uploads/website-images/dummy/department-large-4.webp', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(13, 4, 'uploads/website-images/dummy/department-small-1.webp', 'uploads/website-images/dummy/department-large-1.webp', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(14, 4, 'uploads/website-images/dummy/department-small-2.webp', 'uploads/website-images/dummy/department-large-2.webp', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(15, 4, 'uploads/website-images/dummy/department-small-3.webp', 'uploads/website-images/dummy/department-large-3.webp', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(16, 4, 'uploads/website-images/dummy/department-small-4.webp', 'uploads/website-images/dummy/department-large-4.webp', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(17, 5, 'uploads/website-images/dummy/department-small-1.webp', 'uploads/website-images/dummy/department-large-1.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(18, 5, 'uploads/website-images/dummy/department-small-2.webp', 'uploads/website-images/dummy/department-large-2.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(19, 5, 'uploads/website-images/dummy/department-small-3.webp', 'uploads/website-images/dummy/department-large-3.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(20, 5, 'uploads/website-images/dummy/department-small-4.webp', 'uploads/website-images/dummy/department-large-4.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(21, 6, 'uploads/website-images/dummy/department-small-1.webp', 'uploads/website-images/dummy/department-large-1.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(22, 6, 'uploads/website-images/dummy/department-small-2.webp', 'uploads/website-images/dummy/department-large-2.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(23, 6, 'uploads/website-images/dummy/department-small-3.webp', 'uploads/website-images/dummy/department-large-3.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(24, 6, 'uploads/website-images/dummy/department-small-4.webp', 'uploads/website-images/dummy/department-large-4.webp', '2025-12-20 04:09:36', '2025-12-20 04:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `service_translations`
--

CREATE TABLE `service_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sort_description` varchar(255) DEFAULT NULL,
  `description` longtext NOT NULL,
  `seo_title` text DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_translations`
--

INSERT INTO `service_translations` (`id`, `service_id`, `lang_code`, `title`, `sort_description`, `description`, `seo_title`, `seo_description`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Corporate Law', 'Legal support for corporate governance, & compliance', '<p>We provide expert legal services for corporations including governance structure, shareholder agreements, compliance, and mergers & acquisitions.</p>', 'Corporate Law', 'Legal support for corporate governance, & compliance', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(2, 1, 'ar', 'القانون التجاري', 'الدعم القانوني لحوكمة الشركات والاندماجات والامتثال', '<p>نقدم خدمات قانونية متخصصة للشركات، تشمل هيكلة الحوكمة، واتفاقيات المساهمين، والامتثال، والاندماجات والاستحواذات.</p>', 'القانون التجاري', 'الدعم القانوني لحوكمة الشركات والاندماجات والامتثال', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(3, 2, 'en', 'Family Law', 'Legal services for marriage, divorce, child custody, and more', '<p>Our family law experts assist in resolving family disputes including marriage, divorce, custody, and inheritance issues.</p>', 'Family Law', 'Legal services for marriage, divorce, child custody, and more', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(4, 2, 'ar', 'قانون الأسرة', 'خدمات قانونية للزواج، والطلاق، وحضانة الأطفال، وغيرها', '<p>يقدم خبراؤنا في قانون الأسرة المساعدة في حل النزاعات الأسرية مثل الزواج والطلاق والحضانة وقضايا الميراث.</p>', 'قانون الأسرة', 'خدمات قانونية للزواج، والطلاق، وحضانة الأطفال، وغيرها', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(5, 3, 'en', 'Criminal Law', 'Defense against criminal charges and legal representation in court', '<p>We provide strong defense representation in criminal matters to protect your rights at every stage of the legal process.</p>', 'Criminal Law', 'Defense against criminal charges and legal representation in court', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(6, 3, 'ar', 'القانون الجنائي', 'الدفاع ضد التهم الجنائية والتمثيل القانوني في المحكمة', '<p>نقدم تمثيلًا قانونيًا قويًا في القضايا الجنائية لحماية حقوقك في جميع مراحل الإجراءات القانونية.</p>', 'القانون الجنائي', 'الدفاع ضد التهم الجنائية والتمثيل القانوني في المحكمة', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(7, 4, 'en', 'Business Law', 'Legal guidance for business formation & contracts', '<p>We help businesses navigate legal challenges with expert advice on contracts, compliance, mergers, and more.</p>', 'Business Law', 'Legal guidance for business formation & contracts', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(8, 4, 'ar', 'القانون التجاري', 'إرشاد قانوني لتأسيس الشركات والعقود والامتثال', '<p>نساعد الشركات على التغلب على التحديات القانونية من خلال تقديم المشورة المتخصصة بشأن العقود والامتثال والاندماجات والمزيد.</p>', 'القانون التجاري', 'إرشاد قانوني لتأسيس الشركات والعقود والامتثال', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(9, 5, 'en', 'Insurance Law', 'Assistance with insurance claims, disputes, and legal coverage', '<p>Our attorneys support clients in navigating insurance issues, including claim denials and policy disputes.</p>', 'Insurance Law', 'Assistance with insurance claims, disputes, and legal coverage', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(10, 5, 'ar', 'قانون التأمين', 'المساعدة في مطالبات التأمين والنزاعات والتغطية القانونية', '<p>يدعم محامونا العملاء في التعامل مع قضايا التأمين، بما في ذلك رفض المطالبات والنزاعات المتعلقة بالسياسات.</p>', 'قانون التأمين', 'المساعدة في مطالبات التأمين والنزاعات والتغطية القانونية', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(11, 6, 'en', 'Environmental Law', 'Legal solutions for environmental regulations and compliance', '<p>We advise on environmental laws, compliance, and litigation for businesses and individuals impacting the environment.</p>', 'Environmental Law', 'Legal solutions for environmental regulations and compliance', '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(12, 6, 'ar', 'القانون البيئي', 'حلول قانونية للتشريعات البيئية والامتثال', '<p>نقدم المشورة بشأن القوانين البيئية والامتثال والتقاضي للشركات والأفراد الذين يتأثرون أو يؤثرون على البيئة.</p>', 'القانون البيئي', 'حلول قانونية للتشريعات البيئية والامتثال', '2025-12-20 04:09:36', '2025-12-20 04:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `service_videos`
--

CREATE TABLE `service_videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `link` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_videos`
--

INSERT INTO `service_videos` (`id`, `service_id`, `link`, `code`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'https://www.youtube.com/watch?v=6_aWI8JgRCs', '6_aWI8JgRCs', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(2, 1, 'https://www.youtube.com/watch?v=SzXbRCVy4r0', 'SzXbRCVy4r0', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(3, 2, 'https://www.youtube.com/watch?v=6_aWI8JgRCs', '6_aWI8JgRCs', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(4, 2, 'https://www.youtube.com/watch?v=SzXbRCVy4r0', 'SzXbRCVy4r0', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(5, 3, 'https://www.youtube.com/watch?v=6_aWI8JgRCs', '6_aWI8JgRCs', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(6, 3, 'https://www.youtube.com/watch?v=SzXbRCVy4r0', 'SzXbRCVy4r0', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(7, 4, 'https://www.youtube.com/watch?v=6_aWI8JgRCs', '6_aWI8JgRCs', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(8, 4, 'https://www.youtube.com/watch?v=SzXbRCVy4r0', 'SzXbRCVy4r0', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(9, 5, 'https://www.youtube.com/watch?v=6_aWI8JgRCs', '6_aWI8JgRCs', 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(10, 5, 'https://www.youtube.com/watch?v=SzXbRCVy4r0', 'SzXbRCVy4r0', 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(11, 6, 'https://www.youtube.com/watch?v=6_aWI8JgRCs', '6_aWI8JgRCs', 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36'),
(12, 6, 'https://www.youtube.com/watch?v=SzXbRCVy4r0', 'SzXbRCVy4r0', 1, '2025-12-20 04:09:36', '2025-12-20 04:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'app_name', 'مكتب المحاماة السوري', '2025-12-20 04:09:28', '2025-12-20 10:10:20'),
(2, 'version', '4.0.0', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(3, 'logo', 'uploads/custom-images/wsus-img-2025-12-20-01-08-09-1268.jpg', '2025-12-20 04:09:28', '2025-12-20 11:08:09'),
(4, 'timezone', 'Asia/Damascus', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(5, 'date_format', 'Y-m-d', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(6, 'time_format', 'h:i A', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(7, 'favicon', 'uploads/custom-images/wsus-img-2025-12-20-01-08-09-5119.jpg', '2025-12-20 04:09:28', '2025-12-20 11:08:09'),
(8, 'cookie_status', 'active', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(9, 'border', 'normal', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(10, 'corners', 'thin', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(11, 'background_color', '#c8b47e', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(12, 'text_color', '#ffffff', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(13, 'border_color', '#c8b47e', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(14, 'btn_bg_color', '#ffffff', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(15, 'btn_text_color', '#222758', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(16, 'link_text', 'Policy', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(17, 'btn_text', 'Yes', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(18, 'message', 'This website uses essential cookies to ensure its proper operation and tracking cookies to understand how you interact with it. The latter will be set only upon approval.', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(19, 'recaptcha_site_key', '6Le-PAYqAAAAAIHVR0VOcWt6eB3VUhcvji-wOaBd', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(20, 'recaptcha_secret_key', '6Le-PAYqAAAAAKsiisewXG6ysu2bxOp820eB8Sub', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(21, 'recaptcha_status', 'inactive', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(22, 'tawk_status', 'inactive', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(23, 'tawk_chat_link', 'https://embed.tawk.to/6682660beaf3bd8d4d16bb9f/1i1mlt82l', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(24, 'googel_tag_status', 'inactive', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(25, 'googel_tag_id', 'googel_tag_id', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(26, 'google_analytic_status', 'inactive', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(27, 'google_analytic_id', 'google_analytic_id', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(28, 'pixel_status', 'inactive', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(29, 'pixel_app_id', 'pixel_app_id', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(30, 'google_login_status', 'inactive', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(31, 'gmail_client_id', 'google_client_id', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(32, 'gmail_secret_id', 'google_secret_id', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(33, 'default_avatar', 'uploads/website-images/default-avatar.png', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(34, 'breadcrumb_image', 'uploads/website-images/breadcrumb-image.webp', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(35, 'error_page_image', 'uploads/website-images/error_img.png', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(36, 'mail_host', 'sandbox.smtp.mailtrap.io', '2025-12-20 04:09:28', '2025-12-20 10:36:29'),
(37, 'mail_sender_email', 'sender@gmail.com', '2025-12-20 04:09:28', '2025-12-20 10:36:29'),
(38, 'mail_username', 'khaledahmedhaggagy@gmail.com', '2025-12-20 04:09:28', '2025-12-20 10:36:29'),
(39, 'mail_password', 'khaledahmedhaggagy@gmail.com', '2025-12-20 04:09:28', '2025-12-20 10:36:29'),
(40, 'mail_port', '2525', '2025-12-20 04:09:28', '2025-12-20 10:36:29'),
(41, 'mail_encryption', 'ssl', '2025-12-20 04:09:28', '2025-12-20 10:36:29'),
(42, 'mail_sender_name', 'مكتب المحاماة السوري', '2025-12-20 04:09:28', '2025-12-20 10:36:29'),
(43, 'contact_message_receiver_mail', 'receiver@gmail.com', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(44, 'pusher_app_id', 'pusher_app_id', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(45, 'pusher_app_key', 'pusher_app_key', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(46, 'pusher_app_secret', 'pusher_app_secret', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(47, 'pusher_app_cluster', 'pusher_app_cluster', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(48, 'pusher_status', 'inactive', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(49, 'club_point_rate', '1', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(50, 'club_point_status', 'active', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(51, 'maintenance_mode', '0', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(52, 'maintenance_image', 'uploads/website-images/maintenance.jpg', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(53, 'maintenance_title', 'Website Under maintenance', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(54, 'maintenance_description', '<p>We are currently performing maintenance on our website to<br>improve your experience. Please check back later.</p>\n            <p><a title=\"Websolutions\" href=\"https://websolutionus.com/\">Websolutions</a></p>', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(55, 'last_update_date', '2025-12-20 06:09:28', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(56, 'is_queable', 'inactive', '2025-12-20 04:09:28', '2025-12-20 10:36:47'),
(57, 'comments_auto_approved', 'active', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(58, 'client_can_register', '1', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(59, 'lawyer_can_register', '1', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(60, 'lawyer_can_add_social_links', 'active', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(61, 'lawyer_social_links_limit', '5', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(62, 'prenotification_hour', '3', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(63, 'comment_type', '1', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(64, 'facebook_comment_script', '882238482112522', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(65, 'theme_one', '#c8b47e', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(66, 'theme_two', '#f1634c', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(67, 'preloader', '1', '2025-12-20 04:09:28', '2025-12-20 11:03:34'),
(68, 'preloader_image', 'uploads/website-images/preloader_image.gif', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(69, 'prescription_phone', '+963-11-234-5678', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(70, 'prescription_email', 'support@syrianlaw.com', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(71, 'save_contact_message', '0', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(72, 'app_banner', 'uploads/website-images/app_banner.webp', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(73, 'app_login_img', 'uploads/website-images/app/app_login.jpg', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(74, 'app_forgot_password_img', 'uploads/website-images/app/app_forgot_password.jpg', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(75, 'google_app_store_status', '1', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(76, 'google_app_store_link', 'https://websolutionus.com', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(77, 'google_app_store_img', 'uploads/website-images/google-play.svg', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(78, 'apple_app_store_status', '1', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(79, 'apple_app_store_link', 'https://websolutionus.com', '2025-12-20 04:09:28', '2025-12-20 04:09:28'),
(80, 'apple_app_store_img', 'uploads/website-images/apple-store.svg', '2025-12-20 04:09:28', '2025-12-20 04:09:28');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_carts`
--

CREATE TABLE `shopping_carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `lawyer_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `schedule_id` bigint(20) UNSIGNED NOT NULL,
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `day_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `qty` varchar(255) NOT NULL DEFAULT '1',
  `price` int(11) NOT NULL,
  `date` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'uploads/website-images/dummy/slider-1.webp', 'Slider-1', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(2, 'uploads/website-images/dummy/slider-2.webp', 'Slider-2', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(3, 'uploads/website-images/dummy/slider-3.webp', 'Slider-3', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `socialite_credentials`
--

CREATE TABLE `socialite_credentials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `provider_name` varchar(255) NOT NULL,
  `provider_id` varchar(255) DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `refresh_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_links`
--

INSERT INTO `social_links` (`id`, `link`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'https://www.instagram.com', 'fab fa-instagram', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(2, 'https://www.facebook.com', 'fab fa-facebook-f', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(3, 'https://www.linkedin.com', 'fab fa-linkedin-in', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34'),
(4, 'https://www.twitter.com', 'fab fa-twitter', 1, '2025-12-20 04:09:34', '2025-12-20 04:09:34');

-- --------------------------------------------------------

--
-- Table structure for table `subscriber_contents`
--

CREATE TABLE `subscriber_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriber_contents`
--

INSERT INTO `subscriber_contents` (`id`, `image`, `created_at`, `updated_at`) VALUES
(1, 'uploads/website-images/dummy/subscribe-us-banner.webp', '2025-12-20 04:09:40', '2025-12-20 04:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `subscriber_content_translations`
--

CREATE TABLE `subscriber_content_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscriber_content_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriber_content_translations`
--

INSERT INTO `subscriber_content_translations` (`id`, `subscriber_content_id`, `lang_code`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Subscribe Us', 'Stay updated with our latest news and offers by subscribing to our newsletter. We promise to keep you informed about new services, special promotions, and important updates. Join our community and never miss out on exciting updates and offers.', '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(2, 1, 'ar', 'اشترك معنا', 'ابقَ على اطلاع بأحدث أخبارنا وعروضنا من خلال الاشتراك في نشرتنا الإخبارية. نعدك بإبقائك على علم بالخدمات الجديدة، والعروض الخاصة، والتحديثات المهمة. انضم إلى مجتمعنا ولا تفوتك التحديثات المثيرة والعروض الرائعة.', '2025-12-20 04:09:40', '2025-12-20 04:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `rating` varchar(255) DEFAULT '0',
  `show_homepage` varchar(255) DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `image`, `rating`, `show_homepage`, `status`, `created_at`, `updated_at`) VALUES
(1, 'uploads/website-images/dummy/testimonial-1.webp', '5', '1', 1, '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(2, 'uploads/website-images/dummy/testimonial-2.webp', '5', '1', 1, '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(3, 'uploads/website-images/dummy/testimonial-3.webp', '5', '1', 1, '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(4, 'uploads/website-images/dummy/testimonial-4.webp', '5', '1', 1, '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(5, 'uploads/website-images/dummy/testimonial-5.webp', '5', '1', 1, '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(6, 'uploads/website-images/dummy/testimonial-6.webp', '5', '1', 1, '2025-12-20 04:09:40', '2025-12-20 04:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial_translations`
--

CREATE TABLE `testimonial_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `testimonial_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonial_translations`
--

INSERT INTO `testimonial_translations` (`id`, `testimonial_id`, `lang_code`, `name`, `designation`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Khaled Al-Masri', 'Business Owner, Damascus', 'The legal team provided exceptional support in handling my commercial contract dispute.', '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(2, 1, 'ar', 'خالد المصري', 'صاحب شركة، دمشق', 'قدم الفريق القانوني دعماً استثنائياً في معالجة نزاع العقد التجاري الخاص بي.', '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(3, 2, 'en', 'Layla Ahmad', 'Teacher, Aleppo', 'The lawyers helped me with my family law case with great sensitivity and professionalism.', '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(4, 2, 'ar', 'ليلى أحمد', 'معلمة، حلب', 'ساعدني المحامون في قضية الأحوال الشخصية بحساسية كبيرة واحترافية عالية.', '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(5, 3, 'en', 'Omar Haddad', 'Engineer, Homs', 'Excellent legal representation in my real estate dispute.', '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(6, 3, 'ar', 'عمر حداد', 'مهندس، حمص', 'تمثيل قانوني ممتاز في نزاع الملكية العقارية.', '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(7, 4, 'en', 'Sarah Lambert', 'Founder, LegalTech Hub', 'From the initial consultation to the final resolution, the legal team exceeded my expectations. Their clarity, communication, and commitment made a stressful situation much easier to navigate. I am grateful for their expertise and would confidently recommend their services to others.', '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(8, 4, 'ar', 'Sarah Lambert', 'المؤسسة، LegalTech Hub', 'من الاستشارة الأولى وحتى الحل النهائي، فاق الفريق القانوني توقعاتي. لقد ساعدني وضوحهم وتواصلهم والتزامهم على تخطي وضع مرهق بسهولة أكبر. أنا ممتنة لخبرتهم وأوصي بخدماتهم بكل ثقة.', '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(9, 5, 'en', 'Mohammed Al-Farsi', 'General Manager, Gulf Trading Co.', 'I had a complex legal issue involving contracts and business regulations. The firm handled it with precision and deep knowledge of the law. Their team was approachable, transparent, and responsive throughout the process. I would gladly work with them again if needed.', '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(10, 5, 'ar', 'محمد الفارسي', 'المدير العام، Gulf Trading Co.', 'واجهت قضية قانونية معقدة تتعلق بالعقود والأنظمة التجارية. تعامل المكتب معها بدقة ومعرفة عميقة بالقانون. كان فريقهم متعاوناً وشفافاً وسريع الاستجابة طوال العملية. سأتعامل معهم مجددًا بكل سرور إذا دعت الحاجة.', '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(11, 6, 'en', 'Khalid Al-Zayani', 'CEO, Zayani Group', 'From the initial consultation to the final resolution, the legal team demonstrated exceptional professionalism and clarity. Their dedication gave me peace of mind throughout the case. Truly a firm I can trust.', '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(12, 6, 'ar', 'خالد الزايني', 'الرئيس التنفيذي، Zayani Group', 'من الاستشارة الأولى وحتى الحل النهائي، أظهر الفريق القانوني احترافية ووضوحاً استثنائيين. منحني التزامهم راحة البال طوال فترة القضية. بالفعل شركة يمكن الوثوق بها.', '2025-12-20 04:09:40', '2025-12-20 04:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `ready_for_appointment` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `forget_password_token` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `is_banned` varchar(255) NOT NULL DEFAULT 'no',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `client_id`, `name`, `email`, `password`, `image`, `ready_for_appointment`, `email_verified_at`, `verification_token`, `forget_password_token`, `status`, `is_banned`, `remember_token`, `created_at`, `updated_at`) VALUES
(1000, '2107141535', 'Harold Lujan', 'client@gmail.com', '$2y$12$bP6zuRolacPZeUbyCaJ/veUZmdQ4WcZhHQLjQqfBEDQ1vQ0uy3Txm', NULL, 1, '2024-07-24 03:03:27', NULL, NULL, 'active', 'no', NULL, '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(1001, '2110265002', 'Oliver Ilva', 'client2@gmail.com', '$2y$12$0vGceF40tlyChMHZkTYo.uFbDrR/MrZGVT0par09AI.8WH.o3QZwe', NULL, 1, '2024-07-29 21:17:15', NULL, NULL, 'active', 'no', NULL, '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(1003, NULL, 'محمد أحمد (Test Client)', 'client@test.com', '$2y$12$B7WlY63/W2NA4oNzivYP9OvNsOYBm81jXCqrYym/bjgw7doV5bsg6', NULL, 0, '2025-12-28 11:46:14', NULL, NULL, 'active', 'no', 'rFhiIU3tOs4ItEOV7xMtaJwS2i0nNUVmOUL3qylApYl5GftWpeswsYkkTdxf', '2025-12-28 11:46:14', '2025-12-28 11:46:14'),
(1004, NULL, 'سارة خالد', 'sara@test.com', '$2y$12$gdeGWm6.XE2k0.nWg0.jn.oiKp1yWgcC1ACZlK89bsWWvYcaK7Dde', NULL, 0, '2025-12-28 11:46:15', NULL, NULL, 'active', 'no', NULL, '2025-12-28 11:46:15', '2025-12-28 11:46:15'),
(1005, NULL, 'أحمد علي', 'ahmed@test.com', '$2y$12$ZkK/cxaneju0zhc8j0knfeok6ZO4kWwga4zaSYiwjOXVFghZ2yidi', NULL, 0, '2025-12-28 11:46:15', NULL, NULL, 'active', 'no', NULL, '2025-12-28 11:46:15', '2025-12-28 11:46:15'),
(1006, NULL, 'ليلى محمود', 'laila@test.com', '$2y$12$1Yv8JsF73WXIiCpGHdGkMuxmXGpXvPKjWMYEXF2DoaRQWN4f3upfG', NULL, 0, '2025-12-28 11:46:15', NULL, NULL, 'active', 'no', NULL, '2025-12-28 11:46:15', '2025-12-28 11:46:15');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `guardian_name` varchar(255) DEFAULT NULL,
  `guardian_phone` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `date_of_birth` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `wallet_balance` decimal(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `phone`, `address`, `city`, `country`, `guardian_name`, `guardian_phone`, `occupation`, `age`, `date_of_birth`, `gender`, `wallet_balance`, `created_at`, `updated_at`) VALUES
(1, 1000, '111-222-3398', '3130 Bungalow Road Omaha, NE 68114', 'Omaha', 'USA', 'Robert Santiago', '111-222-3433', 'Student', '20', '2023-10-27', 'male', 0.00, '2025-12-20 04:09:33', '2025-12-20 04:09:33'),
(2, 1001, '125-985-4587', 'Hempstead', 'New York', 'USA', 'Benjamin Amelia', '125-985-4587', 'Teacher', '32', '1992-06-27', 'female', 0.00, '2025-12-20 04:09:33', '2025-12-20 04:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_methods`
--

CREATE TABLE `withdraw_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `min_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `max_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `withdraw_charge` decimal(8,2) NOT NULL DEFAULT 0.00,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdraw_methods`
--

INSERT INTO `withdraw_methods` (`id`, `name`, `min_amount`, `max_amount`, `withdraw_charge`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bank Payment', 10.00, 100.00, 10.00, '<p>Bank Name: Your bank name <br> Account Number:&nbsp; Your bank account number <br> Routing Number: Your bank routing number <br> Branch: Your bank branch name</p>', 'active', '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(2, 'Paypal', 5.00, 50.00, 5.00, '<p>Your Name <br> Your paypal email address <br> Your phone number</p>', 'active', '2025-12-20 04:09:40', '2025-12-20 04:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_requests`
--

CREATE TABLE `withdraw_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lawyer_id` bigint(20) UNSIGNED NOT NULL,
  `withdraw_method_id` bigint(20) UNSIGNED NOT NULL,
  `method` varchar(255) NOT NULL,
  `current_balance` decimal(8,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `withdraw_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `withdraw_charge` decimal(8,2) NOT NULL DEFAULT 0.00,
  `account_info` text NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `approved_date` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdraw_requests`
--

INSERT INTO `withdraw_requests` (`id`, `lawyer_id`, `withdraw_method_id`, `method`, `current_balance`, `total_amount`, `withdraw_amount`, `withdraw_charge`, `account_info`, `status`, `approved_date`, `created_at`, `updated_at`) VALUES
(1, 2, 2, '', 0.00, 50.00, 47.50, 5.00, '<p>Brac bank<br>1542234<br>120314<br>Dhaka</p>', 'approved', '2024-08-08 00:00:00', '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(2, 2, 1, '', 0.00, 100.00, 90.00, 10.00, '<p>Meghna bank<br>24835475255<br>245869<br>Dhanmondi</p>', 'pending', NULL, '2025-12-20 04:09:40', '2025-12-20 04:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `work_sections`
--

CREATE TABLE `work_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_sections`
--

INSERT INTO `work_sections` (`id`, `image`, `video`, `status`, `created_at`, `updated_at`) VALUES
(1, 'uploads/website-images/dummy/work-background.webp', 'https://www.youtube.com/watch?v=G07V0aOmWTI', 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `work_section_faqs`
--

CREATE TABLE `work_section_faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `work_section_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_section_faqs`
--

INSERT INTO `work_section_faqs` (`id`, `work_section_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(2, 1, 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(3, 1, 1, '2025-12-20 04:09:35', '2025-12-20 04:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `work_section_faq_translations`
--

CREATE TABLE `work_section_faq_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `work_section_faq_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_section_faq_translations`
--

INSERT INTO `work_section_faq_translations` (`id`, `work_section_faq_id`, `lang_code`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Who Are Our Clients?', 'Our clients include individuals, businesses, and organizations seeking expert legal advice and representation.', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(2, 1, 'ar', 'من هم عملاؤنا؟', 'عملاؤنا هم أفراد وشركات ومنظمات يبحثون عن استشارات قانونية وخدمات تمثيل قانوني موثوقة.', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(3, 2, 'en', 'When Is A Lawyer Available?', 'Our lawyers are available Monday to Friday, from 9:00 AM to 5:00 PM. Appointments can be scheduled in advance.', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(4, 2, 'ar', 'متى يتوفر المحامي؟', 'يتوفر محامونا من الاثنين إلى الجمعة، من الساعة 9:00 صباحًا حتى 5:00 مساءً. يمكن تحديد المواعيد مسبقًا.', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(5, 3, 'en', 'How Do I Register In This System?', 'You can register by filling out the online registration form on our website and verifying your email address.', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(6, 3, 'ar', 'كيف يمكنني التسجيل في هذا النظام؟', 'يمكنك التسجيل من خلال تعبئة نموذج التسجيل عبر الإنترنت على موقعنا الإلكتروني وتأكيد عنوان بريدك الإلكتروني.', '2025-12-20 04:09:35', '2025-12-20 04:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `work_section_translations`
--

CREATE TABLE `work_section_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `work_section_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_section_translations`
--

INSERT INTO `work_section_translations` (`id`, `work_section_id`, `lang_code`, `title`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Ensure Justice with Our Trusted Legal Support', '2025-12-20 04:09:35', '2025-12-20 04:09:35'),
(2, 1, 'ar', 'ضمان العدالة مع دعمنا القانوني الموثوق', '2025-12-20 04:09:35', '2025-12-20 04:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `zoom_credentials`
--

CREATE TABLE `zoom_credentials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lawyer_id` bigint(20) UNSIGNED NOT NULL,
  `zoom_account_id` text NOT NULL,
  `zoom_api_key` text NOT NULL,
  `zoom_api_secret` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zoom_credentials`
--

INSERT INTO `zoom_credentials` (`id`, `lawyer_id`, `zoom_account_id`, `zoom_api_key`, `zoom_api_secret`, `created_at`, `updated_at`) VALUES
(1, 1, 'zoom_account_id', 'zoom_api_key', 'zoom_api_secret', '2025-12-20 04:09:40', '2025-12-20 04:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `zoom_meetings`
--

CREATE TABLE `zoom_meetings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lawyer_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` int(11) NOT NULL DEFAULT 0,
  `topic` text NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `meeting_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `join_url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zoom_meetings`
--

INSERT INTO `zoom_meetings` (`id`, `lawyer_id`, `admin_id`, `topic`, `start_time`, `duration`, `meeting_id`, `password`, `join_url`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'Test', '2024-08-30 03:00:12', '60', '84537088774', '1644795877', 'https://us05web.zoom.us/j/84537088774?pwd=6eq0JsNwObdioZa6MwcTyyjLIT1fKl.1', '2025-12-20 04:09:40', '2025-12-20 04:09:40'),
(2, 1, 0, 'Test', '2024-08-08 10:16:32', '15', '88508347157', '1234413906', 'https://us05web.zoom.us/j/88508347157?pwd=Qp5ImbEfB3beaH91H63s5MuDNbYUfo.1', '2025-12-20 04:09:41', '2025-12-20 04:09:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us_pages`
--
ALTER TABLE `about_us_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `about_us_page_translations`
--
ALTER TABLE `about_us_page_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `about_us_page_translations_about_us_page_id_index` (`about_us_page_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_user_id_foreign` (`user_id`),
  ADD KEY `appointments_order_id_foreign` (`order_id`),
  ADD KEY `appointments_day_id_foreign` (`day_id`),
  ADD KEY `appointments_schedule_id_foreign` (`schedule_id`),
  ADD KEY `appointments_lawyer_id_foreign` (`lawyer_id`);

--
-- Indexes for table `banned_histories`
--
ALTER TABLE `banned_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `basic_payments`
--
ALTER TABLE `basic_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogs_admin_id_foreign` (`admin_id`),
  ADD KEY `1` (`blog_category_id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_category_translations`
--
ALTER TABLE `blog_category_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_translations`
--
ALTER TABLE `blog_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_infos`
--
ALTER TABLE `contact_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_info_translations`
--
ALTER TABLE `contact_info_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_info_translations_contact_info_id_foreign` (`contact_info_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversations_last_message_id_foreign` (`last_message_id`);

--
-- Indexes for table `counters`
--
ALTER TABLE `counters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counter_translations`
--
ALTER TABLE `counter_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customizable_page_translations`
--
ALTER TABLE `customizable_page_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customizable_page_translations_customizeable_page_id_index` (`customizeable_page_id`),
  ADD KEY `customizable_page_translations_lang_code_index` (`lang_code`);

--
-- Indexes for table `customizeable_pages`
--
ALTER TABLE `customizeable_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customizeable_pages_slug_unique` (`slug`);

--
-- Indexes for table `custom_addons`
--
ALTER TABLE `custom_addons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `custom_addons_name_index` (`name`),
  ADD KEY `idx_custom_addons_status` (`status`);

--
-- Indexes for table `custom_codes`
--
ALTER TABLE `custom_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_paginations`
--
ALTER TABLE `custom_paginations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `day_translations`
--
ALTER TABLE `day_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `day_translations_day_id_index` (`day_id`),
  ADD KEY `day_translations_lang_code_index` (`lang_code`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_faqs`
--
ALTER TABLE `department_faqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_faqs_department_id_foreign` (`department_id`);

--
-- Indexes for table `department_faq_translations`
--
ALTER TABLE `department_faq_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_images`
--
ALTER TABLE `department_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_images_department_id_foreign` (`department_id`);

--
-- Indexes for table `department_translations`
--
ALTER TABLE `department_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_videos`
--
ALTER TABLE `department_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_videos_department_id_foreign` (`department_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_appointment_id_foreign` (`appointment_id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faqs_faq_category_id_foreign` (`faq_category_id`);

--
-- Indexes for table `faq_categories`
--
ALTER TABLE `faq_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_category_translations`
--
ALTER TABLE `faq_category_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_pages`
--
ALTER TABLE `faq_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_translations`
--
ALTER TABLE `faq_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feature_translations`
--
ALTER TABLE `feature_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `languages_name_unique` (`name`),
  ADD UNIQUE KEY `languages_code_unique` (`code`);

--
-- Indexes for table `lawyers`
--
ALTER TABLE `lawyers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lawyers_email_unique` (`email`),
  ADD KEY `lawyers_department_id_foreign` (`department_id`),
  ADD KEY `lawyers_location_id_foreign` (`location_id`);

--
-- Indexes for table `lawyer_social_media`
--
ALTER TABLE `lawyer_social_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lawyer_social_media_lawyer_id_foreign` (`lawyer_id`);

--
-- Indexes for table `lawyer_translations`
--
ALTER TABLE `lawyer_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location_translations`
--
ALTER TABLE `location_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting_histories`
--
ALTER TABLE `meeting_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meeting_histories_lawyer_id_foreign` (`lawyer_id`),
  ADD KEY `meeting_histories_user_id_foreign` (`user_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `menu_item_translations`
--
ALTER TABLE `menu_item_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_item_translations_menu_item_id_foreign` (`menu_item_id`);

--
-- Indexes for table `menu_translations`
--
ALTER TABLE `menu_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_translations_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_conversation_id_foreign` (`conversation_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `multi_currencies`
--
ALTER TABLE `multi_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_letters`
--
ALTER TABLE `news_letters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `on_boarding_screens`
--
ALTER TABLE `on_boarding_screens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `on_boarding_screens_order_unique` (`order`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedules_day_id_foreign` (`day_id`),
  ADD KEY `schedules_lawyer_id_foreign` (`lawyer_id`);

--
-- Indexes for table `section_controls`
--
ALTER TABLE `section_controls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section_control_translations`
--
ALTER TABLE `section_control_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_control_translations_section_control_id_foreign` (`section_control_id`);

--
-- Indexes for table `seo_settings`
--
ALTER TABLE `seo_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_faqs`
--
ALTER TABLE `service_faqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_faqs_service_id_foreign` (`service_id`);

--
-- Indexes for table `service_faq_translations`
--
ALTER TABLE `service_faq_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_images`
--
ALTER TABLE `service_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_images_service_id_foreign` (`service_id`);

--
-- Indexes for table `service_translations`
--
ALTER TABLE `service_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_videos`
--
ALTER TABLE `service_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_videos_service_id_foreign` (`service_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_carts`
--
ALTER TABLE `shopping_carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shopping_carts_user_id_foreign` (`user_id`),
  ADD KEY `shopping_carts_lawyer_id_foreign` (`lawyer_id`),
  ADD KEY `shopping_carts_department_id_foreign` (`department_id`),
  ADD KEY `shopping_carts_schedule_id_foreign` (`schedule_id`),
  ADD KEY `shopping_carts_location_id_foreign` (`location_id`),
  ADD KEY `shopping_carts_day_id_foreign` (`day_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socialite_credentials`
--
ALTER TABLE `socialite_credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriber_contents`
--
ALTER TABLE `subscriber_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriber_content_translations`
--
ALTER TABLE `subscriber_content_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriber_content_translations_subscriber_content_id_foreign` (`subscriber_content_id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonial_translations`
--
ALTER TABLE `testimonial_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `testimonial_translations_testimonial_id_index` (`testimonial_id`),
  ADD KEY `testimonial_translations_lang_code_index` (`lang_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_requests`
--
ALTER TABLE `withdraw_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `withdraw_requests_lawyer_id_foreign` (`lawyer_id`),
  ADD KEY `withdraw_requests_withdraw_method_id_foreign` (`withdraw_method_id`);

--
-- Indexes for table `work_sections`
--
ALTER TABLE `work_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_section_faqs`
--
ALTER TABLE `work_section_faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_section_faq_translations`
--
ALTER TABLE `work_section_faq_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_section_translations`
--
ALTER TABLE `work_section_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `work_section_translations_work_section_id_foreign` (`work_section_id`);

--
-- Indexes for table `zoom_credentials`
--
ALTER TABLE `zoom_credentials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zoom_credentials_lawyer_id_foreign` (`lawyer_id`);

--
-- Indexes for table `zoom_meetings`
--
ALTER TABLE `zoom_meetings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zoom_meetings_lawyer_id_foreign` (`lawyer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us_pages`
--
ALTER TABLE `about_us_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `about_us_page_translations`
--
ALTER TABLE `about_us_page_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `banned_histories`
--
ALTER TABLE `banned_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `basic_payments`
--
ALTER TABLE `basic_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blog_category_translations`
--
ALTER TABLE `blog_category_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `blog_translations`
--
ALTER TABLE `blog_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `configurations`
--
ALTER TABLE `configurations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_infos`
--
ALTER TABLE `contact_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_info_translations`
--
ALTER TABLE `contact_info_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `counters`
--
ALTER TABLE `counters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `counter_translations`
--
ALTER TABLE `counter_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customizable_page_translations`
--
ALTER TABLE `customizable_page_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customizeable_pages`
--
ALTER TABLE `customizeable_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `custom_addons`
--
ALTER TABLE `custom_addons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_codes`
--
ALTER TABLE `custom_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_paginations`
--
ALTER TABLE `custom_paginations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `day_translations`
--
ALTER TABLE `day_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `department_faqs`
--
ALTER TABLE `department_faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `department_faq_translations`
--
ALTER TABLE `department_faq_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `department_images`
--
ALTER TABLE `department_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `department_translations`
--
ALTER TABLE `department_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `department_videos`
--
ALTER TABLE `department_videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `faq_categories`
--
ALTER TABLE `faq_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faq_category_translations`
--
ALTER TABLE `faq_category_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `faq_pages`
--
ALTER TABLE `faq_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faq_translations`
--
ALTER TABLE `faq_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feature_translations`
--
ALTER TABLE `feature_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lawyers`
--
ALTER TABLE `lawyers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `lawyer_social_media`
--
ALTER TABLE `lawyer_social_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `lawyer_translations`
--
ALTER TABLE `lawyer_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `location_translations`
--
ALTER TABLE `location_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `meeting_histories`
--
ALTER TABLE `meeting_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `menu_item_translations`
--
ALTER TABLE `menu_item_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `menu_translations`
--
ALTER TABLE `menu_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `multi_currencies`
--
ALTER TABLE `multi_currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `news_letters`
--
ALTER TABLE `news_letters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `on_boarding_screens`
--
ALTER TABLE `on_boarding_screens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=332;

--
-- AUTO_INCREMENT for table `section_controls`
--
ALTER TABLE `section_controls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `section_control_translations`
--
ALTER TABLE `section_control_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `seo_settings`
--
ALTER TABLE `seo_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `service_faqs`
--
ALTER TABLE `service_faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `service_faq_translations`
--
ALTER TABLE `service_faq_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `service_images`
--
ALTER TABLE `service_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `service_translations`
--
ALTER TABLE `service_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `service_videos`
--
ALTER TABLE `service_videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `shopping_carts`
--
ALTER TABLE `shopping_carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `socialite_credentials`
--
ALTER TABLE `socialite_credentials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscriber_contents`
--
ALTER TABLE `subscriber_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscriber_content_translations`
--
ALTER TABLE `subscriber_content_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `testimonial_translations`
--
ALTER TABLE `testimonial_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1007;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `withdraw_requests`
--
ALTER TABLE `withdraw_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `work_sections`
--
ALTER TABLE `work_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `work_section_faqs`
--
ALTER TABLE `work_section_faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `work_section_faq_translations`
--
ALTER TABLE `work_section_faq_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `work_section_translations`
--
ALTER TABLE `work_section_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `zoom_credentials`
--
ALTER TABLE `zoom_credentials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `zoom_meetings`
--
ALTER TABLE `zoom_meetings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_day_id_foreign` FOREIGN KEY (`day_id`) REFERENCES `days` (`id`),
  ADD CONSTRAINT `appointments_lawyer_id_foreign` FOREIGN KEY (`lawyer_id`) REFERENCES `lawyers` (`id`),
  ADD CONSTRAINT `appointments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`),
  ADD CONSTRAINT `appointments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `1` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_categories` (`id`),
  ADD CONSTRAINT `blogs_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contact_info_translations`
--
ALTER TABLE `contact_info_translations`
  ADD CONSTRAINT `contact_info_translations_contact_info_id_foreign` FOREIGN KEY (`contact_info_id`) REFERENCES `contact_infos` (`id`);

--
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversations_last_message_id_foreign` FOREIGN KEY (`last_message_id`) REFERENCES `messages` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `department_faqs`
--
ALTER TABLE `department_faqs`
  ADD CONSTRAINT `department_faqs_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `department_images`
--
ALTER TABLE `department_images`
  ADD CONSTRAINT `department_images_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `department_videos`
--
ALTER TABLE `department_videos`
  ADD CONSTRAINT `department_videos_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `faqs`
--
ALTER TABLE `faqs`
  ADD CONSTRAINT `faqs_faq_category_id_foreign` FOREIGN KEY (`faq_category_id`) REFERENCES `faq_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lawyers`
--
ALTER TABLE `lawyers`
  ADD CONSTRAINT `lawyers_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `lawyers_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`);

--
-- Constraints for table `lawyer_social_media`
--
ALTER TABLE `lawyer_social_media`
  ADD CONSTRAINT `lawyer_social_media_lawyer_id_foreign` FOREIGN KEY (`lawyer_id`) REFERENCES `lawyers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meeting_histories`
--
ALTER TABLE `meeting_histories`
  ADD CONSTRAINT `meeting_histories_lawyer_id_foreign` FOREIGN KEY (`lawyer_id`) REFERENCES `lawyers` (`id`),
  ADD CONSTRAINT `meeting_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_item_translations`
--
ALTER TABLE `menu_item_translations`
  ADD CONSTRAINT `menu_item_translations_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu_translations`
--
ALTER TABLE `menu_translations`
  ADD CONSTRAINT `menu_translations_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_day_id_foreign` FOREIGN KEY (`day_id`) REFERENCES `days` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `schedules_lawyer_id_foreign` FOREIGN KEY (`lawyer_id`) REFERENCES `lawyers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `section_control_translations`
--
ALTER TABLE `section_control_translations`
  ADD CONSTRAINT `section_control_translations_section_control_id_foreign` FOREIGN KEY (`section_control_id`) REFERENCES `section_controls` (`id`);

--
-- Constraints for table `service_faqs`
--
ALTER TABLE `service_faqs`
  ADD CONSTRAINT `service_faqs_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `service_images`
--
ALTER TABLE `service_images`
  ADD CONSTRAINT `service_images_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `service_videos`
--
ALTER TABLE `service_videos`
  ADD CONSTRAINT `service_videos_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `shopping_carts`
--
ALTER TABLE `shopping_carts`
  ADD CONSTRAINT `shopping_carts_day_id_foreign` FOREIGN KEY (`day_id`) REFERENCES `days` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shopping_carts_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shopping_carts_lawyer_id_foreign` FOREIGN KEY (`lawyer_id`) REFERENCES `lawyers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shopping_carts_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shopping_carts_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shopping_carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subscriber_content_translations`
--
ALTER TABLE `subscriber_content_translations`
  ADD CONSTRAINT `subscriber_content_translations_subscriber_content_id_foreign` FOREIGN KEY (`subscriber_content_id`) REFERENCES `subscriber_contents` (`id`);

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `withdraw_requests`
--
ALTER TABLE `withdraw_requests`
  ADD CONSTRAINT `withdraw_requests_lawyer_id_foreign` FOREIGN KEY (`lawyer_id`) REFERENCES `lawyers` (`id`),
  ADD CONSTRAINT `withdraw_requests_withdraw_method_id_foreign` FOREIGN KEY (`withdraw_method_id`) REFERENCES `withdraw_methods` (`id`);

--
-- Constraints for table `work_section_translations`
--
ALTER TABLE `work_section_translations`
  ADD CONSTRAINT `work_section_translations_work_section_id_foreign` FOREIGN KEY (`work_section_id`) REFERENCES `work_sections` (`id`);

--
-- Constraints for table `zoom_credentials`
--
ALTER TABLE `zoom_credentials`
  ADD CONSTRAINT `zoom_credentials_lawyer_id_foreign` FOREIGN KEY (`lawyer_id`) REFERENCES `lawyers` (`id`);

--
-- Constraints for table `zoom_meetings`
--
ALTER TABLE `zoom_meetings`
  ADD CONSTRAINT `zoom_meetings_lawyer_id_foreign` FOREIGN KEY (`lawyer_id`) REFERENCES `lawyers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
