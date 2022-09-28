-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 17, 2021 at 08:59 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `api_rest_redclh`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `informacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ciudades` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isActive` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crimeneslhs`
--

CREATE TABLE `crimeneslhs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pais_code` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `crimeneslh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clasificacionColectiva` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clasificacionIndividual` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lugar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `breveDescripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numCasosCPIAprobados` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numCasosCPIPendientes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numCasosNoCpiAprobado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numCasosNoCpiPendiente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `datosvictimas`
--

CREATE TABLE `datosvictimas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pais_code` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `numDatosvictimas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generoVictimasHombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generoVictimasMujer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edadVictimaNino` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edadVictimaJoven` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edadVictimaAdulto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edadVictimaOld` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estatusMigratorioRegular` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estatusMigratorioIrregular` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estatusConsulado` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estadoIntegridad` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `pais`
--

CREATE TABLE `pais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `image` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `violacionesddhhs`
--

CREATE TABLE `violacionesddhhs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pais_code` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `violacionesDdhhTotal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clasificacionDCP` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clasificacionDESCA` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calsificacionPueblos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lugar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `breveDescripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numCasosCorteInterDDHH` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numCasosComDHNU` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `casosNoAccionar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int PRIMARY key AUTO_INCREMENT,
  `title` text,
  `user_id` int NOT NULL,
  `description` text,
  `video_review` text,
  `img` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_modal` tinyint(1) NOT NULL,
  `is_activeText` varchar(255) NOT NULL,
  `is_activeBot` varchar(255) NOT NULL,
  `boton` varchar(255) NOT NULL,
  `enlace` varchar(255) NOT NULL,
  `target` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SHOW TABLES;
-- --------------------------------------------------------
--
-- Table structure for table `articulos`
--

CREATE TABLE `articulos` (
  `id` int PRIMARY key AUTO_INCREMENT,
  `title` text,
  `user_id` int NOT NULL,
  `description` text,
  `archivo` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SHOW TABLES;
-- --------------------------------------------------------



CREATE TABLE `videos` (
  `id` int PRIMARY key AUTO_INCREMENT,
  `title` text,
  `user_id` int NOT NULL,
  `video_review` text,
  `is_active` tinyint(1) NOT NULL,
  `is_featured` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SHOW TABLES;
-- --------------------------------------------------------