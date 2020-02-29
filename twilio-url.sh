#!/bin/bash
url=$(curl -s http://$(docker-compose port ngrok 4040)/api/tunnels | jq -r '"\(.tunnels[0].public_url)/sms/receive"')

echo ""
echo "Go to https://www.twilio.com/console/phone-numbers/"
echo "Configure a number's incoming SMS handler with this URL:  $url"
echo ""