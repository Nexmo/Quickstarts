# Voice: Receiving Your First Call

[Video](https://vimeo.com/102380947)

Handling a inbound phone call with Nexmo is similar to getting a inbound SMS. 

Like an inbound SMS, you define a URL to be used as your inbound voice callback in the [numbers section of the 
dashboard][1].

If you simply need to forward inbound calls to another phone number, or a SIP address, that can be setup in the 
dashboard as well. However, to have an application handle the inbound call, set the number to 'Forward to VoiceXML' 
and provide a callback URL.

Request to that callback will contain data about the call - just like requests to an SMS callback contain the SMS 
data. But unlike SMS requests, Nexmo expects the response to contain a valid Voice XML document that directs the call. 

Voice XML (VXML) is to a phone what HTML is to a browser. 

Example: [VXML](./vxml/simple.vxml) [PHP](./php/inbound.php)

Perhaps the simplest of VXML documents is just a prompt, but a VXML document can describe many other interactions: 
prompting the user for data, validating or confirming that data, recording audio, navigating through menus, and more.

While the initial request includes data like the caller's phone number, much like an HTML form, VXML documents can send 
data back to your application. And your application can respond with a new VXML document, continuing the call. 

Learn more about VoiceXML from the [W3C specification][2] and the [W3C's Getting Started Guide][3]. Find the complete
list of parameters and status responses in the [API documentation][4].

[1]: https://dashboard.nexmo.com/private/numbers
[2]: http://www.w3.org/TR/voicexml20/
[3]: http://www.w3.org/Voice/Guide/
[4]: https://docs.nexmo.com/api-ref/voice-api/call