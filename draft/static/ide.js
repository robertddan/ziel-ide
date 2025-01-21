    var exampleSocket = new WebSocket("ws://localhost:4432");
    exampleSocket.onopen = function (event) {
      exampleSocket.send("Can you hear me?");
    };
    exampleSocket.onmessage = function (event) {
      console.log(event.data);
    }