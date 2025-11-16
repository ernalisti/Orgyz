-- database/seeds/user_seeder.sql
USE organize_db;

INSERT INTO users (username, password, role) VALUES
('admin', '$2y$10$g7I3PMEdQ3kN5OBYFRbIhO6E3wqZbZpG8PfBlV8.VsDxKaZ9J0y2C', 'admin')
ON DUPLICATE KEY UPDATE username = username;
-- Seeder example