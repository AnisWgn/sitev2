-- Création de la base de données
CREATE DATABASE IF NOT EXISTS trading_card_game;
USE trading_card_game;

-- Table des utilisateurs
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des cartes
CREATE TABLE IF NOT EXISTS cards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    price INT DEFAULT 100,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insertion de quelques cartes de test
INSERT INTO cards (name, description, image_url, price) VALUES
('Carte Feu', 'Une carte élémentaire de feu', 'images/fire_card.jpg', 100),
('Carte Eau', 'Une carte élémentaire d\'eau', 'images/water_card.jpg', 150),
('Carte Terre', 'Une carte élémentaire de terre', 'images/earth_card.jpg', 200); 