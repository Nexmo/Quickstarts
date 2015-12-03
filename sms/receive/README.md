# SMS: Receiving Your First SMS

[Video](https://vimeo.com/98321160)

Receiving an inbound SMS messages is as easy as processing an HTML form. 

All inbound SMS messages result in a callback to the URL assigned to your virtual number. You can set and update this
URL in the [`numbers section of the dashboard`][1].

The HTTP method - `GET` or `POST` - can be configured from the 'Api Settings' dropdown in the top right of the 
dashboard. Once you follow the edit link, you can set the HTTP method, a delivery status callback, as well as a default 
callback for inbound messages.

Once you've set the HTTP method, and defined a callback for your number, you're ready to receive inbound SMS messages.

There are a few parameters to expect when you receive an inbound SMS. Those parameters will either be part of the query 
string, or be in the post body, depending on the HTTP method you selected.

`to` will be the virtual number that received the message, `text` will be the content of the SMS message, and `misidn` 
will be the sender's number. 

Example: [PHP](./php/receive.php)

Check out the [API documentation][2] for more on receiving SMS messages.

[1]: https://dashboard.nexmo.com/private/numbers
[2]: https://docs.nexmo.com/api-ref/sms-api/handle-inbound-message