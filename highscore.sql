--
-- Tabellenstruktur für Tabelle `highscore`
--

CREATE TABLE IF NOT EXISTS `highscore` (
  `name` varchar(20) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `highscore`
--