#!/bin/bash
#
# Create a development environment.
#
set -e

docker kill mockhttp 2>/dev/null >/dev/null || true
docker rm mockhttp 2>/dev/null >/dev/null || true

docker pull php:apache
docker build -t local-mockhttp .

docker run \
  -d -p 8123:80 \
  -v "$(pwd)":/var/www/html \
  -v "$(pwd)"/example-responses:/example-responses \
  --name mockhttp \
  local-mockhttp

echo ""
echo "Visit http://0.0.0.0:8123"
echo ""
