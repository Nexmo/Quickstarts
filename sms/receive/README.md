# Quickstart: Receiving Your First SMS

[Video](https://vimeo.com/nexmo/review/98321160/28a042f328)

Receiving an inbound SMS messages is as easy as processing an HTML form. 

All inbound SMS messages result in a callback to the URL assigned to your virtual number. You can set and update this
URL in the [numbers section of the dashboard](https://dashboard.nexmo.com/private/numbers).

The HTTP method - `GET` or `POST` - can be configured from the 'Api Settings' dropdown in the top right of the 
dashboard. Once you follow the edit link, you can set the HTTP method, a delivery status callback, as well as a default 
callback for inbound messages.

Once you've set the HTTP method, and defined a callback for your number, you're ready to receive inbound SMS messages.

There are a few parameters to expect when you receive an inbound SMS. Those parameters will either be part of the query 
string, or be in the post body, depending on the HTTP method you selected.

`to` will be the virtual number that received the message, `text` will be the content of the SMS message, and `misidn` 
will be the sender's number. 

Example: [PHP](./php/receive.php)

Check out the API documentation for more on receiving SMS messages.

Having trouble? Take a look at our inbound SMS troubleshooting guide.
