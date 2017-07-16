/*------------------------------------------------------*/
/* DB作成                                                */
/*------------------------------------------------------*/
CREATE DATABASE RankingHack;
USE RankingHack;

/*------------------------------------------------------*/
/* ユーザー作成/権限付与                                   */
/*------------------------------------------------------*/
CREATE USER hacker@'localhost' IDENTIFIED BY 'Duce!Duce!2017';
GRANT ALL ON RankingHack.* TO hacker@'localhost';

/*------------------------------------------------------*/
/* テーブル作成                                           */
/*------------------------------------------------------*/
CREATE TABLE Score(
	id          integer       NOT NULL   AUTO_INCREMENT,
	userid      varchar(32),
	score       integer,
	regist_date datetime,

	PRIMARY KEY(id)
);

CREATE TABLE User(
	id          varchar(32)   NOT NULL,
	name        varchar(64),
	password    varchar(64),
	regist_date datetime,

	PRIMARY KEY(id)
);

/*------------------------------------------------------*/
/* 初期データ                                             */
/*------------------------------------------------------*/
INSERT INTO Score (userid, score, regist_date)
VALUES ("U00001", 12345, now()),
       ("U00002", 23456, now()),
       ("U00003", 34567, now()),
       ("U00004", 45678, now()),
       ("U00005", 56789, now()),
       ("U00006", 67890, now()),
       ("U00007", 78901, now()),
       ("U00008", 89012, now());

INSERT INTO User (id, name, password, regist_date)
VALUES ("U00001", "あんこうさん", "apple", now()),
       ("U00002", "カメさん", "banana", now()),
       ("U00003", "アヒルさん", "pineapple", now()),
       ("U00004", "カバさん", "berry", now()),
       ("U00005", "ウサギさん", "orange", now()),
       ("U00006", "カモさん", "pine", now()),
       ("U00007", "レオポンさん", "greentea", now()),
       ("U00008", "アリクイさん", "pancake", now());
