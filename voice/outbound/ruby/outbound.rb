require "net/http"
require "uri"

uri = URI.parse("https://rest.nexmo.com/call/json")
params = {
    "api_key" => API_KEY,
    "api_secret" => API_SECRET,
    "to" => YOUR_NUMBER,
    "from" => NEXMO_NUMBER,
    "answer_url" => "http://example.com/outbound.vxml"
}

response = Net::HTTP.post_form(uri, params)

puts response.body