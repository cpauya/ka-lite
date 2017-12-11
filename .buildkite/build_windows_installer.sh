#!/usr/bin/env bash

set -euo pipefail

PARENT_PATH=$(pwd)
KALITE_DOCKER_PATH="$PARENT_PATH/windows_installer_docker_build"
KALITE_WINDOWS_PATH="$KALITE_DOCKER_PATH/ka-lite-installers/windows"

# Download artifacts to dist/
mkdir -p dist
buildkite-agent artifact download 'dist/*.whl' dist/
make dockerwriteversion

# Download english content pack
cd dist/ && wget http://pantry.learningequality.org/downloads/ka-lite/0.17/content/contentpacks/en.zip

# Clone KA-Lite windows installer and copy `en.zip` to windows path
cd $KALITE_DOCKER_PATH
git clone https://github.com/learningequality/ka-lite-installers.git && cd ka-lite-installers && git checkout 0.17.x

# Copy kalite whl files to kalite windows installer path
COPY_CMD="cp $PARENT_PATH/dist/*.whl $KALITE_WINDOWS_PATH"
$COPY_CMD

# Copy content packs to windows installer path
COPY_CMD="cp $PARENT_PATH/dist/en.zip $KALITE_WINDOWS_PATH"
$COPY_CMD

# Build KA-Lite windows installer docker image
KALITE_BUILD_VERSION=$(cat $PARENT_PATH/kalite/VERSION)
cd $KALITE_DOCKER_PATH
DOCKER_BUILD_CMD="docker image build -t $KALITE_BUILD_VERSION-build ."
$DOCKER_BUILD_CMD

INSTALLER_PATH="$KALITE_DOCKER_PATH/installer"
mkdir -p $INSTALLER_PATH

# Run KA-Lite windows installer docker image.
DOCKER_RUN_CMD="docker run -v $INSTALLER_PATH:/installer/ $KALITE_BUILD_VERSION-build"
$DOCKER_RUN_CMD

buildkite-agent artifact upload './installer/*.exe'
