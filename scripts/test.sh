#!/bin/bash
#
# Run all tests and linting.
#

set -e

./scripts/lint-php.sh
./scripts/lint-sh.sh
./scripts/unit-tests.sh

docker pull php:apache
docker build -t local-mockhttp .

docker run --rm local-mockhttp /bin/bash -c 'ls -lah'

docker run --rm local-mockhttp /bin/bash -c 'ls -lah' | grep '.htaccess'

echo ""
echo "All tests are passing."
echo ""
