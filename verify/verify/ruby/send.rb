require "net/http"
require "uri"

uri = URI.parse("https://api.nexmo.com/verify/json")
params = {
    "api_key" => API_KEY,
    "api_secret" => API_SECRET,
    "number" => NUMBER,
    "brand" => "MyApp"
}

response = Net::HTTP.post_form(uri, params)

puts response.body