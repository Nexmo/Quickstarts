require "net/http"
require "uri"

uri = URI.parse("https://api.nexmo.com/verify/check/json")
params = {
    "api_key" => API_KEY,
    "api_secret" => API_SECRET,
    "request_id" => "31d724da3286461196a82ef3eec62d2a",
    "code" => "4345"
}

response = Net::HTTP.post_form(uri, params)

puts response.body