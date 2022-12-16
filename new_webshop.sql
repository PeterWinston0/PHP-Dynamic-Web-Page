DROP DATABASE IF EXISTS mywebshop;

CREATE DATABASE mywebshop;

USE mywebshop;

-- CREATE PRODUCT Tabellen

CREATE TABLE `product` (
  `productID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(6,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB;

-- DATA for PRODUCT Tabellen

INSERT INTO `product` (`productID`, `title`, `description`, `price`, `image`) VALUES
(45, 'NEW BALANCE 550 \"UNC\"', 'MODEL: NEW BALANCE 550 COLORWAY: WHITE/PASTEL BLUE SKU: BB550HL1 RELEASE: 2022 CONDITION: NYE INKL. ORIGINAL BOX', '2000.00', 'sko5_32d77b68-d204-4c30-8923-a6526cb8af80_540x.webp'),
(46, 'NIKE DUNK LOW ', 'MODEL: NIKE DUNK LOW COLORWAY: WHITE/VARSITY ROYAL SKU: CU1726-100 RELEASE: 14/03/2020 CONDITION: NYE INKL. ORIGINAL BOX', '2800.00', 'sko4_e3ac21c6-3839-4008-a4fe-6f9d6dbedea4_540x.webp'),
(44, 'YEEZY 700 V3 \"AZAEL\"', 'MODEL: YEEZY 700 V3 COLORWAY: AZAEL/AZAEL/AZAEL SKU: FW4980 RELEASE: 23/12/2019 CONDITION: NYE INKL. ORIGINAL BOX', '2900.00', 'sko41_8e7b5ab9-6989-4d66-92e1-8eb98010b0b5_540x.webp'),
(43, 'NIKE DUNK LOW ', 'MODEL: NIKE DUNK LOW COLORWAY: WHITE/VARSITY ROYAL SKU: CU1726-100 RELEASE: 14/03/2020 CONDITION: NYE INKL. ORIGINAL BOX', '2800.00', 'sko2_bf2f42c6-b457-4032-b61c-46ce8cb174a3_1080x.webp'),
(42, 'NIKE DUNK LOW ', 'MODEL: NIKE DUNK LOW COLORWAY: WHITE/VARSITY ROYAL SKU: CU1726-100 RELEASE: 14/03/2020 CONDITION: NYE INKL. ORIGINAL BOX', '2800.00', 'sko13_470a7cf2-2d0c-4594-a9bc-a07c8877739e_1080x.webp'),
(41, 'NIKE AIR JORDAN 4 ', 'MODEL: AIR JORDAN 4 COLORWAY: WHITE/MIDNIGHT NAVY/LIGHT SMOKE GREY-FIRE RED SKU: DH6927-140 RELEASE: 29/10/2022 CONDITION: NYE INKL. ORIGINAL BOX', '2800.00', 'sko19_c3b6353f-e9c0-4a2f-b4ba-334bf7555074_540x.webp'),
(47, 'NIKE DUNK LOW ', 'MODEL: NIKE DUNK LOW COLORWAY: WHITE/VARSITY ROYAL SKU: CU1726-100 RELEASE: 14/03/2020 CONDITION: NYE INKL. ORIGINAL BOX', '2800.00', 'sko8fifif77_900x.webp'),
(54, 'NIKE AIR JORDAN 4 ', 'MODEL: AIR JORDAN 4 COLORWAY: BLACK/LIGHT STEEL GREY/WHITE/FIRE RED SKU: DH7138-006 RELEASE: 2022 CONDITION: NYE INKL. ORIGINAL BOX', '3500.00', 'sko7_2301aeeb-8788-4cb7-894c-d8891533851c_1080x.webp'),
(52, 'YEEZY BOOST 350 V2 \"CORE BLACK RED\"', 'MODEL: YEEZY BOOST 350 V2 COLORWAY: CORE BLACK/RED/CORE BLACK SKU: BY9612 RELEASE: 2016/2022 CONDITION: NYE INKL. ORIGINAL BOX', '3100.00', 'sko7_2d4a730c-62b7-49ab-a8f2-17f5cefdf37a_540x.webp'),
(53, 'NIKE DUNK LOW \"ARMORY NAVY\"', 'MODEL: NIKE DUNK LOW COLORWAY: MINERAL SLATE/ARMORY NAVY-BLACK-WHITE SKU: DR9705-300 RELEASE: 2022 CONDITION: NYE INKL. ORIGINAL BOX', '1800.00', 'sko5_6ceeeacd-c4ac-4c69-ac7e-5e05b9d4e9b1_540x.webp'),
(55, 'YEEZY BOOST 700 \"WAVE RUNNER\"', 'MODEL: YEEZY BOOST 700 COLORWAY: SOLID GREY/CHALK WHITE/CORE BLACK SKU: B75571 RELEASE: 01/11/2017 CONDITION: NYE INKL. ORIGINAL BOX', '3800.00', 'sko1_f26f96ee-ebb2-4b1a-b133-3b04194db5a2_540x.webp'),
(56, 'NIKE AIR JORDAN 1 LOW \"ARCTIC PUNCH\"', 'MODEL: AIR JORDAN 1 LOW COLORWAY: ARCTIC PUNCH/PURPLE PULSE/WHITE SKU: CK3022-600 RELEASE: 2021 CONDITION: NYE INKL. ORIGINAL BOX', '3100.00', 'sko11_a2bb13fb-ce84-4e10-9b7d-fdf9218c2402_540x.webp'),
(57, 'NEW BALANCE 550 \"WHITE BLACK RAIN CLOUD\"', 'MODEL: NEW BALANCE 550 COLORWAY: WHITE/BLACK/RAIN CLOUD SKU: BB550NCA RELEASE: 2022 CONDITION: NYE INKL. ORIGINAL BOX', '2100.00', 'sko8_2fb91117-0ad3-4fd4-b816-4feed56c3ff5_900x.webp'),
(58, 'NIKE AIR FORCE 1 \"ORANGE SKELETON\"', 'MODEL: NIKE AIR FORCE 1 COLORWAY: STARFISH/WHITE-BLACK SKU: CU8067-800 RELEASE: 28/10/2020 CONDITION: NYE INKL. ORIGINAL BOX', '1900.00', 'Nike-Air-Force-1-Low-Orange-Skeleton-Product_540x.webp'),
(59, 'NIKE AIR FORCE 1 \"ST PATRICKS DAY\"', 'MODEL: NIKE AIR FORCE 1 COLORWAY: WHITE/GREEN SKU: DD8458-300 RELEASE: 29/04/2021 CONDITION: NYE INKL. ORIGINAL BOX', '3000.00', 'sko22_900x.webp'),
(60, 'NIKE AIR FORCE 1 X SPACE JAM', 'MODEL: NIKE AIR FORCE 1 COLORWAY: WHITE/LIGHT BLUE FURY-WHITE SKU: DJ7998-100 RELEASE: 16/07/2021 CONDITION: NYE INKL. ORIGINAL BOX', '1700.00', 'SKO5_e0251622-6539-4dff-aaed-d0d540dbb334_540x.webp');


-- CREATE BRAND Tabellen

CREATE TABLE `brand` (
  `brandID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB;

-- DATA for BRAND Tabellen

INSERT INTO `brand` (`brandID`, `title`, `image`) VALUES
(1, 'Nike', 'Nike-Logo.png'),
(2, 'Adidas', 'Adidas_Logo.svg.png'),
(3, 'Reebok', '551064.png'),
(4, 'Jordan', 'Air-Jordan-Logo.png'),
(5, 'New Balance', 'New-Balance-Emblem.png'),
(6, 'Vans', '4a92e0bc55d3109f494e00436eeb07cc.png');

-- CREATE CAROUSEL Tabellen

CREATE TABLE `carousel` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `image` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `no_order` int(11) DEFAULT NULL
) ENGINE=InnoDB;

