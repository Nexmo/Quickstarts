import urllib

params = {
    'api_key': API_KEY,
    'api_secret': API_SECRET,
    'to': YOUR_NUMBER,
    'from': NEXMO_NUMBER,
    'text': 'Hello from Nexmo'
}

url = 'https://api.nexmo.com/tts/json?' + urllib.urlencode(params)

response = urllib.urlopen(url)
print response.read()
