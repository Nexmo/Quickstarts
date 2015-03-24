#!/bin/bash
curl 'https://api.nexmo.com/verify/json' \
-d api_key=API_KEY \
-d api_secret=API_SECRET \
-d number=YOUR_NUMBER \
-d brand=MyApp