-- DATA for CAROUSEL Tabellen

INSERT INTO `carousel` (`id`, `image`, `text`, `no_order`) VALUES
(1, 'Air-Force-1-Anniversary-2.jpg', NULL, NULL),
(2, 'image1.webp', 'this ', 1),
(3, 'bokk-2019082302461262.jpg', 'This is title', 3);

-- CREATE CATEGORY Tabellen

CREATE TABLE `category` (
  `catID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `no_order` int(11) DEFAULT NULL
) ENGINE=InnoDB;

-- DATA for CATEGORY Tabellen

INSERT INTO `category` (`catID`, `title`, `image`, `no_order`) VALUES
(1, 'Men', 'men-4.jpg', 1),
(2, 'Women', 'women-2.jpg', 2),
(3, 'Limited', 'limited-1.jpg', 3),
(4, 'Sale', 'Sneaker-Pile.jpg', 4),
(5, 'Daily Offer', 'a0cd100df4a05e19fb2cb689407c7452b69d1150-1100x735.jpg', 5);

-- CREATE COMPANY Tabellen

CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB;

-- DATA for COMPANY Tabellen

INSERT INTO `company` (`id`, `title`, `description`, `email`, `phone`, `image`) VALUES
(1, 'Welcome To SneakerDreams', '<p>SneakerDreams is a Professional eCommerce Platform. Here we will provide you only interesting content, which you will like very much. We&#39;re dedicated to providing you the best of eCommerce, with a focus on dependability and Sneakers . We&#39;re working to turn our passion for eCommerce into a booming online website. We hope you enjoy our eCommerce as much as we enjoy offering them to you.I will keep posting more important posts on my Website for all of you. Please give your support and love.Thanks For Visiting Our SiteHave a nice day!</p>', 'sneakerdreams@mail.com', '+45 48 48 48 48', 'main5.webp');

-- CREATE COMPANY_HOURS Tabellen

CREATE TABLE `company_hours` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `day` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL
) ENGINE=InnoDB;

-- DATA for COMPANY_HOURS Tabellen

INSERT INTO `company_hours` (`id`, `day`, `time`) VALUES
(1, 'Monday - Friday', '10 - 18'),
(2, 'Saturday - Sunday', '10-20'),
(3, 'Holidays', '11 - 18'),
(4, 'Black Friday', '08 - 23'),
(5, '', ''),
(6, '', ''),
(7, '', ''),
(8, '', '');

-- CREATE NEWS Tabellen

CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `time` date DEFAULT NULL
) ENGINE=InnoDB;

-- DATA for NEWS Tabellen

INSERT INTO `news` (`id`, `title`, `content`, `image`, `time`) VALUES
(4, 'Air Jordan 1 “Lost & Found”: The Complete Guide (Store List, Release Info, Latest Photos)', 'The Air Jordan 1 “Lost & Found” — previously referred to as the “Chicago Reimagined” — may be the most anticipated release of 2022. And following numerous leaks and teasers, official images of the aged-up colorway have finally surfaced a little over a month ahead of its November release date. Immersive in its every detail, from the box to the materials themselves, the “Lost & Found” paints a vivid scene of finding a set of “Chicago” 1s deep in the basement/storage of a mom and pop shop. Using a spec inspired by its 1985-released counterpart, the shoe features distressed, aged detailing all throughout. The leather on the collar, mid-panel, and toe, for example, is heavily cracked, complementing the dusty finish of the outsole and the scuffs all across the packaging. And to further expand upon the storytelling, the Jumpman has included a vintage-inspired invoice with every pair. Enjoy an official look at the Air Jordan 1 “Lost & Found” right here. These are currently scheduled to release on November 19th via Nike SNKRS as well as select retailers. In other news, early images of the SoleFly Air Jordan 13 recently surfaced as well.', 'jordan-1-lost-and-found-5.webp', NULL),
(5, 'Official Release Details For The A Ma Maniére x Air Jordan 4 Collaboration', 'First teased in July, the A Ma Maniére x Air Jordan 4 releases on Thursday, November 17th, at 11 a.m. ET via amamaniere.com. There will be no local in-store raffle, general raffle, or Discord member draw. Alongside the aforementioned first come, first serve release, the only other way to secure a pair is through a Video Submission Entry in which A Ma Maniére asks participants to do the following (the raffle has since ended): The Whitaker Group has taken the highly-anticipated launch of its latest Air Jordan collaboration to shine a spotlight on the importance of voting during November 8th’s pivotal and critical U.S. Midterm Elections. On the eve of the event, the creative conglomerate releases a two-minute video accompanied by a call-to-action” “USE YOUR VOICE, USE YOUR VOTE.” “We have always stated that what we do is about more than sneakers,” said James Whitner, owner and founder of The Whitaker Group, in an official press release for the AMM x AJ4. “While we have the anticipation and attention of the world on our next Jordan Brand project, it’s our responsibility to use our platform to ensure people – especially young people – show up to the polls and use their voice, use their vote and ask for the country to reflect their values…So while we have your attention – please vote, help someone get to the polls, volunteer in your community and speak up about the issues that are top of mind for you. The future belongs to you – take action.” The Whitaker Group will observe a social media blackout on Election Day (November 8th) in order to leverage its platform for informational purposes. Additionally, Whitner and team will highlight community content gathered from the hashtag “#myvoiceholdspower” throughout the day. For information crucial to using your voice this Election Day, check out The Whitaker Group’s Election Resource Center. Continue ahead to watch the aforementioned two-minute video and to enjoy campaign imagery of the Jordan 4 by A Ma Maniére, which drops online via the boutique’s webstore on Thursday, November 17th. UPDATE November 14th, 2022: The A Ma Maniére officially releases online on November 17th, 2022 at 11am ET on a-ma-maniere.com. Winners of the raffle have been notified. Official lookbook photos of the collection have been updated. UPDATE November 7th, 2022: The story has been updated to reflect the modified release process for the Air Jordan 4 collaboration. A Ma Maniére shared new details via social media, canceling the in-person and general raffles mentioned in the official press release Sneaker News received this morning.', 'air-jordan-4-maniere-release-date.webp', NULL),
(6, 'Official Images Of The DJ Khaled x Air Jordan 5 “Sail”', 'Unveiling their collaborative collection of Air Jordan 5’s last Spring, DJ Khaled and Jordan Brand currently preparing for the November 28th release of the AJ 5 “Crimson Bliss” – in which the producer wore courtside atop a silk pillow at last weekends Miami Heat game. Following a first-look in October at the second proposition within the set to drop, official images of the DJ Khaled x Air Jordan 5 “Sail” have recently surfaced. Having enjoyed one another’s company for a number of years, DJ Khaled’s “We The Best” monicker last graced the Air Jordan 3 “Father Of Ahsad” collection, now choosing to center the collaborative offering on a clad “Sail” treatment across the AJ 5’s tumbled leather upper, tongue construction and laces. Coating its tongue in a metallic silver shade and its heel clip in a darkened shadow grey, pastels lay claim to the remainder of the real estate through a sole unit comprised of lilac, powder blue and seldom bright yellow speckles. Along the heel tab “WE THE BEST” comes embroidered in a muted yellow finish while rendering a color-match along its semi-translucent lace lock. The use of positive affirmations conclude in an upside down fashion reading “KEEP GOING” along the baby blue quilted textile of the tongue’s interior and sock liner. Releasing on November 28th for a retail price of $225, enjoy official images of the DJ Khaled x Air Jordan 5 “Sail” below in the meantime. For more under Jordan Brand’s umbrella, check out the Air Jordan 11 “Cherry”.', 'dj-khaled-air-jordan-5-sail-DV4982-175-6.webp', NULL);

-- CREATE ORDERS Tabellen

CREATE TABLE `orders` (
  `o_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `total_price` decimal(6,2) NOT NULL DEFAULT '0.00',
  `order_status` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `order_no` varchar(20) NOT NULL
) ENGINE=InnoDB;

