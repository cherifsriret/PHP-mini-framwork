DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `maj_audit_moyenne_cours`$$
CREATE PROCEDURE `maj_audit_moyenne_cours` (IN `p_id_cours` INT)   BEGIN
    DECLARE v_moyenne DECIMAL(10, 2);
    -- Calculer la moyenne du cours pour l'utilisateur donné
    SELECT AVG(note) INTO v_moyenne
    FROM notes
    WHERE  cour_id = p_id_cours;
    -- Mettre à jour la table d'audit
    INSERT INTO audit (cour_id, moyenne, `date`)
    VALUES ( p_id_cours, v_moyenne, NOW());
END$$
DELIMITER ;
-- --------------------------------------------------------

--
-- Structure de la table `audit`
--

DROP TABLE IF EXISTS `audit`;
CREATE TABLE IF NOT EXISTS `audit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cour_id` int(11) NOT NULL,
  `moyenne` decimal(10,2) DEFAULT '0.00',
  `date_modification` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_audit_cours` (`cour_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Structure de la table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `coeficient` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Structure de la table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `cour_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `note` decimal(10,2) NOT NULL,
  PRIMARY KEY (`cour_id`,`user_id`),
  KEY `fk_user_note` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déclencheurs `notes`
--
DROP TRIGGER IF EXISTS `after_notes_delete`;
DELIMITER $$
CREATE TRIGGER `after_notes_delete` AFTER DELETE ON `notes` FOR EACH ROW CALL maj_audit_moyenne_cours( OLD.cour_id)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `after_notes_insert`;
DELIMITER $$
CREATE TRIGGER `after_notes_insert` AFTER INSERT ON `notes` FOR EACH ROW CALL maj_audit_moyenne_cours( NEW.cour_id)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `after_notes_update`;
DELIMITER $$
CREATE TRIGGER `after_notes_update` AFTER UPDATE ON `notes` FOR EACH ROW CALL maj_audit_moyenne_cours( NEW.cour_id)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_unique` (`username`),
  UNIQUE KEY `email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `first_name`, `last_name`) VALUES
(1, 'admin', 'admin@domain.com', '$2y$10$Eb1W6MrU3WCDTeNKXlO8uuVpdBf31gzQqLYDn4wgx6b3gTj/YSZwy', 'admin', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
