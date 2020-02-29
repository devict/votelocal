#!/bin/bash
curl -s http://$(docker-compose port ngrok 4040)/api/tunnels | jq .tunnels[0].public_url