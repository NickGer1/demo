-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 25 2026 г., 12:53
-- Версия сервера: 8.0.30
-- Версия PHP: 8.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `project`
--

-- --------------------------------------------------------

--
-- Структура таблицы `claims`
--

CREATE TABLE `claims` (
  `id` bigint UNSIGNED NOT NULL,
  `status` enum('new','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `date` date NOT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `claims`
--

INSERT INTO `claims` (`id`, `status`, `date`, `place`, `pay`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'new', '2026-02-12', 'зал', 'Картой', 2, '2026-02-25 06:49:30', '2026-02-25 06:49:30'),
(2, 'new', '2026-02-25', 'ресторан', 'наличные', 2, '2026-02-25 06:49:44', '2026-02-25 06:49:44'),
(3, 'new', '2026-03-25', 'закрытая веранда', 'часть наличными / часть по qr коду', 2, '2026-02-25 06:50:01', '2026-02-25 06:50:01'),
(4, 'new', '2026-05-05', 'летняя веранда', 'По договору', 2, '2026-02-25 06:50:17', '2026-02-25 06:50:17'),
(5, 'new', '2026-02-22', 'летняя веранда', 'Наличные', 2, '2026-02-25 06:50:32', '2026-02-25 06:50:32'),
(6, 'new', '2026-03-30', 'ресторан', 'картой', 2, '2026-02-25 06:50:47', '2026-02-25 06:50:47'),
(7, 'new', '2026-03-03', 'зал', 'наличные', 2, '2026-02-25 06:50:56', '2026-02-25 06:50:56'),
(8, 'new', '0343-04-11', 'зал', 'по карте', 2, '2026-02-25 06:51:20', '2026-02-25 06:51:20'),
(9, 'new', '2026-03-03', 'летняя веранда', 'qr', 2, '2026-02-25 06:51:34', '2026-02-25 06:51:34');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0002_02_02_000000_create_claims_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `login` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `full_name`, `phone`, `email`, `password`, `is_admin`, `created_at`, `updated_at`) VALUES
(1, 'Admin26', 'Администратор Системы', '+79999999999', 'admin@example.com', '$2y$12$BEBaiXRGFa4SpqglWNL0f.zsd7cpgnZWaoBwjZRyhneo8NP1pKq2C', 1, '2026-02-25 06:44:53', '2026-02-25 06:44:53'),
(2, 'user', 'Иванов Иван Иванович', '+79123456789', 'user@example.com', '$2y$12$GyLhchm6atdwgxSZn48Swe3sa.VvVvjFcyixQ7dQFOG8ae6AbgsY.', 0, '2026-02-25 06:44:53', '2026-02-25 06:44:53');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `claims`
--
ALTER TABLE `claims`
  ADD PRIMARY KEY (`id`),
  ADD KEY `claims_user_id_foreign` (`user_id`),
  ADD KEY `claims_status_index` (`status`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_login_unique` (`login`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `claims`
--
ALTER TABLE `claims`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `claims`
--
ALTER TABLE `claims`
  ADD CONSTRAINT `claims_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
