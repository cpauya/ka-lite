FROM ubuntu:xenial

# install latest python and nodejs
RUN apt-get -y update
RUN apt-get install -y software-properties-common curl
RUN add-apt-repository ppa:voronov84/andreyv
RUN curl -sL https://deb.nodesource.com/setup_6.x | bash -

RUN apt-get -y update
RUN apt-get install -y python2.7 python-pip git nodejs gettext python-sphinx
COPY . /ka-lite

VOLUME /ka-litedist/  # for mounting the whl files into other docker containers
CMD cd /ka-lite && pip install -r requirements_sphinx.txt && pip install -r requirements_dev.txt && pip install -e . && make dist && cp /ka-lite/dist/* /ka-litedist/

