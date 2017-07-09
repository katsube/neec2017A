/**
 * Socket.ioを使用した簡易チャット
 * https://socket.io/get-started/chat/
 */

//--------------------------------------
// モジュール読み込み
//--------------------------------------
var app  = require('express')();
var http = require('http').Server(app);
var io   = require('socket.io')(http);

//--------------------------------------
// Webサーバ
//--------------------------------------
app.get('/', function(req, res){
  res.sendFile(__dirname + '/chat.html');
});
app.get('/jquery.min.js', function(req, res){
  res.sendFile(__dirname + '/jquery.min.js');
});
http.listen(3000, function(){
  console.log('listening on *:3000');
});

//--------------------------------------
// Socket.io
//--------------------------------------
io.on('connection', function(socket){
  //接続時のメッセージ
  console.log('a user connected');

  //チャットメッセージ
  socket.on('chat message', function(msg){
    io.emit('chat message', msg);
	console.log('message: ' + msg);
  });

  //切断
  socket.on('disconnect', function(){
    console.log('user disconnected');
  });
});

