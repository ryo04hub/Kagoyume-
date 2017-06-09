DROP DATABASE IF EXISTS kagoyume_db;
CREATE DATABASE kagoyume_db;

use kagoyume_db;

DROP TABLE IF EXISTS user_t;
CREATE TABLE user_t (
  userID int(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  mail VARCHAR(255) NOT NULL,
  address text NOT NULL,
  total int(11) NOT NULL,
  newDate Datetime NOT NULL,
  deleteFlg int(11) DEFAULT 0 NOT NULL,
  PRIMARY KEY(userID)
) ENGINE=InnoDB DEFAULT CHARSET=cp932;

DROP TABLE IF EXISTS buy_t;
CREATE TABLE buy_t (
  buyID int(11) NOT NULL AUTO_INCREMENT,
  userID int(11) NOT NULL,
  itemCode VARCHAR(255) NOT NULL,
  type int(11) NOT NULL,
  buyDate Datetime NOT NULL,
  PRIMARY KEY(buyID),
  FOREIGN KEY(userID) REFERENCES user_t(userID)
) ENGINE=InnoDB DEFAULT CHARSET=cp932;
