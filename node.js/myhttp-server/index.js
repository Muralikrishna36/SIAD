var http = require("http");
var fs = require("fs");
var server = http.createServer(function(request,response)){
	console.log("Got the request:" + request.url);
	response.writeHead("200");
	var fileStream = fs.createReadStream("./client.html");
	fileStream.pipe(response);
});
var port=8888;
server.listen(post);
console.log("Server is running at port: " +port);
