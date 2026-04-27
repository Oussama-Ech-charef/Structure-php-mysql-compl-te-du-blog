-- Create Database
CREATE DATABASE IF NOT EXISTS tangier_blog;
USE tangier_blog;

-- 1. Table: Categories
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Table: Users (For future transition from sessions to DB)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. Table: Posts
CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    image TEXT,
    description TEXT,
    content TEXT,
    views INT DEFAULT 0,
    status ENUM('draft', 'published') DEFAULT 'published',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

-- Insert Sample Categories
INSERT INTO categories (name) VALUES 
('Beaches'),
('Cafes'),
('Restaurants'),
('Hotels'),
('Tourist Spots');

-- Insert Sample Posts (Using external image links)
INSERT INTO posts (category_id, title, image, description, content, views, status, created_at) VALUES 
(1, 'Plage Achakar', 'https://images.unsplash.com/photo-1534447677768-be436bb09401', 'Beautiful beach near Tangier.', 'Full content about Plage Achakar goes here.', 1250, 'published', NOW()),
(2, 'Café Hafa', 'https://images.unsplash.com/photo-1520174691701-bc555a3404ca', 'Legendary cafe with a view.', 'Café Hafa is one of the most famous places in Tangier.', 850, 'published', NOW()),
(3, 'Restaurant Le Saveur', 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4', 'Best fish in town.', 'Experience the authentic taste of Tangier seafood.', 450, 'published', NOW()),
(1, 'Cape Spartel', 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e', 'Where the Atlantic meets the Mediterranean.', 'Cape Spartel is a must-visit landmark.', 2100, 'published', NOW()),
(5, 'Hercules Caves', 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e', 'Mythological caves by the sea.', 'The Caves of Hercules are an archaeological cave complex.', 3200, 'published', NOW());
