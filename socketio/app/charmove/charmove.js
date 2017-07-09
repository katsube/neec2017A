/**
 * Socket.ioを使用したキャラ移動
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
  res.sendFile(__dirname + '/charmove.html');
});
app.get('/image/:file', function(req, res){
  res.sendFile(__dirname + '/image/' + req.params.file);
});
app.get('/js/:file', function(req, res){
  res.sendFile(__dirname + '/js/' + req.params.file);
});
http.listen(3000, function(){
  console.log('listening on *:3000');
});

//--------------------------------------
// Socket.io
//--------------------------------------
io.on('connection', function(socket){
  // 接続時のメッセージ
  console.log('a user connected');

  // イベント処理を記述

  // 切断
  socket.on('disconnect', function(){
    console.log('user disconnected');
  });
});

