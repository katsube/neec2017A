/**
 * node.jsで簡単なサーバを起動する
 */

//--------------------------------------
// モジュール読み込み
//--------------------------------------
var app  = require('express')();
var http = require('http').Server(app);

//--------------------------------------
// Webサーバ
//--------------------------------------
// Webサーバを起動
http.listen(3000, function(){			// 3000番のポートで起動
  console.log('listening on *:3000');
});

//--------------------------------------
// URL毎の処理を定義
//--------------------------------------
app.get('/', function(req, res){
  res.sendFile(__dirname + '/example1.html');
});

app.get('/hello', function(req, res){
  res.send('<h1>HelloWorld</h1>');
});
