#!/bin/bash
#
# Lint shell scripts.
#
set -e

echo "Linting shell with https://github.com/dcycle/docker-shell-lint"
echo ""
echo "to ignore items use:"
echo ""
echo "# shellcheck disable=SC2016"
echo ""


find . -name "*.sh" -print0 | \
  xargs -0 docker run --rm -v "$(pwd)":/code dcycle/shell-lint:2
