import urllib

params = {
    'api_key': API_KEY,
    'api_secret': API_SECRET,
    'request_id': '9027d08215d449cfbc42dece5302d006',
    'cmd': 'trigger_next_event'
}

url = 'https://api.nexmo.com/verify/control/json?' + urllib.urlencode(params)

response = urllib.urlopen(url)
print response.read()