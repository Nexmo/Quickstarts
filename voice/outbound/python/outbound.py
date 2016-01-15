import urllib

params = {
    'api_key': API_KEY,
    'api_secret': API_SECRET,
    'to': YOUR_NUMBER,
    'from': NEXMO_NUMBER,
    'answer_url': 'http://example.com/outbound.vxml'
}

url = 'https://rest.nexmo.com/call/json?' + urllib.urlencode(params)

response = urllib.urlopen(url)
print response.read()
