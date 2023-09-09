SET NAMES utf8mb4;

INSERT IGNORE INTO `users` VALUES
(UUID(), 'admin', '$2a$10$9ZINRSZaIH9phktmAhxACeQETQreIYMYXoWiqSljMaa.jKzNuJsO6', 'admin', 'システム管理者', NOW(), NOW());
