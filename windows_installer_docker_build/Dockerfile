FROM ubuntu:xenial

RUN apt-get -y update

RUN dpkg --add-architecture i386
RUN apt-get update && apt-get install -y --no-install-recommends git wget ca-certificates sudo software-properties-common

RUN add-apt-repository -y ppa:ubuntu-wine/ppa && apt-get -y update && apt-get install --no-install-recommends --assume-yes wine

COPY . /kalite

RUN mkdir /installer/

ENV KALITE_BUILD_VERSION="$(cat /kalite/kalite/VERSION)"

# Build KA-Lite windows installer.
RUN cd /kalite/ka-lite-installers/windows
RUN echo $KALITE_BUILD_VERSION