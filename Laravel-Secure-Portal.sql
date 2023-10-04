-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 03, 2023 at 09:08 AM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Laravel-Secure-Portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE `blocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` mediumtext COLLATE utf8mb4_unicode_ci,
  `component_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_on_pages` text COLLATE utf8mb4_unicode_ci,
  `display_style` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`id`, `name`, `body`, `component_name`, `controller_name`, `controller_method`, `show_on_pages`, `display_style`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Footer contacts', '<div class=\"pb-2\">\n    <div class=\"\">\n        <div class=\"mb-4\">\n            <h4 class=\"title\">\n                Contact\n            </h4>\n            <div>\n                Address: \n                The EAAACA Secretariat, Jubilee Insurance Centre, Plot 14,Parliament Avenue, P.O.BOX 12274, Kampala(Uganda)\n            </div>\n        </div>\n        <div class=\"\">\n            <div>\n                Tel:\n                <a href=\"tel: +256414346185\">\n                    +256414346185 \n                </a>\n            </div>\n            <div>\n                Fax:\n                <a href=\"tel:+256414346185\">\n                    +256414346185\n                </a>\n            </div>\n            <div>\n                Email:\n                <a href=\"mailto:arineasecretariat@eaaaca.org\">\n                    arineasecretariat@eaaaca.org\n                </a>\n            </div>\n        </div>\n    </div>\n</div>', NULL, NULL, NULL, '*', NULL, NULL, NULL, '2022-02-23 19:55:46', '2023-06-24 12:28:14'),
