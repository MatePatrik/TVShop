-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Nov 02. 15:25
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `televiziok`
CREATE DATABASE IF NOT EXISTS `televiziok` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `televiziok`;
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tv`
--

CREATE TABLE `tv` (
  `tvid` int(11) UNSIGNED NOT NULL,
  `tv_neve` varchar(255) DEFAULT NULL,
  `ar` varchar(30) NOT NULL,
  `marka` varchar(255) NOT NULL,
  `kepatlo` double NOT NULL,
  `hz` double NOT NULL,
  `felbontas` varchar(100) NOT NULL,
  `kijelzo` varchar(10) NOT NULL,
  `megjegyzes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `tv`
--

INSERT INTO `tv` (`tvid`, `tv_neve`, `ar`, `marka`, `kepatlo`, `hz`, `felbontas`, `kijelzo`, `megjegyzes`) VALUES
(1, 'Xiaomi Mi TV P1 55', '167 990 Ft', 'Xiaomi', 139, 60, '3840 x 2160 pixel', 'LED', 'Így is ismerheti: Mi TV P 1 55, MiTVP155');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `userid` int(11) UNSIGNED NOT NULL,
  `nev` varchar(255) NOT NULL,
  `emailcim` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`userid`, `nev`, `emailcim`, `username`, `password`) VALUES
(1, 'a', 'a@gmail.com', 'Lajos', '1234'),
(2, 'Admin', 'admin@gmail.com', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `vasarlas`
--

CREATE TABLE `vasarlas` (
  `tvid` int(10) UNSIGNED NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL,
  `vasarlas` date NOT NULL DEFAULT current_timestamp(),
  `allapot` enum('elindult','lezárult') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `tv`
--
ALTER TABLE `tv`
  ADD PRIMARY KEY (`tvid`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `emailcim` (`emailcim`),
  ADD UNIQUE KEY `username` (`username`);

--
-- A tábla indexei `vasarlas`
--
ALTER TABLE `vasarlas`
  ADD UNIQUE KEY `tvid` (`tvid`,`userid`),
  ADD KEY `userid` (`userid`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `tv`
--
ALTER TABLE `tv`
  MODIFY `tvid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `vasarlas`
--
ALTER TABLE `vasarlas`
  ADD CONSTRAINT `vasarlas_ibfk_1` FOREIGN KEY (`tvid`) REFERENCES `tv` (`tvid`),
  ADD CONSTRAINT `vasarlas_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
