var host = 'ws://0.0.0.0:44321/websockets.php';
var socket = new WebSocket(host);


socket.addEventListener("message", (event) => {
  console.log("Message from server ", event.data);
});

socket.addEventListener("open", (event) => {
    var message = {'a':'a1','b':'b2'};
    socket.send(JSON.stringify(message));
});
