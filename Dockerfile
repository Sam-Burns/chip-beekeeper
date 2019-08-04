FROM ubuntu:disco

ADD . '/usr/local/src/beekeeper/'

WORKDIR '/usr/local/src/beekeeper/'

ARG DEBIAN_FRONTEND=noninteractive

RUN apt-get update \
  && apt-get install -y software-properties-common \
  && add-apt-repository ppa:ondrej/php \
  && apt-get update \
  && apt-get install -y git zip \
  && apt-get install -y git php7.3-cli php7.3-zip php7.3-xml php7.3-mbstring \
  && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
  && php composer-setup.php \
  && rm composer-setup.php \
  && mv composer.phar /usr/local/bin/composer \
  && composer install

CMD [ "php", "./bin/beekeeper.php" ]
