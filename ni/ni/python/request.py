import urllib

params = {
    'api_key': API_KEY,
    'api_secret': API_SECRET,
    'number': YOUR_NUMBER,
    'callback': YOUR_CALLBACK
}

url = 'https://rest.nexmo.com/ni/json?' + urllib.urlencode(params)

response = urllib.urlopen(url)
print response.read()
