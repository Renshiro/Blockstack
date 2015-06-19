--
-- Tabellenstruktur für Tabelle `highscore`
--

CREATE TABLE IF NOT EXISTS `highscore` (
  `scoreId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(40),
  `score` int(11) NOT NULL,
    PRIMARY KEY (scoreId)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `highscore`
--