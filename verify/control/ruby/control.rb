require "net/http"
require "uri"

uri = URI.parse("https://api.nexmo.com/verify/control/json")
params = {
    "api_key" => API_KEY,
    "api_secret" => API_SECRET,
    "request_id" => "9027d08215d449cfbc42dece5302d006",
    "code" => "4345",
    "cmd" => "trigger_next_event"
}

response = Net::HTTP.post_form(uri, params)

puts response.body