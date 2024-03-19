-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 18 2020 г., 15:44
-- Версия сервера: 5.7.25
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `riibtv`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `title`, `order`, `created_at`, `updated_at`) VALUES
(1, 'İctimai nəqliyyat', 1, '2020-06-10 16:49:01', '2020-06-10 17:04:04');

-- --------------------------------------------------------

--
-- Структура таблицы `data_rows`
--

CREATE TABLE `data_rows` (
  `id` int(10) UNSIGNED NOT NULL,
  `data_type_id` int(10) UNSIGNED NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `browse` tinyint(1) NOT NULL DEFAULT '1',
  `read` tinyint(1) NOT NULL DEFAULT '1',
  `edit` tinyint(1) NOT NULL DEFAULT '1',
  `add` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '1',
  `details` text COLLATE utf8mb4_unicode_ci,
  `order` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `data_rows`
--

INSERT INTO `data_rows` (`id`, `data_type_id`, `field`, `type`, `display_name`, `required`, `browse`, `read`, `edit`, `add`, `delete`, `details`, `order`) VALUES
(1, 1, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(2, 1, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(3, 1, 'email', 'text', 'Email', 1, 1, 1, 1, 1, 1, NULL, 3),
(4, 1, 'password', 'password', 'Password', 1, 0, 0, 1, 1, 0, NULL, 4),
(5, 1, 'remember_token', 'text', 'Remember Token', 0, 0, 0, 0, 0, 0, NULL, 5),
(6, 1, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, NULL, 6),
(7, 1, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 7),
(8, 1, 'avatar', 'image', 'Avatar', 0, 1, 1, 1, 1, 1, NULL, 8),
(9, 1, 'user_belongsto_role_relationship', 'relationship', 'Role', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"roles\",\"pivot\":0}', 10),
(10, 1, 'user_belongstomany_role_relationship', 'relationship', 'Roles', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"0\"}', 11),
(11, 1, 'settings', 'hidden', 'Settings', 0, 0, 0, 0, 0, 0, NULL, 12),
(12, 2, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(13, 2, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(14, 2, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(15, 2, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(16, 3, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(17, 3, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(18, 3, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(19, 3, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(20, 3, 'display_name', 'text', 'Display Name', 1, 1, 1, 1, 1, 1, NULL, 5),
(21, 1, 'role_id', 'text', 'Role', 1, 1, 1, 1, 1, 1, NULL, 9),
(22, 4, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(23, 4, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, '{}', 2),
(25, 4, 'created_at', 'timestamp', 'Created At', 0, 1, 0, 0, 0, 0, '{}', 4),
(26, 4, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 5),
(27, 4, 'order', 'number', 'Order', 1, 1, 0, 0, 0, 0, '{}', 3),
(28, 5, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(29, 5, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, '{}', 2),
(30, 5, 'description', 'text_area', 'Description', 1, 0, 1, 1, 1, 1, '{}', 3),
(31, 5, 'order', 'text', 'Order', 1, 0, 0, 0, 0, 0, '{}', 4),
(32, 5, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 5),
(33, 5, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `data_types`
--

CREATE TABLE `data_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT '0',
  `server_side` tinyint(4) NOT NULL DEFAULT '0',
  `details` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `data_types`
--

INSERT INTO `data_types` (`id`, `name`, `slug`, `display_name_singular`, `display_name_plural`, `icon`, `model_name`, `policy_name`, `controller`, `description`, `generate_permissions`, `server_side`, `details`, `created_at`, `updated_at`) VALUES
(1, 'users', 'users', 'User', 'Users', 'voyager-person', 'TCG\\Voyager\\Models\\User', 'TCG\\Voyager\\Policies\\UserPolicy', 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController', '', 1, 0, NULL, '2020-05-04 11:16:24', '2020-05-04 11:16:24'),
(2, 'menus', 'menus', 'Menu', 'Menus', 'voyager-list', 'TCG\\Voyager\\Models\\Menu', NULL, '', '', 1, 0, NULL, '2020-05-04 11:16:24', '2020-05-04 11:16:24'),
(3, 'roles', 'roles', 'Role', 'Roles', 'voyager-lock', 'TCG\\Voyager\\Models\\Role', NULL, 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController', '', 1, 0, NULL, '2020-05-04 11:16:24', '2020-05-04 11:16:24'),
(4, 'categories', 'categories', 'Category', 'Categories', 'voyager-categories', 'App\\Category', NULL, NULL, NULL, 1, 0, '{\"order_column\":\"order\",\"order_display_column\":\"title\",\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-06-09 02:28:20', '2020-06-09 14:36:55'),
(5, 'faqs', 'faqs', 'Faq', 'Faqs', NULL, 'App\\Faq', NULL, NULL, NULL, 1, 0, '{\"order_column\":\"order\",\"order_display_column\":\"title\",\"order_direction\":\"desc\",\"default_search_key\":null,\"scope\":null}', '2020-06-16 06:46:06', '2020-06-16 07:02:27');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `faqs`
--

INSERT INTO `faqs` (`id`, `title`, `description`, `order`, `created_at`, `updated_at`) VALUES
(1, 'What is teklifimvar.az?', 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.', 1, '2020-06-16 07:01:49', '2020-06-16 07:01:49');

-- --------------------------------------------------------

--
-- Структура таблицы `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `menus`
--

INSERT INTO `menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2020-05-04 11:16:26', '2020-05-04 11:16:26'),
(2, 'site', '2020-05-05 05:16:12', '2020-05-05 05:16:12');

-- --------------------------------------------------------

--
-- Структура таблицы `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `url`, `target`, `icon_class`, `color`, `parent_id`, `order`, `created_at`, `updated_at`, `route`, `parameters`) VALUES
(1, 1, 'Dashboard', '', '_self', 'voyager-boat', NULL, NULL, 1, '2020-05-04 11:16:26', '2020-05-04 11:16:26', 'voyager.dashboard', NULL),
(2, 1, 'Media', '', '_self', 'voyager-images', NULL, NULL, 6, '2020-05-04 11:16:26', '2020-06-16 06:49:41', 'voyager.media.index', NULL),
(3, 1, 'Users', '', '_self', 'voyager-person', NULL, NULL, 5, '2020-05-04 11:16:26', '2020-06-16 06:49:41', 'voyager.users.index', NULL),
(4, 1, 'Roles', '', '_self', 'voyager-lock', NULL, NULL, 4, '2020-05-04 11:16:26', '2020-06-16 06:49:41', 'voyager.roles.index', NULL),
(5, 1, 'Tools', '', '_self', 'voyager-tools', NULL, NULL, 8, '2020-05-04 11:16:26', '2020-06-16 06:49:41', NULL, NULL),
(6, 1, 'Menu Builder', '', '_self', 'voyager-list', NULL, NULL, 7, '2020-05-04 11:16:26', '2020-06-16 06:49:41', 'voyager.menus.index', NULL),
(7, 1, 'Database', '', '_self', 'voyager-data', NULL, 5, 1, '2020-05-04 11:16:26', '2020-05-05 03:49:03', 'voyager.database.index', NULL),
(8, 1, 'Compass', '', '_self', 'voyager-compass', NULL, 5, 2, '2020-05-04 11:16:26', '2020-05-05 03:49:03', 'voyager.compass.index', NULL),
(9, 1, 'BREAD', '', '_self', 'voyager-bread', NULL, 5, 3, '2020-05-04 11:16:26', '2020-05-05 03:49:03', 'voyager.bread.index', NULL),
(10, 1, 'Settings', '', '_self', 'voyager-settings', NULL, NULL, 9, '2020-05-04 11:16:27', '2020-06-16 06:49:41', 'voyager.settings.index', NULL),
(11, 1, 'Categories', '', '_self', 'voyager-categories', '#000000', NULL, 2, '2020-06-09 02:28:20', '2020-06-16 06:49:43', 'voyager.categories.index', 'null'),
(12, 1, 'Faqs', '', '_self', 'voyager-question', '#000000', NULL, 3, '2020-06-16 06:46:06', '2020-06-16 06:49:43', 'voyager.faqs.index', 'null');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(23, '2014_10_12_000000_create_users_table', 1),
(24, '2016_01_01_000000_add_voyager_user_fields', 1),
(25, '2016_01_01_000000_create_data_types_table', 1),
(26, '2016_05_19_173453_create_menu_table', 1),
(27, '2016_10_21_190000_create_roles_table', 1),
(28, '2016_10_21_190000_create_settings_table', 1),
(29, '2016_11_30_135954_create_permission_table', 1),
(30, '2016_11_30_141208_create_permission_role_table', 1),
(31, '2016_12_26_201236_data_types__add__server_side', 1),
(32, '2017_01_13_000000_add_route_to_menu_items_table', 1),
(33, '2017_01_14_005015_create_translations_table', 1),
(34, '2017_01_15_000000_make_table_name_nullable_in_permissions_table', 1),
(35, '2017_03_06_000000_add_controller_to_data_types_table', 1),
(36, '2017_04_21_000000_add_order_to_data_rows_table', 1),
(37, '2017_07_05_210000_add_policyname_to_data_types_table', 1),
(38, '2017_08_05_000000_add_group_to_settings_table', 1),
(39, '2017_11_26_013050_add_user_role_relationship', 1),
(40, '2017_11_26_015000_create_user_roles_table', 1),
(41, '2018_03_11_000000_add_user_settings', 1),
(42, '2018_03_14_000000_add_details_to_data_types_table', 1),
(43, '2018_03_16_000000_make_settings_value_nullable', 1),
(44, '2019_08_19_000000_create_failed_jobs_table', 1),
(45, '2020_05_05_135635_create_site_users_table', 2),
(46, '2020_05_06_210318_change_phonenumber_type_from_site_users_table', 3),
(47, '2020_05_10_140121_add_change_column_from_site_users_table', 4),
(48, '2020_06_09_061718_create_categories_table', 5),
(49, '2020_06_09_082208_chage_column_name_to_categories_table', 6),
(50, '2020_06_09_123549_chage_column_name_to_categories_table', 7),
(51, '2020_06_09_124101_add_primary_option_to_categories_table', 8),
(54, '2020_06_10_202641_create_offers_table', 9),
(55, '2020_06_11_072553_create_offer_files_table', 10),
(56, '2020_06_16_102816_create_faqs_table', 11);

-- --------------------------------------------------------

--
-- Структура таблицы `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `offers`
--

INSERT INTO `offers` (`id`, `title`, `user_id`, `category_id`, `area`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Lorem Ipsum is simply dummy text of the', 8, 1, 'Baki Xetai', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, '2020-06-17 07:56:21', '2020-06-17 07:56:21', NULL),
(2, 'A.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdur', 8, 1, 'Baki yasamal', 'A.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdur', 0, '2020-06-17 07:59:54', '2020-06-17 07:59:54', NULL),
(3, 'A.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdur', 8, 1, 'Baki yasamal', 'A.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdurA.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdur', 0, '2020-06-17 08:00:04', '2020-06-17 08:00:04', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `offer_files`
--

CREATE TABLE `offer_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `offer_id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `offer_files`
--

INSERT INTO `offer_files` (`id`, `offer_id`, `path`, `created_at`, `updated_at`) VALUES
(1, 1, 'image/2020-06-17/ePSVSVEK856eGF6ufegv.jpg', '2020-06-17 07:56:21', '2020-06-17 07:56:21'),
(2, 1, 'image/2020-06-17/cxbTQPvMoEaBfoc0aamu.jpg', '2020-06-17 07:56:21', '2020-06-17 07:56:21'),
(3, 1, 'image/2020-06-17/8UBDkornLDGSkP0Gezal.jpg', '2020-06-17 07:56:21', '2020-06-17 07:56:21'),
(4, 1, 'image/2020-06-17/xcWmmnRAGnLXoWcHnaro.jpg', '2020-06-17 07:56:21', '2020-06-17 07:56:21'),
(5, 2, 'image/2020-06-17/rjEii4BnKGDBLkhsNgWS.jpg', '2020-06-17 07:59:54', '2020-06-17 07:59:54'),
(6, 2, 'image/2020-06-17/amlTqEHFaXEFK3c4bHrg.jpg', '2020-06-17 07:59:54', '2020-06-17 07:59:54'),
(7, 2, 'image/2020-06-17/Fb4hDYFoVW0GR7GC5Y1w.jpg', '2020-06-17 07:59:54', '2020-06-17 07:59:54'),
(8, 2, 'image/2020-06-17/Olyha85lxgZx0VyT8gpQ.jpg', '2020-06-17 07:59:54', '2020-06-17 07:59:54'),
(9, 3, 'image/2020-06-17/6zauUPYlCOe7hmhtpA0y.jpg', '2020-06-17 08:00:04', '2020-06-17 08:00:04'),
(10, 3, 'image/2020-06-17/b9bDc9OoY5f4aIsm4ho0.jpg', '2020-06-17 08:00:04', '2020-06-17 08:00:04'),
(11, 3, 'image/2020-06-17/2XFl87lxDardvGSir96T.jpg', '2020-06-17 08:00:04', '2020-06-17 08:00:04'),
(12, 3, 'image/2020-06-17/nvMKxuOjXHhjTkF6jbhm.jpg', '2020-06-17 08:00:04', '2020-06-17 08:00:04');

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `key`, `table_name`, `created_at`, `updated_at`) VALUES
(1, 'browse_admin', NULL, '2020-05-04 11:16:27', '2020-05-04 11:16:27'),
(2, 'browse_bread', NULL, '2020-05-04 11:16:27', '2020-05-04 11:16:27'),
(3, 'browse_database', NULL, '2020-05-04 11:16:27', '2020-05-04 11:16:27'),
(4, 'browse_media', NULL, '2020-05-04 11:16:27', '2020-05-04 11:16:27'),
(5, 'browse_compass', NULL, '2020-05-04 11:16:27', '2020-05-04 11:16:27'),
(6, 'browse_menus', 'menus', '2020-05-04 11:16:27', '2020-05-04 11:16:27'),
(7, 'read_menus', 'menus', '2020-05-04 11:16:27', '2020-05-04 11:16:27'),
(8, 'edit_menus', 'menus', '2020-05-04 11:16:27', '2020-05-04 11:16:27'),
(9, 'add_menus', 'menus', '2020-05-04 11:16:27', '2020-05-04 11:16:27'),
(10, 'delete_menus', 'menus', '2020-05-04 11:16:27', '2020-05-04 11:16:27'),
(11, 'browse_roles', 'roles', '2020-05-04 11:16:27', '2020-05-04 11:16:27'),
(12, 'read_roles', 'roles', '2020-05-04 11:16:28', '2020-05-04 11:16:28'),
(13, 'edit_roles', 'roles', '2020-05-04 11:16:28', '2020-05-04 11:16:28'),
(14, 'add_roles', 'roles', '2020-05-04 11:16:28', '2020-05-04 11:16:28'),
(15, 'delete_roles', 'roles', '2020-05-04 11:16:28', '2020-05-04 11:16:28'),
(16, 'browse_users', 'users', '2020-05-04 11:16:28', '2020-05-04 11:16:28'),
(17, 'read_users', 'users', '2020-05-04 11:16:28', '2020-05-04 11:16:28'),
(18, 'edit_users', 'users', '2020-05-04 11:16:28', '2020-05-04 11:16:28'),
(19, 'add_users', 'users', '2020-05-04 11:16:28', '2020-05-04 11:16:28'),
(20, 'delete_users', 'users', '2020-05-04 11:16:28', '2020-05-04 11:16:28'),
(21, 'browse_settings', 'settings', '2020-05-04 11:16:28', '2020-05-04 11:16:28'),
(22, 'read_settings', 'settings', '2020-05-04 11:16:28', '2020-05-04 11:16:28'),
(23, 'edit_settings', 'settings', '2020-05-04 11:16:28', '2020-05-04 11:16:28'),
(24, 'add_settings', 'settings', '2020-05-04 11:16:28', '2020-05-04 11:16:28'),
(25, 'delete_settings', 'settings', '2020-05-04 11:16:28', '2020-05-04 11:16:28'),
(26, 'browse_categories', 'categories', '2020-06-09 02:28:20', '2020-06-09 02:28:20'),
(27, 'read_categories', 'categories', '2020-06-09 02:28:20', '2020-06-09 02:28:20'),
(28, 'edit_categories', 'categories', '2020-06-09 02:28:20', '2020-06-09 02:28:20'),
(29, 'add_categories', 'categories', '2020-06-09 02:28:20', '2020-06-09 02:28:20'),
(30, 'delete_categories', 'categories', '2020-06-09 02:28:20', '2020-06-09 02:28:20'),
(31, 'browse_faqs', 'faqs', '2020-06-16 06:46:06', '2020-06-16 06:46:06'),
(32, 'read_faqs', 'faqs', '2020-06-16 06:46:06', '2020-06-16 06:46:06'),
(33, 'edit_faqs', 'faqs', '2020-06-16 06:46:06', '2020-06-16 06:46:06'),
(34, 'add_faqs', 'faqs', '2020-06-16 06:46:06', '2020-06-16 06:46:06'),
(35, 'delete_faqs', 'faqs', '2020-06-16 06:46:06', '2020-06-16 06:46:06');

-- --------------------------------------------------------

--
-- Структура таблицы `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
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
(35, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '2020-05-04 11:14:04', '2020-05-04 11:14:04'),
(2, 'user', 'Normal User', '2020-05-04 11:16:27', '2020-05-04 11:16:27');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `details` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`, `group`) VALUES
(1, 'site.title', 'Site Title', 'Site Title', '', 'text', 1, 'Site'),
(2, 'site.description', 'Site Description', 'Site Description', '', 'text', 2, 'Site'),
(3, 'site.logo', 'Site Logo', '', '', 'image', 3, 'Site'),
(4, 'site.google_analytics_tracking_id', 'Google Analytics Tracking ID', '', '', 'text', 4, 'Site'),
(5, 'admin.bg_image', 'Admin Background Image', '', '', 'image', 5, 'Admin'),
(6, 'admin.title', 'Admin Title', 'Voyager', '', 'text', 1, 'Admin'),
(7, 'admin.description', 'Admin Description', 'Welcome to Voyager. The Missing Admin for Laravel', '', 'text', 2, 'Admin'),
(8, 'admin.loader', 'Admin Loader', '', '', 'image', 3, 'Admin'),
(9, 'admin.icon_image', 'Admin Icon Image', '', '', 'image', 4, 'Admin'),
(10, 'admin.google_analytics_client_id', 'Google Analytics Client ID (used for admin dashboard)', '', '', 'text', 1, 'Admin');

-- --------------------------------------------------------

--
-- Структура таблицы `site_users`
--

CREATE TABLE `site_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fatherName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNumber` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` smallint(6) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `site_users`
--

INSERT INTO `site_users` (`id`, `name`, `fatherName`, `email`, `password`, `phoneNumber`, `address`, `active`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Muhammed', 'Ilqar', 'codega.az@gmal.com', '123456', 556575878, NULL, 1, NULL, '2020-05-06 17:14:32', '2020-05-06 17:14:32', NULL),
(2, 'Muhammed', 'Ilqar', 'codega@gmal.com', '123456', 556575878, NULL, 1, NULL, '2020-05-06 17:15:18', '2020-05-06 17:15:18', NULL),
(3, 'Muhammed', 'Ilqar', 'codega2@gmal.com', '$2y$10$aPQ8g3bDEOZ1bICXBeiiieNUEmA5z6d3ND3696eS5p55oJBLLFFS6', 556575878, NULL, 1, NULL, '2020-05-06 17:24:59', '2020-05-06 17:24:59', NULL),
(4, 'Muhammed', 'Ilqar', 'test@gmail.com', '$2y$10$KCZT/dWlYEDMTkSyLp0EPOpyaQnzVZQVU3Mjj9Gzqhm17dwxccVgW', 556575878, NULL, 1, NULL, '2020-05-07 03:08:02', '2020-05-07 03:08:02', NULL),
(5, 'Arzu Memmedova', 'Ilqar', 'Anar.3dmax@gmail.com', '$2y$10$FzQUvilpKY8uqvcskmAEruS3Ep4NvHSoid0FWG1l.F0eWE3fe1LkC', 706575878, NULL, 1, NULL, '2020-05-10 10:55:47', '2020-05-10 10:55:47', NULL),
(6, 'Muhammed', 'Ilqar', 'test2@gmail.com', '$2y$10$d8Kg7PgbsPeIihPVqFoZrutcFq4U.HszMjVCvGVuF1MZoieb.5.B.', 556575878, NULL, 1, NULL, '2020-05-10 10:56:47', '2020-05-10 10:56:47', NULL),
(7, 'Aise Memmedova', 'Muhammed', 'aise@mail.ru', '$2y$10$i5pWHws1UITmxeEKkinqY.w768rrcM3FBTtdFBRkeqT/oqPLET0Fy', 556575878, NULL, 1, NULL, '2020-05-12 10:21:35', '2020-05-12 10:21:35', NULL),
(8, 'Memmedli Ayan', 'terxan', 'ayan@mail.ru', '$2y$10$bYRXJn4RLyfeyMPeN6HU0eV6ARfKaPrTNxDQntHigfGk7rawcfMOq', 706575878, 'Baki seheri Xazar rayonu bine qesebsi', 1, NULL, '2020-05-14 01:02:57', '2020-06-08 01:06:31', NULL),
(9, 'Arzu Memmedova', 'terxan', 'ayan@mail.russs', '$2y$10$Ij3WH3XX8.jhzpMzxk.mUum0FBBfsL4t6D296FcokSfIg3B3PJUoe', 706575878, 'baki seheri Suraxani rayonu Settar Behlulzade  don 17 ev 10', 1, NULL, '2020-05-14 01:25:59', '2020-05-21 02:27:46', NULL),
(10, 'Test testov', 'ceyhun', 'test@mail.ru', '$2y$10$UssZINIct8zqCtG7hgIEWOCLGeRQU/t6iViZwP4dhCU4cmjYFrwLy', 706575878, NULL, 1, NULL, '2020-06-15 01:35:57', '2020-06-15 01:35:57', NULL),
(11, 'test test', 'test', 'test2@mail.com', '$2y$10$/3LPBTZ2YuXmTqN8ylt/4.HvqUkt1p2CqUTQNkplMpp/ulzC2bpe6', 706575878, NULL, 1, NULL, '2020-06-15 01:40:00', '2020-06-15 01:40:00', NULL),
(12, 'Memmedov Meryem', 'davud', 'davud@mil.ru', '$2y$10$bJD0MXH73WmrE3aQPGe.T.ShDnNXz3PLrOl1YKgiXBgu8y.zyKerm', 706575878, NULL, 1, NULL, '2020-06-15 04:36:31', '2020-06-15 04:36:31', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `translations`
--

CREATE TABLE `translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `avatar`, `email_verified_at`, `password`, `remember_token`, `settings`, `created_at`, `updated_at`) VALUES
(1, 1, 'Muhammed', 'codega.az@gmail.com', 'users/default.png', NULL, '$2y$10$bYRXJn4RLyfeyMPeN6HU0eV6ARfKaPrTNxDQntHigfGk7rawcfMOq', NULL, NULL, '2020-05-04 11:14:04', '2020-05-04 11:14:04');

-- --------------------------------------------------------

--
-- Структура таблицы `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `data_rows`
--
ALTER TABLE `data_rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_rows_data_type_id_foreign` (`data_type_id`);

--
-- Индексы таблицы `data_types`
--
ALTER TABLE `data_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_types_name_unique` (`name`),
  ADD UNIQUE KEY `data_types_slug_unique` (`slug`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_name_unique` (`name`);

--
-- Индексы таблицы `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `offer_files`
--
ALTER TABLE `offer_files`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_key_index` (`key`);

--
-- Индексы таблицы `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Индексы таблицы `site_users`
--
ALTER TABLE `site_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `site_users_email_unique` (`email`);

--
-- Индексы таблицы `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Индексы таблицы `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `user_roles_user_id_index` (`user_id`),
  ADD KEY `user_roles_role_id_index` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `data_rows`
--
ALTER TABLE `data_rows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `data_types`
--
ALTER TABLE `data_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT для таблицы `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `offer_files`
--
ALTER TABLE `offer_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `site_users`
--
ALTER TABLE `site_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `data_rows`
--
ALTER TABLE `data_rows`
  ADD CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
