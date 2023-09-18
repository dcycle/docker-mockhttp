#!/bin/bash
#
# Create a development environment.
#
set -e

docker kill mockhttp 2>/dev/null >/dev/null || true
docker rm mockhttp 2>/dev/null >/dev/null || true

docker pull php:apache
docker build -t local-mockhttp .

# Please see the root .gitignore file on why we are doing this:
/bin/cp htaccess .htaccess

docker run \
  -d -p 8123:80 \
  -v "$(pwd)":/var/www/html \
  -v "$(pwd)"/example-responses:/example-responses \
  --name mockhttp \
  local-mockhttp

echo ""
echo "Visit http://0.0.0.0:8123"
echo ""
