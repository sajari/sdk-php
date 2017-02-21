#!/bin/bash -e

function die() {
  echo 1>&2 $*
  exit 1
}

if [ -z "$PROTO_SRC" ]; then
  die "must set PROTO_SRC"
fi

echo 1>&2 "Checking required tools:"
for tool in protoc; do
  q=$(which $tool) || die "didn't find $tool"
  echo 1>&2 "$tool: $q"
done

dest="src/Sajari/proto"

rm -fr $dest
mkdir -p $dest

echo "$dest"
echo 1>&2 "Building protos:"
for dir in $(find $PROTO_SRC -name '*.proto' | xargs -n1 dirname | sort | uniq); do
  echo 1>&2 "- $dir"
  protoc -I$PROTO_SRC --php_out=$dest --grpc_out=$dest --plugin=protoc-gen-grpc=/Users/trent/grpc/bins/opt/grpc_php_plugin $dir/*.proto
done
