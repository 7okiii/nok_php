# どんなdockerイメージを利用して構築をするか
FROM php:8.2-apache

# 設定ファイルをdockerコンテナ内のPHP、Apacheに読み込ませる
ADD php.ini /usr/local/etc/php/
ADD 000-default.conf /etc/apache2/sites-enabled/

# Composerのインストール
RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs

# ミドルウェアインストール
RUN apt-get update \
&& apt-get install -y \
git \
zip \
unzip \
vim \
# 画像編集でGDを使用する
libfreetype6-dev \
libjpeg62-turbo-dev \
libpng-dev \

# 画像編集でGDを使用する
&& docker-php-ext-configure gd --with-freetype --with-jpeg \
&& docker-php-ext-install -j$(nproc) gd \
&& docker-php-ext-install pdo_mysql \

# 日本語入力可能にする
&& apt-get install -y locales \
&& locale-gen ja_JP.UTF-8 \
&& echo "export LANG=ja_JP.UTF-8" >> ~/.bashrc
ENV LANG ja_JP.UTF-8
ENV LANGUAGE ja_JP:ja
ENV LC_ALL=ja_JP.UTF-8
RUN localedef -f UTF-8 -i ja_JP ja_JP.utf8

# Laravelで必要になるmodRewriteを有効化する
RUN mv /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled
RUN /bin/sh -c a2enmod rewrite

# chpasswd コマンドでパスワード設定をする。root ユーザーに password というパスワードを設定。
RUN echo 'root:naoki0618' | chpasswd

# 権限のためユーザを追加(root=1000)が初期値
ARG USERNAME=naoki
ARG GROUPNAME=admin
ARG UID=1000
ARG GID=1000
RUN groupadd -g $GID $GROUPNAME && \
    useradd -m -s /bin/bash -u $UID -g $GID $USERNAME

USER $USERNAME
WORKDIR /home/$USERNAME/