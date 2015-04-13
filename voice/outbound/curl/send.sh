#!/bin/bash
curl 'https://rest.nexmo.com/call/json' \
-d api_key=API_KEY \
-d api_secret=API_SECRET \
-d to=YOUR_NUMBER \
--data-urlencode "answer_url=http://example.com/outbound.vxml" \
-d from=NEXMO_NUMBER