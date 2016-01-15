require "net/http"
require "uri"

uri = URI.parse("https://api.nexmo.com/tts/json")
params = {
    "api_key" => API_KEY,
    "api_secret" => API_SECRET,
    "to" => YOUR_NUMBER,
    "from" => NEXMO_NUMBER,
    "text" => "Hello from Nexmo"
}

response = Net::HTTP.post_form(uri, params)

puts response.body