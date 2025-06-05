-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 
-- 伺服器版本： 8.0.17
-- PHP 版本： 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `database`
--

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `number` int(11) NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `phone number` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `birthday` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`number`, `name`, `mail`, `password`, `address`, `phone number`, `birthday`) VALUES
(1, '測試員1', 'a123456@gmail.com', '123456', NULL, NULL, NULL),
(2, '測試員2', 'a789456@gmail.com', '123', NULL, NULL, NULL),
(3, '測試員3', 'a178657866@gmail.com', '123456789', NULL, '0927541397', '2020-12-10'),
(4, '測試員4', 'text4@gmail.com', '123', NULL, '0987245372', '2021-01-20');

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `Psin` int(11) NOT NULL COMMENT '產品編號',
  `Pname` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '產品名稱/品名',
  `price` int(11) NOT NULL COMMENT '價格',
  `inventory` int(11) NOT NULL COMMENT '存貨/數量',
  `specifications` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '規格',
  `Ingredients` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '成份',
  `Smell` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '嗅點',
  `pic` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`Psin`, `Pname`, `price`, `inventory`, `specifications`, `Ingredients`, `Smell`, `pic`) VALUES
(1, '【禁果】Fuzzy Navel', 1100, 6, '30ml 古龍水', '香精、玉米酒精、蒸餾水（香水95％使用天然成份）', '主基調是以水蜜桃的果香散發誘人的氣味，彷彿喝到了一杯微醺的滋味。', '//cdn.cybassets.com/media/W1siZiIsIjEwMzE2L3Byb2R1Y3RzLzI5NDA2NjU4LzE4MjU5Nl8xOWRhMzk0ZDQ1NTljNmFjNDE2Zi5qcGVnIl0sWyJwIiwidGh1bWIiLCI2MDB4NjAwIl1d.jpeg?sha=15f8ad5766d753d3'),
(2, '【西瓜棒棒糖】', 1100, 14, '30ml 古龍水', '香精、玉米酒精、蒸餾水（香水95％使用天然成份）', '西瓜棒棒糖就是台灣夏天西瓜的氣味, 清涼消暑, 特別讓人感到愉悅! ', '//cdn.cybassets.com/media/W1siZiIsIjEwMzE2L3Byb2R1Y3RzLzgzMjM1NC_opb_nk5zmo5Lmo5Lns5ZfOTkyYTA3YTI3MzAzN2Y0MjdjMmMuanBlZyJdLFsicCIsInRodW1iIiwiNjAweDYwMCJdXQ.jpeg?sha=d43f5425e28e6975'),
(3, '【雙子座】 Gemini 抹式香水', 650, 5, '15ml EDP香水', '香精、玉米酒精、蒸餾水（香水95％使用天然成份）', '雙子座 (關鍵字：Versatile 多變的)\r\n豐富多層次的柑橘氣息就像好奇的雙子們多變的性格及多才多藝。具豐富表達能力是位天生的演說家，亦彷彿杯多變的調酒讓人想不斷的一口一口品嚐下去。時而甜時而香，令人摸不著頭緒！', '//cdn.cybassets.com/media/W1siZiIsIjEwMzE2L3Byb2R1Y3RzLzI4OTg3NjY5LzEy5pif5bqnMTVjcOe2sui3r-S4iuaetumbmeWtkOato-mdol8xNjJiNDdiMDU2YjA0Y2I0ZmUzOC5qcGVnIl0sWyJwIiwidGh1bWIiLCI2MDB4NjAwIl1d.jpeg?sha=1c42ebfbf6de0dd8'),
(4, '【射手座】 Sagittarius 抹式香水', 650, 15, '15ml EDP香水', '香精、玉米酒精、蒸餾水（香水95％使用天然成份）', '迷漾星座款-射手座 (關鍵字：Adventurous 冒險的) \r\n崇尚自由的射手就像這款極具空間感的氣息，大方而無拘無束的。\r\n喜歡冒險、行動派的射手座，動作如箭般的迅速，\r\n想到的事就會馬上付諸執行，很有衝勁、精力充沛。', '//cdn.cybassets.com/media/W1siZiIsIjEwMzE2L3Byb2R1Y3RzLzI4OTg3NzA4LzEy5pif5bqnMTVjcOe2sui3r-S4iuaetuWwhOaJi-ato-mdol9jMmVmOTdiOTMyNzQzNzVlMzQ5Ny5qcGVnIl0sWyJwIiwidGh1bWIiLCI2MDB4NjAwIl1d.jpeg?sha=ecc9280a2eccec93'),
(5, '【加勒比海】Caribbean Sea ', 250, 12, '5ml 古龍水', '香精、玉米酒精、蒸餾水（香水95％使用天然成份）', '淡淡含著氧氣, 混著绿意和花的氣味; 想像春天漂浮在平静，温暖，深蓝色的加勒比海上的感覺。\r\n ', '//cdn.cybassets.com/media/W1siZiIsIjEwMzE2L3Byb2R1Y3RzLzI2NTE2NDczL-WKoOWLkuavlOa1t19iZDUzZThmNDNiZDJjZjhhNWY2My5qcGVnIl0sWyJwIiwidGh1bWIiLCI2MDB4NjAwIl1d.jpeg?sha=89bef2021cce91a6'),
(6, '【保加利亞玫瑰】 Bulgarian Rose', 250, 5, '5ml 古龍水', '香精、玉米酒精、蒸餾水（香水95％使用天然成份）', '手工採集，保加利亞玫瑰精油又被稱為液體黃金，需要1300朵盛開的玫瑰來提煉出1克玫瑰精油，比黃金更名貴！ 它給予了這款玫瑰香水一顆溫柔的心。', '//cdn.cybassets.com/media/W1siZiIsIjEwMzE2L3Byb2R1Y3RzLzI5MDA2NjUyL-S_neWKoOWIqeS6nueOq-eRsF85YzJjYzNlMjRkYWU0ZDkzNzRjMC5qcGVnIl0sWyJwIiwidGh1bWIiLCI2MDB4NjAwIl1d.jpeg?sha=59fd8cea03e311c2'),
(7, '【普羅旺斯草原】 Provence Meadow', 1100, 10, '30ml 古龍水', '香精、玉米酒精、蒸餾水（香水95％使用天然成份）', '只有在普羅旺斯草原聞得到的花草香，包括小茴香、羅勒、迷迭香和百里香還有薰衣草。\r\n這些花草原本是烹飪用，但Demeter 把這些花草一併放入這款香水，讓你一次收集這花草香味', '//cdn.cybassets.com/media/W1siZiIsIjEwMzE2L3Byb2R1Y3RzLzUzNDE3OC_mma7nvoXml7rmlq9fNmJlNWM0YjJlMWM4MmE0YzgzZTIuanBlZyJdLFsicCIsInRodW1iIiwiNjAweDYwMCJdXQ.jpeg?sha=dc4e7a9baf12bab4');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`number`),
  ADD KEY `number` (`number`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Psin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
