# Verify: Verifying a Phone Number

The Verify API reduces what can be a complex process involving both the SMS and TTS APIs into two simple API calls. It 
also eliminates the need for you to generate and securely store single use codes. 

A verification process can be used to verify a user's phone number during signup, or when updating a profile . It can
also be used to enable second factor authentication during login. The Verify API confirms that a user is in possession 
of a specific device based on a phone number.

To start a verification process, you'll need the `number` to be verified, and a short `brand` so the recipient can 
identify . Be sure the `number` is in international format.

Make a call to `https://api.nexmo.com/verify/json` (or `/xml` if that's your preference), with those parameters, along 
with your `api_key` and `api_secret`. You can optionally select a `code_length` of 4 or 6 characters, and a language 
using the `lg` parameter.

Example: [cURL](./curl/send.sh) [PHP](./php/send.php) [Python](./python/send.py) [Ruby](./ruby/send.rb) [NodeJS](./node/send.js)

The response will be a JSON object (or XML) with a status. If the status is `0` the verification request was successful,
and Nexmo has started the process. You can find all the [status codes][codes] in the API docs. Once you've started a 
verification process, you can't verify the same number until the exsisting request expires.

A successful verification request will include a `request_id`. That will need to be used to complete the verification 
process.

Once the process is stated, the code should arrive to your phone as an SMS. If you wait a while, you'll also get a phone 
call, and the code will be read to you. The timing and channels used depends on the type of number, the country, and the 
carrier. 

Once you have the `code` send that and the `request_id` from the initial API request to: 
`https://api.nexmo.com/verify/json` (or `/xml`) with your `api_key` and `api_secret`.

Example: [cURL](./curl/check.sh) [PHP](./php/check.php) [Python](./python/check.py) [Ruby](./ruby/send.rb) [NodeJS](./node/check.js)

Again the `status` will be `0` if the code is correct, and the verification process successful. If not you can retry 
until the process times out, or you reach the maximum number of attempts.

Check out the [API documentation][docs] for more on the Verify API.

[codes]: https://docs.nexmo.com/index.php/verify/search#verify_return_code
[docs]: https://docs.nexmo.com/index.php/verify

