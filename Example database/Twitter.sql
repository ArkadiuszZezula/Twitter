-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 05 Maj 2017, 10:23
-- Wersja serwera: 5.7.18-0ubuntu0.16.04.1
-- Wersja PHP: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `Twitter`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Comments`
--

CREATE TABLE `Comments` (
  `id` int(11) NOT NULL,
  `comments_content` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  `autor_id` int(11) NOT NULL,
  `comments_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `Comments`
--

INSERT INTO `Comments` (`id`, `comments_content`, `post_id`, `autor_id`, `comments_date`) VALUES
(1, 'Pierwszyaaa  2', 43, 219, '2017-02-10 00:00:00'),
(2, 'Pierwszyaaa  2', 43, 219, '2017-02-10 00:00:00'),
(126, 'rwewqewq', 2, 219, '2017-05-01 00:00:00'),
(130, 'cxcx', 2, 219, '2017-05-01 00:00:00'),
(147, 'ww', 1, 219, '2017-05-01 00:00:00'),
(148, 'zxcxcx', 3, 219, '2017-05-01 00:00:00'),
(180, 'ggg', 3, 219, '2017-05-01 00:00:00'),
(183, 'xczcz', 51, 219, '2017-05-02 00:00:00'),
(206, 'OKOKOKOK', 2, 219, '2017-05-02 00:00:00'),
(211, 'NEW', 51, 3, '2017-05-02 00:00:00'),
(212, 'I Pierwszy komentarz do tego posta', 6, 219, '2017-05-03 00:00:00'),
(213, 'Komentarz z okazji Å›wiÄ™ta paÅ„stwowego', 51, 149, '2017-05-03 00:00:00'),
(214, 'Dzisiaj znÃ³w pada deszcz', 53, 149, '2017-05-03 00:00:00'),
(215, 'I jest komentarz', 56, 149, '2017-05-03 00:00:00'),
(218, 'A teraz dodaÅ‚em info o dodanym komentarzu', 56, 149, '2017-05-03 00:00:00'),
(222, 'I jest komentarz', 55, 149, '2017-05-03 00:00:00'),
(225, 'blabla', 55, 149, '2017-05-03 00:00:00'),
(226, 'aaaaaaa', 55, 149, '2017-05-03 00:00:00'),
(227, 'aaaaaaa', 55, 149, '2017-05-03 00:00:00'),
(228, 'ttttttttttttttttttt', 56, 149, '2017-05-03 00:00:00'),
(229, 'ttttttttttttttttttt', 56, 149, '2017-05-03 00:00:00'),
(230, 'xcxc', 56, 149, '2017-05-03 00:00:00'),
(231, 'xxc', 56, 149, '2017-05-03 00:00:00'),
(232, 'xxc', 56, 149, '2017-05-03 00:00:00'),
(233, 'eeeeeee', 56, 149, '2017-05-03 00:00:00'),
(234, 'zxcz', 56, 149, '2017-05-03 00:00:00'),
(235, 'cxcxcxcx', 56, 149, '2017-05-03 00:00:00'),
(236, 'cxcxcxcx', 56, 149, '2017-05-03 00:00:00'),
(237, 'bbbbbbbbbbbbbb', 56, 149, '2017-05-03 00:00:00'),
(238, 'bbbbbbbbbbbbbb', 56, 149, '2017-05-03 00:00:00'),
(239, 'sdsds', 56, 149, '2017-05-03 00:00:00'),
(240, '', 56, 149, '2017-05-03 00:00:00'),
(241, '2232', 56, 149, '2017-05-03 00:00:00'),
(242, '2232', 56, 149, '2017-05-03 00:00:00'),
(243, '2232', 56, 149, '2017-05-03 00:00:00'),
(244, '3343', 56, 149, '2017-05-03 00:00:00'),
(245, '3343', 56, 149, '2017-05-03 00:00:00'),
(246, '3232', 56, 149, '2017-05-03 00:00:00'),
(247, 'eeeeeeeee', 56, 149, '2017-05-03 00:00:00'),
(248, 'sd', 56, 149, '2017-05-03 00:00:00'),
(249, 'adsadas', 56, 149, '2017-05-03 00:00:00'),
(250, 'afsdas', 56, 149, '2017-05-03 00:00:00'),
(251, 'sdasdas', 56, 149, '2017-05-03 00:00:00'),
(252, 'czxcz', 56, 149, '2017-05-03 00:00:00'),
(253, 'wwwwwwwwwww', 55, 149, '2017-05-03 00:00:00'),
(254, 'xcccccccccccccccccccccccccccccccc', 55, 149, '2017-05-03 00:00:00'),
(255, '1', 54, 149, '2017-05-03 00:00:00'),
(256, '2', 54, 149, '2017-05-03 00:00:00'),
(257, '3', 54, 149, '2017-05-03 00:00:00'),
(258, 'asadsad', 54, 149, '2017-05-03 00:00:00'),
(259, 'adsadas', 54, 149, '2017-05-03 10:05:03'),
(260, 'cxcxcx', 54, 149, '2017-05-03 10:05:07'),
(261, 'adssa', 54, 149, '2017-05-03 10:05:36'),
(262, 'cxcx', 54, 149, '2017-05-03 10:05:55'),
(263, 'eeeeeeeeeee', 54, 149, '2017-05-03 10:05:48'),
(264, 'eeeeeeeeeee', 54, 149, '2017-05-03 10:05:01'),
(265, 'w', 54, 149, '2017-05-03 10:05:41'),
(266, 'e', 54, 149, '2017-05-03 10:05:54'),
(267, 'e', 54, 149, '2017-05-03 10:05:09'),
(268, '343', 54, 149, '2017-05-03 10:05:16'),
(269, 'sdsds', 54, 149, '2017-05-03 10:05:44'),
(270, 'sss', 54, 149, '2017-05-03 10:05:10'),
(271, 'aaaaaaaaaaaaaa', 54, 149, '2017-05-03 10:05:35'),
(272, 'ok', 53, 149, '2017-05-03 10:05:27'),
(273, 'cxcx', 53, 149, '2017-05-03 10:05:17'),
(274, 'sdsds', 53, 149, '2017-05-03 10:05:26'),
(279, 'Wpis z nowym czasem', 51, 149, '2017-05-03 11:01:05'),
(280, 'I chyba dziaÅ‚a dobrze', 63, 149, '2017-05-03 11:02:25'),
(281, 'sdsd', 63, 149, '2017-05-03 12:46:16'),
(282, 'zcxzxc', 43, 219, '2017-05-03 19:27:49');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Messages`
--

CREATE TABLE `Messages` (
  `id` int(11) NOT NULL,
  `send_id` int(11) NOT NULL,
  `rec_id` int(11) NOT NULL,
  `messages_content` varchar(255) NOT NULL,
  `display` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `Messages`
--

INSERT INTO `Messages` (`id`, `send_id`, `rec_id`, `messages_content`, `display`) VALUES
(3, 3, 219, '                            First Message\r\n', 1),
(12, 3, 219, '                            Second', 1),
(29, 3, 219, 'Another message\r\n', 1),
(30, 219, 3, 'WiadomoÅ›Ä‡ do odebrania z dnia 4  maja\r\n', 1),
(31, 219, 149, '                Wszystkiego najlepszego\r\n', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Tweet`
--

