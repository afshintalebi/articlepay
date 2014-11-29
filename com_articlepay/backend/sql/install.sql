DROP TABLE IF EXISTS `#__articlepay_user_payed` ;
DROP TABLE IF EXISTS `#__articlepay_articles` ;
DROP TABLE IF EXISTS `#__articlepay_transactions` ;
DROP TABLE IF EXISTS `#__articlepay_payment_types` ;

-- -----------------------------------------------------
-- Table `articlepay_articles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `#__articlepay_articles` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_id` INT UNSIGNED NOT NULL,
  `article_title` VARCHAR(255) NOT NULL DEFAULT '',
  `article_cat_id` INT NULL,
  `article_object` TEXT NULL,
  `article_link` TEXT NULL,
  `article_lang` VARCHAR(45) NULL,
  `created_date` DATETIME NOT NULL,
  `amount` INT NOT NULL,
  `active` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `apayArticleIdUnq` (`article_id` ASC))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `articlepay_payment_types`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `#__articlepay_payment_types` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `payment_data` TEXT NULL,
  `logo_url` TEXT NULL,
  `site_url` TEXT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `articlepay_transactions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `#__articlepay_transactions` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `payment_type_id` INT UNSIGNED NOT NULL,
  `article_id` INT UNSIGNED NOT NULL,
  `user_id` INT UNSIGNED NOT NULL,
  `amount` INT NOT NULL DEFAULT 0,
  `ref_code` VARCHAR(255) NULL,
  `created_date` DATETIME NOT NULL,
  `payment_data` TEXT NULL,
  `has_error` TINYINT(1) NOT NULL DEFAULT 0,
  `done` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `apaytnPaymentTypeIdx` (`payment_type_id` ASC),
  UNIQUE INDEX `apaytnPaytpRefUnq` (`payment_type_id` ASC, `ref_code` ASC),
  CONSTRAINT `apaytnPaymentTypeFk`
    FOREIGN KEY (`payment_type_id`)
    REFERENCES `#__articlepay_payment_types` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `articlepay_user_payed`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `#__articlepay_user_payed` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `article_id` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  INDEX `apayUserPayedAllIdx` (`user_id` ASC, `article_id` ASC),
  INDEX `apayUsePayedIdx` (`article_id` ASC),
  CONSTRAINT `apayUsePayedFk`
    FOREIGN KEY (`article_id`)
    REFERENCES `#__articlepay_articles` (`article_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Data for table `articlepay_payment_types`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `#__articlepay_payment_types` (`id`, `title`, `payment_data`, `logo_url`, `site_url`) VALUES (1, 'زرین پال', NULL, NULL, NULL);
COMMIT;