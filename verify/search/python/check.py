import urllib

params = {
    'api_key': API_KEY,
    'api_secret': API_SECRET,
    'request_id': 'd945c3655d9043c0b0b3941e1144f258',
}

url = 'https://api.nexmo.com/verify/search/json?' + urllib.urlencode(params)

response = urllib.urlopen(url)
print response.read()