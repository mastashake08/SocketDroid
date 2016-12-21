var app = require('http').createServer(handler);
var io = require('socket.io')(app);

var Redis = require('ioredis');
var redis = new Redis();

app.listen(6001, function() {
    console.log('Server is running!');
});

function handler(req, res) {
    res.writeHead(200);
    res.end('Test');
}

io.on('connection', function(socket) {
    //
    console.log('Connected');
    socket.on('disconnect', function(){
    console.log('user disconnected');

  });
});

io.on('android response',function(msg){
  console.log(msg);
  io.emit('admin',msg);
});
io.on('Toast Receieved',function(msg){
  console.log(msg);
  io.emit('admin',msg);
});redis.psubscribe('*', function(err, count) {
    //
});

redis.on('pmessage', function(subscribed, channel, message) {
  if(channel == 'android-response'){
      io.emit('response',message.data);
    else{
    console.log("Message Receieved");
    io.emit('response',"Message Receieved");
    }
  }
  else{
    message = JSON.parse(message);
    console.log(message);
    io.emit(channel , message.data.command);
  }
});
