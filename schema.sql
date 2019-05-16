CREATE DATABASE YetiCave
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;
USE YetiCave;

/**
  Таблица категорий
 */
CREATE TABLE categories (
	id	INT AUTO_INCREMENT PRIMARY KEY,
	name	CHAR(128) NOT NULL UNIQUE,
	code	CHAR(64) NOT NULL UNIQUE
);

/**
  Таблица зарегестрированных пользователей
 */
CREATE TABLE users (
	id		INT AUTO_INCREMENT PRIMARY KEY,
	dt_add 		TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	email 		CHAR(128) NOT NULL UNIQUE,
	name		CHAR(64) NOT NULL,
	password	CHAR(64) NOT NULL,
	avatar_path	CHAR(255),
	info		CHAR(255) NOT NULL,
	INDEX user_email (email)
);

/**
  Таблица лотов
 */
CREATE TABLE lots (
	id		INT AUTO_INCREMENT PRIMARY KEY,
	dt_add		TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	name 		CHAR(255) NOT NULL UNIQUE,
	descr 		TEXT(65535) NOT NULL,
	img_url		CHAR(255),
	start_price		INT UNSIGNED NOT NULL,
	dt_fin		TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	rate_step	INT NOT NULL,
	cat_id		INT NOT NULL,
	author_id	INT NOT NULL,
	winner_id	INT NOT NULL,
	FOREIGN KEY (author_id) REFERENCES users(id),
	FOREIGN KEY (winner_id) REFERENCES users(id),
	FOREIGN KEY (cat_id) REFERENCES categories(id),
	INDEX lot_index (name, cat_id)
);

/**
  Таблица ставок
 */
CREATE TABLE rates (
	id	INT AUTO_INCREMENT PRIMARY KEY,
	dt_add 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	sum_rate	INT UNSIGNED NOT NULL,
	user_id	INT NOT NULL,
	lot_id	INT NOT NULL,
	FOREIGN KEY (user_id) REFERENCES users(id),
	FOREIGN KEY (lot_id) REFERENCES lots(id),
	INDEX user_lot (user_id, lot_id)
	);
