# Quickstart: Getting a Verification Status

In most cases the success of the verification process is determined when the [user provided code is checked][verify]. 
However, it is possible to check the status of a verification during the process, as well as after the process has 
completed.

You'll need the verify `request_id`, which is also what would be used to [complete the verification process][verify].
Pass that along with your `api_key` and `api_secret` to `https://api.nexmo.com/verify/search/json` (or `/xml`).

Example: [cURL](./curl/search.sh) [PHP](./php/search.php) [Python](./python/search.py) [Ruby](./ruby/search.rb) [NodeJS](./node/search.js)

Not only will the response include the current status of the process, but will also include information about the last
time a code was sent, what codes have been checked, and the outcome of those checks.

It's also possible to check multiple verifications by using the `request_ids` parameter instead of `request_id`.

Find example responses, and a full list of parameters in the [API documentation][docs].

[verify]: ../verify/
[docs]: https://docs.nexmo.com/index.php/verify/control