/**
 * MySQLへの接続とSELECT文の発行
 * https://github.com/mysqljs/mysql
 */

/*
--------------------------------
■事前準備
--------------------------------
  1. Vagrantfileに以下の行を追加
       config.vm.network "forwarded_port", guest: 3306, host: 13306

  2. Vagrant起動
       PowerShellを起動しvagrantのディレクトリまで移動。
	   コマンドを打って起動する。
           まだ起動していない場合→ vagrant up      (起動)
           すでに起動している場合→ vagrant reload  (再起動)

  3. Vagrantへログイン
       vagrant ssh

  4. MySQLを起動しデータベース、テーブル作成、サンプルデータを挿入する
       $ mysql -u root -p
	   Enter password: Neec2017!

       mysql> create database sample;
	   mysql> use sample;
	   mysql> create table books (id int not null AUTO_INCREMENT, title varchar(64), PRIMARY KEY(id)); 
	   mysql> insert into books(title) values('羊をめぐる冒険');
 	   mysql> insert into books(title) values('ねじまき鳥クロニクル');
	   mysql> insert into books(title) values('海辺のカフカ');

	   mysql> select * from books;
	   +----+--------------------------------+
       | id | title                          |
       +----+--------------------------------+
       |  1 | 羊をめぐる冒険                 |
       |  2 | ねじまき鳥クロニクル           |
       |  3 | 海辺のカフカ                   |
       +----+--------------------------------+

5. 新規にユーザーを作成し権限付与する
       CREATE USER vagrant@'%' IDENTIFIED BY 'V@grant2017';
	   GRANT ALL ON sample.* TO vagrant@'%';

6. vagrantを抜ける
       mysql> \q
	   $ exit
*/

//-------------------------
// ライブラリ
//-------------------------
var mysql = require('mysql');

//-------------------------
// 接続
//-------------------------
var connection = mysql.createConnection({
  host     : 'localhost',
  user     : 'vagrant',
  password : 'V@grant2017',
  port     : 13306,
  database : 'sample'
});
connection.connect();

//-------------------------
// SELECT文の発行
//-------------------------
connection.query('SELECT * FROM books', function (error, rows, fields) {
	if (error) {
		console.log('error: ' + error);
	}
	else{
		for(var i=0; i<rows.length; i++){
			console.log(rows[i]["id"] +":"+ rows[i]["title"]);
		}
		// var json = JSON.stringify(rows);
		// console.log(json);
	}
});


//-------------------------
// 切断
//-------------------------
connection.end();

