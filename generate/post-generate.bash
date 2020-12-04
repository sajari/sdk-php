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

# TODO(jingram): Prettier freezes up if the vendor folder is there, not sure why
# it's not being ignored.
rm -rf $GEN_PATH/vendor

npx prettier --write -c $GEN_PATH
