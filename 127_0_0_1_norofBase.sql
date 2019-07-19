--
-- База данных: `norofBase`
--
CREATE DATABASE IF NOT EXISTS `norofBase` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `norofBase`;

-- --------------------------------------------------------

--
-- Структура таблицы `advert`
--

CREATE TABLE `advert` (
  `id` int(11) NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `type` enum('active','blocked','moderate') NOT NULL DEFAULT 'moderate',
  `adv_active` enum('active','block') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `advert`
--

INSERT INTO `advert` (`id`, `category_id`, `user_id`, `name`, `description`, `city`, `price`, `type`, `adv_active`) VALUES
(1, 1, 2, 'Колеса зимнее HAKA 1', 'Продам колеса (зимние шины+диски). Одна шина с небольшой грыжей. Общее состояние шин чуть выше среднего. Диски в хорошем состоянии.', 'Курган', '1500.00', 'active', 'active'),
(2, 12, 2, 'Колеса зимнее HAKA 2', 'Продам колеса (зимние шины+диски). Одна шина с небольшой грыжей. Общее состояные шин чуть                  выше среднего. Диски в хорошем состоянии.', 'Курган', '2500.00', 'active', 'active'),
(4, 2, 2, 'Колеса зимнее HAKA 4', 'Продам колеса (зимние шины+диски). Одна шина с небольшой грыжей. Общее состояные шин чуть                  выше среднего. Диски в хорошем состоянии.', 'Курган', '4500.00', 'blocked', 'active'),
(5, 2, 2, 'Колеса зимнее HAKA 5', 'Продам колеса (зимние шины+диски). Одна шина с небольшой грыжей. Общее состояние шин чуть выше среднего. Диски в хорошем состоянии.', 'Курган', '500.00', 'moderate', 'active'),
(6, 2, 1, 'Колеса зимнее HAKA 6', 'Продам колеса (зимние шины+диски). Одна шина с небольшой грыжей. Общее состояные шин чуть                  выше среднего. Диски в хорошем состоянии.', 'Курган', '1500.00', 'active', 'active'),
(8, 3, 1, 'Колеса зимнее HAKA 8', 'Продам колеса (зимние шины+диски). Одна шина с небольшой грыжей. Общее состояные шин чуть                  выше среднего. Диски в хорошем состоянии.', 'Курган', '2500.00', 'blocked', 'active'),
(9, 4, 2, 'Колеса зимнее HAKA 9', 'Продам колеса (зимние шины+диски). Одна шина с небольшой грыжей. Общее состояние шин чуть выше среднего. Диски в хорошем состоянии.', 'Курган', '3000.00', 'active', 'active'),
(10, 5, 2, 'Колеса зимнее HAKA 10', 'Продам колеса (зимние шины+диски). Одна шина с небольшой грыжей. Общее состояные шин чуть                  выше среднего. Диски в хорошем состоянии.', 'Москва', '3500.00', 'active', 'active'),
(12, 7, 2, 'Колеса зимнее HAKA 12', 'Продам колеса (зимние шины+диски). Одна шина с небольшой грыжей. Общее состояные шин чуть                  выше среднего. Диски в хорошем состоянии.', 'Москва', '1000.00', 'moderate', 'active'),
(13, 8, 2, 'Колеса зимнее HAKA 13', 'Продам колеса (зимние шины+диски). Одна шина с небольшой грыжей. Общее состояние шин чуть выше среднего. Диски в хорошем состоянии.', 'Курган', '1500.00', 'active', 'active'),
(14, 9, 1, 'Колеса зимнее HAKA 14', 'Продам колеса (зимние шины+диски). Одна шина с небольшой грыжей. Общее состояные шин чуть                  выше среднего. Диски в хорошем состоянии.', 'Курган', '2000.00', 'active', 'active'),
(16, 11, 1, 'Колеса зимнее HAKA 16', 'Продам колеса (зимние шины+диски). Одна шина с небольшой грыжей. Общее состояные шин чуть                  выше среднего. Диски в хорошем состоянии.', 'Курган', '3000.00', 'active', 'active'),
(21, 1, 1, 'Тест 2', '<p>Тестовое описание 1.&nbsp;Тестовое описание 1.&nbsp;Тестовое описание 1.&nbsp;Тестовое описание 1.&nbsp;Тестовое описание 1.&nbsp;Тестовое описание 1.&nbsp;Тестовое описание 1.&nbsp;</p>', 'Екатеринбург', '1500.00', 'moderate', 'active');

-- --------------------------------------------------------

--
-- Структура таблицы `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `periodicity` enum('3','5') NOT NULL DEFAULT '3',
  `term` int(11) DEFAULT NULL,
  `date_create` date NOT NULL,
  `date_end` date NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `transliter` varchar(255) NOT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `parent_id`, `name`, `transliter`, `keywords`, `description`) VALUES
(1, 0, 'Главная страница', 'Glavnaya_stranica', 'Главные ключевики', 'Главное описание'),
(2, 0, 'Автомобили', 'Avtomobili', 'Ключевые автомобили', 'Описание автомобили'),
(3, 0, 'Аксессуары для авто', 'Aksessuary_dlya_avto', 'ключевики аксессуары', 'описание аксессуары'),
(4, 0, 'Услуги мастеров', 'Uslugi_masterov', '', ''),
(5, 0, 'Гаджеты и техника', 'Gadghety_i_tehnika', 'Гаджеты и техника ключевики', 'Гаджеты и техника описание'),
(6, 0, 'Аренда жилья', 'Arenda_ghilyya', '', ''),
(7, 0, 'Работа', 'Rabota', '', ''),
(8, 0, 'Личные вещи', 'Lichnye_veschi', '', ''),
(9, 0, 'Дрова и уголь', 'Drova_i_ugoly', '', ''),
(10, 0, 'Инструменты', 'Instrumenty', '', ''),
(11, 0, 'Все для дома', 'Vse_dlya_doma', '', ''),
(12, 0, 'Ремонт квартир', 'Remont_kvartir', '', ''),
(13, 0, 'Станки и техника', 'Stanki_i_tehnika', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `city`
--

INSERT INTO `city` (`id`, `name`) VALUES
(1, 'Москва'),
(2, 'Курган'),
(3, 'Екатеринбург'),
(4, 'Владивосток');

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `filePath` varchar(400) NOT NULL,
  `itemId` int(11) DEFAULT NULL,
  `isMain` tinyint(1) DEFAULT NULL,
  `modelName` varchar(150) NOT NULL,
  `urlAlias` varchar(400) NOT NULL,
  `name` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `image`
--

INSERT INTO `image` (`id`, `filePath`, `itemId`, `isMain`, `modelName`, `urlAlias`, `name`) VALUES
(3, 'Adverts/Advert19/03b469.jpg', 19, 1, 'Advert', '6e3c21eb04-1', ''),
(4, 'Adverts/Advert20/0898c8.jpg', 20, 1, 'Advert', '45bc8bfafc-1', ''),
(6, 'Adverts/Advert21/ac5636.jpg', 21, 0, 'Advert', '2b17bc6c40-2', ''),
(7, 'Adverts/Advert21/44917c.jpg', 21, 0, 'Advert', 'd959cf6ccb-3', ''),
(13, 'Adverts/Advert21/73ef19.jpg', 21, 0, 'Advert', '894448c445-4', ''),
(16, 'Adverts/Advert21/fb2e9a.jpg', 21, 1, 'Advert', 'e63d36b479-1', ''),
(17, 'Adverts/Advert21/c655d8.png', 21, NULL, 'Advert', 'ebf52b8e43-5', ''),
(19, 'Categories/Category3/53be72.png', 3, 1, 'Category', '1e64dacc57-1', ''),
(20, 'Categories/Category4/5d5965.png', 4, 1, 'Category', '6b2b527a24-1', ''),
(21, 'Categories/Category5/576e68.png', 5, 1, 'Category', '3fa77b1a85-1', ''),
(22, 'Categories/Category2/271ad0.png', 2, 1, 'Category', '700067d802-1', ''),
(23, 'Categories/Category6/8d65a9.png', 6, 1, 'Category', '0e55ddedf6-1', ''),
(24, 'Categories/Category7/4b5610.png', 7, 1, 'Category', '1c102c12d4-1', ''),
(25, 'Categories/Category8/38dd99.png', 8, 1, 'Category', '2cbfcb090e-1', ''),
(26, 'Categories/Category9/a22a9e.png', 9, 1, 'Category', 'e9b1daf4db-1', ''),
(27, 'Categories/Category13/2b5d9d.png', 13, 1, 'Category', '98fa3c0f65-1', ''),
(28, 'Categories/Category12/74ea5a.png', 12, 1, 'Category', '6ba569a99f-1', ''),
(29, 'Categories/Category11/ae5079.png', 11, 1, 'Category', '67bc09fb88-1', ''),
(30, 'Categories/Category10/64e06c.png', 10, 1, 'Category', '0401c4f564-1', '');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1510239456),
('m140622_111540_create_image_table', 1511030304),
('m140622_111545_add_name_to_image_table', 1511030304),
('m171109_145740_advert', 1510244507),
('m171109_145933_category', 1510244507),
('m171109_145949_user', 1510244508),
('m171109_150011_advert_images', 1510244508),
('m171109_150121_banner', 1510246305),
('m171109_163215_advert', 1510246306),
('m171109_164530_category', 1510246307),
('m171109_185811_advert', 1510254201),
('m171109_191804_category', 1510255306),
('m171109_202528_category', 1510259237),
('m171110_083628_user', 1510303156),
('m171112_134839_user', 1510494632),
('m171115_171609_advert', 1510766323),
('m171116_154514_pages', 1510847401),
('m171117_103951_pages', 1510915400),
('m171119_194708_city', 1511121017),
('m171120_180659_banner', 1511201571);

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `transliter` varchar(255) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `meta_keywords`, `meta_description`, `title`, `transliter`, `description`) VALUES
(18, 'Ключевик 1', 'Описание 1', 'Страница 3', 'stranica_3', '<p>Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.Описание.</p>\r\n');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','moderated','user') NOT NULL DEFAULT 'user',
  `type` enum('active','blocked') NOT NULL DEFAULT 'active',
  `password` varchar(255) NOT NULL,
  `auth_key` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `tel`, `email`, `role`, `type`, `password`, `auth_key`) VALUES
(1, 'Администратор', '+7(999)555-77-77', 'admin@mail.ru', 'admin', 'active', '$2y$13$EjLS79KySAXinN5OvgTldecgYe0NMlfZB0.eDWVJdjuK/tVjgc/5.', 'EzegNYGj61KIqJpKXuRU_FBpFVhuZspS'),
(2, 'Алексей', '+7 909 100-00-00', 'test@mail.ru', 'user', 'active', '', NULL),
(4, 'Модератор 2', '+7(999)999-99-99', 'test2@mail.ru', 'moderated', 'active', '$2y$13$k6BXEpvk/aY1.Rf66R1XEOPZrr..vu0r/bNFTC2t1Z.CWPMhEaHue', '7h4qti4Hw2XFrUbztyKqCBdecnhwOmz0');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `advert`
--
ALTER TABLE `advert`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `advert`
--
ALTER TABLE `advert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT для таблицы `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;