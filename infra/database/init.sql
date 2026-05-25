CREATE TABLE IF NOT EXISTS category (
    id INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS product (
    id INT AUTO_INCREMENT NOT NULL,
    category_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    description LONGTEXT DEFAULT NULL,
    price DOUBLE PRECISION NOT NULL,
    INDEX IDX_D34A04AD12469DE2 (category_id),
    PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT NOT NULL,
    email VARCHAR(180) NOT NULL,
    roles JSON NOT NULL,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    UNIQUE INDEX UNIQ_8D93D649E7927C74 (email),
    PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS messenger_messages (
    id BIGINT AUTO_INCREMENT NOT NULL,
    body LONGTEXT NOT NULL,
    headers LONGTEXT NOT NULL,
    queue_name VARCHAR(190) NOT NULL,
    created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)',
    available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)',
    delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
    INDEX IDX_75EA56E0FB7336F0 (queue_name),
    INDEX IDX_75EA56E0E3BD61CE (available_at),
    INDEX IDX_75EA56E016BA31DB (delivered_at),
    PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;

INSERT IGNORE INTO category (id, name, description) VALUES
(1, 'Home & Kitchen', 'Furniture, cookware, decor and essentials'),
(2, 'Sports & Outdoors', 'Gear, equipment and activewear'),
(3, 'Beauty & Care', 'Skincare, makeup and personal care');

INSERT IGNORE INTO product (id, category_id, name, description, price) VALUES
(1, 1, 'Stainless Steel Cookware Set', '10-piece professional cookware set made from triple-layer stainless steel. Induction compatible and dishwasher safe.', 129.99),
(2, 1, 'Scented Soy Candle Set', 'Hand-poured soy wax candles in premium glass jars. Available in vanilla, lavender, and eucalyptus scents.', 24.99),
(3, 2, 'Adjustable Dumbbell Set', 'Space-saving adjustable dumbbells ranging from 5 to 52.5 lbs. Perfect for home gym workouts.', 199.99),
(4, 2, 'Insulated Water Bottle', 'Double-wall vacuum insulated bottle keeps drinks cold for 24 hours or hot for 12 hours. BPA-free, 32oz.', 34.99),
(5, 3, 'Vitamin C Brightening Serum', 'Advanced formula with 20% vitamin C, hyaluronic acid, and vitamin E for radiant skin.', 29.99),
(6, 3, 'Professional Hair Dryer', 'Ionic hair dryer with 3 heat settings and a concentrator nozzle. Reduces frizz and drying time by 50%.', 49.99);
