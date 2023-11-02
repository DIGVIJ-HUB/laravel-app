/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `movies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `runtime` time DEFAULT NULL,
  `rating` varchar(255) DEFAULT '',
  `image` varchar(255) DEFAULT NULL,
  `publication_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

CREATE TABLE `notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `movie_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `ratings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) DEFAULT NULL,
  `movie_id` varchar(255) DEFAULT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `edited_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

INSERT INTO `movies` (`id`, `user_id`, `title`, `description`, `runtime`, `rating`, `image`, `publication_date`, `created_at`, `updated_at`) VALUES
(1, '1', 'Oppenheimer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum suscipit tempor dolor vel ultrices. Morbi quis ipsum ut odio luctus suscipit quis eu lorem. Donec accumsan luctus varius. In scelerisque id ipsum ut pretium. Vestibulum ultrices arcu quis ipsum tincidunt tristique. Sed erat erat, consectetur ut metus at, placerat vestibulum dolor. Quisque interdum blandit nulla, nec sollicitudin sapien viverra ultricies. Suspendisse suscipit malesuada est vel vulputate.', '00:06:34', '4.85', 'https://www.tallengestore.com/cdn/shop/products/Oppenheimer-CillianMurphy-ChristopherNolan-HollywoodMoviePoster_1_512x512.jpg?v=1647416509', '2022-11-03', NULL, '2023-11-02 10:01:21');
INSERT INTO `movies` (`id`, `user_id`, `title`, `description`, `runtime`, `rating`, `image`, `publication_date`, `created_at`, `updated_at`) VALUES
(2, '1', 'Archer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum suscipit tempor dolor vel ultrices. Morbi quis ipsum ut odio luctus suscipit quis eu lorem. Donec accumsan luctus varius. In scelerisque id ipsum ut pretium. Vestibulum ultrices arcu quis ipsum tincidunt tristique. Sed erat erat, consectetur ut metus at, placerat vestibulum dolor. Quisque interdum blandit nulla, nec sollicitudin sapien viverra ultricies. Suspendisse suscipit malesuada est vel vulputate.', '00:06:34', '5', 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/adventure-movie-poster-template-design-7b13ea2ab6f64c1ec9e1bb473f345547_screen.jpg?ts=1636999411', '2022-11-03', NULL, NULL);
INSERT INTO `movies` (`id`, `user_id`, `title`, `description`, `runtime`, `rating`, `image`, `publication_date`, `created_at`, `updated_at`) VALUES
(3, '1', 'Titanic', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum suscipit tempor dolor vel ultrices. Morbi quis ipsum ut odio luctus suscipit quis eu lorem. Donec accumsan luctus varius. In scelerisque id ipsum ut pretium. Vestibulum ultrices arcu quis ipsum tincidunt tristique. Sed erat erat, consectetur ut metus at, placerat vestibulum dolor. Quisque interdum blandit nulla, nec sollicitudin sapien viverra ultricies. Suspendisse suscipit malesuada est vel vulputate.', '00:06:34', '6', 'https://i.etsystatic.com/10683147/r/il/748406/3548361422/il_fullxfull.3548361422_or4e.jpg', '2022-11-03', NULL, '2023-11-02 10:01:21');
INSERT INTO `movies` (`id`, `user_id`, `title`, `description`, `runtime`, `rating`, `image`, `publication_date`, `created_at`, `updated_at`) VALUES
(4, '2', 'Joker', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum suscipit tempor dolor vel ultrices. Morbi quis ipsum ut odio luctus suscipit quis eu lorem. Donec accumsan luctus varius. In scelerisque id ipsum ut pretium. Vestibulum ultrices arcu quis ipsum tincidunt tristique. Sed erat erat, consectetur ut metus at, placerat vestibulum dolor. Quisque interdum blandit nulla, nec sollicitudin sapien viverra ultricies. Suspendisse suscipit malesuada est vel vulputate.', '00:10:34', NULL, 'https://m.media-amazon.com/images/I/71Jxq2p5YWL._AC_UF1000,1000_QL80_.jpg', '2022-11-01', NULL, '2023-11-02 05:56:43'),
(5, '2', 'Avengers Galaxy', 'Loremmmmmm', '01:55:00', NULL, 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/action-movie-poster-template-design-0f5fff6262fdefb855e3a9a3f0fdd361_screen.jpg?ts=1636996054', '2023-11-04', NULL, '2023-11-02 10:24:29'),
(6, '2', 'This is the way', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum suscipit tempor dolor vel ultrices. Morbi quis ipsum ut odio luctus suscipit quis eu lorem. Donec accumsan luctus varius. In scelerisque id ipsum ut pretium. Vestibulum ultrices arcu quis ipsum tincidunt tristique. Sed erat erat, consectetur ut metus at, placerat vestibulum dolor. Quisque interdum blandit nulla, nec sollicitudin sapien viverra ultricies. Suspendisse suscipit malesuada est vel vulputate.', '00:06:34', NULL, 'https://dbdzm869oupei.cloudfront.net/img/posters/preview/91008.png', '2022-11-03', NULL, '2023-11-01 19:29:19'),
(7, '1', 'Pathan', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum suscipit tempor dolor vel ultrices. Morbi quis ipsum ut odio luctus suscipit quis eu lorem. Donec accumsan luctus varius. In scelerisque id ipsum ut pretium. Vestibulum ultrices arcu quis ipsum tincidunt tristique. Sed erat erat, consectetur ut metus at, placerat vestibulum dolor. Quisque interdum blandit nulla, nec sollicitudin sapien viverra ultricies. Suspendisse suscipit malesuada est vel vulputate.', '01:30:00', NULL, 'https://m.media-amazon.com/images/I/91uzbH0vmcL._AC_UF1000,1000_QL80_.jpg', '2023-11-02', '2023-11-01 21:08:27', '2023-11-01 21:08:27'),
(8, '2', 'Freedom', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum suscipit tempor dolor vel ultrices. Morbi quis ipsum ut odio luctus suscipit quis eu lorem. Donec accumsan luctus varius. In scelerisque id ipsum ut pretium. Vestibulum ultrices arcu quis ipsum tincidunt tristique. Sed erat erat, consectetur ut metus at, placerat vestibulum dolor. Quisque interdum blandit nulla, nec sollicitudin sapien viverra ultricies. Suspendisse suscipit malesuada est vel vulputate.', '01:55:00', NULL, 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/action-movie-poster-template-design-0f5fff6262fdefb855e3a9a3f0fdd361_screen.jpg?ts=1636996054', '2023-11-04', '2023-11-02 08:38:11', '2023-11-02 10:01:21'),
(9, '2', '1917 - Part 2', 'Lorem. sjdnusnjdsnsmdks', '02:30:00', NULL, 'https://www.tallengestore.com/cdn/shop/products/1917_-_Sam_Mendes_-_Hollywood_War_Film_Classic_English_Movie_Poster_a12704bd-2b25-4aa7-8c8d-8f40cf467dc7_large.jpg?v=1582781089', '2023-11-10', '2023-11-02 09:55:09', '2023-11-02 10:01:21');

INSERT INTO `notifications` (`id`, `movie_id`, `created_at`, `updated_at`) VALUES
(1, '7', '2023-11-02 06:25:48', '2023-11-02 06:25:48');
INSERT INTO `notifications` (`id`, `movie_id`, `created_at`, `updated_at`) VALUES
(2, '4', '2023-11-02 06:25:48', '2023-11-02 06:25:48');
INSERT INTO `notifications` (`id`, `movie_id`, `created_at`, `updated_at`) VALUES
(3, '8', '2023-11-02 08:45:58', '2023-11-02 08:45:58');
INSERT INTO `notifications` (`id`, `movie_id`, `created_at`, `updated_at`) VALUES
(4, '8', '2023-11-02 08:46:29', '2023-11-02 08:46:29'),
(5, '9', '2023-11-02 10:07:00', '2023-11-02 10:07:00');



INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'API Token', '169ae921fceceeee4b66bfb5c4b6f5bfb6868f948586df2b72826ab9eceeb875', '[\"*\"]', NULL, '2023-11-02 07:34:06', '2023-11-02 07:34:06');
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(2, 'App\\Models\\User', 3, 'API Token', 'fcb70f17d58a968a9fb08bc2ca8faf8a0bd6407992d16522f15860483cb8af52', '[\"*\"]', NULL, '2023-11-02 07:37:07', '2023-11-02 07:43:57');
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(3, 'App\\Models\\User', 3, 'API Token', '1c7e8c6d35119d9e4df2d861d0a150342781279ed19a5af9a937e6d7204bcda5', '[\"*\"]', '2023-11-02 07:57:21', '2023-11-02 07:44:13', '2023-11-02 07:57:21');
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(5, 'App\\Models\\User', 3, 'API Token', 'd58879cd45ed7f2e205cc9d03286e0f6cd60c44d5f20e2936d03927249b597ac', '[\"*\"]', NULL, '2023-11-02 08:01:04', '2023-11-02 08:01:04'),
(8, 'App\\Models\\User', 3, 'API Token', '6886293dedaf0bfbdf1559837244879177b72cd9f8aaca0ef3e77c2e144b386e', '[\"*\"]', '2023-11-02 08:21:52', '2023-11-02 08:08:12', '2023-11-02 08:21:52'),
(9, 'App\\Models\\User', 1, 'API Token', '4091088ebb877d5278af2f0cb22721a20bba5222b8f19d08b9949c4445a90941', '[\"*\"]', '2023-11-02 08:23:00', '2023-11-02 08:22:13', '2023-11-02 08:23:00'),
(10, 'App\\Models\\User', 2, 'API Token', '57f6d7ddf960e812cc3c5f946d49c76385637da4ca0811a8fb3bf4e927f2cbba', '[\"*\"]', '2023-11-02 08:42:25', '2023-11-02 08:23:42', '2023-11-02 08:42:25'),
(11, 'App\\Models\\User', 1, 'API Token', '1892063265bfc7e7ac84b9363b571a612746cba6010888bfcdb3a7ad4fa645e5', '[\"*\"]', NULL, '2023-11-02 08:46:20', '2023-11-02 08:46:20'),
(12, 'App\\Models\\User', 4, 'API Token', '426bd9a15c64e2201d3dbcfaf3a0f4a4626a953d1a26961bdbf54e1443fe9e5b', '[\"*\"]', NULL, '2023-11-02 09:50:57', '2023-11-02 09:50:57'),
(13, 'App\\Models\\User', 2, 'API Token', '3d59365966f69cb794bd9d80aacd0361d62feb3ed07cca3bdef8917435942ce9', '[\"*\"]', NULL, '2023-11-02 09:54:02', '2023-11-02 09:54:02'),
(14, 'App\\Models\\User', 4, 'API Token', '22c3adf6f401a03689fc2de04229c39bd05e209593cf8f392933ab3705048764', '[\"*\"]', NULL, '2023-11-02 10:02:25', '2023-11-02 10:02:25'),
(16, 'App\\Models\\User', 2, 'API Token', '07bd7db09c9a2a53b61872141f3f4f60e2af39fc6b4a4700958bea46da314175', '[\"*\"]', '2023-11-02 10:24:28', '2023-11-02 10:23:31', '2023-11-02 10:24:28');

INSERT INTO `ratings` (`id`, `user_id`, `movie_id`, `rating`, `edited_at`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '6.9', '2023-11-01 14:53:03', '2023-11-01 14:52:58', '2023-11-01 14:53:03');
INSERT INTO `ratings` (`id`, `user_id`, `movie_id`, `rating`, `edited_at`, `created_at`, `updated_at`) VALUES
(2, '2', '1', '5', '2023-11-01 14:53:03', '2023-11-01 14:52:58', '2023-11-01 14:53:03');
INSERT INTO `ratings` (`id`, `user_id`, `movie_id`, `rating`, `edited_at`, `created_at`, `updated_at`) VALUES
(3, '3', '1', '5.5', '2023-11-01 14:53:03', '2023-11-01 14:52:58', '2023-11-01 14:53:03');
INSERT INTO `ratings` (`id`, `user_id`, `movie_id`, `rating`, `edited_at`, `created_at`, `updated_at`) VALUES
(4, '1', '2', '5', NULL, '2023-11-01 15:11:47', '2023-11-01 15:11:47'),
(5, '3', '3', '6', '2023-11-02 08:18:18', '2023-11-02 08:18:02', '2023-11-02 08:18:18'),
(6, '4', '1', '2', '2023-11-02 09:53:12', '2023-11-02 09:52:56', '2023-11-02 09:53:12');

INSERT INTO `users` (`id`, `name`, `role`, `email`, `password`, `device_token`, `created_at`, `updated_at`) VALUES
(1, 'Digvij', 'user', 'admin@admin.com', '$2y$10$l.opLXqT8c1Ih6qrmBsGA.RorxnvuPl9zCBKLcWHKjSy81D.Wfh8O', NULL, '2023-11-01 12:10:38', '2023-11-02 08:50:01');
INSERT INTO `users` (`id`, `name`, `role`, `email`, `password`, `device_token`, `created_at`, `updated_at`) VALUES
(2, 'Admin', 'admin', 'digvij@gmail.com', '$2y$10$l.opLXqT8c1Ih6qrmBsGA.RorxnvuPl9zCBKLcWHKjSy81D.Wfh8O', '16|AKTJ2CCgOOZbrspYyHfaLyNUIw2Fn4lYYmhjvJei', '2023-11-01 12:10:38', '2023-11-02 10:23:31');
INSERT INTO `users` (`id`, `name`, `role`, `email`, `password`, `device_token`, `created_at`, `updated_at`) VALUES
(3, 'Vedant', 'user', 'vedant@gmail.com', '$2y$10$nvWFsgapI4A86uuvHr9tk.oOmfA.ZmO0tDAFiM4t8WkbgOF8j1Epm', '8|DWnp3RCOrhDvIZ6hjjEbD0GlWuQqXsqSoIk4daGI', '2023-11-02 07:30:39', '2023-11-02 08:08:12');
INSERT INTO `users` (`id`, `name`, `role`, `email`, `password`, `device_token`, `created_at`, `updated_at`) VALUES
(4, 'Saish patil', 'user', 'saish@gmail.com', '$2y$10$RKtOOl/jM75BE/JG1L/Xk.OcGIoF0BCdk1QVhSdTJSPt5BDLUUv6u', NULL, '2023-11-02 09:50:02', '2023-11-02 10:23:10');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;