-- DATA for ORDERS Tabellen

INSERT INTO `orders` (`o_id`, `first_name`, `last_name`, `email`, `address`, `address2`, `zipcode`, `total_price`, `order_status`, `created_at`, `updated_at`, `order_no`) VALUES
(71, 'Peter Winston', 'Gr&oslash;nnebech', 'mig@email.dk', 'Islandsgade 21', 'Islandsgade 21', '6700', '2800.00', 'confirmed', '2022-12-15 22:40:41', '2022-12-15 22:40:41', '202212158E7D');

-- CREATE ORDER_DETAILS Tabellen

CREATE TABLE `order_details` (
  `od_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `order_id` int(11) DEFAULT NULL,
  `productID` int(11) DEFAULT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `product_price` decimal(6,2) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total_price` decimal(6,2) DEFAULT NULL,
  FOREIGN KEY (`order_id`) REFERENCES `orders`(o_id),
  FOREIGN KEY (`productID`) REFERENCES `product`(productID)
) ENGINE=InnoDB;



-- DATA for ORDER_DETAILS Tabellen

INSERT INTO `order_details` (`od_id`, `order_id`, `productID`, `product_name`, `product_price`, `qty`, `total_price`) VALUES
(74, 71, 42, 'NIKE DUNK LOW ', '2800.00', 1, '2800.00');

