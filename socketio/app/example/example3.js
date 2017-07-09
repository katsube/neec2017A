/**
 * node.jsで簡単なサーバを起動する
 * (POSTパラーメーターを受け取る)
 */

//--------------------------------------
// モジュール読み込み
//--------------------------------------
var app = require('express')();
var http = require('http').Server(app);
var bodyParser = require('body-parser');

//--------------------------------------
// Webサーバ
//--------------------------------------
// Webサーバを起動
http.listen(3000, function(){			// 3000番のポートで起動
  console.log('listening on *:3000');
});

//--------------------------------------
// POST取得データの処理
//--------------------------------------
app.use(bodyParser.urlencoded({
    extended: true
}));
app.use(bodyParser.json());

//--------------------------------------
// URL毎の処理を定義
//--------------------------------------
app.get('/', function(req, res){
  res.sendFile(__dirname + '/example3.html');
});

app.get('/hello', function(req, res){
  res.send('<h1>HelloWorld</h1>');
});

app.get('/name', function(req, res){
	if(req.query.name){
		res.send('<h1>welcome to ' + req.query.name + ' </h1>');
	}
	else{
		res.send('Please input your name.');
	}
});

app.post('/name2', function(req, res){
	if (req.body.name) {
		res.send('<h1>welcome to ' + req.body.name + ' </h1>');
	}
	else{
		res.send('Please input your name.');
	}
});