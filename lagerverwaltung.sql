-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
-- @author Yassin EL Haddouti <yassin.el.haddouti@mnd.thm.de>
-- Host: localhost:8889
-- Erstellungszeit: 09. Feb 2020 um 09:05
-- Server-Version: 5.7.26
-- PHP-Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `lagerverwaltung`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellung`
--

CREATE TABLE `bestellung` (
  `bestellung_id` int(10) UNSIGNED NOT NULL,
  `bestellung_nr` varchar(45) NOT NULL,
  `datum` varchar(45) NOT NULL,
  `kunde_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `bestellung`
--

INSERT INTO `bestellung` (`bestellung_id`, `bestellung_nr`, `datum`, `kunde_id`) VALUES
(3, '0116201', '2020-01-16', 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellung_position`
--

CREATE TABLE `bestellung_position` (
  `bestellung_id` int(10) UNSIGNED NOT NULL,
  `produkt_id` int(10) UNSIGNED NOT NULL,
  `menge` int(11) DEFAULT NULL,
  `gelagert` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `bestellung_position`
--

INSERT INTO `bestellung_position` (`bestellung_id`, `produkt_id`, `menge`, `gelagert`) VALUES
(3, 8, 20, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fachregal`
--

CREATE TABLE `fachregal` (
  `fachregal_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `barcode` varchar(250) NOT NULL,
  `max_kapazitaet` int(10) UNSIGNED NOT NULL,
  `bestand` int(11) DEFAULT '0',
  `lagerregal_id` int(10) UNSIGNED NOT NULL,
  `belegt_von` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `fachregal`
--

INSERT INTO `fachregal` (`fachregal_id`, `name`, `barcode`, `max_kapazitaet`, `bestand`, `lagerregal_id`, `belegt_von`) VALUES
(427, 're-1-fa-1', '00000-1-0000-1', 50, 50, 46, NULL),
(428, 're-1-fa-2', '00000-1-0000-2', 50, 50, 46, NULL),
(429, 're-1-fa-3', '00000-1-0000-3', 50, 0, 46, NULL),
(430, 're-1-fa-4', '00000-1-0000-4', 50, 0, 46, NULL),
(431, 're-1-fa-5', '00000-1-0000-5', 50, 0, 46, NULL),
(432, 're-1-fa-6', '00000-1-0000-6', 50, 0, 46, NULL),
(433, 're-1-fa-7', '00000-1-0000-7', 50, 0, 46, NULL),
(434, 're-1-fa-8', '00000-1-0000-8', 50, 0, 46, NULL),
(435, 're-1-fa-9', '00000-1-0000-9', 50, 0, 46, NULL),
(436, 're-1-fa-10', '00000-1-0000-10', 50, 0, 46, NULL),
(437, 're-1-fa-11', '00000-1-0000-11', 50, 0, 46, NULL),
(438, 're-1-fa-12', '00000-1-0000-12', 50, 0, 46, NULL),
(439, 're-2-fa-1', '00000-2-0000-1', 100, 100, 47, NULL),
(440, 're-2-fa-2', '00000-2-0000-2', 100, 90, 47, NULL),
(441, 're-2-fa-3', '00000-2-0000-3', 100, 0, 47, NULL),
(442, 're-2-fa-4', '00000-2-0000-4', 100, 0, 47, NULL),
(443, 're-2-fa-5', '00000-2-0000-5', 100, 0, 47, NULL),
(444, 're-2-fa-6', '00000-2-0000-6', 100, 0, 47, NULL),
(445, 're-2-fa-7', '00000-2-0000-7', 100, 0, 47, NULL),
(446, 're-2-fa-8', '00000-2-0000-8', 100, 0, 47, NULL),
(447, 're-2-fa-9', '00000-2-0000-9', 100, 0, 47, NULL),
(448, 're-2-fa-10', '00000-2-0000-10', 100, 0, 47, NULL),
(449, 're-3-fa-1', '00000-3-0000-1', 400, 0, 48, NULL),
(450, 're-3-fa-2', '00000-3-0000-2', 400, 0, 48, NULL),
(451, 're-3-fa-3', '00000-3-0000-3', 400, 0, 48, NULL),
(452, 're-3-fa-4', '00000-3-0000-4', 400, 0, 48, NULL),
(453, 're-3-fa-5', '00000-3-0000-5', 400, 0, 48, NULL),
(454, 're-3-fa-6', '00000-3-0000-6', 400, 0, 48, NULL),
(455, 're-3-fa-7', '00000-3-0000-7', 400, 0, 48, NULL),
(456, 're-3-fa-8', '00000-3-0000-8', 400, 0, 48, NULL),
(457, 're-3-fa-9', '00000-3-0000-9', 400, 0, 48, NULL),
(458, 're-3-fa-10', '00000-3-0000-10', 400, 0, 48, NULL),
(459, 're-3-fa-11', '00000-3-0000-11', 400, 0, 48, NULL),
(460, 're-3-fa-12', '00000-3-0000-12', 400, 0, 48, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kunde`
--

CREATE TABLE `kunde` (
  `kunde_id` int(10) UNSIGNED NOT NULL,
  `vorname` varchar(45) NOT NULL,
  `nachname` varchar(45) NOT NULL,
  `geburtsdatum` date NOT NULL,
  `strasse` varchar(45) DEFAULT NULL,
  `hausnummer` varchar(45) DEFAULT NULL,
  `postleitzahl` varchar(45) DEFAULT NULL,
  `stadt` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `tel` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `kunde`
--

INSERT INTO `kunde` (`kunde_id`, `vorname`, `nachname`, `geburtsdatum`, `strasse`, `hausnummer`, `postleitzahl`, `stadt`, `fax`, `tel`) VALUES
(1, 'yassin', 'haddouti', '1988-07-26', 'Dorheimer str', '14', '24433r', 'München', '08765434567', '0987654534576'),
(2, 'ahmed', 'zaza', '2019-12-16', 'mestr', '34', '27000', 'Frankfurt am main', '076543423423', '075645253235'),
(3, 'muster', 'mann', '1988-07-10', 'saarlandstr', '11', '12000', 'Friedberg', '08765434567', '08765434567'),
(8, 'yyy', 'yyy', '2020-01-09', 'yy', '11', '11111', 'yyy', '08765434567', '08765434567');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lagerregal`
--

CREATE TABLE `lagerregal` (
  `lagerregal_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `nummer` int(10) UNSIGNED NOT NULL,
  `barcode` varchar(250) DEFAULT NULL,
  `fachanzahl` int(10) UNSIGNED NOT NULL,
  `label_farbe` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `lagerregal`
--

INSERT INTO `lagerregal` (`lagerregal_id`, `name`, `nummer`, `barcode`, `fachanzahl`, `label_farbe`) VALUES
(46, 'Regal', 1, '', 12, '#289c9c'),
(47, 'Regal', 2, '', 10, '#4c7cd9'),
(48, 'Regal', 3, '', 12, '#d442bc');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lieferant`
--

CREATE TABLE `lieferant` (
  `lieferant_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `strasse` varchar(45) DEFAULT NULL,
  `hausnummer` varchar(45) DEFAULT NULL,
  `postleitzahl` varchar(45) DEFAULT NULL,
  `stadt` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `tel` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `lieferant`
--

INSERT INTO `lieferant` (`lieferant_id`, `name`, `strasse`, `hausnummer`, `postleitzahl`, `stadt`, `fax`, `tel`) VALUES
(1, 'elio GmbH', 'meinstr', '11', '12000', 'Friedberg', '08765434567', '08765434567'),
(2, 'dr Müllersvv', 'MainzerStr', '33', '27000', 'Frankfurt am main', '08765434567', '0756453423'),
(3, 'ewrwer', 'ewrwe', '3443', '3wrew^', '^', '', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lieferung`
--

CREATE TABLE `lieferung` (
  `lieferung_id` int(10) UNSIGNED NOT NULL,
  `lieferung_nr` varchar(45) NOT NULL,
  `datum` datetime NOT NULL,
  `lieferant_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `lieferung`
--

INSERT INTO `lieferung` (`lieferung_id`, `lieferung_nr`, `datum`, `lieferant_id`) VALUES
(52, '0116201', '2019-12-25 00:00:00', 1),
(53, '01162053', '2020-01-14 00:00:00', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lieferung_position`
--

CREATE TABLE `lieferung_position` (
  `lieferung_id` int(10) UNSIGNED NOT NULL,
  `produkt_id` int(10) UNSIGNED NOT NULL,
  `menge` int(11) DEFAULT NULL,
  `gelagert` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `lieferung_position`
--

INSERT INTO `lieferung_position` (`lieferung_id`, `produkt_id`, `menge`, `gelagert`) VALUES
(52, 3, 50, 0),
(52, 8, 200, 1),
(53, 9, 200, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mitarbeiter`
--

CREATE TABLE `mitarbeiter` (
  `mitarbeiter_id` int(10) UNSIGNED NOT NULL,
  `vorname` varchar(45) DEFAULT NULL,
  `nachname` varchar(45) DEFAULT NULL,
  `personal_nr` varchar(45) NOT NULL,
  `passwort` varchar(45) NOT NULL,
  `rolle` int(10) UNSIGNED NOT NULL,
  `benutzerbild` varchar(200) DEFAULT NULL,
  `ist_angemeldet` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `mitarbeiter`
--

INSERT INTO `mitarbeiter` (`mitarbeiter_id`, `vorname`, `nachname`, `personal_nr`, `passwort`, `rolle`, `benutzerbild`, `ist_angemeldet`) VALUES
(1, 'yassin', 'mitarbeiter1', '00110011', 'demo', 0, '20201131115.png', 0),
(2, 'ahmed', 'mitarbeter2', '00220022', 'demo', 0, NULL, 0),
(3, 'zaza', 'mitarbeiter3', '00330033', 'demo', 0, '2020118163850.png', 0),
(4, 'admin', 'admin', '00440044', 'admin', 1, '202011311031.jpg', 1),
(5, 'ddd', 'mitarbeiter4', '00550055', 'demo', 0, '202011323924.png', 0),
(6, 'ahmed', 'mitarbeiter5', '00110011', 'demo', 0, '202011323853.jpeg', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `position_fach`
--

CREATE TABLE `position_fach` (
  `lieferung_id` int(10) UNSIGNED NOT NULL,
  `produkt_id` int(10) UNSIGNED NOT NULL,
  `fachregal_id` int(10) UNSIGNED NOT NULL,
  `gelagerte_menge` int(11) NOT NULL,
  `mitarbeiter_id` int(10) UNSIGNED DEFAULT NULL,
  `ist_gelagert` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `position_fach`
--

INSERT INTO `position_fach` (`lieferung_id`, `produkt_id`, `fachregal_id`, `gelagerte_menge`, `mitarbeiter_id`, `ist_gelagert`) VALUES
(52, 3, 428, 50, 1, 0),
(52, 8, 439, 100, 1, 1),
(52, 8, 440, 100, 1, 1),
(53, 9, 427, 50, 1, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `position_fach_bestellung`
--

CREATE TABLE `position_fach_bestellung` (
  `bestellung_id` int(10) UNSIGNED NOT NULL,
  `produkt_id` int(10) UNSIGNED NOT NULL,
  `fachregal_id` int(10) UNSIGNED NOT NULL,
  `ausgelagerte_menge` int(11) NOT NULL,
  `mitarbeiter_id` int(10) UNSIGNED DEFAULT NULL,
  `ist_ausgelagert` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `position_fach_bestellung`
--

INSERT INTO `position_fach_bestellung` (`bestellung_id`, `produkt_id`, `fachregal_id`, `ausgelagerte_menge`, `mitarbeiter_id`, `ist_ausgelagert`) VALUES
(3, 8, 440, 10, 2, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `produkt`
--

CREATE TABLE `produkt` (
  `produkt_id` int(10) UNSIGNED NOT NULL,
  `artikel_nr` varchar(45) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `bestand` int(11) DEFAULT '0',
  `min_bestand` int(11) DEFAULT NULL,
  `max_bestand` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `produkt`
--

INSERT INTO `produkt` (`produkt_id`, `artikel_nr`, `name`, `bestand`, `min_bestand`, `max_bestand`) VALUES
(1, 'xs3445', 'iphone5', 0, 50, 12),
(3, '34054', 'iphone x', 0, 45, 234),
(4, 'x0340', 'macbook', 0, 12, 56),
(5, '23443', 'samsung 3', 0, 23, 57),
(6, 'galx33', 'samsung galaxey', 0, 23, 54),
(7, 'eee', 'samsung note', 0, 34, 45),
(8, 'mcos3', 'macbook pro', 200, 300, 343),
(9, 'samsung33', 'samsung 7', 0, 23, 56),
(10, '234ee', 'macbook air', 0, 23, 876),
(11, 'asdasd3', 'iWatch Series 3', 0, 50, 100),
(25, 'testcc', 'test04', 0, 20, 60);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `bestellung`
--
ALTER TABLE `bestellung`
  ADD PRIMARY KEY (`bestellung_id`),
  ADD UNIQUE KEY `bestellung_nr_UNIQUE` (`bestellung_nr`),
  ADD KEY `kunde_id_idx` (`kunde_id`);

--
-- Indizes für die Tabelle `bestellung_position`
--
ALTER TABLE `bestellung_position`
  ADD PRIMARY KEY (`bestellung_id`,`produkt_id`);

--
-- Indizes für die Tabelle `fachregal`
--
ALTER TABLE `fachregal`
  ADD PRIMARY KEY (`fachregal_id`),
  ADD KEY `lagerregal_id_idx` (`lagerregal_id`),
  ADD KEY `beleget_von_idx` (`belegt_von`);

--
-- Indizes für die Tabelle `kunde`
--
ALTER TABLE `kunde`
  ADD PRIMARY KEY (`kunde_id`);

--
-- Indizes für die Tabelle `lagerregal`
--
ALTER TABLE `lagerregal`
  ADD PRIMARY KEY (`lagerregal_id`),
  ADD UNIQUE KEY `nummer_UNIQUE` (`nummer`);

--
-- Indizes für die Tabelle `lieferant`
--
ALTER TABLE `lieferant`
  ADD PRIMARY KEY (`lieferant_id`);

--
-- Indizes für die Tabelle `lieferung`
--
ALTER TABLE `lieferung`
  ADD PRIMARY KEY (`lieferung_id`),
  ADD UNIQUE KEY `lieferung_nr_UNIQUE` (`lieferung_nr`),
  ADD KEY `lieferant_id_idx` (`lieferant_id`);

--
-- Indizes für die Tabelle `lieferung_position`
--
ALTER TABLE `lieferung_position`
  ADD PRIMARY KEY (`lieferung_id`,`produkt_id`),
  ADD KEY `produkt_id_idx` (`produkt_id`);

--
-- Indizes für die Tabelle `mitarbeiter`
--
ALTER TABLE `mitarbeiter`
  ADD PRIMARY KEY (`mitarbeiter_id`);

--
-- Indizes für die Tabelle `position_fach`
--
ALTER TABLE `position_fach`
  ADD PRIMARY KEY (`lieferung_id`,`produkt_id`,`fachregal_id`),
  ADD KEY `mitarbeiter_id_idx` (`mitarbeiter_id`),
  ADD KEY `fachregal_id_idx` (`fachregal_id`),
  ADD KEY `produkt_id_idx` (`produkt_id`),
  ADD KEY `IX_fachregal_id_idx` (`fachregal_id`),
  ADD KEY `IX_mitarbeiter_id_idx` (`mitarbeiter_id`);

--
-- Indizes für die Tabelle `position_fach_bestellung`
--
ALTER TABLE `position_fach_bestellung`
  ADD PRIMARY KEY (`bestellung_id`,`produkt_id`,`fachregal_id`),
  ADD KEY `fkb_produkt_id_idx` (`produkt_id`),
  ADD KEY `fkb_mitarbeiter_id_idx` (`mitarbeiter_id`),
  ADD KEY `fkb_fachrgal_id_idx` (`fachregal_id`);

--
-- Indizes für die Tabelle `produkt`
--
ALTER TABLE `produkt`
  ADD PRIMARY KEY (`produkt_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `bestellung`
--
ALTER TABLE `bestellung`
  MODIFY `bestellung_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `fachregal`
--
ALTER TABLE `fachregal`
  MODIFY `fachregal_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=461;

--
-- AUTO_INCREMENT für Tabelle `kunde`
--
ALTER TABLE `kunde`
  MODIFY `kunde_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `lagerregal`
--
ALTER TABLE `lagerregal`
  MODIFY `lagerregal_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT für Tabelle `lieferant`
--
ALTER TABLE `lieferant`
  MODIFY `lieferant_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `lieferung`
--
ALTER TABLE `lieferung`
  MODIFY `lieferung_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT für Tabelle `mitarbeiter`
--
ALTER TABLE `mitarbeiter`
  MODIFY `mitarbeiter_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `produkt`
--
ALTER TABLE `produkt`
  MODIFY `produkt_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `bestellung`
--
ALTER TABLE `bestellung`
  ADD CONSTRAINT `kunde_id` FOREIGN KEY (`kunde_id`) REFERENCES `kunde` (`kunde_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `fachregal`
--
ALTER TABLE `fachregal`
  ADD CONSTRAINT `beleget_von` FOREIGN KEY (`belegt_von`) REFERENCES `produkt` (`produkt_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `lagerregal_id` FOREIGN KEY (`lagerregal_id`) REFERENCES `lagerregal` (`lagerregal_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `lieferung`
--
ALTER TABLE `lieferung`
  ADD CONSTRAINT `lieferant_id` FOREIGN KEY (`lieferant_id`) REFERENCES `lieferant` (`lieferant_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `lieferung_position`
--
ALTER TABLE `lieferung_position`
  ADD CONSTRAINT `lieferung_id` FOREIGN KEY (`lieferung_id`) REFERENCES `lieferung` (`lieferung_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `produkt_id` FOREIGN KEY (`produkt_id`) REFERENCES `produkt` (`produkt_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `position_fach`
--
ALTER TABLE `position_fach`
  ADD CONSTRAINT `fk_fachregal_id` FOREIGN KEY (`fachregal_id`) REFERENCES `fachregal` (`fachregal_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lieferung_id` FOREIGN KEY (`lieferung_id`) REFERENCES `lieferung_position` (`lieferung_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mitarbeiter_id` FOREIGN KEY (`mitarbeiter_id`) REFERENCES `mitarbeiter` (`mitarbeiter_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produkt_id` FOREIGN KEY (`produkt_id`) REFERENCES `lieferung_position` (`produkt_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `position_fach_bestellung`
--
ALTER TABLE `position_fach_bestellung`
  ADD CONSTRAINT `fkb_bestellung_id` FOREIGN KEY (`bestellung_id`) REFERENCES `bestellung_position` (`bestellung_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkb_fachrgal_id` FOREIGN KEY (`fachregal_id`) REFERENCES `fachregal` (`fachregal_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkb_mitarbeiter_id` FOREIGN KEY (`mitarbeiter_id`) REFERENCES `mitarbeiter` (`mitarbeiter_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkb_produkt_id` FOREIGN KEY (`bestellung_id`,`produkt_id`) REFERENCES `bestellung_position` (`bestellung_id`, `produkt_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
