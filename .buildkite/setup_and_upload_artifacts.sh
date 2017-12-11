#!/usr/bin/env bash

set -euo pipefail

SCRIPTPATH=$(pwd)
PIP="$SCRIPTPATH/env/bin/pip"
PYTHON="$SCRIPTPATH/env/bin/python"

echo "Now creating virtualenv..."
virtualenv -p python3 env

# Install requests and github3.py
$PIP install requests==2.10.0
$PIP install github3.py==0.9.6

echo "Executing upload script..."
mkdir -p dist
mkdir -p installer

buildkite-agent artifact download 'dist/*.pex' dist/
buildkite-agent artifact download 'dist/*.whl' dist/
buildkite-agent artifact download 'dist/*.zip' dist/
buildkite-agent artifact download 'dist/*.tar.gz' dist/
buildkite-agent artifact download 'installer/*.exe' installer/

$PYTHON .buildkite/upload_artifacts.py
