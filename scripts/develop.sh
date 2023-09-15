#!/bin/bash
#
# Create a development environment.
#
set -e

docker pull php:apache
docker build -t local-mockhttp .

docker run \
  -d -p 8123:80 \
  -v "$(pwd)":/var/www/html \
  --name mockhttp \
  local-mockhttp
