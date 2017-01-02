
var fs =  require('fs');

var options = {
    key:    fs.readFileSync('/etc/nginx/ssl/socketdroid.com/154085/server.key'),
    cert:   fs.readFileSync('/etc/nginx/ssl/socketdroid.com/154085/server.crt')
};
var app = require('https').createServer(options);
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

  socket.on('audio',function(data){
    console.log(data);
    socket.broadcast.emit(data.device, data.audio);
  }).on('touch-down',function(data){
    console.log("touch-down");
    console.log(data);
    io.emit(data.room,data);
  })
  .on('touch-move',function(data){
    console.log("touch-move");
    console.log(data);
   io.emit(data.room,data);
  })
  .on('touch-up',function(data){
    console.log(data);
    io.emit(data.room,data);
  });
    console.log('Connected');
    socket.on('disconnect', function(){
    console.log('user disconnected');

  });

});
redis.psubscribe('*', function(err, count) {
    //
});

redis.on('pmessage', function(subscribed, channel, message) {

    message = JSON.parse(message);
    console.log(message);
    io.emit(channel , message);


});
