-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-05-23 11:13:13
-- サーバのバージョン： 10.4.28-MariaDB
-- PHP のバージョン: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `manalog`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `answer`
--

CREATE TABLE `answer` (
  `task_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `user_anwser` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `answer_count` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `answer`
--

INSERT INTO `answer` (`task_id`, `number`, `user_anwser`, `user_id`, `answer_count`, `point`, `time_stamp`) VALUES
(1, 1, '2', 1, 1, 0, '2023-05-23 09:09:54'),
(1, 2, '1', 1, 1, 5, '2023-05-23 09:09:54'),
(1, 3, 'eeee', 1, 1, 0, '2023-05-23 09:09:54');

-- --------------------------------------------------------

--
-- テーブルの構造 `question`
--

CREATE TABLE `question` (
  `TaskId` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `sentence` text NOT NULL,
  `choice` text DEFAULT NULL,
  `answer` text NOT NULL,
  `point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `question_image`
--

CREATE TABLE `question_image` (
  `task_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `file_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `task_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `class` varchar(3) NOT NULL,
  `startDay` date NOT NULL,
  `endDay` date NOT NULL,
  `answer_limit` int(11) NOT NULL,
  `back_color` varchar(30) NOT NULL,
  `task_release` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `class` varchar(3) NOT NULL,
  `number` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `authority` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `user_info`
--

INSERT INTO `user_info` (`id`, `name`, `class`, `number`, `email`, `password`, `authority`) VALUES
(1, 'aaaT1', '1T1', 99, 'aaa@aa', '$2y$10$hQvSbTjrADeicHI90oCbB.YXaN01uap8yHHN9toSCgkNx/razsG6q', 'T');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
