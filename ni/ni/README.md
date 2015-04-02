# Quickstart: Getting Number Information

The Number Insight API enables your application to retrieve information about a specific number: country and carrier,
ported status, land line or mobile, and more.

Submitting a Number Insight request is simple, just pass the phone `number` and a `callback` URL to 
`https://rest.nexmo.com/ni/json` (also, you could use `/xml` if that's more your style). If you're only interested in a 
subset of information, you can send a comma separated list of [`features`][features].
 
The response (JSON or XML) will contain pricing information, the status (`0` for success), and the `request_id`.

Example: [cURL](./curl/request.sh) [PHP](./php/request.php)

Once the information has been gathered, Nexmo will [deliver the data by a callback][response]. You can use the 
`request_id` to tie a callback to the original request. You can also set a `client_ref` when sending the request, and 
that will be included in the callback data to help identify or segment usage. Of course, the number itself may be 
enough for most cases.
 
All that's left is to parse the callback data - by default it'll be in the query string.

Example: [PHP](./php/callback.php)

Take a look at the full [Number Insight documentation][docs] for a full list of response features, and optional 
parameters.

[docs]: https://docs.nexmo.com/index.php/number-insight
[features]: https://docs.nexmo.com/index.php/number-insight/request
[response]: https://docs.nexmo.com/index.php/number-insight/response