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

CREATE TABLE IF NOT EXISTS `menus` (
    `id` MEDIUMINT NOT NULL AUTO_INCREMENT COMMENT 'ID',
    `key` VARCHAR(50) NOT NULL COMMENT '機能キー名',
    `permission_type` VARCHAR(50) NOT NULL COMMENT '権限タイプ名',
    `role_name` VARCHAR(20) NOT NULL COMMENT 'ロール名',
    `created` DATETIME NOT NULL COMMENT '作成日',
    `modified` DATETIME NOT NULL COMMENT '更新日',
    PRIMARY KEY (`id`),
    UNIQUE KEY `menus_IDX1` (`key`, `permission_type`, `role_name`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
