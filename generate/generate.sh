#!/usr/bin/env bash

set -eo pipefail

cd "$(dirname "$0")"

function die() {
    echo 1>&2 $*
    exit 1
}

if [ -z "$GEN_PATH" ]; then
    die "GEN_PATH must be set, e.g. /path/to/sajari/sdk-php"
fi
if [ -z "$TEMPLATES_PATH" ]; then
    die "TEMPLATES_PATH must be set, e.g. /path/to/sajari/sdk-php/generate/templates"
fi

VERSION=4.1.0

docker-entrypoint.sh generate \
    -i /openapi.json \
    -g php \
    --git-user-id sajari \
    --git-repo-id sdk-php \
    -t $TEMPLATES_PATH \
    --additional-properties invokerPackage=Sajari \
    --additional-properties artifactVersion=$VERSION \
    -o $GEN_PATH
