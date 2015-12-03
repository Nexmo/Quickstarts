# SMS: Replying to SMS Messages

[Video](https://vimeo.com/98325185)

Replying to an SMS message simply combines processing an inbound message with sending an outbound message. If you
haven't yet, you may want to visit the Quickstarts for [sending your first SMS][1] and [receiving your first SMS][2].

The inbound request includes the sender's number as the `msisdn` and your Nexmo virtual number as the `to`. 

To send a reply, send an outbound message using the inbound `msisdn` as the `to`, and the inbound `to` as the `from`. 

Example: [PHP](./php/reply.php)

Flipping the roles of sender and receiver effectively creates a reply; however, it's important to note that SMS messages 
have no concept of threads. There's no way to determine if an inbound message is a reply to a previous message, or a 
completely new message, unattached to the context of past messages.

Find more about [sending messages][3] and [handling inbound messages][4] in the API documentation.

[1]: ../send/
[2]: ../receive/
[3]: https://docs.nexmo.com/api-ref/sms-api/request
[4]: https://docs.nexmo.com/api-ref/sms-api/handle-inbound-message