-- CREATE PRODUCT_BRANDS Tabellen

CREATE TABLE `product_brands` (
  `productID` int(11) NOT NULL,
  `brandID` int(11) NOT NULL,
  FOREIGN KEY (`productID`) REFERENCES `product`(`productID`),
  FOREIGN KEY (`brandID`) REFERENCES `brand`(`brandID`),
  PRIMARY KEY (`productID`, `brandID`)
) ENGINE=InnoDB;

-- DATA for PRODUCT_BRANDS Tabellen

INSERT INTO `product_brands` (`productID`, `brandID`) VALUES
(41, 1),
(42, 1),
(43, 1),
(46, 1),
(47, 1),
(53, 1),
(54, 1),
(60, 1),
(44, 2),
(52, 2),
(41, 4),
(46, 4),
(54, 4),
(45, 5);

-- CREATE PRODUCT_CATEGORIES Tabellen

CREATE TABLE `product_categories` (
  `productID` int(11) NOT NULL,
  `catID` int(11) NOT NULL,
  FOREIGN KEY (`productID`) REFERENCES `product`(productID),
  FOREIGN KEY (`catID`) REFERENCES `category`(catID),
  PRIMARY KEY(productID, catID)
) ENGINE=InnoDB;

-- DATA for PRODUCT_CATEGORIES Tabellen

