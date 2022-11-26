CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `adresse_mail_utilisateur` varchar(255) NOT NULL,
  `mot_de_passe_utilisateur` varchar(255) NOT NULL,
  `id_role` int(11) NOT NULL DEFAULT 2,
  `id_adresse` int(11) NOT NULL,
  ADD PRIMARY KEY (`id_utilisateur`) AUTO_INCREMENT,
  ADD UNIQUE KEY `adresse_mail_utilisateur` (`adresse_mail_utilisateur`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_adresse` (`id_adresse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `nom_role` varchar(50) NOT NULL
  ADD PRIMARY KEY (`id_role`),
  ADD UNIQUE KEY `nom_role` (`nom_role`);
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `adresse` (
  `id_adresse` int(11) NOT NULL AUTO_INCREMENT,
  `ville_adresse` varchar(255) NOT NULL,
  `code_postal_adresse` varchar(15) NOT NULL
  ADD PRIMARY KEY (`id_adresse`);
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `utilisateur`
  ADD CONSTRAINT `id_adresse` FOREIGN KEY (`id_adresse`) REFERENCES `adresse` (`id_adresse`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;  

CREATE TABLE `article` (
  `id_article` int(11) NOT NULL AUTO_INCREMENT,
  `titre_article` varchar(255) NOT NULL,
  `date_sortie` date NOT NULL,
  `url_image` varchar(255) NOT NULL,
  `date_article` date NOT NULL DEFAULT current_timestamp(),
  `id_couleur` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  ADD PRIMARY KEY (`id_article`),
  ADD UNIQUE KEY `titre_article` (`titre_article`),
  ADD KEY `id_couleur` (`id_couleur`),
  ADD KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `commentaire` (
  `id_commentaire` int(11) NOT NULL AUTO_INCREMENT,
  `contenu_commentaire` text NOT NULL,
  `date_commentaire` date NOT NULL DEFAULT current_timestamp(),
  `id_utilisateur` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  ADD PRIMARY KEY (`id_commentaire`),
  ADD KEY `id_article` (`id_article`),
  ADD KEY `id_user` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `paragraphe` (
  `id_paragraphe` int(11) NOT NULL AUTO_INCREMENT,
  `contenu_paragraphe` text NOT NULL,
  `id_article` int(11) NOT NULL,
  ADD PRIMARY KEY (`id_paragraphe`),
  ADD KEY `id_articles` (`id_article`);
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `couleur` (
  `id_couleur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_couleur` varchar(255) NOT NULL,
  ADD PRIMARY KEY (`id_couleur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `article`
  ADD CONSTRAINT `id_couleur` FOREIGN KEY (`id_couleur`) REFERENCES `couleur` (`id_couleur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `commentaire`
  ADD CONSTRAINT `id_article` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `paragraphe`
  ADD CONSTRAINT `id_articles` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`) ON DELETE CASCADE ON UPDATE CASCADE;