(2, 'Latest news', NULL, NULL, 'Modules\\Block\\Http\\Controllers\\CustomBlocksController', 'latestNews', 'news.show', NULL, NULL, NULL, '2022-02-25 12:22:31', '2022-02-28 12:57:41'),
(4, 'Front Slider', NULL, 'FrontSlider', 'Modules\\Block\\Http\\Controllers\\CustomBlocksController', 'frontSlider', '/', NULL, NULL, NULL, '2022-02-28 13:33:17', '2022-04-21 17:51:37'),
(5, 'ContactForm', NULL, 'ContactForm', NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-28 21:06:08', '2022-02-28 21:06:08');

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `organization_id` bigint(20) UNSIGNED NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `approved_date` datetime DEFAULT NULL,
  `approved_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cases`
--

INSERT INTO `cases` (`id`, `reference_number`, `date_created`, `description`, `organization_id`, `approved`, `approved_date`, `approved_by_id`, `status_id`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'C01001-20|09|2022', '2022-09-01 10:00:00', '<p>This is the first case! Wow</p>', 1, 0, NULL, NULL, NULL, 1, NULL, '2023-02-26 21:01:00', '2023-06-25 16:12:23'),
(2, 'C01002-20|12|2022', '2022-12-20 15:21:00', 'Case description goes here', 1, 0, NULL, NULL, NULL, 1, NULL, NULL, '2023-06-24 12:21:36'),
(4, 'C01042-20|12|2023', '2023-06-24 15:58:56', '<p>Case three description goes here</p>', 2, 0, NULL, NULL, NULL, 1, NULL, '2023-06-16 03:59:39', '2023-06-24 12:58:56'),
(5, '2023/07/30-003', '2023-07-31 14:44:36', NULL, 4, 0, NULL, NULL, NULL, 3, NULL, '2023-07-31 11:44:36', '2023-07-31 11:44:36');

-- --------------------------------------------------------

--
-- Table structure for table `case_contributors`
--

CREATE TABLE `case_contributors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `case_id` bigint(20) UNSIGNED NOT NULL,
  `contact_point_id` bigint(20) UNSIGNED NOT NULL,
  `is_inactive` tinyint(1) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `case_contributors`
--

INSERT INTO `case_contributors` (`id`, `case_id`, `contact_point_id`, `is_inactive`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, 1, 2, NULL, NULL, NULL, '2023-05-13 12:36:31', '2023-05-13 12:36:31'),
(4, 1, 1, NULL, NULL, NULL, '2023-05-13 22:29:13', '2023-05-13 22:29:13');

-- --------------------------------------------------------

--
-- Table structure for table `case_coordinators`
--

CREATE TABLE `case_coordinators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `case_id` bigint(20) UNSIGNED NOT NULL,
  `contact_point_id` bigint(20) UNSIGNED NOT NULL,
  `is_inactive` tinyint(1) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `case_coordinators`
--

INSERT INTO `case_coordinators` (`id`, `case_id`, `contact_point_id`, `is_inactive`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL, NULL, '2023-05-13 22:28:59', '2023-05-13 22:28:59');

-- --------------------------------------------------------

--
-- Table structure for table `case_findings`
--

CREATE TABLE `case_findings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `findings` text COLLATE utf8mb4_unicode_ci,
  `case_investigation_id` bigint(20) UNSIGNED NOT NULL,
  `date_of_submission` datetime NOT NULL,
  `status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `case_findings`
--

INSERT INTO `case_findings` (`id`, `findings`, `case_investigation_id`, `date_of_submission`, `status_id`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '<p>I investigated the two institutions and found out that most of the</p>', 1, '2023-05-29 13:29:00', NULL, NULL, NULL, '2023-05-27 10:29:07', '2023-05-27 11:22:41'),
(2, '<p>kgi</p>', 6, '2023-06-24 22:41:00', NULL, NULL, NULL, '2023-06-25 19:41:22', '2023-06-25 19:41:51');

-- --------------------------------------------------------

--
-- Table structure for table `case_investigations`
--

CREATE TABLE `case_investigations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `case_id` bigint(20) UNSIGNED NOT NULL,
  `assigned_contributor_id` bigint(20) UNSIGNED NOT NULL,
  `assigned_on` datetime NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `case_investigations`
--

INSERT INTO `case_investigations` (`id`, `case_id`, `assigned_contributor_id`, `assigned_on`, `description`, `status_id`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '2023-04-25 13:16:00', '<p>This is the description <i>End of description</i></p>', NULL, NULL, NULL, '2023-05-20 18:53:24', '2023-06-26 07:01:55'),
(2, 1, 4, '2023-03-29 22:44:00', '<p>This&nbsp;</p>', NULL, NULL, NULL, '2023-05-20 19:44:46', '2023-06-24 09:21:02'),
(4, 2, 4, '2023-06-25 18:21:00', NULL, NULL, NULL, NULL, '2023-06-25 15:21:51', '2023-06-25 15:21:51'),
(6, 1, 4, '2023-06-25 18:44:25', NULL, NULL, NULL, NULL, '2023-06-25 15:44:25', '2023-06-25 15:44:25');

-- --------------------------------------------------------

--
-- Table structure for table `case_management`
--

CREATE TABLE `case_management` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `is_approved_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `case_management`
--

INSERT INTO `case_management` (`id`, `name`, `description`, `is_approved`, `is_approved_by_id`, `status_id`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'First case', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `case_types`
--

CREATE TABLE `case_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `case_types`
--

INSERT INTO `case_types` (`id`, `name`, `body`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Fraud', NULL, NULL, '2023-03-01 16:22:30', '2023-03-01 16:22:30'),
(2, 'Corruption', NULL, NULL, '2023-03-01 16:22:43', '2023-03-01 16:22:43'),
(3, 'Embezzlement', NULL, NULL, '2023-03-01 16:23:34', '2023-03-01 16:23:34');

-- --------------------------------------------------------

--
-- Table structure for table `commentables`
--

CREATE TABLE `commentables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL,
  `commentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `body`, `is_approved`, `parent_id`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Sample comment', 0, NULL, NULL, NULL, '2023-02-26 20:45:57', '2023-02-26 20:45:57');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `content_blog_posts`
--

CREATE TABLE `content_blog_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metatags` json DEFAULT NULL,
  `settings` json DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `content_events`
--

CREATE TABLE `content_events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `starting_date` datetime DEFAULT NULL,
  `ending_date` datetime DEFAULT NULL,
  `location` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metatags` json DEFAULT NULL,
  `settings` json DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `content_events`
--

INSERT INTO `content_events` (`id`, `title`, `starting_date`, `ending_date`, `location`, `body`, `slug`, `metatags`, `settings`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'ARINs TALK EXTENSION  Jun 29-Jun 29,', '2021-06-29 00:00:00', '2021-06-29 00:00:00', '5638 Jude Crescent\nNorth Ocie, ND 42099-1215', NULL, 'ut-voluptas-tempora-alias-nam', NULL, NULL, 1, NULL, '2022-02-28 09:16:00', '2023-01-19 03:17:49'),
(2, 'Asset Management Forum West Balkans and Latin America  Sep 21-Sep 22,', '2020-09-21 00:00:00', '2020-09-22 00:00:00', '338 Ike Wells Suite 328\nLemuelborough, RI 61470', NULL, 'non-ut-voluptatem-molestiae', NULL, NULL, 1, NULL, '2022-02-28 09:16:00', '2023-01-19 03:16:52'),
(3, 'Regional Training Webinar: Asset Recovery Frameworks, Standards and Tools  May 17-May 21,', NULL, NULL, '', NULL, 'regional-training-webinar-asset-recovery-frameworks-standards-and-tools-may-17-may-21', NULL, NULL, 1, NULL, '2023-01-19 03:18:07', '2023-01-19 03:18:07'),
(4, 'ARINS TALK  May 04-May 04,', NULL, NULL, '', NULL, 'arins-talk-may-04-may-04', NULL, NULL, 1, NULL, '2023-01-19 03:18:22', '2023-01-19 03:18:22');

-- --------------------------------------------------------

--
-- Table structure for table `content_featureds`
--

CREATE TABLE `content_featureds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metatags` json DEFAULT NULL,
  `settings` json DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `content_featureds`
--

INSERT INTO `content_featureds` (`id`, `title`, `body`, `slug`, `metatags`, `settings`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(6, 'Slider 3', '<p></p>', 'commodi-sed-sequi-in-ut-animi-cumque', NULL, NULL, 1, NULL, '2022-02-28 09:16:00', '2023-01-19 03:12:01'),
(7, 'Slider 2', '<p></p>', 'beatae-repellendus-debitis-quia', NULL, NULL, 1, NULL, '2022-02-28 09:16:00', '2023-01-19 03:11:53'),
(8, 'Slider 1', '<p></p>', 'officiis-officia-rem-dolor-qui-id', NULL, NULL, 2, NULL, '2022-02-28 09:16:00', '2023-01-19 03:11:45');

-- --------------------------------------------------------

--
-- Table structure for table `content_galleries`
--

CREATE TABLE `content_galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metatags` json DEFAULT NULL,
  `settings` json DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `content_news`
--

CREATE TABLE `content_news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metatags` json DEFAULT NULL,
  `settings` json DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `content_news`
--

INSERT INTO `content_news` (`id`, `title`, `body`, `slug`, `metatags`, `settings`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(12, 'Supreme Audit Institutions act against corruption with Anti-Corruption Authorities', '<p>On 31st March and 1st April 2022, representatives from the African Organization of English-speaking Supreme Audit Institutions in Africa (AFROSAI-E) and the East African Association of Anti-Corruption Authorities (EAAACA) met in Pretoria, South Africa. The two organizations met for a planning workshop supported by GIZ- Good Financial Governance in Africa Programme, commissioned by the German Federal Ministry of Economic Cooperation and Development. The programme is also co-funded by the European Union and Ministry for Foreign Affairs of Finland in the project “Fighting Illicit Financial Flows in Africa”. The meeting objective is to strengthen the collaboration between Supreme Audit Institutions (SAIs) and Anti-Corruption Authorities (ACAs). The enhanced collaboration between the two accountability actors at a national level is seen as a critical enabler in the fight against corruption.</p>', 'ratione-provident-suscipit-alias-nobis-soluta-odio', NULL, NULL, 2, NULL, '2022-02-28 09:16:00', '2023-01-19 04:24:35'),
(13, 'ARIN-EA elects the New president', '<p>20.11.2019: The Asset Recovery Network for Eastern Africa has elected attn. Lillian William Kafiti as the new president for the Association. she has replaced Head of Legal Affairs at the Inspectorate of Government Uganda. The New president is from Preventing and Combating of Corruption Bureau Tanzania</p>', 'sed-odio-quam-maxime-omnis-aliquam-magni-molestias', NULL, NULL, 1, NULL, '2022-02-28 09:16:00', '2023-01-19 04:22:31'),
(14, 'EACC obtains orders freezing Sh952m assets linked to Coast parastatal manager', '<p>The EACC&nbsp; has obtained interim orders freezing Sh952 million assets linked to a Kerra Coast regional manager.</p><p>In a media brief, the anti-graft agency said it had instituted a forfeiture suit against Eng Benson Muteti Masila, the Coast regional manager at Kenya Rural Roads Authority, and six others.</p><p>It said the court, through Justice James Wakiaga, on July 30, 2021 issued interim orders forestalling any dealings in the assets until the interlocutory application is heard and determined.</p><p>The court also issued an order of injunction restraining the respondents, their agents, servants, and/or any other persons from selling, transferring, charging, or further charging, leasing, developing, subdividing, &nbsp;disposing of the properties in question.</p><p>The EACC said it is seeking to forfeit unexplained assets worth Sh952,363,824.99 acquired between February 2009 and December 2018.</p><p>The assets being sought include Sh597.4 million from Masila and Sh80.7 million from his wife Zipporah Mwongeli Muteti.</p><p>Other assets sought are from companies linked to Masila as follows; Mumbe Junior Academy Limited (Sh174.8 million);&nbsp;Mumbe Boys High School Limited (Sh2,06 million), Mumbe Girls High School Limited (Sh17.8 million) and Mumbe Hardware and Suppliers Limited (Sh794 million)</p><p>The Anti-graft agency said cumulatively, the unexplained wealth comprises bank and M-Pesa deposits amounting to Sh567.6 million, landed properties valued at Sh347 million, motor vehicles valued at Sh5.3 million, listed shares valued at Sh2.2 million and insurance policies with a maturity value of Sh30.1 million.</p><p>EACC said in its application to the court that it&nbsp;received information that Muteti (the first respondent in the case), routinely demanded and received bribes and kickbacks from contractors awarded tenders for the supply of goods, and services in the Coast region.</p><p>\"Investigations established that the 1st respondent&nbsp;&nbsp; took undue advantage of his position of trust to confer benefit to himself through awarding several tenders to Skai Kenya Limited (the 7th respondent), a company directly associated with him through his brother,\" EACC said.</p>', 'facilis-provident-nihil-provident-recusandae', NULL, NULL, 2, NULL, '2022-02-28 09:16:00', '2023-01-19 04:19:02'),
(15, 'The 5TH ARIN-EA AGM held in Kampala', NULL, 'ab-et-minus-numquam-fugit-recusandae-voluptas', NULL, NULL, 2, NULL, '2022-02-28 09:16:00', '2023-01-19 04:15:49');

-- --------------------------------------------------------

--
-- Table structure for table `content_our_works`
--

CREATE TABLE `content_our_works` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `introduction_text` text COLLATE utf8mb4_unicode_ci,
  `body` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metatags` json DEFAULT NULL,
  `settings` json DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `content_pages`
--

CREATE TABLE `content_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `introduction_text` text COLLATE utf8mb4_unicode_ci,
  `body` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metatags` json DEFAULT NULL,
  `settings` json DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `content_pages`
--

INSERT INTO `content_pages` (`id`, `title`, `introduction_text`, `body`, `slug`, `metatags`, `settings`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Home', NULL, NULL, 'home', NULL, NULL, 1, NULL, '2022-02-28 09:16:49', '2022-03-19 12:23:29'),
(2, 'About ARIN-EA', 'Asset Recovery Inter-Agency Network for Eastern Africa', NULL, 'about-us', NULL, NULL, 1, NULL, '2022-02-28 09:16:49', '2023-01-19 03:23:50'),
(3, 'Contact', 'Have us call you', NULL, 'contact', NULL, NULL, 1, NULL, '2022-02-28 09:16:49', '2022-02-28 20:59:57'),
(4, 'Terms of Service', NULL, NULL, 'terms-of-service', NULL, NULL, 1, NULL, '2022-02-28 09:16:49', '2022-03-19 12:22:55'),
(5, 'Privacy Policy', NULL, NULL, 'privacy-policy', NULL, NULL, 1, NULL, '2022-02-28 09:16:49', '2022-03-19 12:23:10');

-- --------------------------------------------------------

--
-- Table structure for table `content_publications`
--

CREATE TABLE `content_publications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metatags` json DEFAULT NULL,
  `settings` json DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `content_publications`
--

INSERT INTO `content_publications` (`id`, `title`, `body`, `slug`, `metatags`, `settings`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(6, 'ARIN-EA ARUSHA TRAINING FINAL REPORT', NULL, 'et-quis-neque-hic-asperiores-placeat', NULL, NULL, 1, NULL, '2022-02-28 09:16:00', '2023-01-19 03:15:17'),
(7, 'Bernard\' 2016', NULL, 'vitae-quidem-autem-nihil-et', NULL, NULL, 1, NULL, '2022-02-28 09:16:00', '2023-01-19 03:14:56'),
(8, 'ARINEA STATEMENT OF INTENT', NULL, 'pariatur-omnis-delectus-similique', NULL, NULL, 1, NULL, '2022-02-28 09:16:00', '2023-01-19 03:14:23');

-- --------------------------------------------------------

--
-- Table structure for table `content_services`
--

CREATE TABLE `content_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `introduction_text` text COLLATE utf8mb4_unicode_ci,
  `body` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metatags` json DEFAULT NULL,
  `settings` json DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `content_testimonies`
--

CREATE TABLE `content_testimonies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `testimony` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metatags` json DEFAULT NULL,
  `settings` json DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `body`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Uganda', NULL, NULL, '2023-03-01 17:15:13', '2023-03-01 17:15:13');

-- --------------------------------------------------------

--
-- Table structure for table `countryables`
--

CREATE TABLE `countryables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `countryable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `countryable_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_to` text COLLATE utf8mb4_unicode_ci,
  `email_cc` text COLLATE utf8mb4_unicode_ci,
  `email_bc` text COLLATE utf8mb4_unicode_ci,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `email_from`, `email_to`, `email_cc`, `email_bc`, `subject`, `body`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'mulongokato.2000@gmail.com', 'mulongokato.2000@gmail.com', NULL, NULL, 'Reminder for our upcoming training', '<p>Dear All,</p><p>I hope this finds you well. This email is to serve as a kind reminder to you all about our upcoming training scheduled on …</p>', 1, NULL, '2023-03-01 17:06:24', '2023-03-01 17:06:24');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `field_blocks`
--

CREATE TABLE `field_blocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fieldable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fieldable_id` bigint(20) UNSIGNED NOT NULL,
  `block_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `styles` json DEFAULT NULL,
  `attributes` json DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `field_blocks`
--

INSERT INTO `field_blocks` (`id`, `fieldable_type`, `fieldable_id`, `block_id`, `user_id`, `position`, `styles`, `attributes`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Modules\\Layout\\Entities\\LayoutSectionTop', 1, 4, 1, '1', NULL, NULL, NULL, '2022-02-28 13:33:51', '2022-03-26 13:31:41'),
(3, 'Modules\\Layout\\Entities\\LayoutColumn', 13, 5, 1, '1', NULL, NULL, NULL, '2022-02-28 21:07:06', '2022-02-28 21:07:06');

-- --------------------------------------------------------

--
-- Table structure for table `field_htmls`
--

CREATE TABLE `field_htmls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fieldable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fieldable_id` bigint(20) UNSIGNED NOT NULL,
  `body` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `styles` json DEFAULT NULL,
  `attributes` json DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `field_htmls`
--

INSERT INTO `field_htmls` (`id`, `fieldable_type`, `fieldable_id`, `body`, `user_id`, `position`, `styles`, `attributes`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 'Modules\\Layout\\Entities\\LayoutColumn', 14, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d127672.26943277652!2d32.586578!3d0.313962!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x366c20406acee7b0!2sInspectorate%20of%20Government%20-%20Headquaters!5e0!3m2!1sen!2sug!4v1674100467195!5m2!1sen!2sug\" width=\"100%\" height=\"350\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 1, '2', NULL, '[{\"key\": \"class\", \"value\": \"border rounded\"}]', NULL, '2022-02-28 21:12:47', '2023-01-19 03:55:05');

-- --------------------------------------------------------

--
-- Table structure for table `field_images`
--

CREATE TABLE `field_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fieldable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fieldable_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `styles` json DEFAULT NULL,
  `attributes` json DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `field_images`
--

INSERT INTO `field_images` (`id`, `fieldable_type`, `fieldable_id`, `user_id`, `position`, `styles`, `attributes`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 'Modules\\Layout\\Entities\\LayoutColumn', 9, 1, 'undefined', NULL, NULL, NULL, '2023-01-19 03:27:29', '2023-01-19 03:27:29');

-- --------------------------------------------------------

--
-- Table structure for table `field_links`
--

CREATE TABLE `field_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fieldable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fieldable_id` bigint(20) UNSIGNED NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_text` text COLLATE utf8mb4_unicode_ci,
  `apply_link_to` set('wrap','title','image','text','link_text') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `styles` json DEFAULT NULL,
  `attributes` json DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `field_texts`
--

CREATE TABLE `field_texts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fieldable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fieldable_id` bigint(20) UNSIGNED NOT NULL,
  `body` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `styles` json DEFAULT NULL,
  `attributes` json DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `field_texts`
--

INSERT INTO `field_texts` (`id`, `fieldable_type`, `fieldable_id`, `body`, `user_id`, `position`, `styles`, `attributes`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, 'Modules\\Layout\\Entities\\LayoutColumn', 8, '<p>ARIN-EA was conceptualized on 4th July 2013 at a side event during the 4th Global focal Point Meeting on Asset recovery held in Bangkok, Thailand. The network was launched with the support of StAR Initiative/World Bank of 6th November 2013 in Kigali, Rwanda during the 7th East African Association of Anti-Corruption Authorities (EAAACA) Annual General Meeting (AGM).&nbsp;</p><p>ARIN-EA is the first informal network of practitioners in the Eastern Africa Region to tackle the proceeds of all crime. Creating such an innovative network will increase the possibility of stopping criminals from enjoying the illegally acquired wealth.</p>', 1, '2', NULL, NULL, NULL, '2022-02-28 20:54:29', '2023-01-19 03:26:50'),
(4, 'Modules\\Layout\\Entities\\LayoutColumn', 10, '<h4>Visit us</h4><p>Jubilee Insurance Centre, Plot 14, Parliament Avenue, Kampala(Uganda)</p>', 1, '1', NULL, NULL, NULL, '2022-02-28 21:01:35', '2023-01-19 03:50:15'),
(5, 'Modules\\Layout\\Entities\\LayoutColumn', 11, '<h4>Call us</h4><p><a href=\"+256414346185\">+256 414346185</a></p>', 1, '1', NULL, NULL, NULL, '2022-02-28 21:02:46', '2023-01-19 03:51:17'),
(6, 'Modules\\Layout\\Entities\\LayoutColumn', 12, '<h4>Email us</h4><p><a href=\"mailto:arineasecretariat@eaaaca.org\">arineasecretariat@eaaaca.org</a></p>', 1, '1', NULL, NULL, NULL, '2022-02-28 21:04:13', '2023-01-19 03:51:57'),
(7, 'Modules\\Layout\\Entities\\LayoutColumn', 3, '<p>ARIN-EA stands for Asset Recovery Inter-Agency Network for Eastern Africa. ARIN-EA is an informal network which aims at informal exchange of information on individuals, assets and companies, at the regional and international level so as to facilitate the effective tracing and recovery of proceeds of crime and deprive criminals of their illicit gains.&nbsp;</p><p>ARIN-EA recognizes the need to promote cooperation at the regional level as well as in international to effectively track/race and recover stolen assets within and beyond the territorial boundaries of Eastern Africa, in collaboration with relevant partners.</p>', 1, '2', NULL, '[{\"key\": \"class\", \"value\": \"text-center font-size-x\"}]', NULL, '2022-03-26 13:58:38', '2023-01-19 03:12:56'),
(8, 'Modules\\Layout\\Entities\\LayoutColumn', 16, '<p>ARIN-EA stands for Asset Recovery Inter-Agency Network for Eastern Africa. ARIN-EA is an informal network which aims at informal exchange of information on individuals, assets and companies, at the regional and international level so as to facilitate the effective tracing and recovery of proceeds of crime and deprive criminals of their illicit gains.</p><p>ARIN-EA recognizes the need to promote cooperation at the regional level as well as in international to effectively track/race and recover stolen assets within and beyond the territorial boundaries of Eastern Africa, in collaboration with relevant partners.</p>', 1, '1', NULL, NULL, NULL, '2023-01-19 03:28:22', '2023-01-19 03:28:22');

-- --------------------------------------------------------

--
-- Table structure for table `field_titles`
--

CREATE TABLE `field_titles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fieldable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fieldable_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `styles` json DEFAULT NULL,
  `attributes` json DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `field_titles`
--

INSERT INTO `field_titles` (`id`, `fieldable_type`, `fieldable_id`, `title`, `user_id`, `position`, `styles`, `attributes`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Modules\\Layout\\Entities\\LayoutColumn', 1, 'Our Services', 1, '1', NULL, '[{\"key\": \"element\", \"value\": \"h2\"}, {\"key\": \"class\", \"value\": \"hhhh\"}, {\"key\": \"url\", \"value\": \"/services\"}]', NULL, '2022-02-28 14:17:38', '2022-04-23 07:43:10'),
(2, 'Modules\\Layout\\Entities\\LayoutColumn', 2, 'Latest News', 1, '1', NULL, '[{\"key\": \"element\", \"value\": \"h3\"}, {\"key\": \"class\", \"value\": \"text-center\"}]', NULL, '2022-02-28 14:21:26', '2023-01-19 03:20:27'),
(5, 'Modules\\Layout\\Entities\\LayoutColumn', 14, 'Get directions', 1, '1', NULL, '[{\"key\": \"element\", \"value\": \"h3\"}, {\"key\": \"class\", \"value\": \"text-center pb-4\"}]', NULL, '2022-02-28 21:14:21', '2022-02-28 21:16:05'),
(6, 'Modules\\Layout\\Entities\\LayoutColumn', 3, 'About ARIN-EA', 1, '1', NULL, '[{\"key\": \"element\", \"value\": \"h2\"}, {\"key\": \"class\", \"value\": \"text-center pb-2\"}]', NULL, '2022-03-26 13:58:13', '2023-01-19 03:12:31'),
(7, 'Modules\\Layout\\Entities\\LayoutColumn', 8, 'Establishment', 1, '2', NULL, '[{\"key\": \"element\", \"value\": \"h3\"}]', NULL, '2023-01-19 03:26:25', '2023-01-19 03:26:25');

-- --------------------------------------------------------

--
-- Table structure for table `forum_categories`
--

CREATE TABLE `forum_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forum_categories`
--

INSERT INTO `forum_categories` (`id`, `name`, `body`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Forum Category One', NULL, NULL, '2023-03-01 16:02:20', '2023-03-01 16:03:48'),
(2, 'Forum Category Two', NULL, NULL, '2023-03-01 16:04:09', '2023-03-01 16:04:09');

-- --------------------------------------------------------

--
-- Table structure for table `forum_topics`
--

CREATE TABLE `forum_topics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `forum_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forum_topics`
--

INSERT INTO `forum_topics` (`id`, `title`, `forum_category_id`, `body`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'IT in combating corruption', 2, '<p>How can we best combat corruption using currently available tools, in this ever changing technological world. Here are the most recommended tools.</p>', 1, NULL, '2023-03-01 16:40:38', '2023-03-01 16:40:38');

-- --------------------------------------------------------

--
-- Table structure for table `informationrequest_informationrestriction`
--

CREATE TABLE `informationrequest_informationrestriction` (
  `information_request_id` bigint(20) UNSIGNED NOT NULL,
  `information_restriction_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `informationrequest_informationrestriction`
--

INSERT INTO `informationrequest_informationrestriction` (`information_request_id`, `information_restriction_id`) VALUES
(1, 4),
(1, 1),
(1, 2),
(2, 4),
(6, 2),
(7, 4),
(8, 1),
(9, 2),
(10, 1),
(3, 2),
(11, 1),
(13, 1),
(14, 1),
(14, 2);

-- --------------------------------------------------------

--
-- Table structure for table `informationrequest_natureofoffence`
--

CREATE TABLE `informationrequest_natureofoffence` (
  `information_request_id` bigint(20) UNSIGNED NOT NULL,
  `nature_of_offence_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `informationrequest_natureofoffence`
--

INSERT INTO `informationrequest_natureofoffence` (`information_request_id`, `nature_of_offence_id`) VALUES
(1, 1),
(1, 6),
(1, 8),
(1, 13),
(1, 14),
(1, 15),
(1, 11),
(1, 12),
(1, 9),
(2, 8),
(2, 15),
(6, 6),
(11, 2),
(12, 4),
(12, 6),
(12, 5),
(13, 1),
(13, 2),
(13, 3),
(14, 1),
(14, 8);

-- --------------------------------------------------------

--
-- Table structure for table `information_requests`
--

CREATE TABLE `information_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organization_id` bigint(20) UNSIGNED NOT NULL,
  `member_state_id` bigint(20) UNSIGNED NOT NULL,
  `date_time_of_request` datetime DEFAULT NULL,
  `request_reference_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `case_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type_of_crimes_investigated` mediumtext COLLATE utf8mb4_unicode_ci,
  `description_of_circumstances` mediumtext COLLATE utf8mb4_unicode_ci,
  `purpose_for_information_request` mediumtext COLLATE utf8mb4_unicode_ci,
  `connection_btw_information_request` mediumtext COLLATE utf8mb4_unicode_ci,
  `identity_of_the_persons` mediumtext COLLATE utf8mb4_unicode_ci,
  `reasons_tobe_in_member_state` mediumtext COLLATE utf8mb4_unicode_ci,
  `reason_for_request` text COLLATE utf8mb4_unicode_ci,
  `review_on` datetime DEFAULT NULL,
  `review_status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `review_notes` text COLLATE utf8mb4_unicode_ci,
  `review_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `information_requests`
--

INSERT INTO `information_requests` (`id`, `organization_id`, `member_state_id`, `date_time_of_request`, `request_reference_no`, `case_id`, `type_of_crimes_investigated`, `description_of_circumstances`, `purpose_for_information_request`, `connection_btw_information_request`, `identity_of_the_persons`, `reasons_tobe_in_member_state`, `reason_for_request`, `review_on`, `review_status_id`, `review_notes`, `review_by_id`, `status_id`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2023-03-31 20:34:00', '#0009/2000/07', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 2, NULL, '2023-02-26 21:21:00', '2023-07-09 05:57:18'),
(2, 1, 4, '2023-06-14 09:41:00', '#C0086/2023/07', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-16 16:20:02', 1, NULL, 1, NULL, 2, NULL, '2023-07-09 06:41:56', '2023-07-16 13:20:02'),
(3, 2, 8, '2023-07-12 08:48:00', '#SRGEWR5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-16 10:26:31', 2, NULL, 1, NULL, 3, NULL, '2023-07-16 05:48:42', '2023-07-26 11:29:45'),
(4, 2, 4, '2023-07-13 08:53:00', '#8723849', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 3, NULL, '2023-07-16 05:54:04', '2023-07-16 05:54:04'),
(5, 1, 2, '2023-07-02 17:37:00', '#3564', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '2023-07-16 14:37:30', '2023-07-16 14:37:30'),
(6, 1, 4, '2023-07-13 17:44:00', '#U9879/00098/X', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-31 12:44:59', 1, NULL, 1, NULL, 2, NULL, '2023-07-16 14:45:28', '2023-07-31 09:44:59'),
(7, 1, 3, '2023-07-23 13:34:00', '#3534', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, 1, NULL, '2023-07-23 10:35:06', '2023-07-23 10:35:29'),
(8, 1, 4, '2023-07-23 15:07:00', 'REF-87687', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-23 15:08:02', 1, NULL, 1, NULL, 1, NULL, '2023-07-23 12:07:42', '2023-07-23 12:08:02'),
(9, 1, 2, '2023-07-23 15:09:00', '#REF-98798798/98', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-23 15:10:13', 1, NULL, 1, NULL, 1, NULL, '2023-07-23 12:10:02', '2023-07-23 12:10:13'),
(10, 1, 6, '2023-07-23 13:21:00', '#356456', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:22:17', NULL, NULL, NULL, NULL, 1, NULL, '2023-07-26 10:22:00', '2023-07-26 10:22:17'),
(11, 1, 6, '2023-07-20 15:03:00', '#REF-2023/07/20/98772', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-26 15:06:08', 2, NULL, 1, NULL, 1, NULL, '2023-07-26 12:04:23', '2023-07-31 09:22:08'),
(12, 1, 5, '2023-07-26 15:06:00', '#REF-66373', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-26 15:07:45', 1, NULL, 1, NULL, 1, NULL, '2023-07-26 12:06:53', '2023-07-26 12:07:45'),
(13, 1, 4, '2023-07-19 12:00:00', 'REF-2023/07/20-0005', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-26 15:46:49', 1, NULL, 1, NULL, 1, NULL, '2023-07-26 12:43:55', '2023-07-26 12:46:49'),
(14, 2, 1, '2023-07-31 12:54:00', '#REF-2023/07/31/0007', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, '2023-07-31 09:55:15', '2023-07-31 09:55:15');

-- --------------------------------------------------------

--
-- Table structure for table `information_restrictions`
--

CREATE TABLE `information_restrictions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `information_restrictions`
--

INSERT INTO `information_restrictions` (`id`, `name`, `description`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Use granted', NULL, NULL, NULL, '2023-05-06 10:08:51', '2023-05-06 10:08:51'),
(2, 'Use granted, but do not mention the information provider', NULL, NULL, NULL, '2023-05-06 10:09:22', '2023-05-06 10:09:22'),
(3, 'Do not use without authorisation of the information provider', NULL, NULL, NULL, '2023-05-06 10:09:52', '2023-05-06 10:09:52'),
(4, 'Do not use', NULL, NULL, NULL, '2023-05-06 10:10:00', '2023-05-06 10:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `internal_communicationables`
--

CREATE TABLE `internal_communicationables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `internal_communication_id` bigint(20) UNSIGNED NOT NULL,
  `internal_communicationable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `internal_communicationable_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `internal_communications`
--

CREATE TABLE `internal_communications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `internal_communications`
--

INSERT INTO `internal_communications` (`id`, `title`, `description`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Default communication', NULL, 1, NULL, '2023-02-26 21:38:35', '2023-02-26 21:38:35');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"05ada503-9785-461f-ae52-f1255f2fed13\",\"displayName\":\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyUser\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":16:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:51:\\\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyUser\\\":12:{s:59:\\\"\\u0000Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyUser\\u0000entity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:2:\\\"id\\\";s:36:\\\"f7b804d6-f4ad-4db6-b92a-f85fc8dbf68e\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:33:\\\"App\\\\Notifications\\\\CustomDbChannel\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1674101588, 1674101588),
(2, 'default', '{\"uuid\":\"d097d7cf-1668-4356-83ff-6154365e0fb9\",\"displayName\":\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyAdmins\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":16:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:53:\\\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyAdmins\\\":12:{s:61:\\\"\\u0000Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyAdmins\\u0000entity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:2:\\\"id\\\";s:36:\\\"a398bff6-b80b-4357-8f45-59a3deef8fd8\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:33:\\\"App\\\\Notifications\\\\CustomDbChannel\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1674101588, 1674101588),
(3, 'default', '{\"uuid\":\"53bbd3bb-0b43-4114-9ab3-7ba962d07152\",\"displayName\":\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyUser\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":16:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:51:\\\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyUser\\\":12:{s:59:\\\"\\u0000Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyUser\\u0000entity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:2:\\\"id\\\";s:36:\\\"de12799e-2396-4100-b42a-e1366de99493\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:33:\\\"App\\\\Notifications\\\\CustomDbChannel\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1686833831, 1686833831),
(4, 'default', '{\"uuid\":\"a41c5e10-23ad-4a4e-a9a9-81bd65647be0\",\"displayName\":\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyAdmins\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":16:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:53:\\\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyAdmins\\\":12:{s:61:\\\"\\u0000Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyAdmins\\u0000entity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:2:\\\"id\\\";s:36:\\\"262f7898-8e92-4946-b5c1-f4cceb2453b2\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:33:\\\"App\\\\Notifications\\\\CustomDbChannel\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1686833831, 1686833831),
(5, 'default', '{\"uuid\":\"2c367440-ea52-488b-b9fa-39c4b7f45058\",\"displayName\":\"Modules\\\\User\\\\Notifications\\\\NewAccountCreatedNotifyUser\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":16:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:3;}s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:54:\\\"Modules\\\\User\\\\Notifications\\\\NewAccountCreatedNotifyUser\\\":12:{s:62:\\\"\\u0000Modules\\\\User\\\\Notifications\\\\NewAccountCreatedNotifyUser\\u0000entity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:2:\\\"id\\\";s:36:\\\"2411361e-1a7a-45c9-9e20-5693813d0d58\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1686833893, 1686833893),
(6, 'default', '{\"uuid\":\"cad8790f-30e6-48b0-8f89-449a90968d23\",\"displayName\":\"Modules\\\\User\\\\Notifications\\\\NewAccountCreatedNotifyUser\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":16:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:3;}s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:54:\\\"Modules\\\\User\\\\Notifications\\\\NewAccountCreatedNotifyUser\\\":12:{s:62:\\\"\\u0000Modules\\\\User\\\\Notifications\\\\NewAccountCreatedNotifyUser\\u0000entity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:2:\\\"id\\\";s:36:\\\"2411361e-1a7a-45c9-9e20-5693813d0d58\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:33:\\\"App\\\\Notifications\\\\CustomDbChannel\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1686833893, 1686833893),
(7, 'default', '{\"uuid\":\"253e58bf-d1a4-487d-8cb7-8171184226d7\",\"displayName\":\"Modules\\\\User\\\\Notifications\\\\NewAccountCreatedNotifyAdmins\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":16:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:56:\\\"Modules\\\\User\\\\Notifications\\\\NewAccountCreatedNotifyAdmins\\\":12:{s:64:\\\"\\u0000Modules\\\\User\\\\Notifications\\\\NewAccountCreatedNotifyAdmins\\u0000entity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:2:\\\"id\\\";s:36:\\\"723a653e-e7ed-4907-ba0b-ff1bb48366a9\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1686833893, 1686833893),
(8, 'default', '{\"uuid\":\"f643f903-18d0-4cc1-b45a-5b3e8b7fb90c\",\"displayName\":\"Modules\\\\User\\\\Notifications\\\\NewAccountCreatedNotifyAdmins\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":16:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:56:\\\"Modules\\\\User\\\\Notifications\\\\NewAccountCreatedNotifyAdmins\\\":12:{s:64:\\\"\\u0000Modules\\\\User\\\\Notifications\\\\NewAccountCreatedNotifyAdmins\\u0000entity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:2:\\\"id\\\";s:36:\\\"723a653e-e7ed-4907-ba0b-ff1bb48366a9\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:33:\\\"App\\\\Notifications\\\\CustomDbChannel\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1686833893, 1686833893),
(9, 'default', '{\"uuid\":\"9e4928ae-7560-4422-9f61-e3e2f83d6252\",\"displayName\":\"Modules\\\\User\\\\Notifications\\\\PasswordResetLinkSentNotifyUser\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":16:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:3;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:58:\\\"Modules\\\\User\\\\Notifications\\\\PasswordResetLinkSentNotifyUser\\\":12:{s:66:\\\"\\u0000Modules\\\\User\\\\Notifications\\\\PasswordResetLinkSentNotifyUser\\u0000entity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:2:\\\"id\\\";s:36:\\\"996aea4a-2bf7-42da-bf50-c60f922feab7\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:33:\\\"App\\\\Notifications\\\\CustomDbChannel\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1686839502, 1686839502),
(10, 'default', '{\"uuid\":\"678da0f3-a7c9-47b7-b9a0-fb20d60594f9\",\"displayName\":\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyUser\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":16:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:3;}s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:51:\\\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyUser\\\":12:{s:59:\\\"\\u0000Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyUser\\u0000entity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:2:\\\"id\\\";s:36:\\\"fa09cce6-4f4f-4570-a7ca-ee3f0a4f479e\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:33:\\\"App\\\\Notifications\\\\CustomDbChannel\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1688892898, 1688892898),
(11, 'default', '{\"uuid\":\"1cfe9e93-a9f4-4629-bef9-a236677d6020\",\"displayName\":\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyAdmins\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":16:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:53:\\\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyAdmins\\\":12:{s:61:\\\"\\u0000Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyAdmins\\u0000entity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:2:\\\"id\\\";s:36:\\\"dfb046f5-fa6a-4cf5-9a0c-bd014c90d94c\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:33:\\\"App\\\\Notifications\\\\CustomDbChannel\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1688892898, 1688892898),
(12, 'default', '{\"uuid\":\"3e244f3a-0275-490a-b7c6-a01d990d7656\",\"displayName\":\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyUser\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":16:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:51:\\\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyUser\\\":12:{s:59:\\\"\\u0000Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyUser\\u0000entity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:2:\\\"id\\\";s:36:\\\"4d3f508e-09f2-4d9f-bbc9-df6b1c6d0905\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:33:\\\"App\\\\Notifications\\\\CustomDbChannel\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1689520444, 1689520444),
(13, 'default', '{\"uuid\":\"bd8397c1-09cd-4a1a-ab43-c57cca011933\",\"displayName\":\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyAdmins\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":16:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:53:\\\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyAdmins\\\":12:{s:61:\\\"\\u0000Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyAdmins\\u0000entity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:2:\\\"id\\\";s:36:\\\"c3dd86eb-37ef-40c1-adb1-72197262cb86\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:33:\\\"App\\\\Notifications\\\\CustomDbChannel\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1689520444, 1689520444),
(14, 'default', '{\"uuid\":\"6cc218e0-3390-4224-bba7-b6e0a19777f3\",\"displayName\":\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyUser\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":16:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:51:\\\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyUser\\\":12:{s:59:\\\"\\u0000Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyUser\\u0000entity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:2:\\\"id\\\";s:36:\\\"2f707c45-0c65-45e9-a269-d800b9fe22da\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:33:\\\"App\\\\Notifications\\\\CustomDbChannel\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1690017929, 1690017929),
(15, 'default', '{\"uuid\":\"e1fe8677-0893-4847-827e-2597dc207b09\",\"displayName\":\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyAdmins\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":16:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:53:\\\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyAdmins\\\":12:{s:61:\\\"\\u0000Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyAdmins\\u0000entity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:2:\\\"id\\\";s:36:\\\"1d0e9af3-0cae-46ef-a145-9f897951b75d\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:33:\\\"App\\\\Notifications\\\\CustomDbChannel\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1690017929, 1690017929),
(16, 'default', '{\"uuid\":\"0613a28f-1ba1-4ed3-aa23-ac019e2dd7cc\",\"displayName\":\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyUser\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":16:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:3;}s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:51:\\\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyUser\\\":12:{s:59:\\\"\\u0000Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyUser\\u0000entity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:2:\\\"id\\\";s:36:\\\"499ac49e-7f27-4d94-b5db-2d71ffde6e33\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:33:\\\"App\\\\Notifications\\\\CustomDbChannel\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1690038366, 1690038366),
(17, 'default', '{\"uuid\":\"10b68278-da68-4fea-a8ee-080056db6a46\",\"displayName\":\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyAdmins\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":16:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:53:\\\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyAdmins\\\":12:{s:61:\\\"\\u0000Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyAdmins\\u0000entity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:2:\\\"id\\\";s:36:\\\"6034c875-3274-4618-83c7-71f5632be2d1\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:33:\\\"App\\\\Notifications\\\\CustomDbChannel\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1690038366, 1690038366),
(18, 'default', '{\"uuid\":\"4c4e3622-6b1d-4302-82f3-5def279fe6f6\",\"displayName\":\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyUser\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":16:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:51:\\\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyUser\\\":12:{s:59:\\\"\\u0000Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyUser\\u0000entity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:2:\\\"id\\\";s:36:\\\"157bf7aa-5479-4fe4-83d1-a560b31b0b21\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:33:\\\"App\\\\Notifications\\\\CustomDbChannel\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1690040189, 1690040189),
(19, 'default', '{\"uuid\":\"2839662f-1af2-40e1-ac21-e88f7462a346\",\"displayName\":\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyAdmins\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":16:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:53:\\\"Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyAdmins\\\":12:{s:61:\\\"\\u0000Modules\\\\User\\\\Notifications\\\\ProfileUpdatedNotifyAdmins\\u0000entity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:2:\\\"id\\\";s:36:\\\"133bcf15-86a9-43dd-8b8b-44cca1499e99\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:33:\\\"App\\\\Notifications\\\\CustomDbChannel\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1690040189, 1690040189);

-- --------------------------------------------------------

--
-- Table structure for table `job_adverts`
--

CREATE TABLE `job_adverts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metatags` json DEFAULT NULL,
  `settings` json DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_adverts`
--

INSERT INTO `job_adverts` (`id`, `title`, `body`, `slug`, `metatags`, `settings`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Call for a forensic expert in online fraud', '<p>EAAACA in conjunction with its partners are seeking a …</p>', 'call-for-a-forensic-expert-in-online-fraud', NULL, NULL, 1, NULL, '2023-03-01 17:23:36', '2023-03-01 17:23:36');

-- --------------------------------------------------------

--
-- Table structure for table `layout_columns`
--

CREATE TABLE `layout_columns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `layout_row_id` bigint(20) UNSIGNED NOT NULL,
  `width` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `styles` json DEFAULT NULL,
  `attributes` json DEFAULT NULL,
  `css_classes` varchar(2025) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `css_styles` varchar(2025) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` json DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `layout_columns`
--

INSERT INTO `layout_columns` (`id`, `layout_row_id`, `width`, `position`, `styles`, `attributes`, `css_classes`, `css_styles`, `settings`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 2, 'col-md-12', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-28 14:20:52', '2022-02-28 14:20:52'),
(3, 3, 'col-md-9', 1, '[{\"key\": \"background-color\", \"value\": null}, {\"key\": \"background-image\", \"value\": null}, {\"key\": \"background-repeat\", \"value\": null}, {\"key\": \"background-size\", \"value\": null}, {\"key\": \"padding\", \"value\": null}, {\"key\": \"margin\", \"value\": null}]', '[{\"key\": \"class\", \"value\": \"pb-5\"}]', NULL, NULL, NULL, NULL, NULL, '2022-02-28 20:16:17', '2023-01-19 03:13:08'),
(4, 3, 'col-md-4', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-28 20:16:17', '2022-02-28 20:17:59'),
(5, 3, 'col-md-4', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-28 20:16:17', '2022-02-28 20:17:59'),
(6, 3, 'col-md-12', 2, '[{\"key\": \"background-color\", \"value\": null}, {\"key\": \"background-image\", \"value\": null}, {\"key\": \"background-repeat\", \"value\": null}, {\"key\": \"background-size\", \"value\": null}, {\"key\": \"padding\", \"value\": null}, {\"key\": \"margin\", \"value\": null}]', '[{\"key\": \"class\", \"value\": null}]', NULL, NULL, NULL, NULL, NULL, '2022-02-28 20:17:53', '2022-04-24 08:50:12'),
(8, 6, 'col-md-6', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-28 20:53:45', '2022-02-28 20:53:45'),
(9, 6, 'col-md-6', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-28 20:53:45', '2022-02-28 20:53:45'),
(10, 7, 'col-md-4', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-28 21:00:27', '2022-02-28 21:00:27'),
(11, 7, 'col-md-4', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-28 21:00:27', '2022-02-28 21:00:27'),
(12, 7, 'col-md-4', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-28 21:00:27', '2022-02-28 21:00:27'),
(13, 8, 'col-md-12', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-28 21:06:55', '2022-02-28 21:06:55'),
(14, 9, 'col-md-12', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-28 21:12:21', '2022-02-28 21:12:21'),
(16, 11, 'col-md-12', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-19 03:27:56', '2023-01-19 03:27:56');

-- --------------------------------------------------------

--
-- Table structure for table `layout_rows`
--

CREATE TABLE `layout_rows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fieldable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fieldable_id` bigint(20) UNSIGNED NOT NULL,
  `field_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `styles` json DEFAULT NULL,
  `attributes` json DEFAULT NULL,
  `css_classes` varchar(2025) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `css_styles` varchar(2025) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` json DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `layout_rows`
--

INSERT INTO `layout_rows` (`id`, `fieldable_type`, `fieldable_id`, `field_name`, `position`, `styles`, `attributes`, `css_classes`, `css_styles`, `settings`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 'Modules\\Layout\\Entities\\LayoutSection', 2, NULL, 1, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-02-28 14:20:47', '2022-02-28 14:20:47'),
(3, 'Modules\\Layout\\Entities\\LayoutSection', 1, NULL, 2, '[{\"key\": \"background-color\", \"value\": null}, {\"key\": \"background-image\", \"value\": null}, {\"key\": \"background-repeat\", \"value\": null}, {\"key\": \"background-size\", \"value\": null}, {\"key\": \"padding\", \"value\": null}, {\"key\": \"margin\", \"value\": null}]', '[{\"key\": \"class\", \"value\": \"no-gutters justify-content-md-center\"}]', NULL, NULL, NULL, 1, NULL, '2022-02-28 20:15:49', '2022-04-24 08:52:41'),
(6, 'Modules\\Layout\\Entities\\LayoutSection', 4, NULL, 1, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-02-28 20:53:40', '2022-02-28 20:53:40'),
(7, 'Modules\\Layout\\Entities\\LayoutSection', 5, NULL, 1, '[{\"key\": \"background-color\", \"value\": null}, {\"key\": \"background-image\", \"value\": null}, {\"key\": \"background-repeat\", \"value\": null}, {\"key\": \"background-size\", \"value\": null}, {\"key\": \"padding\", \"value\": null}, {\"key\": \"margin\", \"value\": null}]', '[{\"key\": \"class\", \"value\": \"text-center\"}]', NULL, NULL, NULL, 1, NULL, '2022-02-28 21:00:23', '2022-02-28 21:16:39'),
(8, 'Modules\\Layout\\Entities\\LayoutSection', 6, NULL, 1, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-02-28 21:06:50', '2022-02-28 21:06:50'),
(9, 'Modules\\Layout\\Entities\\LayoutSection', 7, NULL, 1, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-02-28 21:12:15', '2022-02-28 21:12:15'),
(11, 'Modules\\Layout\\Entities\\LayoutSection', 9, NULL, 1, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-01-19 03:27:45', '2023-01-19 03:27:45');

-- --------------------------------------------------------

--
-- Table structure for table `layout_sections`
--

CREATE TABLE `layout_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fieldable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fieldable_id` bigint(20) UNSIGNED NOT NULL,
  `position` int(11) DEFAULT NULL,
  `styles` json DEFAULT NULL,
  `attributes` json DEFAULT NULL,
  `css_classes` varchar(2025) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `css_styles` varchar(2025) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` json DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `layout_sections`
--

INSERT INTO `layout_sections` (`id`, `fieldable_type`, `fieldable_id`, `position`, `styles`, `attributes`, `css_classes`, `css_styles`, `settings`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Modules\\Content\\Entities\\ContentPage', 1, 1, NULL, '[{\"key\": \"class\", \"value\": \"py-5 intro-overlay-wrapper\"}]', NULL, NULL, NULL, 1, NULL, '2022-02-28 14:16:06', '2022-03-26 14:05:06'),
(2, 'Modules\\Content\\Entities\\ContentPage', 1, 2, NULL, '[{\"key\": \"class\", \"value\": \"py-5 bg-light\"}]', NULL, NULL, NULL, 1, NULL, '2022-02-28 14:19:56', '2022-02-28 14:20:22'),
(4, 'Modules\\Content\\Entities\\ContentPage', 2, 2, NULL, '[{\"key\": \"class\", \"value\": \"py-5 my-5\"}]', NULL, NULL, NULL, 1, NULL, '2022-02-28 20:53:25', '2023-01-19 03:26:06'),
(5, 'Modules\\Content\\Entities\\ContentPage', 3, 1, NULL, '[{\"key\": \"class\", \"value\": \"py-5\"}]', NULL, NULL, NULL, 1, NULL, '2022-02-28 21:00:09', '2022-02-28 21:00:18'),
(6, 'Modules\\Content\\Entities\\ContentPage', 3, 2, NULL, '[{\"key\": \"class\", \"value\": \"py-5 bg-light\"}]', NULL, NULL, NULL, 1, NULL, '2022-02-28 21:06:23', '2022-02-28 21:06:45'),
(7, 'Modules\\Content\\Entities\\ContentPage', 3, 3, NULL, '[{\"key\": \"class\", \"value\": \"py-5\"}]', NULL, NULL, NULL, 1, NULL, '2022-02-28 21:12:01', '2022-02-28 21:13:04'),
(8, 'Modules\\Content\\Entities\\ContentService', 4, 1, NULL, '[{\"key\": \"class\", \"value\": \"py-5 bg-light\"}]', NULL, NULL, NULL, 1, NULL, '2022-03-19 09:48:46', '2022-03-19 09:49:04'),
(9, 'Modules\\Content\\Entities\\ContentPage', 2, 1, NULL, '[{\"key\": \"class\", \"value\": \"pt-5\"}]', NULL, NULL, NULL, 1, NULL, '2022-04-29 15:23:22', '2023-01-19 03:29:23'),
(10, 'Modules\\Content\\Entities\\ContentService', 1, 1, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-06-20 15:55:49', '2022-06-20 15:55:49');

-- --------------------------------------------------------

--
-- Table structure for table `layout_section_tops`
--

CREATE TABLE `layout_section_tops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fieldable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fieldable_id` bigint(20) UNSIGNED NOT NULL,
  `position` int(11) DEFAULT NULL,
  `styles` json DEFAULT NULL,
  `attributes` json DEFAULT NULL,
  `css_classes` varchar(2025) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `css_styles` varchar(2025) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` json DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `layout_section_tops`
--

INSERT INTO `layout_section_tops` (`id`, `fieldable_type`, `fieldable_id`, `position`, `styles`, `attributes`, `css_classes`, `css_styles`, `settings`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Modules\\Content\\Entities\\ContentPage', 1, 1, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-02-28 08:20:48', '2022-02-28 08:20:48');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `file_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upload_folder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `name`, `file_name`, `disk`, `mime_type`, `size`, `file_description`, `upload_folder`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Fire logo', 'logo.png', 'public', 'image/png', 8283, '', 'images', 1, NULL, '2022-02-23 18:52:20', '2022-02-23 18:52:20'),
(6, 'no image', 'no-image.jpg', 'public', 'image/jpeg', 6263, '', 'images/2022/04', 1, NULL, '2022-04-22 10:50:14', '2022-04-22 10:50:14'),
(7, 'pexels skyler ewing 4793432', 'pexels-skyler-ewing-4793432.jpg', 'public', 'image/jpeg', 978271, '', 'images/2022/04', 1, NULL, '2022-04-26 09:47:45', '2022-04-26 09:47:45'),
(8, 'pexels pixabay 33199', 'pexels-pixabay-33199.jpg', 'public', 'image/jpeg', 1109207, '', 'images/2022/04', 1, NULL, '2022-04-26 09:48:07', '2022-04-26 09:48:07'),
(9, 'pexels burst 545013', 'pexels-burst-545013.jpg', 'public', 'image/jpeg', 1594207, '', 'images/2022/04', 1, NULL, '2022-04-26 09:48:25', '2022-04-26 09:48:25'),
(10, 'pexels dazzle jam 1038041', 'pexels-dazzle-jam-1038041.jpg', 'public', 'image/jpeg', 3178701, '', 'images/2022/04', 1, NULL, '2022-04-26 09:48:39', '2022-04-26 09:48:39'),
(11, 'pexels thorn yang 139829', 'pexels-thorn-yang-139829.jpg', 'public', 'image/jpeg', 2429064, '', 'images/2022/04', 1, NULL, '2022-04-26 09:48:56', '2022-04-26 09:48:56'),
(12, 'pexels spencer selover 614974', 'pexels-spencer-selover-614974.jpg', 'public', 'image/jpeg', 2319973, '', 'images/2022/04', 1, NULL, '2022-04-26 09:49:19', '2022-04-26 09:49:19'),
(13, 'HSS GRADUATE PROGRAMME STRUCTURES', 'HSS-GRADUATE-PROGRAMME-STRUCTURES.docx', 'public', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 180704, '', 'documents/2022/12', 1, NULL, '2022-12-14 07:00:26', '2022-12-14 07:00:26'),
(14, 'December 2022 Final Examinations Graduate New S22 IS 501 Systems Analysis and Design 137665', 'December-2022-Final-Examinations-Graduate-New-S22-IS-501-Systems-Analysis-and-Design-137665.zip', 'public', 'application/zip', 3430674, '', 'applications/2022/12', 1, NULL, '2022-12-14 07:04:10', '2022-12-14 07:04:10'),
(15, 'arin 1', 'arin-1.jpg', 'public', 'image/jpeg', 138471, '', 'images/2023/01', 1, NULL, '2023-01-19 03:08:47', '2023-01-19 03:08:47'),
(16, 'EAAACA Organs', 'EAAACA-Organs.jpg', 'public', 'image/jpeg', 267105, '', 'images/2023/01', 1, NULL, '2023-01-19 03:09:26', '2023-01-19 03:09:26'),
(17, 'establishment of arinea 1', 'establishment-of-arinea-1.jpg', 'public', 'image/jpeg', 467360, '', 'images/2023/01', 1, NULL, '2023-01-19 03:11:08', '2023-01-19 03:11:08'),
(18, 'Lillian William Kafiti Arinea President', 'Lillian-William-Kafiti-Arinea-President.jpg', 'public', 'image/jpeg', 151749, '', 'images/2023/01', 1, NULL, '2023-01-19 03:25:27', '2023-01-19 03:25:27'),
(19, 'birth of arin', 'birth-of-arin.jpg', 'public', 'image/jpeg', 116809, '', 'images/2023/01', 1, NULL, '2023-01-19 03:27:29', '2023-01-19 03:27:29'),
(20, 'EACC Building', 'EACC-Building.PNG', 'public', 'image/png', 366924, '', 'images/2023/01', 1, NULL, '2023-01-19 04:19:02', '2023-01-19 04:19:02'),
(21, 'dsc 8812', 'dsc-8812.jpg', 'public', 'image/jpeg', 125582, '', 'attachments/2023/01', 1, NULL, '2023-01-19 04:22:31', '2023-01-19 04:22:31'),
(22, 'dsc 8812', 'dsc-8812.jpg', 'public', 'image/jpeg', 125582, '', 'images/2023/01', 1, NULL, '2023-01-19 04:22:49', '2023-01-19 04:22:49'),
(23, 'SAI EAAACA', 'SAI-EAAACA.JPG', 'public', 'image/jpeg', 142168, '', 'images/2023/01', 1, NULL, '2023-01-19 04:24:35', '2023-01-19 04:24:35'),
(28, 'Screenshot 2023 04 12 at 12 02 31', 'Screenshot-2023-04-12-at-12-02-31.png', 'private', 'image/png', 25411, '', 'attachments/2023/05', 1, NULL, '2023-05-24 18:57:34', '2023-05-24 18:57:34'),
(29, 'Screenshot 2023 04 12 at 12 02 31', 'Screenshot-2023-04-12-at-12-02-31.png', 'private', 'image/png', 25411, '', 'attachments/2023/05', 1, NULL, '2023-05-25 18:16:26', '2023-05-25 18:16:26'),
(30, 'Screenshot 2023 04 12 at 12 02 31', 'Screenshot-2023-04-12-at-12-02-31.png', 'private', 'image/png', 25411, '', 'attachments/2023/05', 1, NULL, '2023-05-25 18:57:33', '2023-05-25 18:57:33'),
(31, 'ARIN EA International Bodies to Assist in Tracing and Recovering Alex', 'ARIN-EA-International-Bodies-to-Assist-in-Tracing-and-Recovering-Alex.pptx', 'private', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 831862, '', 'attachments/2023/05', 1, NULL, '2023-05-25 19:40:59', '2023-05-25 19:40:59'),
(32, 'Screenshot 2023 04 12 at 12 02 31', 'Screenshot-2023-04-12-at-12-02-31.png', 'private', 'image/png', 25411, '', 'attachments/2023/05', 1, NULL, '2023-05-27 09:40:36', '2023-05-27 09:40:36'),
(33, 'Screenshot 2023 04 12 at 12 02 31', 'Screenshot-2023-04-12-at-12-02-31.png', 'private', 'image/png', 25411, '', 'attachments/2023/05', 1, NULL, '2023-05-27 10:30:06', '2023-05-27 10:30:06'),
(34, 'Screenshot 2023 07 26 at 14 48 49', 'Screenshot-2023-07-26-at-14-48-49.png', 'private', 'image/png', 141499, '', 'attachments/2023/07', 1, NULL, '2023-07-26 12:49:43', '2023-07-26 12:49:43');

-- --------------------------------------------------------

--
-- Table structure for table `mediables`
--

CREATE TABLE `mediables` (
  `media_id` bigint(20) UNSIGNED NOT NULL,
  `mediable_id` bigint(20) UNSIGNED NOT NULL,
  `mediable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mediables`
--

INSERT INTO `mediables` (`media_id`, `mediable_id`, `mediable_type`, `group`) VALUES
(15, 8, 'Modules\\Content\\Entities\\ContentFeatured', 'images'),
(16, 7, 'Modules\\Content\\Entities\\ContentFeatured', 'images'),
(17, 6, 'Modules\\Content\\Entities\\ContentFeatured', 'images'),
(19, 2, 'Modules\\Field\\Entities\\FieldImage', 'images'),
(20, 14, 'Modules\\Content\\Entities\\ContentNews', 'images'),
(21, 13, 'Modules\\Content\\Entities\\ContentNews', 'attachments'),
(22, 13, 'Modules\\Content\\Entities\\ContentNews', 'images'),
(23, 12, 'Modules\\Content\\Entities\\ContentNews', 'images'),
(31, 1, 'Modules\\Custom\\Entities\\CaseFinding', 'attachments'),
(33, 1, 'Modules\\Custom\\Entities\\CaseManagement', 'attachments'),
(31, 1, 'Modules\\Custom\\Entities\\CaseManagement', 'attachments'),
(31, 2, 'Modules\\Custom\\Entities\\CaseInvestigation', 'attachments'),
(31, 4, 'Modules\\Custom\\Entities\\CaseManagement', 'attachments'),
(31, 2, 'Modules\\Custom\\Entities\\CaseFinding', 'attachments'),
(31, 1, 'Modules\\Custom\\Entities\\RequestResponse', 'attachments'),
(34, 10, 'Modules\\Custom\\Entities\\RequestResponse', 'attachments');

-- --------------------------------------------------------

--
-- Table structure for table `media_providers`
--

CREATE TABLE `media_providers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media_videoables`
--

CREATE TABLE `media_videoables` (
  `media_video_id` bigint(20) UNSIGNED NOT NULL,
  `media_videoable_id` bigint(20) NOT NULL,
  `media_videoable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media_videos`
--

CREATE TABLE `media_videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `provider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `provider_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_states`
--

CREATE TABLE `member_states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member_states`
--

INSERT INTO `member_states` (`id`, `name`, `description`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Uganda', NULL, NULL, NULL, '2023-05-06 09:11:05', '2023-05-06 09:11:05'),
(2, 'Kenya', NULL, NULL, NULL, '2023-05-06 09:11:16', '2023-05-06 09:11:16'),
(3, 'Tanzania', NULL, NULL, NULL, '2023-05-06 09:11:26', '2023-05-06 09:11:26'),
(4, 'Rwanda', NULL, NULL, NULL, '2023-05-06 09:11:37', '2023-05-06 09:11:37'),
(5, 'Burundi', NULL, NULL, NULL, '2023-07-26 07:14:36', '2023-07-26 07:14:36'),
(6, 'Ethiopia', NULL, NULL, NULL, '2023-07-26 07:15:21', '2023-07-26 07:15:21'),
(7, 'Djibouti', NULL, NULL, NULL, '2023-07-26 07:15:42', '2023-07-26 07:15:42'),
(8, 'South Sudan', NULL, NULL, NULL, '2023-07-26 07:15:58', '2023-07-26 07:15:58');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2014_10_15_000000_update_users_table', 1),
(5, '2017_11_04_103444_create_laravel_logger_activity_table', 1),
(6, '2019_08_19_000000_create_failed_jobs_table', 1),
(7, '2019_08_19_000000_create_notifications_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2020_05_21_100000_create_teams_table', 1),
(10, '2020_05_21_200000_create_team_user_table', 1),
(11, '2020_05_21_300000_create_team_invitations_table', 1),
(12, '2021_04_17_142456_create_permission_tables', 1),
(13, '2021_04_18_113512_create_models_table', 1),
(14, '2021_04_21_085918_update_permissions_table', 1),
(15, '2021_04_21_180755_create_permission_types_table', 1),
(16, '2021_05_03_085646_create_media_table', 1),
(17, '2021_06_03_071344_create_jobs_table', 1),
(18, '2021_06_14_082348_create_field_titles_table', 1),
(19, '2021_06_14_082357_create_field_texts_table', 1),
(20, '2021_06_14_085644_create_layout_rows_table', 1),
(21, '2021_06_14_085653_create_layout_columns_table', 1),
(30, '2021_08_01_100654_create_layout_sections_table', 1),
(31, '2021_08_01_100705_create_layout_section_tops_table', 1),
(32, '2021_08_09_104035_create_sessions_table', 1),
(33, '2021_08_09_200149_create_contact_messages_table', 1),
(34, '2021_08_09_211345_create_field_images_table', 1),
(35, '2021_09_06_094826_create_field_htmls_table', 1),
(36, '2021_09_07_083843_create_blocks_table', 1),
(37, '2021_09_07_135740_create_field_blocks_table', 1),
(38, '2021_11_12_085146_create_media_providers_table', 1),
(39, '2021_11_12_205848_create_media_videos_table', 1),
(40, '2021_11_13_205848_create_media_videoables_table', 1),
(41, '2019_08_19_000010_update_notifications_table', 2),
(42, '2021_08_12_000000_update_media_table', 3),
(52, '2022_01_01_000001_create_taxonomy_types_table', 4),
(53, '2022_01_01_000002_create_taxonomy_terms_table', 4),
(54, '2022_01_01_000003_create_taxonomy_termables_table', 4),
(66, '2021_07_05_000001_create_content_blog_posts_table', 5),
(67, '2021_07_05_000002_create_content_events_table', 5),
(68, '2021_07_05_000003_create_content_featureds_table', 5),
(69, '2021_07_05_000004_create_content_galleries_table', 5),
(70, '2021_07_05_000005_create_content_news_table', 5),
(71, '2021_07_05_000006_create_content_our_works_table', 5),
(72, '2021_07_05_000007_create_content_pages_table', 5),
(73, '2021_07_05_000008_create_content_publications_table', 5),
(74, '2021_07_05_000009_create_content_services_table', 5),
(75, '2021_07_05_000010_create_content_testimonies_table', 5),
(77, '2022_01_00_000006_create_field_links_table', 6),
(78, '2023_01_18_000001_create_statuses_table', 7),
(79, '2023_01_18_000002_create_countries_table', 7),
(80, '2023_01_18_000003_create_countryables_table', 7),
(81, '2023_01_19_000001_create_information_requests_table', 7),
(82, '2023_01_19_000002_create_forum_categories_table', 7),
(83, '2023_01_19_000003_create_forum_topics_table', 7),
(84, '2023_01_19_000004_create_case_types_table', 7),
(85, '2023_01_19_000005_create_cases_table', 7),
(86, '2023_02_01_000001_create_comments_table', 7),
(87, '2023_02_01_000002_create_commentables_table', 7),
(88, '2023_02_19_000007_create_internal_communications_table', 7),
(89, '2023_02_19_000008_create_job_adverts_table', 7),
(90, '2023_02_19_000009_create_emails_table', 7),
(91, '2023_02_20_000001_create_internal_communicationables_table', 7),
(92, '2023_02_20_000001_create_messages_table', 7),
(93, '2023_05_06_000001_create_member_states_table', 8),
(94, '2023_05_06_000002_create_organizations_table', 8),
(95, '2023_05_06_000003_create_nature_of_offences_table', 8),
(96, '2023_05_06_000004_create_information_restrictions_table', 8),
(97, '2023_05_06_000005_create_contact_points_table', 8),
(98, '2023_05_06_000006_create_case_coordinators_table', 8),
(99, '2023_05_06_000007_create_case_contributors_table', 8),
(100, '2023_05_06_000008_create_case_investigations_table', 8),
(101, '2023_05_06_000009_create_case_findings_table', 8),
(102, '2023_05_05_000001_create_case_management_table', 9),
(103, '2023_05_06_000010_create_request_responses_table', 10),
(104, '2023_06_01_000001_create_user_profiles_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`id`, `name`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'user', 'User Accounts', NULL, '2022-01-20 07:39:05', '2022-01-20 07:39:05'),
(2, 'model', 'System models', NULL, '2022-01-20 07:39:05', '2022-01-20 07:39:05'),
(3, 'role', 'User Roles', NULL, '2022-01-20 07:39:05', '2022-01-20 07:39:05'),
(4, 'permission', 'User Permissions', NULL, '2022-01-20 07:39:05', '2022-01-20 07:39:05'),
(5, 'media', 'Files & Media', NULL, '2022-01-20 07:39:05', '2022-01-20 07:39:05'),
(6, 'team', 'User Teams', NULL, '2022-01-20 07:39:05', '2022-01-20 07:39:05'),
(7, 'notification', 'System notifications', NULL, '2022-01-20 07:39:05', '2022-01-20 07:39:05'),
(15, 'permission_type', 'Permission types', NULL, '2022-04-28 09:56:32', '2022-04-28 09:56:32'),
(16, 'administration', 'Access administration links', NULL, '2022-04-28 11:24:07', '2022-04-28 11:54:02'),
(17, 'case_management', NULL, NULL, '2023-06-15 16:29:55', '2023-06-15 16:29:55'),
(18, 'case_contributor', NULL, NULL, '2023-06-15 16:30:23', '2023-06-15 16:30:23'),
(19, 'case_coordinator', NULL, NULL, '2023-06-15 16:30:43', '2023-06-15 16:30:43'),
(20, 'case_finding', NULL, NULL, '2023-06-15 18:49:29', '2023-06-15 18:49:29'),
(21, 'case_investigation', NULL, NULL, '2023-06-15 18:50:13', '2023-06-15 18:50:13'),
(22, 'case_type', NULL, NULL, '2023-06-15 18:50:45', '2023-06-15 18:50:45'),
(23, 'contact_point', NULL, NULL, '2023-06-15 18:51:07', '2023-06-15 18:51:07'),
(24, 'country', NULL, NULL, '2023-06-15 18:51:35', '2023-06-15 18:51:35'),
(25, 'information_request', NULL, NULL, '2023-06-15 18:52:08', '2023-06-15 18:52:08'),
(26, 'information_restriction', NULL, NULL, '2023-06-15 18:52:31', '2023-06-15 18:52:31'),
(27, 'internal_communication', NULL, NULL, '2023-06-15 18:53:04', '2023-06-15 18:53:04'),
(28, 'member_state', NULL, NULL, '2023-06-15 18:53:28', '2023-06-15 18:53:28'),
(29, 'nature_of_offence', NULL, NULL, '2023-06-15 18:54:09', '2023-06-15 18:54:09'),
(30, 'organization', NULL, NULL, '2023-06-15 18:54:29', '2023-06-15 18:54:29'),
(31, 'forum_category', NULL, NULL, '2023-06-15 19:00:15', '2023-06-15 19:00:15'),
(32, 'forum_topic', NULL, NULL, '2023-06-15 19:00:39', '2023-06-15 19:00:39'),
(33, 'email', NULL, NULL, '2023-06-15 19:01:04', '2023-06-15 19:01:04'),
(34, 'internal_communication', NULL, NULL, '2023-06-15 19:01:35', '2023-06-15 19:01:35'),
(35, 'job_advert', NULL, NULL, '2023-06-15 19:02:05', '2023-06-15 19:02:05');

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `nature_of_offences`
--

CREATE TABLE `nature_of_offences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nature_of_offences`
--

INSERT INTO `nature_of_offences` (`id`, `name`, `description`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Participation in a criminal organisation', NULL, NULL, NULL, '2023-05-06 09:50:51', '2023-05-06 09:50:51'),
(2, 'Laundering of the proceeds of crime', NULL, NULL, NULL, '2023-05-06 09:51:23', '2023-05-06 09:51:23'),
(3, 'Terrorism', NULL, NULL, NULL, '2023-05-06 09:51:33', '2023-05-06 09:51:33'),
(4, 'Counterfeiting of currency', NULL, NULL, NULL, '2023-05-06 09:51:51', '2023-05-06 09:51:51'),
(5, 'Trafficking in human beings', NULL, NULL, NULL, '2023-05-06 09:52:16', '2023-05-06 09:52:16'),
(6, 'Computer related crime', NULL, NULL, NULL, '2023-05-06 09:52:34', '2023-05-06 09:52:34'),
(7, 'Sexual exploitation of children and child pornography', NULL, NULL, NULL, '2023-05-06 09:53:04', '2023-05-06 09:53:04'),
(8, 'Environmental crime, including trafficking in endangered animal species and in endangered plant species and varieties', NULL, NULL, NULL, '2023-05-06 09:54:11', '2023-05-06 09:54:11'),
(9, 'Illicit trafficking in weapons, munitions and explosives', NULL, NULL, NULL, '2023-05-06 09:55:01', '2023-05-06 09:55:01'),
(10, 'Rape', NULL, NULL, NULL, '2023-05-06 09:55:08', '2023-05-06 09:55:08'),
(11, 'Arson', NULL, NULL, NULL, '2023-05-06 09:55:19', '2023-05-06 09:55:19'),
(12, 'Crimes within the jurisdiction of the International criminal court', NULL, NULL, NULL, '2023-05-06 09:56:05', '2023-05-06 09:56:05'),
(13, 'Counterfeiting in human beings', NULL, NULL, NULL, '2023-05-06 09:56:41', '2023-05-06 09:56:41'),
(14, 'Verification of authenticity of documents', NULL, NULL, NULL, '2023-05-06 09:57:06', '2023-05-06 09:57:06'),
(15, 'Corruption', NULL, NULL, NULL, '2023-05-06 09:57:16', '2023-05-06 09:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `member_state_id` bigint(20) UNSIGNED NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `name`, `description`, `member_state_id`, `address`, `telephone`, `fax`, `email`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'ARIN-EA', NULL, 1, 'Plot XXXX', '+256 320 XXXXXX', '+256 0800 000000', 'info@arinea.org', 1, NULL, '2023-05-06 09:37:03', '2023-05-06 09:40:21'),
(2, 'EACC', NULL, 2, 'Plot', NULL, NULL, NULL, NULL, NULL, '2023-05-14 07:25:48', '2023-07-22 15:07:02'),
(3, 'SBAC', NULL, 5, 'Plot', NULL, NULL, NULL, NULL, NULL, '2023-07-26 07:36:04', '2023-07-26 07:36:04'),
(4, 'EACC', NULL, 2, 'Plot', NULL, NULL, NULL, NULL, NULL, '2023-07-26 07:36:55', '2023-07-26 07:36:55'),
(5, 'EAAACA', NULL, 1, 'Plot 14, Parliament Avenue Jubilee Insurance Building', '+256 414 346 185', '+256 414 346 185', 'generalsecretary@eaaaca.com', NULL, NULL, '2023-07-31 08:53:57', '2023-07-31 08:53:57'),
(6, 'DABAR INSPECTORATE GENERALE', NULL, 7, 'info@localhost.com', NULL, NULL, NULL, NULL, NULL, '2023-07-31 08:56:29', '2023-07-31 08:56:29');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `model_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'user.create', 'web', 1, 'Add new items', '2022-04-28 08:53:14', '2022-04-28 08:53:14'),
(2, 'user.view', 'web', 1, 'View any item', '2022-04-28 08:53:14', '2022-04-28 08:53:14'),
(3, 'user.update', 'web', 1, 'Update any item', '2022-04-28 08:53:14', '2022-04-28 08:53:14'),
(4, 'user.delete', 'web', 1, 'Delete any item', '2022-04-28 08:53:14', '2022-04-28 08:53:14'),
(5, 'user.index', 'web', 1, 'View all listing page', '2022-04-28 08:53:14', '2022-04-28 08:53:14'),
(6, 'user.*', 'web', 1, 'Manage all', '2022-04-28 08:53:14', '2022-04-28 08:53:14'),
(12, 'model.create', 'web', 2, 'Add new items', '2022-04-28 08:53:56', '2022-04-28 08:53:56'),
(13, 'model.view', 'web', 2, 'View any item', '2022-04-28 08:53:56', '2022-04-28 08:53:56'),
(14, 'model.update', 'web', 2, 'Update any item', '2022-04-28 08:53:56', '2022-04-28 08:53:56'),
(15, 'model.delete', 'web', 2, 'Delete any item', '2022-04-28 08:53:56', '2022-04-28 08:53:56'),
(16, 'model.index', 'web', 2, 'View all listing page', '2022-04-28 08:53:56', '2022-04-28 08:53:56'),
(17, 'model.*', 'web', 2, 'Manage all', '2022-04-28 08:53:56', '2022-04-28 08:53:56'),
(18, 'role.create', 'web', 3, 'Add new items', '2022-04-28 08:54:16', '2022-04-28 08:54:16'),
(19, 'role.view', 'web', 3, 'View any item', '2022-04-28 08:54:16', '2022-04-28 08:54:16'),
(20, 'role.update', 'web', 3, 'Update any item', '2022-04-28 08:54:16', '2022-04-28 08:54:16'),
(21, 'role.delete', 'web', 3, 'Delete any item', '2022-04-28 08:54:16', '2022-04-28 08:54:16'),
(22, 'role.index', 'web', 3, 'View all listing page', '2022-04-28 08:54:16', '2022-04-28 08:54:16'),
(23, 'role.*', 'web', 3, 'Manage all', '2022-04-28 08:54:16', '2022-04-28 08:54:16'),
(24, 'permission.create', 'web', 4, 'Add new items', '2022-04-28 08:54:30', '2022-04-28 08:54:30'),
(25, 'permission.view', 'web', 4, 'View any item', '2022-04-28 08:54:30', '2022-04-28 08:54:30'),
(26, 'permission.update', 'web', 4, 'Update any item', '2022-04-28 08:54:30', '2022-04-28 08:54:30'),
(27, 'permission.delete', 'web', 4, 'Delete any item', '2022-04-28 08:54:30', '2022-04-28 08:54:30'),
(28, 'permission.index', 'web', 4, 'View all listing page', '2022-04-28 08:54:30', '2022-04-28 08:54:30'),
(29, 'permission.*', 'web', 4, 'Manage all', '2022-04-28 08:54:30', '2022-04-28 08:54:30'),
(30, 'media.create', 'web', 5, 'Add new items', '2022-04-28 08:54:53', '2022-04-28 08:54:53'),
(31, 'media.view', 'web', 5, 'View any item', '2022-04-28 08:54:53', '2022-04-28 08:54:53'),
(32, 'media.update', 'web', 5, 'Update any item', '2022-04-28 08:54:53', '2022-04-28 08:54:53'),
(33, 'media.delete', 'web', 5, 'Delete any item', '2022-04-28 08:54:53', '2022-04-28 08:54:53'),
(34, 'media.index', 'web', 5, 'View all listing page', '2022-04-28 08:54:53', '2022-04-28 08:54:53'),
(35, 'media.*', 'web', 5, 'Manage all', '2022-04-28 08:54:53', '2022-04-28 08:54:53'),
(36, 'media.view.own', 'web', 5, 'View own items', '2022-04-28 08:54:53', '2022-04-28 08:54:53'),
(37, 'media.update.own', 'web', 5, 'Update own items', '2022-04-28 08:54:53', '2022-04-28 08:54:53'),
(38, 'media.delete.own', 'web', 5, 'Delete own items', '2022-04-28 08:54:53', '2022-04-28 08:54:53'),
(39, 'media.index.own', 'web', 5, 'View own listing page', '2022-04-28 08:54:53', '2022-04-28 08:54:53'),
(40, 'media.*.own', 'web', 5, 'Manage own items', '2022-04-28 08:54:53', '2022-04-28 08:54:53'),
(41, 'team.create', 'web', 6, 'Add new items', '2022-04-28 08:56:43', '2022-04-28 08:56:43'),
(42, 'team.view', 'web', 6, 'View any item', '2022-04-28 08:56:43', '2022-04-28 08:56:43'),
(43, 'team.update', 'web', 6, 'Update any item', '2022-04-28 08:56:44', '2022-04-28 08:56:44'),
(44, 'team.delete', 'web', 6, 'Delete any item', '2022-04-28 08:56:44', '2022-04-28 08:56:44'),
(45, 'team.index', 'web', 6, 'View all listing page', '2022-04-28 08:56:45', '2022-04-28 08:56:45'),
(46, 'team.*', 'web', 6, 'Manage all', '2022-04-28 08:56:45', '2022-04-28 08:56:45'),
(47, 'team.view.own', 'web', 6, 'View own items', '2022-04-28 08:56:45', '2022-04-28 08:56:45'),
(48, 'team.update.own', 'web', 6, 'Update own items', '2022-04-28 08:56:46', '2022-04-28 08:56:46'),
(49, 'team.delete.own', 'web', 6, 'Delete own items', '2022-04-28 08:56:46', '2022-04-28 08:56:46'),
(50, 'team.index.own', 'web', 6, 'View own listing page', '2022-04-28 08:56:46', '2022-04-28 08:56:46'),
(51, 'team.*.own', 'web', 6, 'Manage own items', '2022-04-28 08:56:47', '2022-04-28 08:56:47'),
(52, 'notification.create', 'web', 7, 'Add new items', '2022-04-28 08:57:02', '2022-04-28 08:57:02'),
(53, 'notification.view', 'web', 7, 'View any item', '2022-04-28 08:57:02', '2022-04-28 08:57:02'),
(54, 'notification.update', 'web', 7, 'Update any item', '2022-04-28 08:57:02', '2022-04-28 08:57:02'),
(55, 'notification.delete', 'web', 7, 'Delete any item', '2022-04-28 08:57:02', '2022-04-28 08:57:02'),
(56, 'notification.index', 'web', 7, 'View all listing page', '2022-04-28 08:57:02', '2022-04-28 08:57:02'),
(57, 'notification.*', 'web', 7, 'Manage all', '2022-04-28 08:57:02', '2022-04-28 08:57:02'),
(58, 'notification.view.own', 'web', 7, 'View own items', '2022-04-28 08:57:02', '2022-04-28 08:57:02'),
(59, 'notification.update.own', 'web', 7, 'Update own items', '2022-04-28 08:57:02', '2022-04-28 08:57:02'),
(60, 'notification.delete.own', 'web', 7, 'Delete own items', '2022-04-28 08:57:02', '2022-04-28 08:57:02'),
(61, 'notification.index.own', 'web', 7, 'View own listing page', '2022-04-28 08:57:02', '2022-04-28 08:57:02'),
(62, 'notification.*.own', 'web', 7, 'Manage own items', '2022-04-28 08:57:02', '2022-04-28 08:57:02'),
(63, 'permission_type.create', 'web', 15, 'Add new items', '2022-04-28 09:56:32', '2022-04-28 09:56:32'),
(64, 'permission_type.view', 'web', 15, 'View any item', '2022-04-28 09:56:32', '2022-04-28 09:56:32'),
(65, 'permission_type.update', 'web', 15, 'Update any item', '2022-04-28 09:56:32', '2022-04-28 09:56:32'),
(66, 'permission_type.delete', 'web', 15, 'Delete any item', '2022-04-28 09:56:32', '2022-04-28 09:56:32'),
(67, 'permission_type.index', 'web', 15, 'View all listing page', '2022-04-28 09:56:32', '2022-04-28 09:56:32'),
(68, 'permission_type.*', 'web', 15, 'Manage all', '2022-04-28 09:56:32', '2022-04-28 09:56:32'),
(69, 'manage.content', 'web', 16, 'Manage \"Content\"', '2022-04-28 11:33:02', '2022-04-28 11:49:53'),
(70, 'manage.block', 'web', 16, 'Access \"Blocks\"', '2022-04-28 11:41:24', '2022-04-28 11:51:45'),
(71, 'manage.notification', 'web', 16, 'Access \"Notifications\"', '2022-04-28 11:41:24', '2022-04-28 11:51:34'),
(72, 'manage.taxonomy', 'web', 16, 'Access \"Taxonomy\"', '2022-04-28 11:41:24', '2022-04-28 11:51:23'),
(73, 'manage.user', 'web', 16, 'Access \"Users\"', '2022-04-28 11:41:24', '2022-04-28 11:51:12'),
(74, 'manage.role_permission', 'web', 16, 'Access \"Roles & Permission\"', '2022-04-28 11:41:24', '2022-04-28 11:51:00'),
(75, 'manage.team_group', 'web', 16, 'Access \"Teams & Groups\"', '2022-04-28 11:41:24', '2022-04-28 11:50:49'),
(76, 'manage.media', 'web', 16, 'Access \"Media\"', '2022-04-28 11:41:24', '2022-04-28 11:50:39'),
(77, 'manage.layout', 'web', 16, 'Access \"Layout\"', '2022-04-28 11:41:24', '2022-04-28 11:50:28'),
(78, 'manage.field', 'web', 16, 'Access \"Fields\"', '2022-04-28 11:41:24', '2022-04-28 11:50:16'),
(79, 'manage.system', 'web', 16, 'Access \"System\"', '2022-04-28 11:41:24', '2022-04-28 11:50:08'),
(80, 'case_management.create', 'web', 17, 'Add new items', '2023-06-15 16:29:55', '2023-06-15 16:29:55'),
(81, 'case_management.view', 'web', 17, 'View any item', '2023-06-15 16:29:55', '2023-06-15 16:29:55'),
(82, 'case_management.update', 'web', 17, 'Update any item', '2023-06-15 16:29:55', '2023-06-15 16:29:55'),
(83, 'case_management.delete', 'web', 17, 'Delete any item', '2023-06-15 16:29:55', '2023-06-15 16:29:55'),
(84, 'case_management.index', 'web', 17, 'View all listing page', '2023-06-15 16:29:55', '2023-06-15 16:29:55'),
(85, 'case_management.*', 'web', 17, 'Manage all', '2023-06-15 16:29:55', '2023-06-15 16:29:55'),
(86, 'case_management.view.own', 'web', 17, 'View own items', '2023-06-15 16:29:55', '2023-06-15 16:29:55'),
(87, 'case_management.update.own', 'web', 17, 'Update own items', '2023-06-15 16:29:55', '2023-06-15 16:29:55'),
(88, 'case_management.delete.own', 'web', 17, 'Delete own items', '2023-06-15 16:29:55', '2023-06-15 16:29:55'),
(89, 'case_management.index.own', 'web', 17, 'View own listing page', '2023-06-15 16:29:55', '2023-06-15 16:29:55'),
(90, 'case_management.*.own', 'web', 17, 'Manage own items', '2023-06-15 16:29:55', '2023-06-15 16:29:55'),
(91, 'case_contributor.create', 'web', 18, 'Add new items', '2023-06-15 16:30:23', '2023-06-15 16:30:23'),
(92, 'case_contributor.view', 'web', 18, 'View any item', '2023-06-15 16:30:23', '2023-06-15 16:30:23'),
(93, 'case_contributor.update', 'web', 18, 'Update any item', '2023-06-15 16:30:23', '2023-06-15 16:30:23'),
(94, 'case_contributor.delete', 'web', 18, 'Delete any item', '2023-06-15 16:30:23', '2023-06-15 16:30:23'),
(95, 'case_contributor.index', 'web', 18, 'View all listing page', '2023-06-15 16:30:23', '2023-06-15 16:30:23'),
(96, 'case_contributor.*', 'web', 18, 'Manage all', '2023-06-15 16:30:23', '2023-06-15 16:30:23'),
(97, 'case_contributor.view.own', 'web', 18, 'View own items', '2023-06-15 16:30:23', '2023-06-15 16:30:23'),
(98, 'case_contributor.update.own', 'web', 18, 'Update own items', '2023-06-15 16:30:23', '2023-06-15 16:30:23'),
(99, 'case_contributor.delete.own', 'web', 18, 'Delete own items', '2023-06-15 16:30:23', '2023-06-15 16:30:23'),
(100, 'case_contributor.index.own', 'web', 18, 'View own listing page', '2023-06-15 16:30:23', '2023-06-15 16:30:23'),
(101, 'case_contributor.*.own', 'web', 18, 'Manage own items', '2023-06-15 16:30:23', '2023-06-15 16:30:23'),
(102, 'case_coordinator.create', 'web', 19, 'Add new items', '2023-06-15 16:30:43', '2023-06-15 16:30:43'),
(103, 'case_coordinator.view', 'web', 19, 'View any item', '2023-06-15 16:30:43', '2023-06-15 16:30:43'),
(104, 'case_coordinator.update', 'web', 19, 'Update any item', '2023-06-15 16:30:43', '2023-06-15 16:30:43'),
(105, 'case_coordinator.delete', 'web', 19, 'Delete any item', '2023-06-15 16:30:43', '2023-06-15 16:30:43'),
(106, 'case_coordinator.index', 'web', 19, 'View all listing page', '2023-06-15 16:30:43', '2023-06-15 16:30:43'),
(107, 'case_coordinator.*', 'web', 19, 'Manage all', '2023-06-15 16:30:43', '2023-06-15 16:30:43'),
(108, 'case_coordinator.view.own', 'web', 19, 'View own items', '2023-06-15 16:30:43', '2023-06-15 16:30:43'),
(109, 'case_coordinator.update.own', 'web', 19, 'Update own items', '2023-06-15 16:30:43', '2023-06-15 16:30:43'),
(110, 'case_coordinator.delete.own', 'web', 19, 'Delete own items', '2023-06-15 16:30:43', '2023-06-15 16:30:43'),
(111, 'case_coordinator.index.own', 'web', 19, 'View own listing page', '2023-06-15 16:30:43', '2023-06-15 16:30:43'),
(112, 'case_coordinator.*.own', 'web', 19, 'Manage own items', '2023-06-15 16:30:43', '2023-06-15 16:30:43'),
(113, 'case_finding.create', 'web', 20, 'Add new items', '2023-06-15 18:49:29', '2023-06-15 18:49:29'),
(114, 'case_finding.view', 'web', 20, 'View any item', '2023-06-15 18:49:29', '2023-06-15 18:49:29'),
(115, 'case_finding.update', 'web', 20, 'Update any item', '2023-06-15 18:49:29', '2023-06-15 18:49:29'),
(116, 'case_finding.delete', 'web', 20, 'Delete any item', '2023-06-15 18:49:29', '2023-06-15 18:49:29'),
(117, 'case_finding.index', 'web', 20, 'View all listing page', '2023-06-15 18:49:29', '2023-06-15 18:49:29'),
(118, 'case_finding.*', 'web', 20, 'Manage all', '2023-06-15 18:49:29', '2023-06-15 18:49:29'),
(119, 'case_finding.view.own', 'web', 20, 'View own items', '2023-06-15 18:49:29', '2023-06-15 18:49:29'),
(120, 'case_finding.update.own', 'web', 20, 'Update own items', '2023-06-15 18:49:29', '2023-06-15 18:49:29'),
(121, 'case_finding.delete.own', 'web', 20, 'Delete own items', '2023-06-15 18:49:29', '2023-06-15 18:49:29'),
(122, 'case_finding.index.own', 'web', 20, 'View own listing page', '2023-06-15 18:49:29', '2023-06-15 18:49:29'),
(123, 'case_finding.*.own', 'web', 20, 'Manage own items', '2023-06-15 18:49:29', '2023-06-15 18:49:29'),
(124, 'case_investigation.create', 'web', 21, 'Add new items', '2023-06-15 18:50:13', '2023-06-15 18:50:13'),
(125, 'case_investigation.view', 'web', 21, 'View any item', '2023-06-15 18:50:13', '2023-06-15 18:50:13'),
(126, 'case_investigation.update', 'web', 21, 'Update any item', '2023-06-15 18:50:13', '2023-06-15 18:50:13'),
(127, 'case_investigation.delete', 'web', 21, 'Delete any item', '2023-06-15 18:50:13', '2023-06-15 18:50:13'),
(128, 'case_investigation.index', 'web', 21, 'View all listing page', '2023-06-15 18:50:13', '2023-06-15 18:50:13'),
(129, 'case_investigation.*', 'web', 21, 'Manage all', '2023-06-15 18:50:13', '2023-06-15 18:50:13'),
(130, 'case_investigation.view.own', 'web', 21, 'View own items', '2023-06-15 18:50:13', '2023-06-15 18:50:13'),
(131, 'case_investigation.update.own', 'web', 21, 'Update own items', '2023-06-15 18:50:13', '2023-06-15 18:50:13'),
(132, 'case_investigation.delete.own', 'web', 21, 'Delete own items', '2023-06-15 18:50:13', '2023-06-15 18:50:13'),
(133, 'case_investigation.index.own', 'web', 21, 'View own listing page', '2023-06-15 18:50:13', '2023-06-15 18:50:13'),
(134, 'case_investigation.*.own', 'web', 21, 'Manage own items', '2023-06-15 18:50:13', '2023-06-15 18:50:13'),
(135, 'case_type.create', 'web', 22, 'Add new items', '2023-06-15 18:50:45', '2023-06-15 18:50:45'),
(136, 'case_type.view', 'web', 22, 'View any item', '2023-06-15 18:50:45', '2023-06-15 18:50:45'),
(137, 'case_type.update', 'web', 22, 'Update any item', '2023-06-15 18:50:45', '2023-06-15 18:50:45'),
(138, 'case_type.delete', 'web', 22, 'Delete any item', '2023-06-15 18:50:45', '2023-06-15 18:50:45'),
(139, 'case_type.index', 'web', 22, 'View all listing page', '2023-06-15 18:50:45', '2023-06-15 18:50:45'),
(140, 'case_type.*', 'web', 22, 'Manage all', '2023-06-15 18:50:45', '2023-06-15 18:50:45'),
(141, 'contact_point.create', 'web', 23, 'Add new items', '2023-06-15 18:51:07', '2023-06-15 18:51:07'),
(142, 'contact_point.view', 'web', 23, 'View any item', '2023-06-15 18:51:08', '2023-06-15 18:51:08'),
(143, 'contact_point.update', 'web', 23, 'Update any item', '2023-06-15 18:51:08', '2023-06-15 18:51:08'),
(144, 'contact_point.delete', 'web', 23, 'Delete any item', '2023-06-15 18:51:08', '2023-06-15 18:51:08'),
(145, 'contact_point.index', 'web', 23, 'View all listing page', '2023-06-15 18:51:08', '2023-06-15 18:51:08'),
(146, 'contact_point.*', 'web', 23, 'Manage all', '2023-06-15 18:51:08', '2023-06-15 18:51:08'),
(147, 'contact_point.view.own', 'web', 23, 'View own items', '2023-06-15 18:51:08', '2023-06-15 18:51:08'),
(148, 'contact_point.update.own', 'web', 23, 'Update own items', '2023-06-15 18:51:08', '2023-06-15 18:51:08'),
(149, 'contact_point.delete.own', 'web', 23, 'Delete own items', '2023-06-15 18:51:08', '2023-06-15 18:51:08'),
(150, 'contact_point.index.own', 'web', 23, 'View own listing page', '2023-06-15 18:51:08', '2023-06-15 18:51:08'),
(151, 'contact_point.*.own', 'web', 23, 'Manage own items', '2023-06-15 18:51:08', '2023-06-15 18:51:08'),
(152, 'country.create', 'web', 24, 'Add new items', '2023-06-15 18:51:35', '2023-06-15 18:51:35'),
(153, 'country.view', 'web', 24, 'View any item', '2023-06-15 18:51:35', '2023-06-15 18:51:35'),
(154, 'country.update', 'web', 24, 'Update any item', '2023-06-15 18:51:35', '2023-06-15 18:51:35'),
(155, 'country.delete', 'web', 24, 'Delete any item', '2023-06-15 18:51:35', '2023-06-15 18:51:35'),
(156, 'country.index', 'web', 24, 'View all listing page', '2023-06-15 18:51:35', '2023-06-15 18:51:35'),
(157, 'country.*', 'web', 24, 'Manage all', '2023-06-15 18:51:35', '2023-06-15 18:51:35'),
(158, 'country.view.own', 'web', 24, 'View own items', '2023-06-15 18:51:35', '2023-06-15 18:51:35'),
(159, 'country.update.own', 'web', 24, 'Update own items', '2023-06-15 18:51:35', '2023-06-15 18:51:35'),
(160, 'country.delete.own', 'web', 24, 'Delete own items', '2023-06-15 18:51:35', '2023-06-15 18:51:35'),
(161, 'country.index.own', 'web', 24, 'View own listing page', '2023-06-15 18:51:35', '2023-06-15 18:51:35'),
(162, 'country.*.own', 'web', 24, 'Manage own items', '2023-06-15 18:51:35', '2023-06-15 18:51:35'),
(163, 'information_request.create', 'web', 25, 'Add new items', '2023-06-15 18:52:08', '2023-06-15 18:52:08'),
(164, 'information_request.view', 'web', 25, 'View any item', '2023-06-15 18:52:08', '2023-06-15 18:52:08'),
(165, 'information_request.update', 'web', 25, 'Update any item', '2023-06-15 18:52:08', '2023-06-15 18:52:08'),
(166, 'information_request.delete', 'web', 25, 'Delete any item', '2023-06-15 18:52:08', '2023-06-15 18:52:08'),
(167, 'information_request.index', 'web', 25, 'View all listing page', '2023-06-15 18:52:08', '2023-06-15 18:52:08'),
(168, 'information_request.*', 'web', 25, 'Manage all', '2023-06-15 18:52:08', '2023-06-15 18:52:08'),
(169, 'information_request.view.own', 'web', 25, 'View own items', '2023-06-15 18:52:08', '2023-06-15 18:52:08'),
(170, 'information_request.update.own', 'web', 25, 'Update own items', '2023-06-15 18:52:08', '2023-06-15 18:52:08'),
(171, 'information_request.delete.own', 'web', 25, 'Delete own items', '2023-06-15 18:52:08', '2023-06-15 18:52:08'),
(172, 'information_request.index.own', 'web', 25, 'View own listing page', '2023-06-15 18:52:08', '2023-06-15 18:52:08'),
(173, 'information_request.*.own', 'web', 25, 'Manage own items', '2023-06-15 18:52:08', '2023-06-15 18:52:08'),
(174, 'information_restriction.create', 'web', 26, 'Add new items', '2023-06-15 18:52:31', '2023-06-15 18:52:31'),
(175, 'information_restriction.view', 'web', 26, 'View any item', '2023-06-15 18:52:31', '2023-06-15 18:52:31'),
(176, 'information_restriction.update', 'web', 26, 'Update any item', '2023-06-15 18:52:31', '2023-06-15 18:52:31'),
(177, 'information_restriction.delete', 'web', 26, 'Delete any item', '2023-06-15 18:52:31', '2023-06-15 18:52:31'),
(178, 'information_restriction.index', 'web', 26, 'View all listing page', '2023-06-15 18:52:31', '2023-06-15 18:52:31'),
(179, 'information_restriction.*', 'web', 26, 'Manage all', '2023-06-15 18:52:31', '2023-06-15 18:52:31'),
(180, 'information_restriction.view.own', 'web', 26, 'View own items', '2023-06-15 18:52:31', '2023-06-15 18:52:31'),
(181, 'information_restriction.update.own', 'web', 26, 'Update own items', '2023-06-15 18:52:31', '2023-06-15 18:52:31'),
(182, 'information_restriction.delete.own', 'web', 26, 'Delete own items', '2023-06-15 18:52:31', '2023-06-15 18:52:31'),
(183, 'information_restriction.index.own', 'web', 26, 'View own listing page', '2023-06-15 18:52:31', '2023-06-15 18:52:31'),
(184, 'information_restriction.*.own', 'web', 26, 'Manage own items', '2023-06-15 18:52:31', '2023-06-15 18:52:31'),
(185, 'internal_communication.create', 'web', 27, 'Add new items', '2023-06-15 18:53:04', '2023-06-15 18:53:04'),
(186, 'internal_communication.view', 'web', 27, 'View any item', '2023-06-15 18:53:04', '2023-06-15 18:53:04'),
(187, 'internal_communication.update', 'web', 27, 'Update any item', '2023-06-15 18:53:04', '2023-06-15 18:53:04'),
(188, 'internal_communication.delete', 'web', 27, 'Delete any item', '2023-06-15 18:53:04', '2023-06-15 18:53:04'),
(189, 'internal_communication.index', 'web', 27, 'View all listing page', '2023-06-15 18:53:04', '2023-06-15 18:53:04'),
(190, 'internal_communication.*', 'web', 27, 'Manage all', '2023-06-15 18:53:04', '2023-06-15 18:53:04'),
(191, 'internal_communication.view.own', 'web', 27, 'View own items', '2023-06-15 18:53:04', '2023-06-15 18:53:04'),
(192, 'internal_communication.update.own', 'web', 27, 'Update own items', '2023-06-15 18:53:04', '2023-06-15 18:53:04'),
(193, 'internal_communication.delete.own', 'web', 27, 'Delete own items', '2023-06-15 18:53:04', '2023-06-15 18:53:04'),
(194, 'internal_communication.index.own', 'web', 27, 'View own listing page', '2023-06-15 18:53:05', '2023-06-15 18:53:05'),
(195, 'internal_communication.*.own', 'web', 27, 'Manage own items', '2023-06-15 18:53:05', '2023-06-15 18:53:05'),
(196, 'member_state.create', 'web', 28, 'Add new items', '2023-06-15 18:53:28', '2023-06-15 18:53:28'),
(197, 'member_state.view', 'web', 28, 'View any item', '2023-06-15 18:53:28', '2023-06-15 18:53:28'),
(198, 'member_state.update', 'web', 28, 'Update any item', '2023-06-15 18:53:28', '2023-06-15 18:53:28'),
(199, 'member_state.delete', 'web', 28, 'Delete any item', '2023-06-15 18:53:28', '2023-06-15 18:53:28'),
(200, 'member_state.index', 'web', 28, 'View all listing page', '2023-06-15 18:53:28', '2023-06-15 18:53:28'),
(201, 'member_state.*', 'web', 28, 'Manage all', '2023-06-15 18:53:28', '2023-06-15 18:53:28'),
(202, 'nature_of_offence.create', 'web', 29, 'Add new items', '2023-06-15 18:54:09', '2023-06-15 18:54:09'),
(203, 'nature_of_offence.view', 'web', 29, 'View any item', '2023-06-15 18:54:09', '2023-06-15 18:54:09'),
(204, 'nature_of_offence.update', 'web', 29, 'Update any item', '2023-06-15 18:54:09', '2023-06-15 18:54:09'),
(205, 'nature_of_offence.delete', 'web', 29, 'Delete any item', '2023-06-15 18:54:09', '2023-06-15 18:54:09'),
(206, 'nature_of_offence.index', 'web', 29, 'View all listing page', '2023-06-15 18:54:09', '2023-06-15 18:54:09'),
(207, 'nature_of_offence.*', 'web', 29, 'Manage all', '2023-06-15 18:54:09', '2023-06-15 18:54:09'),
(208, 'organization.create', 'web', 30, 'Add new items', '2023-06-15 18:54:29', '2023-06-15 18:54:29'),
(209, 'organization.view', 'web', 30, 'View any item', '2023-06-15 18:54:29', '2023-06-15 18:54:29'),
(210, 'organization.update', 'web', 30, 'Update any item', '2023-06-15 18:54:29', '2023-06-15 18:54:29'),
(211, 'organization.delete', 'web', 30, 'Delete any item', '2023-06-15 18:54:29', '2023-06-15 18:54:29'),
(212, 'organization.index', 'web', 30, 'View all listing page', '2023-06-15 18:54:29', '2023-06-15 18:54:29'),
(213, 'organization.*', 'web', 30, 'Manage all', '2023-06-15 18:54:29', '2023-06-15 18:54:29'),
(214, 'forum_category.create', 'web', 31, 'Add new items', '2023-06-15 19:00:15', '2023-06-15 19:00:15'),
(215, 'forum_category.view', 'web', 31, 'View any item', '2023-06-15 19:00:15', '2023-06-15 19:00:15'),
(216, 'forum_category.update', 'web', 31, 'Update any item', '2023-06-15 19:00:15', '2023-06-15 19:00:15'),
(217, 'forum_category.delete', 'web', 31, 'Delete any item', '2023-06-15 19:00:15', '2023-06-15 19:00:15'),
(218, 'forum_category.index', 'web', 31, 'View all listing page', '2023-06-15 19:00:15', '2023-06-15 19:00:15'),
(219, 'forum_category.*', 'web', 31, 'Manage all', '2023-06-15 19:00:15', '2023-06-15 19:00:15'),
(220, 'forum_category.view.own', 'web', 31, 'View own items', '2023-06-15 19:00:15', '2023-06-15 19:00:15'),
(221, 'forum_category.update.own', 'web', 31, 'Update own items', '2023-06-15 19:00:15', '2023-06-15 19:00:15'),
(222, 'forum_category.delete.own', 'web', 31, 'Delete own items', '2023-06-15 19:00:15', '2023-06-15 19:00:15'),
(223, 'forum_category.index.own', 'web', 31, 'View own listing page', '2023-06-15 19:00:15', '2023-06-15 19:00:15'),
(224, 'forum_category.*.own', 'web', 31, 'Manage own items', '2023-06-15 19:00:15', '2023-06-15 19:00:15'),
(225, 'forum_topic.create', 'web', 32, 'Add new items', '2023-06-15 19:00:39', '2023-06-15 19:00:39'),
(226, 'forum_topic.view', 'web', 32, 'View any item', '2023-06-15 19:00:39', '2023-06-15 19:00:39'),
(227, 'forum_topic.update', 'web', 32, 'Update any item', '2023-06-15 19:00:39', '2023-06-15 19:00:39'),
(228, 'forum_topic.delete', 'web', 32, 'Delete any item', '2023-06-15 19:00:39', '2023-06-15 19:00:39'),
(229, 'forum_topic.index', 'web', 32, 'View all listing page', '2023-06-15 19:00:39', '2023-06-15 19:00:39'),
(230, 'forum_topic.*', 'web', 32, 'Manage all', '2023-06-15 19:00:39', '2023-06-15 19:00:39'),
(231, 'forum_topic.view.own', 'web', 32, 'View own items', '2023-06-15 19:00:39', '2023-06-15 19:00:39'),
(232, 'forum_topic.update.own', 'web', 32, 'Update own items', '2023-06-15 19:00:39', '2023-06-15 19:00:39'),
(233, 'forum_topic.delete.own', 'web', 32, 'Delete own items', '2023-06-15 19:00:39', '2023-06-15 19:00:39'),
(234, 'forum_topic.index.own', 'web', 32, 'View own listing page', '2023-06-15 19:00:40', '2023-06-15 19:00:40'),
(235, 'forum_topic.*.own', 'web', 32, 'Manage own items', '2023-06-15 19:00:40', '2023-06-15 19:00:40'),
(236, 'email.create', 'web', 33, 'Add new items', '2023-06-15 19:01:04', '2023-06-15 19:01:04'),
(237, 'email.view', 'web', 33, 'View any item', '2023-06-15 19:01:04', '2023-06-15 19:01:04'),
(238, 'email.update', 'web', 33, 'Update any item', '2023-06-15 19:01:04', '2023-06-15 19:01:04'),
(239, 'email.delete', 'web', 33, 'Delete any item', '2023-06-15 19:01:04', '2023-06-15 19:01:04'),
(240, 'email.index', 'web', 33, 'View all listing page', '2023-06-15 19:01:04', '2023-06-15 19:01:04'),
(241, 'email.*', 'web', 33, 'Manage all', '2023-06-15 19:01:04', '2023-06-15 19:01:04'),
(242, 'email.view.own', 'web', 33, 'View own items', '2023-06-15 19:01:04', '2023-06-15 19:01:04'),
(243, 'email.update.own', 'web', 33, 'Update own items', '2023-06-15 19:01:04', '2023-06-15 19:01:04'),
(244, 'email.delete.own', 'web', 33, 'Delete own items', '2023-06-15 19:01:04', '2023-06-15 19:01:04'),
(245, 'email.index.own', 'web', 33, 'View own listing page', '2023-06-15 19:01:04', '2023-06-15 19:01:04'),
(246, 'email.*.own', 'web', 33, 'Manage own items', '2023-06-15 19:01:04', '2023-06-15 19:01:04'),
(247, 'job_advert.create', 'web', 35, 'Add new items', '2023-06-15 19:02:05', '2023-06-15 19:02:05'),
(248, 'job_advert.view', 'web', 35, 'View any item', '2023-06-15 19:02:05', '2023-06-15 19:02:05'),
(249, 'job_advert.update', 'web', 35, 'Update any item', '2023-06-15 19:02:05', '2023-06-15 19:02:05'),
(250, 'job_advert.delete', 'web', 35, 'Delete any item', '2023-06-15 19:02:05', '2023-06-15 19:02:05'),
(251, 'job_advert.index', 'web', 35, 'View all listing page', '2023-06-15 19:02:05', '2023-06-15 19:02:05'),
(252, 'job_advert.*', 'web', 35, 'Manage all', '2023-06-15 19:02:05', '2023-06-15 19:02:05'),
(253, 'job_advert.view.own', 'web', 35, 'View own items', '2023-06-15 19:02:05', '2023-06-15 19:02:05'),
(254, 'job_advert.update.own', 'web', 35, 'Update own items', '2023-06-15 19:02:05', '2023-06-15 19:02:05'),
(255, 'job_advert.delete.own', 'web', 35, 'Delete own items', '2023-06-15 19:02:05', '2023-06-15 19:02:05'),
(256, 'job_advert.index.own', 'web', 35, 'View own listing page', '2023-06-15 19:02:05', '2023-06-15 19:02:05'),
(257, 'job_advert.*.own', 'web', 35, 'Manage own items', '2023-06-15 19:02:05', '2023-06-15 19:02:05');

-- --------------------------------------------------------

--
-- Table structure for table `permission_types`
--

CREATE TABLE `permission_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_types`
--

INSERT INTO `permission_types` (`id`, `name`, `position`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '.create', NULL, 'Add new items', NULL, '2022-04-28 08:51:50', '2022-04-28 08:51:50'),
(2, '.view', NULL, 'View any item', NULL, '2022-04-28 08:51:50', '2022-04-28 08:51:50'),
(3, '.update', NULL, 'Update any item', NULL, '2022-04-28 08:51:50', '2022-04-28 08:51:50'),
(4, '.delete', NULL, 'Delete any item', NULL, '2022-04-28 08:51:50', '2022-04-28 08:51:50'),
(5, '.index', NULL, 'View all listing page', NULL, '2022-04-28 08:51:50', '2022-04-28 08:51:50'),
(6, '.*', NULL, 'Manage all', NULL, '2022-04-28 08:51:50', '2022-04-28 08:51:50'),
(7, '.view.own', NULL, 'View own items', NULL, '2022-04-28 08:51:50', '2022-04-28 08:51:50'),
(8, '.update.own', NULL, 'Update own items', NULL, '2022-04-28 08:51:50', '2022-04-28 08:51:50'),
(9, '.delete.own', NULL, 'Delete own items', NULL, '2022-04-28 08:51:50', '2022-04-28 08:51:50'),
(10, '.index.own', NULL, 'View own listing page', NULL, '2022-04-28 08:51:50', '2022-04-28 08:51:50'),
(11, '.*.own', NULL, 'Manage own items', NULL, '2022-04-28 08:51:50', '2022-04-28 08:51:50');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_responses`
--

CREATE TABLE `request_responses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `response` text COLLATE utf8mb4_unicode_ci,
  `information_request_id` bigint(20) UNSIGNED NOT NULL,
  `date_of_response` datetime NOT NULL,
  `feedback_on` datetime DEFAULT NULL,
  `feedback_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `feedback_notes` text COLLATE utf8mb4_unicode_ci,
  `feedback_status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `request_responses`
--

INSERT INTO `request_responses` (`id`, `response`, `information_request_id`, `date_of_response`, `feedback_on`, `feedback_by_id`, `feedback_notes`, `feedback_status_id`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '<p>The response goes here</p><p><strong>….</strong></p>', 1, '2023-07-06 08:19:00', '2023-07-16 16:07:15', 1, NULL, 4, NULL, NULL, '2023-07-09 05:15:34', '2023-07-23 11:22:02'),
(2, '<p>ads</p>', 2, '2023-07-09 11:29:00', NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-09 08:29:03', '2023-07-09 08:30:21'),
(3, '<p>zd fed</p>', 1, '2023-07-09 19:52:55', '2023-07-16 16:08:19', 1, NULL, 5, NULL, NULL, '2023-07-09 16:52:55', '2023-07-23 11:21:54'),
(4, '<p>&nbsp;asdfs</p>', 7, '2023-07-23 13:35:00', '0000-00-00 00:00:00', 1, NULL, 5, NULL, NULL, '2023-07-23 10:35:49', '2023-07-23 11:31:18'),
(5, '<p>jaj</p>', 8, '2023-07-23 15:08:00', '2023-07-23 15:08:24', 1, NULL, 5, NULL, NULL, '2023-07-23 12:08:11', '2023-07-23 12:08:24'),
(6, '<p>aAS AS A</p>', 8, '2023-07-23 15:08:53', '2023-07-23 15:09:08', 1, NULL, 4, NULL, NULL, '2023-07-23 12:08:53', '2023-07-23 14:29:31'),
(7, '<p>ygj</p>', 9, '2023-07-23 15:10:21', '2023-07-23 15:10:30', 1, NULL, 5, NULL, NULL, '2023-07-23 12:10:21', '2023-07-23 12:10:30'),
(8, '<p>werewrwe</p>', 7, '2023-07-23 16:15:40', '2023-07-23 16:16:00', 1, NULL, 5, NULL, NULL, '2023-07-23 13:15:40', '2023-07-23 13:16:00'),
(9, '<p>This is the response for your request</p>', 12, '2023-07-26 15:09:33', '2023-07-26 15:10:30', 1, NULL, 4, NULL, NULL, '2023-07-26 12:09:33', '2023-07-26 12:10:30'),
(10, '<p>This is the response to your Information Request</p>', 13, '2023-07-19 15:49:00', '2023-07-26 15:51:09', 1, NULL, 4, NULL, NULL, '2023-07-26 12:49:43', '2023-07-26 12:51:09');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'web', '2022-01-20 07:39:05', '2022-01-20 07:39:05'),
(2, 'IT Team', 'web', '2022-01-20 07:39:05', '2023-06-15 12:56:16'),
(3, 'Contact Point', 'web', '2023-06-15 12:54:36', '2023-06-15 12:54:36');

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
(6, 1),
(17, 1),
(23, 1),
(29, 1),
(35, 1),
(46, 1),
(57, 1),
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
(85, 1),
(96, 1),
(107, 1),
(118, 1),
(129, 1),
(140, 1),
(146, 1),
(157, 1),
(168, 1),
(179, 1),
(190, 1),
(201, 1),
(207, 1),
(213, 1),
(219, 1),
(230, 1),
(241, 1),
(252, 1),
(69, 2),
(70, 2),
(72, 2),
(74, 2),
(75, 2),
(76, 2),
(77, 2),
(78, 2),
(79, 2),
(5, 3),
(36, 3),
(37, 3),
(38, 3),
(39, 3),
(40, 3),
(80, 3),
(84, 3),
(90, 3),
(163, 3),
(167, 3),
(178, 3),
(200, 3),
(206, 3),
(212, 3),
(218, 3),
(229, 3),
(240, 3),
(251, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('g5x3PhzHEJjnHANw3ncmUmORN76AoSzAYwh1p83h', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibmtwdWFvZFU0akhkTm1BNGlYRkVPenlEWkJwMkhoNks2MkF1VVNoViI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1MjoiaHR0cDovLzEyNy4wLjAuMTo4MDAxL2Rhc2hib2FyZC9pbmZvcm1hdGlvbi1yZXF1ZXN0cyI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDEvZm9yZ290LXBhc3N3b3JkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1691240282),
('I4YteKw2aOLY2rDlLwWeyi1w8HQRnuMtrcP4FQkx', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRlpESnFaNjdKOUFZNmsySHdhTFF0YVVUQWtWRHJkN3ZoQno3OUxrOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkTUFyc3lkUjZpdUZpYXMvVGJXNTVOdXNqTUMuTDh5anE5V3guclRWYkJoOWZ5ZnU3M0VDdG0iO30=', 1696323995),
('TzZO8xeqRoaOByaDOedUso8t4nj7rrbzZYlSPbs8', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.6.1 Safari/605.1.15', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSG1DdmViZkJwaXJkd2xmYU9UT2EwdDBUSkpXQ21Xc1JrSXkwTjJzWiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkTUFyc3lkUjZpdUZpYXMvVGJXNTVOdXNqTUMuTDh5anE5V3guclRWYkJoOWZ5ZnU3M0VDdG0iO30=', 1691241570);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`, `status_category`, `body`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'APPROVED', 'InformationRequestReview', NULL, NULL, '2023-03-01 16:11:26', '2023-07-16 06:32:39'),
(2, 'PENDING', 'InformationRequestReview', NULL, NULL, '2023-03-01 16:11:32', '2023-07-31 09:15:06'),
(3, 'REJECTED', NULL, NULL, NULL, '2023-03-01 16:11:43', '2023-07-31 09:21:47'),
(4, 'ACCEPTED', 'RequestResponse', NULL, NULL, '2023-07-16 12:51:07', '2023-07-16 12:51:07'),
(5, 'MORE INFORMATION NEEDED', 'RequestResponse', NULL, NULL, '2023-07-16 12:52:08', '2023-07-31 09:24:25');

-- --------------------------------------------------------

--
-- Table structure for table `taxonomy_termables`
--

CREATE TABLE `taxonomy_termables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `taxonomy_term_id` bigint(20) UNSIGNED NOT NULL,
  `taxonomy_termable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taxonomy_termable_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxonomy_terms`
--

CREATE TABLE `taxonomy_terms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `taxonomy_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxonomy_terms`
--

INSERT INTO `taxonomy_terms` (`id`, `name`, `description`, `slug`, `user_id`, `taxonomy_type_id`, `parent_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Health', NULL, 'health', NULL, 1, NULL, NULL, '2022-02-27 06:54:33', '2022-02-27 06:54:33'),
(2, 'Development', NULL, 'development', NULL, 1, NULL, NULL, '2022-02-27 06:54:33', '2022-02-27 06:54:33'),
(3, 'IT', NULL, 'it', NULL, 1, NULL, NULL, '2022-02-27 06:54:33', '2022-02-27 06:54:33'),
(4, 'Mr.', NULL, 'mr', NULL, 2, NULL, NULL, '2022-02-27 06:54:33', '2022-02-27 06:54:33'),
(5, 'Mrs', NULL, 'mrs', NULL, 2, NULL, NULL, '2022-02-27 06:54:33', '2022-02-27 06:54:33'),
(6, 'Dr', NULL, 'dr', NULL, 2, NULL, NULL, '2022-02-27 06:54:33', '2022-02-27 06:54:33'),
(7, 'Prof', NULL, 'prof', NULL, 2, NULL, NULL, '2022-02-27 06:54:33', '2022-02-27 06:54:33'),
(8, 'Press Release', NULL, 'press-release', NULL, 3, NULL, NULL, '2022-02-27 06:54:33', '2022-02-27 06:54:33'),
(9, 'Memo', NULL, 'memo', NULL, 3, NULL, NULL, '2022-02-27 06:54:33', '2022-02-27 06:54:33');

-- --------------------------------------------------------

--
-- Table structure for table `taxonomy_types`
--

CREATE TABLE `taxonomy_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxonomy_types`
--

INSERT INTO `taxonomy_types` (`id`, `name`, `description`, `slug`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Tags', 'Use \"Tags\" for tagging on entities', 'tags', NULL, NULL, '2022-02-27 06:54:33', '2022-02-27 06:54:33'),
(2, 'Titles', 'Use \"Titles\" for salutations like Mr., Dr. etc', 'titles', NULL, NULL, '2022-02-27 06:54:33', '2022-02-27 06:54:33'),
(3, 'News Categories', 'Use for News Categories', 'news-categories', NULL, NULL, '2022-02-27 06:54:33', '2022-02-27 06:54:33'),
(4, 'Publication Categories', 'Use for Publication Types/Categories', 'publication-categories', NULL, NULL, '2022-02-27 06:54:33', '2022-02-27 06:54:33');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_team` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_invitations`
--

CREATE TABLE `team_invitations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_user`
--

CREATE TABLE `team_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organization_id` bigint(20) UNSIGNED DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `personal_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_joined` date DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `passport_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_joined_organization` date DEFAULT NULL,
  `area_of_expertise` text COLLATE utf8mb4_unicode_ci,
  `area_of_training_of_trainer` text COLLATE utf8mb4_unicode_ci,
  `access_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `last_seen` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `provider`, `provider_id`, `organization_id`, `designation`, `telephone_number`, `personal_email`, `date_joined`, `dob`, `passport_number`, `date_joined_organization`, `area_of_expertise`, `area_of_training_of_trainer`, `access_token`, `enabled`, `last_seen`, `created_at`, `updated_at`) VALUES
(1, 'ARIN-EA Admin', 'admax@gmail.com', '2022-01-20 07:39:06', '$2y$10$MArsydR6iuFias/TbW55NusjMC.L8yjq9Wx.rTVbBh9fyfu73ECtm', NULL, NULL, 'sG6ti4IOmw4aoQ77wefjbTy2KNG2Pih1NQoPZYSpkVCtq9WC84Banw7vmFu4', NULL, NULL, NULL, NULL, 1, 'Developer', '+256 775415192', 'mulongokato.2000@gmail.com', '2019-10-22', NULL, 'MCXXXXXXXXXXX', NULL, NULL, NULL, NULL, 1, '2023-10-03 12:05:32', '2022-01-20 07:39:06', '2023-10-03 09:05:32'),
(2, 'Richard Nadyope', 'nadyoperichard@gmail.com', '2022-01-20 07:39:06', '$2y$10$SXl2hUD9gwVtHDMnLI.OWu/JmsnowstHHh1/Oi6dVere5F040M.Iq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '+256', 'nadyoperichard@gmail.com', NULL, NULL, 'MX', NULL, NULL, NULL, NULL, 1, NULL, '2022-01-20 07:39:07', '2023-07-16 15:14:04'),
(3, 'Jackie Kibogy', 'jkibogy@integrity.go.ke', '2023-06-15 12:58:40', '$2y$10$alL0v/kX9lyHrMeuS186OuoKITJOFSheAnTsQCvlRSe8Re.04/rfq', NULL, NULL, 's4DCi6Cwp08OPTwUBVdUthamgRHBWSwks4zCFp7OA6TjlV13XiDgFbgMKDMn', NULL, NULL, NULL, NULL, 2, 'Legal Officer, Civil Litigation & Asset Recovery', '723635050', 'jackie.kibogy@gmail.com', '2016-01-11', '1984-02-11', '1213213', '2019-08-15', NULL, NULL, NULL, 1, '2023-07-31 15:34:19', '2023-06-15 12:58:13', '2023-07-31 12:34:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blocks_user_id_foreign` (`user_id`);

--
-- Indexes for table `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cases_is_approved_by_id_foreign` (`approved_by_id`),
  ADD KEY `cases_status_id_foreign` (`status_id`),
  ADD KEY `cases_user_id_foreign` (`user_id`),
  ADD KEY `fk_case_organization_id` (`organization_id`);

--
-- Indexes for table `case_contributors`
--
ALTER TABLE `case_contributors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_contributors_case_id_foreign` (`case_id`),
  ADD KEY `case_contributors_user_id_foreign` (`user_id`),
  ADD KEY `case_contributors_contact_point_id_foreign` (`contact_point_id`);

--
-- Indexes for table `case_coordinators`
--
ALTER TABLE `case_coordinators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_coordinators_case_id_foreign` (`case_id`),
  ADD KEY `case_coordinators_user_id_foreign` (`user_id`),
  ADD KEY `case_coordinators_contact_point_id_foreign` (`contact_point_id`);

--
-- Indexes for table `case_findings`
--
ALTER TABLE `case_findings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_findings_case_investigation_id_foreign` (`case_investigation_id`),
  ADD KEY `case_findings_status_id_foreign` (`status_id`),
  ADD KEY `case_findings_user_id_foreign` (`user_id`);

--
-- Indexes for table `case_investigations`
--
ALTER TABLE `case_investigations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_investigations_case_id_foreign` (`case_id`),
  ADD KEY `case_investigations_assigned_contributor_id_foreign` (`assigned_contributor_id`),
  ADD KEY `case_investigations_status_id_foreign` (`status_id`),
  ADD KEY `case_investigations_user_id_foreign` (`user_id`);

--
-- Indexes for table `case_management`
--
ALTER TABLE `case_management`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_management_is_approved_by_id_foreign` (`is_approved_by_id`),
  ADD KEY `case_management_status_id_foreign` (`status_id`),
  ADD KEY `case_management_user_id_foreign` (`user_id`);

--
-- Indexes for table `case_types`
--
ALTER TABLE `case_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commentables`
--
ALTER TABLE `commentables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commentables_user_id_foreign` (`user_id`),
  ADD KEY `commentables_commentable_id_index` (`commentable_id`),
  ADD KEY `commentables_comment_id_foreign` (`comment_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_parent_id_foreign` (`parent_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_messages_user_id_foreign` (`user_id`);

--
-- Indexes for table `content_blog_posts`
--
ALTER TABLE `content_blog_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `content_blog_posts_slug_unique` (`slug`),
  ADD KEY `content_blog_posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `content_events`
--
ALTER TABLE `content_events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `content_events_slug_unique` (`slug`),
  ADD KEY `content_events_user_id_foreign` (`user_id`);

--
-- Indexes for table `content_featureds`
--
ALTER TABLE `content_featureds`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `content_featureds_slug_unique` (`slug`),
  ADD KEY `content_featureds_user_id_foreign` (`user_id`);

--
-- Indexes for table `content_galleries`
--
ALTER TABLE `content_galleries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `content_galleries_slug_unique` (`slug`),
  ADD KEY `content_galleries_user_id_foreign` (`user_id`);

--
-- Indexes for table `content_news`
--
ALTER TABLE `content_news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `content_news_slug_unique` (`slug`),
  ADD KEY `content_news_user_id_foreign` (`user_id`);

--
-- Indexes for table `content_our_works`
--
ALTER TABLE `content_our_works`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `content_our_works_slug_unique` (`slug`),
  ADD KEY `content_our_works_user_id_foreign` (`user_id`);

--
-- Indexes for table `content_pages`
--
ALTER TABLE `content_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `content_pages_slug_unique` (`slug`),
  ADD KEY `content_pages_user_id_foreign` (`user_id`);

--
-- Indexes for table `content_publications`
--
ALTER TABLE `content_publications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `content_publications_slug_unique` (`slug`),
  ADD KEY `content_publications_user_id_foreign` (`user_id`);

--
-- Indexes for table `content_services`
--
ALTER TABLE `content_services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `content_services_slug_unique` (`slug`),
  ADD KEY `content_services_user_id_foreign` (`user_id`);

--
-- Indexes for table `content_testimonies`
--
ALTER TABLE `content_testimonies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `content_testimonies_slug_unique` (`slug`),
  ADD KEY `content_testimonies_user_id_foreign` (`user_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countryables`
--
ALTER TABLE `countryables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countryables_user_id_foreign` (`user_id`),
  ADD KEY `countryables_countryable_id_index` (`countryable_id`),
  ADD KEY `countryables_country_id_foreign` (`country_id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emails_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `field_blocks`
--
ALTER TABLE `field_blocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `field_blocks_fieldable_type_fieldable_id_index` (`fieldable_type`,`fieldable_id`),
  ADD KEY `field_blocks_user_id_foreign` (`user_id`),
  ADD KEY `field_blocks_block_id_foreign` (`block_id`);

--
-- Indexes for table `field_htmls`
--
ALTER TABLE `field_htmls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `field_htmls_fieldable_type_fieldable_id_index` (`fieldable_type`,`fieldable_id`),
  ADD KEY `field_htmls_user_id_foreign` (`user_id`);

--
-- Indexes for table `field_images`
--
ALTER TABLE `field_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `field_images_fieldable_type_fieldable_id_index` (`fieldable_type`,`fieldable_id`),
  ADD KEY `field_images_user_id_foreign` (`user_id`);

--
-- Indexes for table `field_links`
--
ALTER TABLE `field_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `field_links_fieldable_type_fieldable_id_index` (`fieldable_type`,`fieldable_id`),
  ADD KEY `field_links_user_id_foreign` (`user_id`);

--
-- Indexes for table `field_texts`
--
ALTER TABLE `field_texts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `field_texts_fieldable_type_fieldable_id_index` (`fieldable_type`,`fieldable_id`),
  ADD KEY `field_texts_user_id_foreign` (`user_id`);

--
-- Indexes for table `field_titles`
--
ALTER TABLE `field_titles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `field_titles_fieldable_type_fieldable_id_index` (`fieldable_type`,`fieldable_id`),
  ADD KEY `field_titles_user_id_foreign` (`user_id`);

--
-- Indexes for table `forum_categories`
--
ALTER TABLE `forum_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_topics`
--
ALTER TABLE `forum_topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forum_topics_forum_category_id_foreign` (`forum_category_id`),
  ADD KEY `forum_topics_user_id_foreign` (`user_id`);

--
-- Indexes for table `informationrequest_informationrestriction`
--
ALTER TABLE `informationrequest_informationrestriction`
  ADD KEY `fk_ii_information_request_id` (`information_request_id`),
  ADD KEY `fk_ii_information_restriction_id` (`information_restriction_id`);

--
-- Indexes for table `informationrequest_natureofoffence`
--
ALTER TABLE `informationrequest_natureofoffence`
  ADD KEY `fk_information_request_id` (`information_request_id`),
  ADD KEY `fk_nature_of_offence_id` (`nature_of_offence_id`);

--
-- Indexes for table `information_requests`
--
ALTER TABLE `information_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `information_requests_is_approved_by_id_foreign` (`review_by_id`),
  ADD KEY `information_requests_status_id_foreign` (`status_id`),
  ADD KEY `information_requests_user_id_foreign` (`user_id`),
  ADD KEY `index_ir_member_state_id` (`member_state_id`),
  ADD KEY `organization_id` (`organization_id`),
  ADD KEY `index_ir_case_id` (`case_id`),
  ADD KEY `fk_review_status_id_statuses` (`review_status_id`);

--
-- Indexes for table `information_restrictions`
--
ALTER TABLE `information_restrictions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `information_restrictions_user_id_foreign` (`user_id`);

--
-- Indexes for table `internal_communicationables`
--
ALTER TABLE `internal_communicationables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `internal_communicationables_user_id_foreign` (`user_id`),
  ADD KEY `internal_communicationables_internal_communicationable_id_index` (`internal_communicationable_id`),
  ADD KEY `internal_communicationables_internal_communication_id_foreign` (`internal_communication_id`);

--
-- Indexes for table `internal_communications`
--
ALTER TABLE `internal_communications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `internal_communications_user_id_foreign` (`user_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_adverts`
--
ALTER TABLE `job_adverts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `job_adverts_slug_unique` (`slug`),
  ADD KEY `job_adverts_user_id_foreign` (`user_id`);

--
-- Indexes for table `layout_columns`
--
ALTER TABLE `layout_columns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `layout_columns_layout_row_id_foreign` (`layout_row_id`),
  ADD KEY `layout_columns_user_id_foreign` (`user_id`);

--
-- Indexes for table `layout_rows`
--
ALTER TABLE `layout_rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `layout_rows_fieldable_type_fieldable_id_index` (`fieldable_type`,`fieldable_id`),
  ADD KEY `layout_rows_user_id_foreign` (`user_id`);

--
-- Indexes for table `layout_sections`
--
ALTER TABLE `layout_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `layout_sections_fieldable_type_fieldable_id_index` (`fieldable_type`,`fieldable_id`),
  ADD KEY `layout_sections_user_id_foreign` (`user_id`);

--
-- Indexes for table `layout_section_tops`
--
ALTER TABLE `layout_section_tops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `layout_section_tops_fieldable_type_fieldable_id_index` (`fieldable_type`,`fieldable_id`),
  ADD KEY `layout_section_tops_user_id_foreign` (`user_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_user_id_index` (`user_id`);

--
-- Indexes for table `mediables`
--
ALTER TABLE `mediables`
  ADD KEY `mediables_media_id_index` (`media_id`),
  ADD KEY `mediables_mediable_id_index` (`mediable_id`);

--
-- Indexes for table `media_providers`
--
ALTER TABLE `media_providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_videoables`
--
ALTER TABLE `media_videoables`
  ADD KEY `media_videoables_media_video_id_foreign` (`media_video_id`);

--
-- Indexes for table `media_videos`
--
ALTER TABLE `media_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_videos_provider_id_foreign` (`provider_id`),
  ADD KEY `media_videos_user_id_foreign` (`user_id`);

--
-- Indexes for table `member_states`
--
ALTER TABLE `member_states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_states_user_id_foreign` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_to_user_id_foreign` (`to_user_id`),
  ADD KEY `messages_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `models_id_index` (`id`);

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
-- Indexes for table `nature_of_offences`
--
ALTER TABLE `nature_of_offences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nature_of_offences_user_id_foreign` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organizations_user_id_foreign` (`user_id`),
  ADD KEY `organizations_member_state_id_foreign` (`member_state_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`),
  ADD KEY `permissions_model_id_index` (`model_id`);

--
-- Indexes for table `permission_types`
--
ALTER TABLE `permission_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_types_id_index` (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `request_responses`
--
ALTER TABLE `request_responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_responses_information_request_id_foreign` (`information_request_id`),
  ADD KEY `request_responses_is_approved_by_id_foreign` (`feedback_by_id`),
  ADD KEY `request_responses_user_id_foreign` (`user_id`),
  ADD KEY `fk_ feedback_status_id` (`feedback_status_id`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxonomy_termables`
--
ALTER TABLE `taxonomy_termables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taxonomy_termables_user_id_foreign` (`user_id`),
  ADD KEY `taxonomy_termables_taxonomy_termable_id_index` (`taxonomy_termable_id`),
  ADD KEY `taxonomy_termables_taxonomy_term_id_foreign` (`taxonomy_term_id`);

--
-- Indexes for table `taxonomy_terms`
--
ALTER TABLE `taxonomy_terms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taxonomy_terms_user_id_foreign` (`user_id`),
  ADD KEY `taxonomy_terms_taxonomy_type_id_foreign` (`taxonomy_type_id`),
  ADD KEY `taxonomy_terms_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `taxonomy_types`
--
ALTER TABLE `taxonomy_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taxonomy_types_user_id_foreign` (`user_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_user_id_index` (`user_id`);

--
-- Indexes for table `team_invitations`
--
ALTER TABLE `team_invitations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_invitations_team_id_email_unique` (`team_id`,`email`);

--
-- Indexes for table `team_user`
--
ALTER TABLE `team_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_user_team_id_user_id_unique` (`team_id`,`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `fk_organization_id` (`organization_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `case_contributors`
--
ALTER TABLE `case_contributors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `case_coordinators`
--
ALTER TABLE `case_coordinators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `case_findings`
--
ALTER TABLE `case_findings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `case_investigations`
--
ALTER TABLE `case_investigations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `case_management`
--
ALTER TABLE `case_management`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `case_types`
--
ALTER TABLE `case_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `commentables`
--
ALTER TABLE `commentables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `content_blog_posts`
--
ALTER TABLE `content_blog_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `content_events`
--
ALTER TABLE `content_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `content_featureds`
--
ALTER TABLE `content_featureds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `content_galleries`
--
ALTER TABLE `content_galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `content_news`
--
ALTER TABLE `content_news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `content_our_works`
--
ALTER TABLE `content_our_works`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `content_pages`
--
ALTER TABLE `content_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `content_publications`
--
ALTER TABLE `content_publications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `content_services`
--
ALTER TABLE `content_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `content_testimonies`
--
ALTER TABLE `content_testimonies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countryables`
--
ALTER TABLE `countryables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `field_blocks`
--
ALTER TABLE `field_blocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `field_htmls`
--
ALTER TABLE `field_htmls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `field_images`
--
ALTER TABLE `field_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `field_links`
--
ALTER TABLE `field_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `field_texts`
--
ALTER TABLE `field_texts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `field_titles`
--
ALTER TABLE `field_titles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `forum_categories`
--
ALTER TABLE `forum_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `forum_topics`
--
ALTER TABLE `forum_topics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `information_requests`
--
ALTER TABLE `information_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `information_restrictions`
--
ALTER TABLE `information_restrictions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `internal_communicationables`
--
ALTER TABLE `internal_communicationables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `internal_communications`
--
ALTER TABLE `internal_communications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `job_adverts`
--
ALTER TABLE `job_adverts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `layout_columns`
--
ALTER TABLE `layout_columns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `layout_rows`
--
ALTER TABLE `layout_rows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `layout_sections`
--
ALTER TABLE `layout_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `layout_section_tops`
--
ALTER TABLE `layout_section_tops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `media_providers`
--
ALTER TABLE `media_providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media_videos`
--
ALTER TABLE `media_videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_states`
--
ALTER TABLE `member_states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `nature_of_offences`
--
ALTER TABLE `nature_of_offences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;

--
-- AUTO_INCREMENT for table `permission_types`
--
ALTER TABLE `permission_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_responses`
--
ALTER TABLE `request_responses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `taxonomy_termables`
--
ALTER TABLE `taxonomy_termables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxonomy_terms`
--
ALTER TABLE `taxonomy_terms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `taxonomy_types`
--
ALTER TABLE `taxonomy_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_invitations`
--
ALTER TABLE `team_invitations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_user`
--
ALTER TABLE `team_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blocks`
--
ALTER TABLE `blocks`
  ADD CONSTRAINT `blocks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `cases`
--
ALTER TABLE `cases`
  ADD CONSTRAINT `cases_is_approved_by_id_foreign` FOREIGN KEY (`approved_by_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `cases_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `cases_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_case_organization_id` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`);

--
-- Constraints for table `case_contributors`
--
ALTER TABLE `case_contributors`
  ADD CONSTRAINT `case_contributors_case_id_foreign` FOREIGN KEY (`case_id`) REFERENCES `cases` (`id`),
  ADD CONSTRAINT `case_contributors_contact_point_id_foreign` FOREIGN KEY (`contact_point_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `case_contributors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `case_coordinators`
--
ALTER TABLE `case_coordinators`
  ADD CONSTRAINT `case_coordinators_case_id_foreign` FOREIGN KEY (`case_id`) REFERENCES `cases` (`id`),
  ADD CONSTRAINT `case_coordinators_contact_point_id_foreign` FOREIGN KEY (`contact_point_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `case_coordinators_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `case_findings`
--
ALTER TABLE `case_findings`
  ADD CONSTRAINT `case_findings_case_investigation_id_foreign` FOREIGN KEY (`case_investigation_id`) REFERENCES `case_investigations` (`id`),
  ADD CONSTRAINT `case_findings_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `case_findings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `case_investigations`
--
ALTER TABLE `case_investigations`
  ADD CONSTRAINT `case_investigations_assigned_contributor_id_foreign` FOREIGN KEY (`assigned_contributor_id`) REFERENCES `case_contributors` (`id`),
  ADD CONSTRAINT `case_investigations_case_id_foreign` FOREIGN KEY (`case_id`) REFERENCES `cases` (`id`),
  ADD CONSTRAINT `case_investigations_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `case_investigations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `case_management`
--
ALTER TABLE `case_management`
  ADD CONSTRAINT `case_management_is_approved_by_id_foreign` FOREIGN KEY (`is_approved_by_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `case_management_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `case_management_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `commentables`
--
ALTER TABLE `commentables`
  ADD CONSTRAINT `commentables_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`),
  ADD CONSTRAINT `commentables_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD CONSTRAINT `contact_messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `content_blog_posts`
--
ALTER TABLE `content_blog_posts`
  ADD CONSTRAINT `content_blog_posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `content_events`
--
ALTER TABLE `content_events`
  ADD CONSTRAINT `content_events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `content_featureds`
--
ALTER TABLE `content_featureds`
  ADD CONSTRAINT `content_featureds_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `content_galleries`
--
ALTER TABLE `content_galleries`
  ADD CONSTRAINT `content_galleries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `content_news`
--
ALTER TABLE `content_news`
  ADD CONSTRAINT `content_news_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `content_our_works`
--
ALTER TABLE `content_our_works`
  ADD CONSTRAINT `content_our_works_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `content_pages`
--
ALTER TABLE `content_pages`
  ADD CONSTRAINT `content_pages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `content_publications`
--
ALTER TABLE `content_publications`
  ADD CONSTRAINT `content_publications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `content_services`
--
ALTER TABLE `content_services`
  ADD CONSTRAINT `content_services_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `content_testimonies`
--
ALTER TABLE `content_testimonies`
  ADD CONSTRAINT `content_testimonies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `countryables`
--
ALTER TABLE `countryables`
  ADD CONSTRAINT `countryables_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`),
  ADD CONSTRAINT `countryables_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `emails`
--
ALTER TABLE `emails`
  ADD CONSTRAINT `emails_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `field_blocks`
--
ALTER TABLE `field_blocks`
  ADD CONSTRAINT `field_blocks_block_id_foreign` FOREIGN KEY (`block_id`) REFERENCES `blocks` (`id`),
  ADD CONSTRAINT `field_blocks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `field_htmls`
--
ALTER TABLE `field_htmls`
  ADD CONSTRAINT `field_htmls_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `field_images`
--
ALTER TABLE `field_images`
  ADD CONSTRAINT `field_images_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `field_links`
--
ALTER TABLE `field_links`
  ADD CONSTRAINT `field_links_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `field_texts`
--
ALTER TABLE `field_texts`
  ADD CONSTRAINT `field_texts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `field_titles`
--
ALTER TABLE `field_titles`
  ADD CONSTRAINT `field_titles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `forum_topics`
--
ALTER TABLE `forum_topics`
  ADD CONSTRAINT `forum_topics_forum_category_id_foreign` FOREIGN KEY (`forum_category_id`) REFERENCES `forum_categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `forum_topics_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `informationrequest_informationrestriction`
--
ALTER TABLE `informationrequest_informationrestriction`
  ADD CONSTRAINT `fk_ii_information_request_id` FOREIGN KEY (`information_request_id`) REFERENCES `information_requests` (`id`),
  ADD CONSTRAINT `fk_ii_information_restriction_id` FOREIGN KEY (`information_restriction_id`) REFERENCES `information_restrictions` (`id`);

--
-- Constraints for table `informationrequest_natureofoffence`
--
ALTER TABLE `informationrequest_natureofoffence`
  ADD CONSTRAINT `fk_information_request_id` FOREIGN KEY (`information_request_id`) REFERENCES `information_requests` (`id`),
  ADD CONSTRAINT `fk_nature_of_offence_id` FOREIGN KEY (`nature_of_offence_id`) REFERENCES `nature_of_offences` (`id`);

--
-- Constraints for table `information_requests`
--
ALTER TABLE `information_requests`
  ADD CONSTRAINT `fk_case_id` FOREIGN KEY (`case_id`) REFERENCES `case_management` (`id`),
  ADD CONSTRAINT `fk_member_state_id_info_requests` FOREIGN KEY (`member_state_id`) REFERENCES `member_states` (`id`),
  ADD CONSTRAINT `fk_organization_id_info_requests` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`),
  ADD CONSTRAINT `fk_review_status_id_statuses` FOREIGN KEY (`review_status_id`) REFERENCES `statuses` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `information_requests_is_approved_by_id_foreign` FOREIGN KEY (`review_by_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `information_requests_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `information_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `information_restrictions`
--
ALTER TABLE `information_restrictions`
  ADD CONSTRAINT `information_restrictions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `internal_communicationables`
--
ALTER TABLE `internal_communicationables`
  ADD CONSTRAINT `internal_communicationables_internal_communication_id_foreign` FOREIGN KEY (`internal_communication_id`) REFERENCES `internal_communications` (`id`),
  ADD CONSTRAINT `internal_communicationables_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `internal_communications`
--
ALTER TABLE `internal_communications`
  ADD CONSTRAINT `internal_communications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `job_adverts`
--
ALTER TABLE `job_adverts`
  ADD CONSTRAINT `job_adverts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `layout_columns`
--
ALTER TABLE `layout_columns`
  ADD CONSTRAINT `layout_columns_layout_row_id_foreign` FOREIGN KEY (`layout_row_id`) REFERENCES `layout_rows` (`id`),
  ADD CONSTRAINT `layout_columns_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `layout_rows`
--
ALTER TABLE `layout_rows`
  ADD CONSTRAINT `layout_rows_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `layout_sections`
--
ALTER TABLE `layout_sections`
  ADD CONSTRAINT `layout_sections_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `layout_section_tops`
--
ALTER TABLE `layout_section_tops`
  ADD CONSTRAINT `layout_section_tops_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `mediables`
--
ALTER TABLE `mediables`
  ADD CONSTRAINT `mediables_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `media_videoables`
--
ALTER TABLE `media_videoables`
  ADD CONSTRAINT `media_videoables_media_video_id_foreign` FOREIGN KEY (`media_video_id`) REFERENCES `media_videos` (`id`);

--
-- Constraints for table `media_videos`
--
ALTER TABLE `media_videos`
  ADD CONSTRAINT `media_videos_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `media_providers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `media_videos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `member_states`
--
ALTER TABLE `member_states`
  ADD CONSTRAINT `member_states_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_to_user_id_foreign` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

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
-- Constraints for table `nature_of_offences`
--
ALTER TABLE `nature_of_offences`
  ADD CONSTRAINT `nature_of_offences_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `organizations`
--
ALTER TABLE `organizations`
  ADD CONSTRAINT `organizations_member_state_id_foreign` FOREIGN KEY (`member_state_id`) REFERENCES `member_states` (`id`),
  ADD CONSTRAINT `organizations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `request_responses`
--
ALTER TABLE `request_responses`
  ADD CONSTRAINT `fk_ feedback_status_id` FOREIGN KEY (`feedback_status_id`) REFERENCES `statuses` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `request_responses_information_request_id_foreign` FOREIGN KEY (`information_request_id`) REFERENCES `information_requests` (`id`),
  ADD CONSTRAINT `request_responses_is_approved_by_id_foreign` FOREIGN KEY (`feedback_by_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `request_responses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `taxonomy_termables`
--
ALTER TABLE `taxonomy_termables`
  ADD CONSTRAINT `taxonomy_termables_taxonomy_term_id_foreign` FOREIGN KEY (`taxonomy_term_id`) REFERENCES `taxonomy_terms` (`id`),
  ADD CONSTRAINT `taxonomy_termables_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `taxonomy_terms`
--
ALTER TABLE `taxonomy_terms`
  ADD CONSTRAINT `taxonomy_terms_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `taxonomy_terms` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `taxonomy_terms_taxonomy_type_id_foreign` FOREIGN KEY (`taxonomy_type_id`) REFERENCES `taxonomy_types` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `taxonomy_terms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `taxonomy_types`
--
ALTER TABLE `taxonomy_types`
  ADD CONSTRAINT `taxonomy_types_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `team_invitations`
--
ALTER TABLE `team_invitations`
  ADD CONSTRAINT `team_invitations_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_organization_id` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
