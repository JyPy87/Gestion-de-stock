--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `firstname`, `lastname`) VALUES
(4, 'sa@mail.com', '[\"ROLE_SUPERADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$TXJWaE1UTWN2U0Q2dTZPVA$nWGzJg0dTy9A8ig0GE+EgTZLCJygtdzonVzP5WlNK0w', 'Super', 'Admin'),
(5, 'a@mail.com', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$Y1ZQQTI4QTVPQS5COXpObQ$kMuhborbNRpXbz34YGhMOjqwkLz8JnfPl1M+hAfQl7A', 'Jean', 'Admin'),
(6, 'u@mail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$eGYzQ2NIQWtKVU5McS9qYg$Ch14krciXyrwHCKw7bxAdvJWIw499Tf2lXIa8KgPWzA', 'Michel', 'User');
COMMIT;
