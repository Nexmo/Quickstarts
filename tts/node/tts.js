var https = require('https');

var data = JSON.stringify({
  api_key: API_KEY,
  api_secret: API_SECRET,
  to: YOUR_NUMBER,
  from: NEXMO_NUMBER,
  text: 'Hello from Nexmo'
});

var options = {
  host: 'api.nexmo.com',
  path: '/tts/json',
  port: 443,
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'Content-Length': Buffer.byteLength(data)
  }
};

var req = https.request(options);

req.write(data);
req.end();

var responseData = '';
req.on('response', function(res){
  res.on('data', function(chunk){
    responseData += chunk;
  });
  
  res.on('end', function(){
    console.log(JSON.parse(responseData));
  });
});