CREATE TABLE `Tweet` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `text` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `creationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `Tweet`
--

INSERT INTO `Tweet` (`id`, `userId`, `text`, `creationDate`) VALUES
(1, 1, 'Lorem ipsum', '2017-04-20 00:00:00'),
(2, 1, 'Drugi wpis', '2017-03-20 00:00:00'),
(3, 2, 'Blabla', '2017-03-20 00:00:00'),
(4, 3, 'Kolejny wpis', '2017-02-20 00:00:00'),
(6, 3, 'Pierwszy tweet', '2017-05-01 00:00:00'),
(8, 3, 'Next Tweet', '2017-04-30 00:00:00'),
(9, 3, 'The last one', '2017-04-30 00:00:00'),
(10, 3, 'And another tweet', '2017-04-30 00:00:00'),
(34, 93, 'And another tweet', '2017-04-30 00:00:00'),
(43, 219, 'To jest pierwszy tweet z komentarzem\r\n', '2017-04-30 00:00:00'),
(51, 219, 'ÅšwiÄ™to flagi', '2017-05-02 00:00:00'),
(52, 149, '3 Maja Konstytucja', '2017-05-03 00:00:00'),
(53, 149, 'Drugi Tweet z okazj', '2017-05-03 00:00:00'),
(54, 149, 'Poprawiony tweet z okazji obchodÃ³w Å›wiÄ™ta Konstytucji 3 Maja', '2017-05-03 00:00:00'),
(55, 149, 'Poprawiony tweet z okazji obchodÃ³w Å›wiÄ™ta Konstytucji 3 Maja', '2017-05-03 00:00:00'),
(56, 149, 'Poprawiony tweet z okazji obchodÃ³w Å›wiÄ™ta Konstytucji 3 Maja', '2017-05-03 00:00:00'),
(57, 149, 'xcxcxxcxc', '2017-05-03 10:05:39'),
(63, 149, 'PoprawiÅ‚em ustawianie czasu na czas msql', '2017-05-03 11:00:01'),
(65, 219, 'zxczxc', '2017-05-03 18:36:31');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Users`
--

