FROM centos:7.4.1708


ENV  PHP_BUILD_DEPS \
       gcc openssl-devel libxml2-devel libjpeg-devel autoconf \
       libpng-devel freetype-devel libicu-devel gcc-c++ re2c openldap-devel \
       libmcrypt-devel libxslt-devel libcurl-devel make libmcrypt
ADD entrypoint.sh /usr/local/bin
RUN yum -y update \
    && yum -y install epel-release \
    && yum -y install wget $PHP_BUILD_DEPS \
    && yum clean all \
    && mkdir /app && cd /app \
    && wget http://cn.php.net/distributions/php-5.6.33.tar.gz \
    && tar xf php-5.6.33.tar.gz \
    && rm php-5.6.33.tar.gz -f \
    && cd php-5.6.33 \
    && ./configure --prefix=/usr/local/php \
        --with-config-file-path=/usr/local/php/etc \
        --with-config-file-scan-dir=/usr/local/php/conf.d \
        --with-fpm-user=www \
        --with-fpm-group=www \
        --enable-fpm  \
        --with-mysql=mysqlnd \
        --with-mysqli=mysqlnd \
        --with-pdo-mysql=mysqlnd \
        --with-iconv-dir \
        --with-freetype-dir=/usr/local/freetype \
        --with-jpeg-dir \
        --with-png-dir \
        --with-zlib \
        --with-libxml-dir=/usr \
        --enable-xml \
        --disable-rpath \
        --enable-bcmath \
        --enable-shmop \
        --enable-sysvsem \
        --enable-inline-optimization \
        --enable-mbregex \
        --enable-mbstring \
        --with-mcrypt \
        --enable-ftp \
        --with-gd \
        --enable-gd-native-ttf \
        --with-curl \
        --with-openssl \
        --with-mhash \
        --enable-pcntl \
        --enable-sockets \
        --with-xmlrpc \
        --enable-zip \
        --enable-soap \
        --with-gettext \
        --disable-fileinfo \
        --enable-opcache \
        --enable-intl \
        --with-xsl \
    && make -j "$(nproc)" \
    && make install \
    && rm -rf /app/php-5.6.33/

RUN  ln -sf /usr/local/php/bin/php /usr/local/bin/php \
     && ln -sf /usr/local/php/bin/phpize /usr/local/bin/phpize \
     && ln -sf /usr/local/php/bin/pecl   /usr/local/bin/pecl \
     && ln -sf /usr/local/php/bin/pear /usr/local/bin/pear \
     && ln -sf /usr/local/php/sbin/php-fpm /usr/local/bin/php-fpm \
     && wget -O /usr/local/bin/composer https://getcomposer.org/composer.phar \
     && chmod +x /usr/local/bin/composer \
     && pecl install igbinary \
     && echo "y"|pecl install redis \
     && echo "y"|pecl install memcache 


RUN  useradd www \
     && chown www:www /app \
     && { \
          echo '[global]'; \
          echo 'daemonize = no'; \
          echo '[www]'; \
          echo 'user = www'; \
          echo 'group = www'; \
          echo 'listen = [::]:9000'; \
          echo 'listen.mode = 0660'; \
          echo 'pm = dynamic'; \
          echo 'pm.max_children = 5'; \
          echo 'pm.start_servers = 2'; \
          echo 'pm.min_spare_servers = 1'; \
          echo 'pm.max_spare_servers = 3'; \
         }|tee /usr/local/php/etc/php-fpm.conf \
     && mkdir -p /usr/local/php/conf.d \
     && { \
		echo 'opcache.memory_consumption=128'; \
		echo 'opcache.interned_strings_buffer=8'; \
		echo 'opcache.max_accelerated_files=4000'; \
		echo 'opcache.revalidate_freq=2'; \
		echo 'opcache.fast_shutdown=1'; \
		echo 'opcache.enable_cli=1'; \
	}|tee /usr/local/php/conf.d/opcache-recommended.ini \
     && { \
           echo 'extension=igbinary.so'; \
           echo 'extension=memcache.so'; \
           echo 'extension=redis.so'; \
        }|tee /usr/local/php/conf.d/extension.ini
           
WORKDIR /app

EXPOSE 9000

ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]
