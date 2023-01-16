CREATE TABLE
    `mailing_address` (
        `sid` int NOT NULL,
        `ip_address` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
        `country_code` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
        `state_code` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
        `city` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
        `zipcode` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
        `address_1` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
        `address_2` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
        `zipcode5` varchar(10) COLLATE utf8mb4_general_ci,
        `created_at` datetime NOT NULL,
        `updated_at` datetime NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

ALTER TABLE `mailing_address` ADD PRIMARY KEY (`sid`);

ALTER TABLE
    `mailing_address` MODIFY `sid` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 1;