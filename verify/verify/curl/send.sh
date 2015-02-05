#!/bin/bash
curl 'https://api.nexmo.com/verify/json' \
-d api_key=NEXMO_KEY \
-d api_secret=NEXMO_SECRET \
-d number=YOUR_NUMBER \
-d brand=MyApp
