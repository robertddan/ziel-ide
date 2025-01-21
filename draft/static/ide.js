'use strict';

var exampleSocket = new WebSocket("ws://localhost:9001");
exampleSocket.onopen = function (event) {
    exampleSocket.send("Can you hear me?");
};
exampleSocket.onmessage = function (event) {
    console.log(event.data);
};
