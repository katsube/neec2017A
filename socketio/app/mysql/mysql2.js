/**
 * MySQLへの接続とINSERT分の発行及びトランザクション
 * https://github.com/mysqljs/mysql
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
//connection.connect();

//-------------------------
// INSERT文の発行
//-------------------------
connection.beginTransaction( function(error) {
	//TRUNSACTIONを開始できなかったらエラー
	if (error){ throw error; }

	connection.query('INSERT INTO books(title) values(?)', ['騎士団長殺し'], function (error, results, fields) {    
		//INSERTに失敗したらROLLBACK
		if (error) { 
			connection.rollback(function() {
				throw error;
			});
		}

    	//COMMIT
    	connection.commit(function(error) {
			//COMMITに失敗したらROLLBACK
			if (error) { 
				connection.rollback(function() {
					throw error;
				});
			}
			//成功したら終了
			else{
				console.log("Suuceess insert!");
				process.exit(0);
			}
		});	
	});
});

//-------------------------
// 切断
//-------------------------
//connection.end();