INSERT INTO `product_categories` (`productID`, `catID`) VALUES
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(60, 1),
(42, 2),
(43, 2),
(44, 2),
(45, 2),
(47, 2),
(60, 2),
(44, 3),
(47, 3),
(60, 3),
(45, 4),
(46, 5);

-- CREATE PRODUCT_RELATED Tabellen

CREATE TABLE `product_related` (
  `productID` int(11) NOT NULL,
  `productRelatedID` int(11) NOT NULL,
  FOREIGN KEY (`productID`) REFERENCES `product`(productID),
  FOREIGN KEY (`productRelatedID`) REFERENCES `product`(productID),
  PRIMARY KEY(productID, productRelatedID)
) ENGINE=InnoDB;

-- DATA for PRODUCT_RELATED Tabellen

INSERT INTO `product_related` (`productID`, `productRelatedID`) VALUES
(46, 41),
(54, 41),
(43, 42),
(47, 42),
(53, 42),
(60, 42),
(47, 43),
(53, 43),
(60, 43),
(52, 44),
(54, 46),
(42, 47),
(43, 47),
(53, 47),
(60, 56),
(60, 59);

-- CREATE USERS Tabellen

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user` varchar(255) NOT NULL,
  `pass` text  NOT NULL
) ENGINE=InnoDB;

-- DATA for USERS Tabellen

INSERT INTO `users` (`id`, `user`, `pass`) VALUES
(1, 'peter', '$2y$15$n/Z5oRfe6WW7Le0ZwLl0ReBJjRsoZczWaOt66RgBrqDj7Wh6Mw9jG'),
(2, 'admin', '$2y$15$J/gSgmmc4fFt/9G9Jjg.A.H2IfFhQbGTP2IskBJnMN2ITOIDKTsCO');

-- CREATE VIEW LATEST_PRODUCTS

CREATE VIEW `latest_products` AS 
(SELECT * FROM product ORDER BY productID DESC LIMIT 12);

CREATE VIEW `price_products` AS 
(SELECT * FROM product ORDER BY price ASC LIMIT 12);


-- TRIGGERS
CREATE TRIGGER `trigger_insert_brand` BEFORE INSERT ON `brand` FOR EACH ROW SET NEW.title = CONCAT(UPPER(SUBSTRING(NEW.title,1,1)),LOWER(SUBSTRING(NEW.title,2)));

CREATE TRIGGER `trigger_update_brand` BEFORE UPDATE ON `brand` FOR EACH ROW SET NEW.title = CONCAT(UPPER(SUBSTRING(NEW.title,1,1)),LOWER(SUBSTRING(NEW.title,2)));

CREATE TRIGGER `trigger_insert_category` BEFORE INSERT ON `category` FOR EACH ROW SET NEW.title = CONCAT(UPPER(SUBSTRING(NEW.title,1,1)),LOWER(SUBSTRING(NEW.title,2)));

CREATE TRIGGER `trigger_update_category` BEFORE UPDATE ON `category` FOR EACH ROW SET NEW.title = CONCAT(UPPER(SUBSTRING(NEW.title,1,1)),LOWER(SUBSTRING(NEW.title,2)));
