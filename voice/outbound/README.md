# Voice: Making An Outbound Call

[Video](https://vimeo.com/102381018)

## Description
Starting an outbound Voice XML call is similar to using the [TTS API][1]. Both expect a `to` parameter, and an optional 
`from`. And like the TTS API you can use `machine_detection` and `machine_timeout` to ignore voicemail systems. 

However, in place of the text used by the the TTS API, the Call API expects an `answer_url` pointing to a Voice XML 
document.

Send the request to `https://rest.nexmo.com/call/json` (or `xml` if that's your preference).

Example: [cURL](./curl/send.sh) [PHP](./php/outbound.php)

The response will contain the call ID, and a status of the request. 

You can also provide a `error_url` callback, to be notified in case of an error. 

Once the call ends, the call duration, times, and pricing will be sent to the `status_url` if defined in the request. 
For each callback URL the desired HTTP method may be defined with a matching `_method` parameter.

Example: [PHP](./php/status.php)

Find a complete list of status parameters in the [API documentation][2]. And take a look at the 
[Inbound Call Quickstart][3] for a brief introduction to Voice XML.

[1]: ./../../tts/
[2]: https://docs.nexmo.com/index.php/voice-api/call
[3]: ./../inbound/