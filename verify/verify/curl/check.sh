#!/bin/bash
curl 'https://api.nexmo.com/verify/check/json' \
-d api_key=NEXMO_KEY \
-d api_secret=NEXMO_SECRET \
-d request_id=a7d922f6a00442ee8e2f2a7646cb2a6d \
-d code=1728
