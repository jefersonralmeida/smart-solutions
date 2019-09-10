#!/bin/bash

# only execute ngrok container if it's enabled on the user environment
if [ "${NGROK_ENABLED:-false}" = "true" ] && [ -n "${NGROK_AUTH_TOKEN}" ] && [ -n "${NGROK_AUTH_USER}" ] && [ -n "${NGROK_AUTH_PASSWORD}" ] ; then
  ./ngrok http --authtoken=${NGROK_AUTH_TOKEN} --auth="${NGROK_AUTH_USER}:${NGROK_AUTH_PASSWORD}" -subdomain="${NGROK_SUBDOMAIN}" --config=ngrok.yml web:80
else
  echo "Ngrok is not enabled or have invalid configs"
fi
