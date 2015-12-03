# Quickstart: Controlling a Verify Request

The Verify API retires delivery of the code automatically, but in some cases that process needs to be interrupted. If 
the user realizes the phone number they provided is incorrect, or wants to force a retry without waiting, the Control
API makes that possible.

To control an ongoing verify process, you'll need the verify `request_id`, which is the same `request_id` that would be 
used to [complete the verification process][verify]. You then make a call to `https://api.nexmo.com/verify/control/json` 
(or `/xml`) with your `api_key` and `api_secret`, the `request_id` and send the control command using the `cmd` 
parameter.
 
There are two commands you can send, `cancel` to end the verification process, and `trigger_next_event` to retry 
delivery of the code right away. 

Example: [cURL](./curl/control.sh) [PHP](./php/control.php) [Python](./python/control.py) [Ruby](./ruby/control.rb) [NodeJS](./node/control.js)

The response will be a JSON object (or XML) with a status. If the status is `0` the control request was successful. It's
important to note that a verification cannot be canceled if it's already expired, or if the command is issued too 
close to the start of the verification. It's also not possible to trigger more retry attempts than the verification 
process would normally make.
 
Check out the [API documentation][docs] for more on the Verify API.

[verify]: ../verify/
[docs]: https://docs.nexmo.com/api-ref/verify/control
