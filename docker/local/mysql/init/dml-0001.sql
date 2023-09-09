SET NAMES utf8mb4;

INSERT IGNORE INTO `users` VALUES
(UUID(), 'admin', 'admin00', 'admin', 'システム管理者', NOW(), NOW());
