Soarin PHP Framework
===========================
PHP as fast as possible

Introduction
-----------------------------

This software is a super lightweight RESTful framework for your future PHP code base. Every attempt has been made to make it as fast as possible (especially if you include all the below extensions properly).

Installation
-----------------------------

1. Setup a server (coming soon)
2. [Setup web software](https://github.com/charleshross/soarin/wiki/Setup-web-server)
3. Setup Soarin (coming soon)

PHP Framework Dependencies
-----------------------------

Required:

* [PHP v5.5.6+](http://www.php.net/)
* [NGINX v1.5.7+](http://nginx.org/)
* [Node.js v0.10.24+](http://www.nodejs.org) with [Grunt v0.4.2+](http://gruntjs.com/)

Optional (gives full features):

* [Redis v2.8.3+](http://redis.io/) with [phpredis PHP Extension](https://github.com/nicolasff/phpredis)
* [PHP Zend OPcache extension](http://us2.php.net/opcache)
* [PHP GD extension](http://php.net/manual/en/book.image.php)
* [PHP PDO extension with pdo-mysql and pdo-pgsql](http://www.php.net/manual/en/book.pdo.php)
* [PHP cURL extension](http://php.net/manual/en/book.curl.php)
* [MySQL v5.6.15+](http://dev.mysql.com/downloads/mysql/)
* [PostgreSQL v9.3+](http://www.postgresql.org/)

NGINXG Server Clause Setup
-----------------------------
Use a server clause similar to this one, replace <items like this> with your server information.
	
	server {

		listen <ip address:port number>;
		server_name <ip:port or domain name>;
		
		root <path to soarin folder>/public;
	    
		# remove when in 'production'
		location ~ \.(jpg|jpeg|png|apng|gif|swf|ico|txt|html|htm|js|css|less|eot|svg|ttf|woff)$ {
			root /;
			try_files <path to soarin folder>/php/app/$uri <path to soarin folder>/public/$uri 404.php;
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

Grunt Setup (needed for full features)
-----------------------------
Grunt is included with scripts to auto-compile/minify your project's /php/styles/ files (css/less/javascript/js libraries)

1. Install node
2. Install Grunt global npm package by running command `npm install -g grunt-cli`
3. Move into framework's Grunt folder `<framework path>/php/grunt/`
4. Install the Grunt dependencies, run command `npm install`
5. Run Soarin Grunt script by typing `grunt`

Framework folder structure
-----------------------------
Directory structure of Soarin

<pre>
Path									  Description									 Constant
----									  -----------									 --------
.
├── <b> php </b>                          parent folder for internal files
│   │   
│   ├── <b> app </b>                      your application folder                        APP
│   │   │   
│   │   ├── <b> config </b>               application config folder
│   │   │   │   
│   │   │   ├── <b> config.php </b>       Soarin config variables files
│   │   │   ├── <b> errors.php </b>       Error code handling file
│   │   │   └── <b> routes.php </b>       Router configuration file
│   │   │   
│   │   ├── <b> controllers </b>          Controllers folder
│   │   │   
│   │   ├── <b> logs </b>                 log files folder
│   │   │   
│   │   ├── <b> models </b>               Models folder                                  MODELS
│   │   │   
│   │   ├── <b> styles </b>               Frontend styles folder                         STYLES
│   │   │   │
│   │   │   ├── <b> autoload.json </b>    library autoload config file
│   │   │   ├── <b> css </b>              CSS file folder
│   │   │   ├── <b> images </b>           static file folder
│   │   │   ├── <b> js </b>               JS file folder
│   │   │   ├── <b> less </b>             LESS file folder
│   │   │   └── <b> libraries </b>        JS Libraries folder
│   │   │   
│   │   └── <b> views </b>                Views folder
│   │   
│   ├── <b> grunt </b>                    grunt script folder (code optimizer)
│   │   
│   └── <b> libraries </b>                php libraries folder                           LIBRARIES
│       │  
│       └── <b> soarin </b>               the soarin framework folder (internals)        SOARIN
│   
└── <b> public </b>                       parent folder for public web files
    │  
    ├── <b> 404.html </b>                 404 file
    └── <b> index.php </b>                entry point file

</pre>