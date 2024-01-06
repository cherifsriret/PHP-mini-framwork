DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `maj_audit_avg_course`$$
CREATE PROCEDURE `maj_audit_avg_course` (IN `p_id_course` INT)   BEGIN
    DECLARE v_avg DECIMAL(10, 2);
    -- Calculer la moyenne du cours pour l'utilisateur donné
    SELECT AVG(note) INTO v_avg
    FROM notes
    WHERE  course_id = p_id_course;
    -- Mettre à jour la table d'audit
    INSERT INTO `audits` (`course_id`, `average`, `updated_at`)
    VALUES ( p_id_course, v_avg, NOW());
    -- Mettre à jour la table course mettre a jour la moyenne du cours
    UPDATE `courses` SET `average` = v_avg WHERE  `id` = p_id_course ;
END$$
DELIMITER ;
-- --------------------------------------------------------

--
-- Structure de la table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `average` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Structure de la table `audits`
--

DROP TABLE IF EXISTS `audits`;
CREATE TABLE IF NOT EXISTS `audits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `average` decimal(10,2) DEFAULT '0.00',
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

ALTER TABLE `audits` ADD CONSTRAINT `course_audit_fk` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Structure de la table `notes`
--
DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `note` decimal(10,2) NOT NULL,
  `coeficient` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `notes` ADD CONSTRAINT `user_note_fk` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`), ADD CONSTRAINT `course_note_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Déclencheurs `notes`
--
DROP TRIGGER IF EXISTS `after_notes_delete`;
DELIMITER $$
CREATE TRIGGER `after_notes_delete` AFTER DELETE ON `notes` FOR EACH ROW CALL maj_audit_avg_course( OLD.course_id)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `after_notes_insert`;
DELIMITER $$
CREATE TRIGGER `after_notes_insert` AFTER INSERT ON `notes` FOR EACH ROW CALL maj_audit_avg_course( NEW.course_id)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `after_notes_update`;
DELIMITER $$
CREATE TRIGGER `after_notes_update` AFTER UPDATE ON `notes` FOR EACH ROW CALL maj_audit_avg_course( NEW.course_id)
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
(1, 'admin', 'admin@domain.com', '$2y$10$Eb1W6MrU3WCDTeNKXlO8uuVpdBf31gzQqLYDn4wgx6b3gTj/YSZwy', 'admin', 'user'),
(2, 'admin2', 'admin2@domain.com', '$2y$10$Eb1W6MrU3WCDTeNKXlO8uuVpdBf31gzQqLYDn4wgx6b3gTj/YSZwy', 'admin2', 'user'),
(3, 'admin3', 'admin3@domain.com', '$2y$10$Eb1W6MrU3WCDTeNKXlO8uuVpdBf31gzQqLYDn4wgx6b3gTj/YSZwy', 'admin3', 'user');


INSERT INTO `courses` (`id`, `name`, `description`, `average`) VALUES 
(NULL, 'Mathématiques', 'Mathématiques',  '0.00'),
(NULL, 'Français', 'Français',  '0.00'),
(NULL, 'Anglais', 'Anglais', '0.00'),
(NULL, 'Physique', 'Physique',  '0.00');

