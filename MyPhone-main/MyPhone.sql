-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 20 2023 г., 21:39
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `MyPhone`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Смартфоны', NULL),
(2, 'Умные часы', NULL),
(3, 'Аудио', NULL),
(4, 'Электроника', NULL),
(5, 'Приставки и игры', NULL),
(6, 'Техника для дома', NULL),
(7, 'Аксессуары', NULL),
(8, 'Сертификаты', NULL),
(9, 'Услуги', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int UNSIGNED NOT NULL,
  `client_id` int UNSIGNED NOT NULL,
  `seller_id` int UNSIGNED DEFAULT NULL,
  `status` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Оформлен',
  `ordering_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `purchase_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `client_id`, `seller_id`, `status`, `ordering_time`, `purchase_time`) VALUES
(1, 52, 53, 'Оплачен', '2022-12-14 05:47:37', '2022-12-22 05:53:59'),
(3, 52, 53, 'Оплачен', '2022-12-22 05:19:25', '2022-12-22 05:58:36'),
(4, 52, 53, 'Оплачен', '2022-12-22 05:19:50', '2022-12-22 05:58:35'),
(5, 52, 53, 'Оплачен', '2022-12-22 05:20:17', '2022-12-22 05:58:35'),
(6, 52, 53, 'Оплачен', '2022-12-22 05:23:53', '2022-12-22 05:58:33'),
(7, 53, 53, 'Оплачен', '2022-12-22 05:54:07', '2022-12-22 05:58:30'),
(8, 53, 53, 'Оплачен', '2022-12-22 07:36:32', '2022-12-22 07:36:38'),
(9, 52, 53, 'Оплачен', '2023-01-15 19:25:41', '2023-01-15 19:26:07'),
(10, 56, 56, 'Оплачен', '2023-01-17 17:51:59', '2023-01-17 17:52:07'),
(11, 56, 56, 'Отменен', '2023-01-17 22:45:35', '2023-01-19 19:24:02'),
(12, 56, NULL, 'Оформлен', '2023-01-19 19:23:37', NULL),
(13, 56, NULL, 'Оформлен', '2023-01-19 19:24:39', NULL),
(14, 56, NULL, 'Оформлен', '2023-01-19 19:25:47', NULL),
(15, 56, NULL, 'Оформлен', '2023-01-19 19:44:42', NULL),
(16, 56, NULL, 'Оформлен', '2023-01-19 19:44:48', NULL),
(17, 56, NULL, 'Оформлен', '2023-01-19 19:45:04', NULL),
(18, 56, NULL, 'Оформлен', '2023-01-19 19:45:34', NULL),
(19, 56, NULL, 'Оформлен', '2023-01-19 19:45:56', NULL),
(20, 56, NULL, 'Оформлен', '2023-01-19 19:46:10', NULL),
(21, 56, NULL, 'Оформлен', '2023-01-19 19:46:36', NULL),
(22, 56, NULL, 'Оформлен', '2023-01-19 19:47:23', NULL),
(23, 56, NULL, 'Оформлен', '2023-01-19 19:47:47', NULL),
(24, 56, NULL, 'Оформлен', '2023-01-19 19:51:38', NULL),
(25, 56, NULL, 'Оформлен', '2023-01-19 19:51:49', NULL),
(26, 56, NULL, 'Оформлен', '2023-01-19 19:51:56', NULL),
(27, 56, NULL, 'Оформлен', '2023-01-19 19:52:01', NULL),
(28, 56, NULL, 'Оформлен', '2023-01-19 19:52:07', NULL),
(29, 56, NULL, 'Оформлен', '2023-01-19 19:52:15', NULL),
(30, 56, NULL, 'Оформлен', '2023-01-19 19:52:41', NULL),
(31, 56, NULL, 'Оформлен', '2023-01-19 19:53:38', NULL),
(32, 56, NULL, 'Оформлен', '2023-01-19 19:53:48', NULL),
(33, 56, NULL, 'Оформлен', '2023-01-19 19:55:01', NULL),
(34, 56, NULL, 'Оформлен', '2023-01-19 19:55:08', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` float NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`, `description`) VALUES
(67, 'Смартфон Apple iPhone 14 Pro Max 128GB', '16738901367d9bbab152d3846b75ef1760c9e84859.png', 104990, NULL),
(68, 'Смартфон Apple iPhone 14 128GB', '1673892110ea706d6fe276cd891bc4a89e93e9909a.jpg', 61890, NULL),
(69, 'Смартфон Apple iPhone 13 Pro Max 128GB', '167389453086aa4a75f939576004a0def940ffc52e.png', 89390, NULL),
(70, 'Смартфон Apple iPhone 13 Pro 128GB', '16738947982beadf37027b097e6f7f5605b09b2d65.png', 88490, NULL),
(71, 'Смартфон Apple iPhone 13 128GB', '16738953289564f480b643ec2e4767dee6c0b394f2.png', 55490, NULL),
(73, 'Смартфон Apple iPhone 13 mini 128GB', '1674161785720efe635ef2ec8d81f03fffe4bed2ab.png', 53490, NULL),
(74, 'Смартфон Apple iPhone 12 64GB', '1674161848232234ca61cb311a388629c87536861d.jpg', 42150, NULL),
(75, 'Смартфон Apple iPhone 11 64GB', '16741618883efc4e0009aa4e348d7ab86902521923.png', 34990, NULL),
(76, 'Смартфон Apple iPhone XR 64GB', '16741619374b0f4b836e30b1b35a0cd157ab952854.jpg', 38990, NULL),
(77, 'Смартфон Apple iPhone SE 2020 64GB ', '1674161988135b23b32a7af3d1ef70bf9ef2f654d2.jpg', 31190, NULL),
(78, 'Смартфон Apple iPhone X 256GB', '1674162024fce51f7f3f996f218b9e2a5d75e40883.jpg', 47890, NULL),
(79, 'Детские умные часы GEOZON Classic, голубой', '16741622152fedc3ee743542759b4495e534cfe8e9.jpg', 2290, NULL),
(80, 'Умный браслет Xiaomi Mi Band 7, черный', '1674162245d1f3cd7ce689dba2701d7f93393f4363.jpg', 3490, NULL),
(81, 'Браслет Xiaomi Mi Band 4 NFC', '1674162268b42903f023f05338bf8ca7f8ff4bee8b.jpg', 4190, NULL),
(82, 'Умные часы Amazfit GTS 2, Розовый', '16741622895d0cbfc258cb96c3a0825ce1d6c4e303.jpg', 12290, NULL),
(83, 'Часы Apple Watch Series 3 38mm Aluminum Case', '16741623131e1586897cca5af25674574c06fa3367.jpg', 15390, NULL),
(84, 'Умные часы Apple Watch Series 3 42mm ', '1674162354301cf8d7d022ece349f9c711ce41cf8a.jpg', 18990, NULL),
(85, 'Часы Apple Watch SE GPS 44mm Aluminum Case ', '1674162412f5f3a8d5718c495a1d5ec0c8c15b3d2e.jpg', 23490, NULL),
(86, 'Гарнитура Apple EarPods с разъёмом 3,5 мм', '1674162449fdf6d05ea8121a6849ab250432041e3a.jpg', 2290, NULL),
(87, 'Беспроводные наушники Apple AirPods 2', '16741625235cb872aa7f0a8cbd2094d4d0c271a763.jpg', 8990, NULL),
(88, 'Беспроводные наушники Apple AirPods 3', '1674162552fd223db351f76077632ffa7dace69b13.jpeg', 13590, NULL),
(89, 'Беспроводные наушники Apple AirPods Pro White', '1674162576a5979d8a93f92cd0ec314efc17d9fe41.jpg', 15290, NULL),
(90, 'Умная колонка Яндекс.Станция Лайт, Желтый', '16741626188046404ca3059f2c8b70682f611fa293.jpg', 4490, NULL),
(91, 'Умная колонка Яндекс Новая Станция Мини', '16741626433cf3e92e440754205ea61b49cee34c54.png', 6990, NULL),
(92, 'Яндекс Станция 2 умная колонка с Алисой', '16741626776310cdb95c1f01afa51b9caf533ce557.jpg', 14790, NULL),
(93, 'Умная колонка Яндекс.Станция Макс, черная', '167416271964d7bb5e66cf97dd1d03d71b47e75300.jpg', 23390, NULL),
(94, 'Умная колонка Apple HomePod mini (Белый)', '167416274729c6e805d932883493678d455310566e.jpg', 9190, NULL),
(96, 'Переходник Satechi TypeC Slim Multiport ', '167416319092d9f13daf81f5630d8d6a36d397c76d.jpg', 8390, NULL),
(97, 'Клавиатура Elgato Stream Deck XL, черный', '1674163307d86f562e646bee0ea4205976adbeb870.jpg', 29790, NULL),
(98, 'Проектор Xiaomi Mi Smart Projector 2 Pro', '16741633342934e6c14559a08445322bbc217afb9e.png', 77990, NULL),
(99, 'Монитор Apple Studio Display 27 Standard 5K ', '1674163384b598c91744178427aee4dbcd32dbc72c.jpg', 199990, NULL),
(100, 'Игровая приставка Sony PlayStation 5 SSD', '1674163532sony_playstation_5_gamepad_3.jpg', 68990, NULL),
(101, 'Sony playstation 4 pro ', '1674163595KONSOLA-SONY-PLAYSTATION-4-PRO-PS4-PRO-1TB.jfif', 41990, NULL),
(102, 'Игровая консоль PlayStation 4 Slim (1TB)', '16741636881506991686136_default.jpg', 29990, NULL),
(103, 'Игровая консоль Xbox Series S 512GB', '1674163725kupit_igrovaya_konsol_xbox_series_s.jpg', 24990, NULL),
(104, 'Horizon Запретный Запад ', '1674163766kupit_horizon_zapretnyj_zapad_forbidden_west_ps4.jpg', 5990, NULL),
(105, 'Far Cry 6', '1674163796kupit_far_cry_6_ps4.jpg', 3990, NULL),
(106, 'FIFA 22 ', '1674163821kupit_fifa_22_ps4.jpg', 2990, NULL),
(107, 'Assassins Creed Вальгалла Valhalla', '1674163856kupit_assassin_s_creed_valgalla_valhalla_ps4.jpg', 3900, NULL),
(108, 'UFC 4', '1674163901kupit_ufc_4_xbox_one.jpg', 3990, NULL),
(109, 'Grand Theft Auto V', '1674163921kupit_grand_theft_auto_v_gta_5_premium_edition_xbox_one.jpg', 3990, NULL),
(110, 'Cyberpunk 2077', '1674163963kupit_cyberpunk_2077_xbox_one.jpg', 4900, NULL),
(111, 'Overcooked  All You Can Eat', '167416400081ufqcjsq6l.jpg', 2490, NULL),
(112, 'Геймпад Sony DualShock камуфляж v2', '1674164037dualshock4_2_greencamouflage_01_big.png', 6999, NULL),
(113, 'Геймпад Sony DualShock White v2', '1674164071400x400.jpg', 6499, NULL),
(114, 'Беспроводной контроллер для Xbox One', '16741641410f762b2ee4dad4d0b7ff675956ba5a12.jpeg', 5990, NULL),
(115, 'Беспроводной геймпад Carbon для Xbox', '1674164179ocr-_-2022_12_05t224844.605.jpeg', 7490, NULL),
(116, 'Роботпылесос Xiaomi Dreame F9', '1674164332a2f93fbe3157093181a34f01063197e0.jpg', 16990, NULL),
(119, 'Робот-пылесос Xiaomi Mi Robot Vacuum-Mop P', '1674216573dc780b33eaca5af8c414b4669ca0a86b.jpg', 26790, NULL),
(120, 'Mi Robot Vacuum-Mop 2 Pro ', '16742173958419026771185d28687351ac292d283b.jpg', 26900, NULL),
(121, 'Чехол Deppa для AirPods 2 Мятный', '16742174636b2ecfa544422e116840d73c793d3904.jpg', 299, NULL),
(122, 'Чехол Deppa для AirPods 2 Красный', '167421751923cca655f91a62b83aad4d8574a6f7fa.jpg', 299, NULL),
(123, 'Чехол Deppa для AirPods 2 Белый', '167421753132b78fc3efec906aa4bd60bd07635b3b.jpg', 299, NULL),
(124, 'Чехол Deppa для AirPods 2 Синий ', '16742175410ebbce15a78f3e88adcd8522bcfa68af.jpg', 299, NULL),
(125, 'Подарочный сертификат на 1000 рублей', '1674217642167387907417909.970.png', 1000, NULL),
(126, 'Подарочный сертификат на 2500 рублей', '1674217656167387907417909.970.png', 2500, NULL),
(127, 'Подарочный сертификат на 5000 рублей', '1674217667167387907417909.970.png', 5000, NULL),
(128, 'Подарочный сертификат на 1000рублей', '1674217680167387907417909.970.png', 1000, NULL),
(129, 'Переустановка ISO', '1674217715img_488323.png', 999, NULL),
(130, 'Защитное стекло', '1674217731img_488323.png', 1299, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `product_category`
--

CREATE TABLE `product_category` (
  `product_id` int UNSIGNED NOT NULL,
  `category_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `product_category`
--

INSERT INTO `product_category` (`product_id`, `category_id`) VALUES
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 2),
(80, 2),
(81, 2),
(82, 2),
(83, 2),
(84, 2),
(85, 2),
(86, 3),
(87, 3),
(88, 3),
(89, 3),
(90, 3),
(91, 3),
(92, 3),
(93, 3),
(94, 3),
(96, 4),
(97, 4),
(98, 4),
(99, 4),
(100, 5),
(101, 5),
(102, 5),
(103, 5),
(104, 5),
(105, 5),
(106, 5),
(107, 5),
(108, 5),
(109, 5),
(110, 5),
(111, 5),
(112, 5),
(113, 5),
(114, 5),
(115, 5),
(116, 6),
(119, 6),
(120, 6),
(121, 7),
(122, 7),
(123, 7),
(124, 7),
(125, 8),
(126, 8),
(127, 8),
(128, 8),
(129, 9),
(130, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `product_order`
--

CREATE TABLE `product_order` (
  `product_id` int UNSIGNED NOT NULL,
  `order_id` int UNSIGNED NOT NULL,
  `count` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `product_order`
--

INSERT INTO `product_order` (`product_id`, `order_id`, `count`) VALUES
(67, 10, 1),
(67, 11, 1),
(67, 12, 2),
(67, 13, 1),
(67, 15, 96),
(67, 22, 2),
(67, 23, 1),
(67, 24, 2),
(67, 25, 1),
(67, 26, 1),
(67, 27, 1),
(67, 28, 1),
(67, 29, 1),
(67, 30, 2),
(67, 31, 1),
(67, 32, 1),
(67, 33, 1),
(68, 11, 1),
(68, 12, 1),
(68, 13, 1),
(68, 16, 1),
(68, 17, 1),
(68, 18, 1),
(68, 19, 1),
(68, 20, 1),
(68, 21, 1),
(68, 22, 1),
(68, 34, 1),
(69, 11, 1),
(69, 12, 1),
(69, 22, 1),
(70, 11, 1),
(70, 12, 1),
(71, 11, 1),
(71, 14, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'owner', NULL),
(2, 'client', NULL),
(3, 'seller', NULL),
(4, 'guest', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `patronymic_name` varchar(45) DEFAULT NULL,
  `role_id` int UNSIGNED NOT NULL,
  `login` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(319) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `cookie` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `patronymic_name`, `role_id`, `login`, `password`, `email`, `phone`, `birthday`, `cookie`) VALUES
(52, 'Покупатель', NULL, NULL, 2, NULL, '$2y$10$1T2qB4wG2Y10tk3cJmvA4./A/tnoj6vGPKXtALg6/YrizvHfgWPe2', 'gdimoks@mail.ru', NULL, NULL, '857e192ce98471d7e9f602129f4303c5bb6f29cd3d880350b8e5289cbfc986f3'),
(53, 'Продавец', NULL, NULL, 3, NULL, '$2y$10$DVgNWJtEjHoK5lZrWHhPUeFcgYr6mXWa.ORk8vjC4igZkjqjjDeWe', 'fanko@fancho.ru', NULL, NULL, '9931fdff142d16b97e8fef7e1e4ebc07998d3801789cf4be281d6ab0256a7925'),
(54, 'Владелец', NULL, NULL, 1, NULL, '$2y$10$gK8zGNxyEofBc4egt3BnjOvBTphth8OcxAf6RxGMu.H4kV85h8zXq', 'owner@own.ru', NULL, NULL, '6afb61fdb7dde58af03d376ec59edd131780ced4d0bfbdeacdbe40454363a7bf'),
(55, 'Олег', NULL, NULL, 3, NULL, '$2y$10$W9YXg/gWWNsah9QvlGx2geqJlVAAHYMy01.AOnRNbk1iGnng2ZWSW', 'oleg@mail.ru', NULL, NULL, 'f2d89145b97dd52d8f52070540595f25cceeaee20dcb29119c6c93bbbe0f89aa'),
(56, 'Олег', NULL, NULL, 3, NULL, '$2y$10$Oyn6FK12ZjP03VulkHfQN.xo3CwMsy0RmH3EHKlDDoF4ozcTPwLii', 'oleg1@mail.ru', NULL, NULL, '93f471d49332540437a8e873cdaf2a6e21d6984ea56f72809937deea61c9d541'),
(57, 'Олег', 'Найденов', NULL, 1, NULL, '$2y$10$odLy07yhMseiDid61mwOJuADBD2WN2wfXfC0cnNnP/HX9hHbDoS.K', 'oleg.naydenovic@gmail.com', NULL, NULL, '75614ca33f01fdf0152a75f4ac989aa56ee9d4124c680bb8270897b50fa5ade9'),
(58, 'Некит', '', NULL, 3, NULL, '$2y$10$MFduzZ/MakqWSFb7LpA9X.6FdNlb7g8DhzGQWSFwGfWR3pYsZDLPW', '123@mail.ru', NULL, NULL, '9b567ad0a8b08093cd69dc9960bad8387a0431b58200624bbda4b9a504785788'),
(60, 'Никита', 'Лукашевич', NULL, 2, NULL, '$2y$10$M1hpQvyeaSwnAf1QJyhQK.lTVvtJDWxUodFL9wF3FkCruV.2W1BY.', '12333333@mail.ru', NULL, NULL, 'ab1d9325dd52586db5b7707c8e5f36a7f28f0dfc1681287ce40e3389b44f6a12'),
(61, 'Аим', 'ааааа', '', 2, NULL, '$2y$10$nOEie0v/UezgOf8zgKrQ9Oc07IRppF4VJqe4wWJTzR/qXTeXCtXzG', '123@co1c.coc', NULL, NULL, NULL),
(62, 'Аим', 'ааааа', 'бббббббббб', 2, NULL, '$2y$10$E9g2OhQXXLTAtKgp4yQnheGnfquN8HWSnJniPqYYcEdT4RRmjGbTq', '123@coc.coc', NULL, NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`product_id`,`order_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_category_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product_order`
--
ALTER TABLE `product_order`
  ADD CONSTRAINT `product_order_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_order_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
