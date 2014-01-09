Soarin PHP Framework
===========================
PHP as fast as possible

Introduction
-----------------------------

This software is a super lightweight RESTful framework for your future PHP code base. Every attempt has been made to make it as fast as possible (especially if you include all the below extensions properly).

Installation
-----------------------------

1. Setup a server
2. [Setup web software](https://github.com/charleshross/soarin/wiki/Setup-web-server)
3. Setup Soarin
3. Configure Soarin

PHP Framework Dependencies
-----------------------------

Required:

* [PHP v5.5.6](http://www.php.net/) or later
* [NGINX v1.5.7](http://nginx.org/) or later

Important framework PHP extras:

* [GD PHP extension](http://php.net/manual/en/book.image.php)
* [Zend OPcache PHP extension](http://us2.php.net/opcache)

Optional framework PHP extras:
* [phpredis PHP Extension](https://github.com/nicolasff/phpredis)
* [PHP PDO extension with pdo-mysql and pdo-pgsql](http://www.php.net/manual/en/book.pdo.php)
* [cURL PHP extension](http://php.net/manual/en/book.curl.php)

NGINXG Server Clause Setup
-----------------------------
Use a server clause similar to this one, replace <> items with your server information
	
	server {

		listen <port number here>;
		server_name localhost:<port number here>;
		
		root <path to soarin folder>/public;
	    
		# remove when in 'production'
		location ~ \.(jpg|jpeg|png|apng|gif|swf|ico|txt|html|htm|js|css|less)$ {
			root /;
			try_files <path to soarin folder>/php/app/$uri <path to soarin folder>/public/$uri 404.html;
		}
		
		location / {
			index index.php;
				if (!-f $request_filename) {
					rewrite ^(.*)$ /index.php last;
				}
		}

		location ~ \.php$ {

			include /opt/nginx/conf/fastcgi.conf;
			fastcgi_index index.php;
			if (-f $request_filename) {
				fastcgi_pass 127.0.0.1:9000;
			}
		}
		
		location ~ \.flv$ {
			flv;
		}
		
		location ~ \.mp4$ {
			mp4;
		}

	}

NGINX Compile Configuration
-----------------------------
The NGINX web server used for this project was configured with these options

	./configure --prefix=/opt/nginx \
	--with-pcre \
	--with-http_ssl_module \
	--with-http_flv_module \
	--with-http_realip_module \
	--with-http_mp4_module \
	--with-mail \

Required Debian packages: gcc libpcre3 libpcre3-dev zlib1g zlib1g-dev openssl libssl-dev

PHP Compile Configuration
-----------------------------
PHP was compiled for this project using these configuration options

	./configure --prefix=/opt/php \
	--with-mysql=shared,/opt/mysql/server-5.6 \
	--with-pgsql=/var/lib/postgresql/9.3/main \
	--with-jpeg-dir \
	--with-pdo-mysql \
	--with-pdo-pgsql \
	--with-mysqli \
	--with-curl \
	--enable-exif \
	--with-gd \
	--enable-mbstring \
	--enable-pdo \
	--enable-sockets \
	--enable-fpm \
	--with-pear \
	--enable-opcache

Required Debian packages: libxml2-dev libcurl4-gnutls-dev libpng12-0 libpng12-dev libjpeg62 libjpeg62-dev libpq-dev

Note: to enable opcache you must add "zend_extension=opcache.so" to your PHP.INI file

Grunt Setup (optional)
-----------------------------
Grunt is included with scripts to auto-compile/minify your project's /frontend/ files

1. Install node
2. Install closure (make sure the /grunt/Gruntfile.js file points to closure jar path)
2. Install global npm package by running command `npm install -g grunt-cli`
3. Move into project's /grunt/ folder.
4. Install the grunt dependencies, type `npm install`
5. Run grunt script, type `grunt`