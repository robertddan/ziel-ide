        var host = 'ws://0.0.0.0:4432/websockets.php';
        var socket = new WebSocket(host);
        socket.onmessage = function(e) {
            document.getElementById('root').innerHTML = e.data;
        };