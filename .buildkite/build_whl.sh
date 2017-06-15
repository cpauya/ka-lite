#!/usr/bin/env bash

set -euo pipefail

pip install pex   
pip install wheel
make dockerenvdist
make pex 
buildkite-agent artifact upload 'dist/*.whl'
buildkite-agent artifact upload 'dist/*.zip'
buildkite-agent artifact upload 'dist/*.tar.gz'
buildkite-agent artifact upload 'dist/*.pex'