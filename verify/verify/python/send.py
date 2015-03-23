import urllib

params = {
    'api_key': API_KEY,
    'api_secret': API_SECRET,
    'number': NUMBER,
    'brand': 'MyApp'
}

url = 'https://api.nexmo.com/verify/json?' + urllib.urlencode(params)

response = urllib.urlopen(url)
print response.read()
