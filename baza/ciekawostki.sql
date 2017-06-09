-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 09 Cze 2017, 18:06
-- Wersja serwera: 10.1.21-MariaDB
-- Wersja PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `ciekawostki`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ciekawostka`
--

CREATE TABLE `ciekawostka` (
  `id` int(11) NOT NULL,
  `nazwa` text COLLATE utf8_polish_ci NOT NULL,
  `opis` text COLLATE utf8_polish_ci NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_konta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategoria`
--

CREATE TABLE `kategoria` (
  `id` int(11) NOT NULL,
  `nazwa` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konto`
--

CREATE TABLE `konto` (
  `id` int(11) NOT NULL,
  `login` text COLLATE utf8_polish_ci NOT NULL,
  `haslo` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `konto`
--

INSERT INTO `konto` (`id`, `login`, `haslo`) VALUES
(1, 'klient', '$2y$10$0Zbtg6bLgsuOM3AoMsNZNepb2ef9.h6TDh7.UccEzsEr4jS1O6RrS'),
(2, 'mateusz', '$2y$10$SoWXBdZ4uxsZzyH1xszPKORwcZytPXT24qHjHyDN7H1qr8Vb3hMfm'),
(3, 'megane', '$2y$10$xMSQo4IywBuu5kE011.FfuM4EC5t6MOFWJmOe95t/aD.UfBosDk3G'),
(4, 'ciastko', '$2y$10$zHLiCu9jbU00bU4qRaBkCuJQjmOFGMsaKfT7TC8RIBeLvK065xlrS');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `ciekawostka`
--
ALTER TABLE `ciekawostka`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_konta` (`id_konta`);

--
-- Indexes for table `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konto`
--
ALTER TABLE `konto`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `ciekawostka`
--
ALTER TABLE `ciekawostka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `konto`
--
ALTER TABLE `konto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `ciekawostka`
--
ALTER TABLE `ciekawostka`
  ADD CONSTRAINT `autor_fk` FOREIGN KEY (`id_konta`) REFERENCES `konto` (`id`),
  ADD CONSTRAINT `kategoria_fk` FOREIGN KEY (`id_kategori`) REFERENCES `kategoria` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
