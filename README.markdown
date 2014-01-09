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
* [Zend OPcache PHP extension](http://us2.php.net/opcache)
* [GD PHP extension](http://php.net/manual/en/book.image.php)
* [PHP PDO extension with pdo-mysql and pdo-pgsql](http://www.php.net/manual/en/book.pdo.php)
* [cURL PHP extension](http://php.net/manual/en/book.curl.php)

NGINXG Server Clause Setup
-----------------------------
Use a server clause similar to this one, replace <items like this> with your server information.
	
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
```
.
├── php
│   ├── app
│   │   ├── config
│   │   │   ├── config.php
│   │   │   ├── errors.php
│   │   │   └── routes.php
│   │   ├── controllers
│   │   │   └── Soarin
│   │   │       └── Index.php
│   │   ├── logs
│   │   │   ├── errors.log
│   │   │   └── sql.log
│   │   ├── models
│   │   ├── styles
│   │   │   ├── autoload.json
│   │   │   ├── css
│   │   │   ├── images
│   │   │   │   └── soarin.png
│   │   │   ├── js
│   │   │   ├── less
│   │   │   │   ├── assets
│   │   │   │   │   └── bootstrap.less
│   │   │   │   └── master.less
│   │   │   └── libraries
│   │   │       ├── bootstrap
│   │   │       │   ├── css
│   │   │       │   │   ├── bootstrap.css
│   │   │       │   │   ├── bootstrap.production.fix.css
│   │   │       │   │   └── bootstrap-theme.css
│   │   │       │   ├── fonts
│   │   │       │   │   ├── glyphicons-halflings-regular.eot
│   │   │       │   │   ├── glyphicons-halflings-regular.svg
│   │   │       │   │   ├── glyphicons-halflings-regular.ttf
│   │   │       │   │   └── glyphicons-halflings-regular.woff
│   │   │       │   └── js
│   │   │       │       └── bootstrap.js
│   │   │       ├── jquery
│   │   │       │   └── jquery-1.10.2.js
│   │   │       ├── jquery-migrate
│   │   │       │   └── jquery-migrate.js
│   │   │       ├── jquery-ui
│   │   │       │   ├── css
│   │   │       │   │   └── redmond
│   │   │       │   │       ├── images
│   │   │       │   │       │   ├── animated-overlay.gif
│   │   │       │   │       │   ├── ui-bg_flat_0_aaaaaa_40x100.png
│   │   │       │   │       │   ├── ui-bg_flat_55_fbec88_40x100.png
│   │   │       │   │       │   ├── ui-bg_glass_75_d0e5f5_1x400.png
│   │   │       │   │       │   ├── ui-bg_glass_85_dfeffc_1x400.png
│   │   │       │   │       │   ├── ui-bg_glass_95_fef1ec_1x400.png
│   │   │       │   │       │   ├── ui-bg_gloss-wave_55_5c9ccc_500x100.png
│   │   │       │   │       │   ├── ui-bg_inset-hard_100_f5f8f9_1x100.png
│   │   │       │   │       │   ├── ui-bg_inset-hard_100_fcfdfd_1x100.png
│   │   │       │   │       │   ├── ui-icons_217bc0_256x240.png
│   │   │       │   │       │   ├── ui-icons_2e83ff_256x240.png
│   │   │       │   │       │   ├── ui-icons_469bdd_256x240.png
│   │   │       │   │       │   ├── ui-icons_6da8d5_256x240.png
│   │   │       │   │       │   ├── ui-icons_cd0a0a_256x240.png
│   │   │       │   │       │   ├── ui-icons_d8e7f3_256x240.png
│   │   │       │   │       │   └── ui-icons_f9bd01_256x240.png
│   │   │       │   │       └── jquery-ui-1.10.3.custom.css
│   │   │       │   └── jquery-ui-1.10.2.js
│   │   │       ├── jwplayer
│   │   │       │   ├── jwplayer.flash.swf
│   │   │       │   ├── jwplayer.html5.js
│   │   │       │   ├── jwplayer.js
│   │   │       │   └── README.html
│   │   │       ├── less
│   │   │       │   └── less-1.5.1.js
│   │   │       ├── libraries.json
│   │   │       ├── mercury
│   │   │       │   ├── javascripts
│   │   │       │   │   ├── jquery-1.7.js
│   │   │       │   │   ├── mercury_dialogs.js
│   │   │       │   │   ├── mercury.js
│   │   │       │   │   ├── mercury_loader.js
│   │   │       │   │   └── mercury.min.js
│   │   │       │   ├── mercury-icons.psd
│   │   │       │   └── stylesheets
│   │   │       │       ├── mercury.bundle.css
│   │   │       │       └── mercury.css
│   │   │       └── socket.io
│   │   │           └── socket.io.js
│   │   └── views
│   │       └── Soarin
│   │           └── Index.php
│   ├── grunt
│   │   ├── Gruntfile.js
│   │   ├── package.json
│   │   └── tasks
│   │       ├── clean-public.js
│   │       ├── css.js
│   │       ├── images.js
│   │       ├── js.js
│   │       ├── less-to-css.js
│   │       └── libraries.js
│   └── libraries
│       └── soarin
│           ├── boot.php
│           ├── classes
│           │   ├── HTML
│           │   │   └── Head.php
│           │   ├── Log.php
│           │   ├── SQL
│           │   │   └── PDO.php
│           │   └── SQL.php
│           └── router
│               ├── autoloader.php
│               ├── router.php
│               ├── url.php
│               └── zaphpa
│                   ├── plugins
│                   │   ├── MethodOverride.class.php
│                   │   ├── ZaphpaAutoDocumentator.class.php
│                   │   └── ZaphpaCORS.class.php
│                   └── zaphpa.lib.php
├── public
│   ├── 404.html
│   └── index.php
└── README.markdown
```