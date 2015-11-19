require "net/http"
require "uri"

uri = URI.parse("https://rest.nexmo.com/ni/json")
params = {
    "api_key" => API_KEY,
    "api_secret" => API_SECRET,
    "number" => YOUR_NUMBER,
    "callback" => YOUR_CALLBACK
}

response = Net::HTTP.post_form(uri, params)

puts response.body