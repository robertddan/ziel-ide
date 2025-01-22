var host = 'ws://0.0.0.0:44321/websockets.php';
var socket = new WebSocket(host);

socket.onmessage = function(event) {
    document.getElementById('root').innerHTML = event.data;
}