CREATE TABLE `Users` (
  `id` int(30) NOT NULL,
  `email` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `hashed_password` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `Users`
--

INSERT INTO `Users` (`id`, `email`, `username`, `hashed_password`) VALUES
(1, 'emailJanek@email.pl', 'Janek Kowalski', '$2y$10$QmBlxL1W0ie4lvs7feyHY.jZkUplk.p9sv11TwBJ5Cw3rYGOwBv8O'),
(2, 'marek@email.pl', 'MarekWojcik\r\n', '$2y$10$t.nrYVrHFJaVFAGQLYbWJuGCVH5bDykZTYv/s3TVz8EMDJv6SAJNa'),
(3, 'nad@yahoo.com', 'Alojzy Nadzwyczajny', '$2y$10$XKxVwgZcW.vJPVIthIjrSuInFXMWuSv3xa4Fu7sd5cpU4MnzV.no2'),
(4, 'test@email.pl', 'Zbigniew B', '$2y$10$AS6Gtd2f5/jXCevT7qjWieMJgkxZGhbUmiGcvDYtL/YUcIndr6m5u'),
(8, 'Adam@gmail.com', 'adam', '$2y$10$imlb8APdAjppcXd9JZpNNOZNSi9Jk0FbP5LIE3S0CAza4Ii6.7RgC'),
(50, 'John@gmail.com', 'John', '$2y$10$IeZzb.5Fb14Lsb7rLbUvQ.gcJTaMF5zeQCy/yHLiJFIXR91/72JMK'),
(73, 'krzysiek@wp.pl', 'krzysiek', '$2y$10$yUKYY0OtnqeeTxPijvhWDugGknDis2oSIsnIektpTlZhWCYuroCae'),
(79, 'Magda@wp.pl', 'Magda Kwiatkowska', '$2y$10$kKibzFiUTpXy1MAA6iijlO9nmeIb0HwH/7etP0vwEcLI5L.hBEEaC'),
(80, 'Kasia@wp.pl', 'Kasia Nosowska', '$2y$10$dA7VMoHSfXKF2RlFfaeqne8SDrVsGeKjdCY7BOI7VUiOARanMcD8m'),
(93, 'Basia@wp.pl', 'Basia', '$2y$10$dvisxcu2zoj5Wyq6el9WDOZD3t3inoQWDVNp3fEXO.X/3SDAMbMk2'),
(99, 'Marian@wp.pl', 'Marian', '$2y$10$ewQuXoSpI9OEFzBJUVBYU.5m20x/tnkHDUiTRbsO.e/F1xIwQACI.'),
(103, 'PaweÅ‚@wp.pl', 'PaweÅ‚', '$2y$10$Pr13ODuqbw/IoP8cgd6Ck.jiI1zHFXJwhly7GPZdgv2R2GKBxkXS6'),
(111, 'Darek@wp.pl', 'Darek Zborowski', '$2y$10$mveVXD5N1a6p6dW32p8DAO6WQL3YovgqVRWRja/zsK.CfmgqSw5Wq'),
(135, 'BogusÅ‚aw@wp.pl', 'BogusÅ‚aw', '$2y$10$6AMftkrodpp7lHRCiHVTDuwa2oii2kYc3QoQ92prEhKbp19Om1PiC'),
(138, 'GoÅ›ka@wp.pl', 'Gosia', '$2y$10$Xpbgk/21dc7blw2Zxdauzeabd/BF/KNSorF3NzhSQ8RUgo4BbW5nG'),
(149, 'Grzegorz@wp.pl', 'Grzesiek', '$2y$10$LgJIcZr6eM5sDGR7m1ib2OV39vgPKg.wVa29etjTUonSgIRbiRPiC'),
(211, 'MaÅ‚gosia@wp.pl', 'MaÅ‚gosia', '$2y$10$Nq3Lb0UpflDfDDTzvZ9xp.ZYynBhRqI2jozAc9xvvFx0oRCe9xp/a'),
(212, 'Jan@wp.pl', 'Jan', '$2y$10$n2R9hZSgmeZPyeICUnOPKuzvrhPdq6QEdYmWZ4bif6TEkUcKZMfdq'),
(213, 'Karol', 'Karol', '$2y$10$0AUDFurqxanBPl3dghYsV.eLwYSg4ydnZKJWViqMMsOwNdcsTphCm'),
(218, 'Krzysztof@yahoo.com', 'Krzysiek Malinowski', '$2y$10$SQPMqcuaXeaDoVYVP5XzXOiPuW3N2CGrL.motb24Nl2xw/GBwF.Qa'),
(219, 'Zenek@interia.pl', 'Zenek Borkowski', '$2y$10$/y53KhXt0r4HEQ.OnklnsuvKEnuWAGpn81EGo8EWMQ59IjeADBLBK'),
(222, 'Wojtek@wp.pl', 'Wojtek', '$2y$10$Bl4ELmwz/sYVcnrH/76S9e5/Uq136RgYdDySM6UWEFHMh5mSUpbjW'),
(238, 'Marian@onet.pl', 'Marian Kowalski', '$2y$10$828gbkZXKS5T7J6oLkbV/OUWrHCEO4N9IxYExO5TlNEesouOvL2Wm');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `autor_id` (`autor_id`);

--
-- Indexes for table `Messages`
--
ALTER TABLE `Messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `send_id` (`send_id`),
  ADD KEY `rec_id` (`rec_id`);

--
-- Indexes for table `Tweet`
--
ALTER TABLE `Tweet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `autor_id` (`userId`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `Comments`
--
ALTER TABLE `Comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=283;
--
-- AUTO_INCREMENT dla tabeli `Messages`
--
ALTER TABLE `Messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT dla tabeli `Tweet`
--
ALTER TABLE `Tweet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT dla tabeli `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `Comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `Tweet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Comments_ibfk_2` FOREIGN KEY (`autor_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `Messages`
--
ALTER TABLE `Messages`
  ADD CONSTRAINT `Messages_ibfk_1` FOREIGN KEY (`send_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Messages_ibfk_2` FOREIGN KEY (`rec_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `Tweet`
--
ALTER TABLE `Tweet`
  ADD CONSTRAINT `Tweet_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
