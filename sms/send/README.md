# SMS: Sending Your First SMS

[Video](https://vimeo.com/98321044)

Sending your first SMS with Nexmo is as easy as making an HTTP request.

Once you've created an account, you can find your API credentials in the dashboard. Use the 'API Settings' link to the 
right near the top of the screen to reveal your API key and secret.

Using the HTTP client in the language of your choice, or just cURL, create a request to `http://rest.nexmo.com/sms/json`

If you prefer an XML response, use `/xml` instead. 

You can pass parameters to the API using the query string, a form encoded POST body, or a JSON object in the POST body 
if you've set the `Content-Type` header to `application/json`.

You'll need to send your `api_key` as well your `api_secret`, and for a simple SMS message the `to`, `from` and `text` 
of the message. 

Make sure the `to` is in international format. If you're in the US or Canada, the `from` will have to be an inbound 
number that's part of your account. Carrier and country specific restrictions on the sender id (the `from`) can be 
[found in our FAQ][1].

New accounts can only send to numbers that have been verified in the dashboard, and 'Nexmo Demo' will be added to all 
messages. Once you've added funds to your account, those restrictions will be removed.

Example: [cURL][curl] [PHP](./php/send.php)

Now that the parameters are set, fire off the request. 

The response will be a JSON object (or XML if you prefer) containing the message id, the status of the message, what 
network was used, as well as the cost and your account's balance. Check out our API docs for more information on the 
response.

If the status is `0`, check your phone. You've just sent your first SMS message using Nexmo.

Check out the [API documentation][2] for more on sending SMS messages.

[1]: https://help.nexmo.com/categories/20079687-Country-Specifics
[2]: https://docs.nexmo.com/index.php/sms-api/send-message
[curl]: ./curl/send.sh