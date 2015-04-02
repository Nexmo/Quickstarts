#!/bin/bash
curl 'https://rest.nexmo.com/ni/json' \
-d api_key=$API_KEY \
-d api_secret=$API_SECRET \
-d number=$YOUR_NUMBER \
-d callback=$YOUR_CALLBACK
