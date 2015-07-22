#!/bin/bash
curl 'https://api.nexmo.com/verify/control/json' \
-d api_key=API_KEY \
-d api_secret=API_SECRET \
-d request_id=039368b9e6a24ee29492a6ea63c74202 \
-d cmd=trigger_next_event