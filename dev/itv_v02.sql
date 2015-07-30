-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 30. Jul 2015 um 10:57
-- Server-Version: 5.6.25
-- PHP-Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `itv_v02`
--
DROP DATABASE `itv_v02`;
CREATE DATABASE IF NOT EXISTS `itv_v02` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `itv_v02`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE IF NOT EXISTS `benutzer` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(77) NOT NULL,
  `rollen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`id`, `name`, `password`, `rollen_id`) VALUES
(0, 'Testuser', 'sha256:1000:af6tOqH7h/6mSjk9jMyvKVIkGZclaVIa:4ZOrq16u4tE2zKQrPdIct6BF0Zmu8Zn+', 0),
(1, 'Lehrer1', 'sha256:1000:6ooftK+MzudrVwWYpcOhczF/gT78czSE:qWdGfwEEwPdztz7D65Tukg5QCeI1Dbjf', 1),
(2, 'Admin1', 'sha256:1000:JzHTAo1TwIOBOkvurYMBgHgbIFtcJ/eU:cHf/WiYT3rfqBmw4BcBcqXCri2DsLY8v', 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer_rollen`
--

CREATE TABLE IF NOT EXISTS `benutzer_rollen` (
  `rollen_id` int(11) NOT NULL,
  `rollen_beschreibung` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `benutzer_rollen`
--

INSERT INTO `benutzer_rollen` (`rollen_id`, `rollen_beschreibung`) VALUES
(0, 'DEBUG Rolle'),
(1, 'Lehrer'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hardware_in_raum`
--

CREATE TABLE IF NOT EXISTS `hardware_in_raum` (
  `sir_k_id` int(11) NOT NULL,
  `sir_r_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `hardware_in_raum`
--

INSERT INTO `hardware_in_raum` (`sir_k_id`, `sir_r_id`) VALUES
(2, 2),
(1, 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `komponente_hat_attribute`
--

CREATE TABLE IF NOT EXISTS `komponente_hat_attribute` (
  `komponenten_k_id` int(11) NOT NULL,
  `komponentenattribute_kat_id` int(11) NOT NULL,
  `khkat_wert` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `komponente_hat_attribute`
--

INSERT INTO `komponente_hat_attribute` (`komponenten_k_id`, `komponentenattribute_kat_id`, `khkat_wert`) VALUES
(1, 1, '2.5 GHz'),
(1, 2, 'something'),
(3, 1, 'attribut hier');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `komponenten`
--

CREATE TABLE IF NOT EXISTS `komponenten` (
  `k_id` int(11) NOT NULL,
  `raeume_r_id` int(11) NOT NULL,
  `lieferant_l_id` int(11) NOT NULL,
  `k_einkaufsdatum` date DEFAULT NULL,
  `k_gewaehrleistungsdauer` int(11) DEFAULT NULL,
  `k_notiz` varchar(1024) DEFAULT NULL,
  `k_hersteller` varchar(45) DEFAULT NULL,
  `komponentenarten_ka_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `komponenten`
--

INSERT INTO `komponenten` (`k_id`, `raeume_r_id`, `lieferant_l_id`, `k_einkaufsdatum`, `k_gewaehrleistungsdauer`, `k_notiz`, `k_hersteller`, `komponentenarten_ka_id`) VALUES
(1, 1, 1, '2015-07-13', 2, 'something', 'Supertek', 0),
(2, 3, 1, '2015-07-20', 4, 'something something neue notiz', 'Awesome Inc', 1),
(3, 4, 1, '2015-07-30', 5, 'noch eine notiz', 'Not as good', 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `komponentenarten`
--

CREATE TABLE IF NOT EXISTS `komponentenarten` (
  `ka_id` int(11) NOT NULL,
  `ka_komponentenart` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `komponentenarten`
--

INSERT INTO `komponentenarten` (`ka_id`, `ka_komponentenart`) VALUES
(0, 'Bildschirm'),
(1, 'Desktop PC'),
(2, 'Router'),
(3, 'Switch');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `komponentenattribute`
--

CREATE TABLE IF NOT EXISTS `komponentenattribute` (
  `kat_id` int(11) NOT NULL,
  `kat_bezeichnung` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `komponentenattribute`
--

INSERT INTO `komponentenattribute` (`kat_id`, `kat_bezeichnung`) VALUES
(1, 'CPU'),
(2, 'GPU'),
(3, 'Netzwerkkarte'),
(4, 'Wlan Chip');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lieferant`
--

CREATE TABLE IF NOT EXISTS `lieferant` (
  `l_id` int(11) NOT NULL,
  `l_firmenname` varchar(45) DEFAULT NULL,
  `l_strasse` varchar(45) DEFAULT NULL,
  `l_plz` varchar(5) DEFAULT NULL,
  `l_ort` varchar(45) DEFAULT NULL,
  `l_tel` varchar(20) DEFAULT NULL,
  `l_mobil` varchar(20) DEFAULT NULL,
  `l_fax` varchar(20) DEFAULT NULL,
  `l_email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `lieferant`
--

INSERT INTO `lieferant` (`l_id`, `l_firmenname`, `l_strasse`, `l_plz`, `l_ort`, `l_tel`, `l_mobil`, `l_fax`, `l_email`) VALUES
(1, 'SampleCompany', 'SampleStraße', '99999', 'SampleOrt', '99999/99999', '498435', '64513', 'sample@email.xy');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `raeume`
--

CREATE TABLE IF NOT EXISTS `raeume` (
  `r_id` int(11) NOT NULL,
  `r_nr` varchar(20) DEFAULT NULL COMMENT 'z.B. r014, W304, etc.',
  `r_bezeichnung` varchar(45) DEFAULT NULL COMMENT 'z.B. Werkstatt, Lager,...',
  `r_notiz` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `raeume`
--

INSERT INTO `raeume` (`r_id`, `r_nr`, `r_bezeichnung`, `r_notiz`) VALUES
(1, 'r102', 'Werkstatt', 'was weiß ich denn'),
(2, 'r404', 'Lager', 'something something'),
(3, 'r001', 'Unterrichtsraum', 'notiz hier'),
(4, 'r205', 'Wieder ein Raum', 'nix'),
(5, 'r001', 'IT raum3', 'hier'),
(6, 'r204', 'Lagerraum', 'sampletext'),
(7, 'r999', 'Testraum', 'somethingsomethingxx');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wird_beschrieben_durch`
--

CREATE TABLE IF NOT EXISTS `wird_beschrieben_durch` (
  `komponentenarten_ka_id` int(11) NOT NULL,
  `komponentenattribute_kat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `wird_beschrieben_durch`
--

INSERT INTO `wird_beschrieben_durch` (`komponentenarten_ka_id`, `komponentenattribute_kat_id`) VALUES
(0, 2),
(1, 2);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `rollen_id` (`rollen_id`);

--
-- Indizes für die Tabelle `benutzer_rollen`
--
ALTER TABLE `benutzer_rollen`
  ADD PRIMARY KEY (`rollen_id`);

--
-- Indizes für die Tabelle `hardware_in_raum`
--
ALTER TABLE `hardware_in_raum`
  ADD PRIMARY KEY (`sir_k_id`,`sir_r_id`),
  ADD KEY `sir_r_id` (`sir_r_id`);

--
-- Indizes für die Tabelle `komponente_hat_attribute`
--
ALTER TABLE `komponente_hat_attribute`
  ADD PRIMARY KEY (`komponenten_k_id`,`komponentenattribute_kat_id`),
  ADD KEY `fk_komponenten_has_komponentenattribute_komponentenattribute1` (`komponentenattribute_kat_id`),
  ADD KEY `fk_komponenten_has_komponentenattribute_komponenten1` (`komponenten_k_id`);

--
-- Indizes für die Tabelle `komponenten`
--
ALTER TABLE `komponenten`
  ADD PRIMARY KEY (`k_id`),
  ADD KEY `fk_komponenten_haendler` (`lieferant_l_id`),
  ADD KEY `fk_komponenten_raeume1` (`raeume_r_id`),
  ADD KEY `fk_komponenten_komponentenarten1` (`komponentenarten_ka_id`);

--
-- Indizes für die Tabelle `komponentenarten`
--
ALTER TABLE `komponentenarten`
  ADD PRIMARY KEY (`ka_id`);

--
-- Indizes für die Tabelle `komponentenattribute`
--
ALTER TABLE `komponentenattribute`
  ADD PRIMARY KEY (`kat_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `komponentenattribute`
--
ALTER TABLE `komponentenattribute`
  MODIFY `kat_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
