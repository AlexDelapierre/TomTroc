USE tomtroc;

-- Insertion des utilisateurs (Mot de passe : password123)
INSERT INTO user (username, email, password, avatar) VALUES
('Alice', 'alice@test.fr', '$2y$12$l8Cz8ntfpwEiDuus0A6D0O1H63yW5sII.8qzCQTq.7CcoSquSh586', 'avatar_alice.jpg'),
('Bob', 'bob@test.fr', '$2y$12$l8Cz8ntfpwEiDuus0A6D0O1H63yW5sII.8qzCQTq.7CcoSquSh586', 'avatar_bob.jpg'),
('Charlie', 'charlie@test.fr', '$2y$12$l8Cz8ntfpwEiDuus0A6D0O1H63yW5sII.8qzCQTq.7CcoSquSh586', NULL);

-- Insertion de quelques livres
INSERT INTO book (user_id, title, author, description, image, is_available) VALUES
(1, 'Le Petit Prince', 'Antoine de Saint-Exupéry', 'Un grand classique de la littérature française, une histoire poétique et philosophique.', 'le_petit_prince.jpg', 1),
(1, 'L\'Étranger', 'Albert Camus', 'L\'histoire de Meursault, un homme qui semble indifférent à tout, même à la mort.', 'l_etranger.jpg', 1),
(2, '1984', 'George Orwell', 'Un roman d\'anticipation qui décrit un monde totalitaire sous surveillance constante.', '1984.jpg', 1),
(2, 'Le Seigneur des Anneaux', 'J.R.R. Tolkien', 'Une épopée fantastique dans la Terre du Milieu.', 'lotr.jpg', 0), -- Indisponible car en cours d'échange
(3, 'Fondation', 'Isaac Asimov', 'Un chef-d\'œuvre de la science-fiction sur le déclin et la chute d\'un empire galactique.', 'fondation.jpg', 1);

-- Insertion de quelques messages pour tester la messagerie
INSERT INTO message (sender_id, receiver_id, content, created_at) VALUES
(1, 2, 'Bonjour Bob, ton exemplaire de 1984 m\'intéresse ! Est-il toujours disponible ?', '2026-04-10 10:00:00'),
(2, 1, 'Salut Alice, oui tout à fait. Tu aurais quoi à proposer en échange ?', '2026-04-10 10:15:00'),
(1, 2, 'Je peux te proposer Le Petit Prince si tu veux !', '2026-04-10 10:20:00'),
(3, 1, 'Salut Alice, j\'aime beaucoup ta collection de livres.', '2026-04-11 09:00:00');
