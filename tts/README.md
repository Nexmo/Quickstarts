# Voice: Delivering Messages with Voice

[Video](https://vimeo.com/99601185)

When sending an SMS isn't the optimal solution, sending a voice message is just as easy with our Text To Speech API. 

If you've already sent an SMS, switching to TTS is simple. The only change you need to make is swapping the API url from
`https://rest.nexmo.com/sms/json` to  `https://api.nexmo.com/tts/json` (or `xml` if that's your preference). The `to`, 
`from`, and `text` parameters stay the same.

Example: [cURL](./curl/tts.sh) [PHP](./php/tts.php)

Once that's done, instead of your message being sent as an SMS, the phone number will be called, and your messages will 
be read by our text to speech engine. If you set a callback when making the request, that URL will be sent the call data 
once complete.

While that's all you *have* to do to use TTS, there are some additional voice only features.

You can pass a `repeat` parameter to repeat the message up to 10 times. 

The `machine_detection` can be used to configure the call to disconnect when an answering machine or voicemail system is 
detected, and `machine_timeout` to set the window used for detection.

`lg` and `voice` are used to set the language and the gender of the text to speech engine. 

If a `callback` parameter is set, that URL will receive call data once the call is complete, similar to the delivery 
receipt available when sending an SMS message.

Finally, you're not limited to text to speech, passing a link to an audio file will play that file. Use the format 
`<audio src='http://example.com/hello.mp3'/>`, which allows mixing TTS and multiple audio prompts to create complex 
messages.

Check out the API documentation for more on the [TTS API][1] and how to [control the speech engine][2].

[1]: https://docs.nexmo.com/index.php/voice-api/text-to-speech
[2]: https://docs.nexmo.com/index.php/voice-api/text-to-speech#tts_tips