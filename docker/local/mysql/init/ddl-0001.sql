SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS `users` (
    `id` CHAR(36) NOT NULL COMMENT 'ID',
    `username` VARCHAR(50) NOT NULL COMMENT 'ログインID',
    `password` VARCHAR(255) COMMENT 'パスワード',
    `role_name` VARCHAR(20) NOT NULL COMMENT 'ロール名',
    `name` VARCHAR(50) NOT NULL COMMENT '姓名',
    `created` DATETIME NOT NULL COMMENT '作成日',
    `modified` DATETIME NOT NULL COMMENT '更新日',
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_IDX1` (`username`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
