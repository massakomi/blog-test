-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 14 2019 г., 21:35
-- Версия сервера: 8.0.12
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `updated_at` datetime NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `blog`
--

INSERT INTO `blog` (`id`, `title`, `content`, `updated_at`, `image`) VALUES
(2, 'Bootstrap 4.3.0 1', 'Bootstrap v4.3 has landed with over 120 combined closed issues and merged pull requests. This release brings improvements to our utilities, some prep work for moving on to v5’s development, and the standard bug fixes and documentation updates.\r\n\r\nDuring our last release, we shared a small preview of where we’re taking the project next. That’s getting clearer in the coming weeks as our attention turns towards embracing Hugo for ultra fast docs development, removing jQuery in favor of regular JavaScript, and addressing our growing code base.\r\n\r\nKeep reading for v4.3 highlights, and see you soon with more details on v5!', '2019-07-14 19:13:11', 'Lighthouse.jpg'),
(3, 'Bootstrap 3.4.1 and 4.3.1', 'Today we’re shipping Bootstrap v4.3.1 and v3.4.1 to patch an XSS vulnerability, CVE-2019-8331. Also included in v4.3.1 is a small fix to some RFS (responsive font sizes) mixins that were added in v4.3.0.\r\n\r\nEarlier this week a developer reported an XSS issue similar to the data-target vulnerability that was fixed in v4.1.2 and v3.4.0: the data-template attribute for our tooltip and popover plugins lacked proper XSS sanitization of the HTML that can be passed into the attribute’s value.', '2019-07-14 20:53:44', NULL),
(10, 'Bootstrap 4.2.1', 'Look out world, we’re shipping Bootstrap v4.2.1 with a slew of new features, bug fixes, and docs updates. On the new features side, we have spinners, toasts, switches, and (finally!) touch support in the carousel. That’s just the tip of the iceberg though.\r\n\r\nHeads up! v4.2.0 was incorrectly published to npm, so we’ve had to immediately turnaround a v4.2.1 release. npm i bootstrap@latest should now return 4.2.1. Apologies for the inconvenience!\r\n\r\nWe’ve crammed months of work into v4.2.1 with over 400 commits since our last v4.1.3 release. As mentioned in our v3.4.0 release last week, we’re working to decouple our releases from my direct involvement to improve the shipping cadence. Expect more improvements there in 2019.\r\n\r\nKeep reading for highlights and some insight into how we’re getting to v4.3 quickly, and then into v5 (woo!).', '2019-07-14 20:50:52', 'Tulips.jpg'),
(11, 'Bootstrap 3.4.0', 'That’s n1ot a typo—today1 we’re shipping Bootstrap 3.4.0, a long overdue update to address some quality of life issues, XSS fixes, and build tooling updates to make it easier for us, and you, to develop.\r\n\r\nW1hile we’d planned for ages to do a fresh v3.x update, we lost steam as energy was focused on all the work in v4. Early this year, one issue in particular gained a ton of momentum from the community and the core team decided to do a huge push to pull together a solid release. I regret the time it took to pull this release together, especially given the security fixes, but with the improvements under the hood, v3 has never been easier to develop and maintain. Thanks for your continued support along the way!\r\n\r\nKeep reading for what’s changed and a look ahead at what’s coming in v4.2.0.', '2019-07-14 21:14:49', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
