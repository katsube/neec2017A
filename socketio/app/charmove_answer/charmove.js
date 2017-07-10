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
  //接続時のメッセージ
  console.log('a user connected');

  //チャットメッセージ
  socket.on('movechar', function(data){
    io.emit('movechar', data);
	console.log('movechar: ' + data);
  });

  //切断
  socket.on('disconnect', function(){
    console.log('user disconnected');
  });
});

