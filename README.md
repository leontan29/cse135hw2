# Leon Tan's CSE 135 Site

This github contains a website for CSE135.

My name is Leon Tan; I am doing this as a solo project.

## Password

To access the site or machine:

	- username: grader
	- password: Grader,135

## Links

[HW1](#hw1)

[HW2](#hw2)

## HW2
(http://cse135byleon.site/screenshots.hw2/

* [perl-cgiform.png](http://cse135byleon.site/screenshots.hw2/perl-cgiform.png)
* [perl-destroy-session.png](http://cse135byleon.site/screenshots.hw2/perl-destroy-session.png)
* [perl-env-pm.png](http://cse135byleon.site/screenshots.hw2/perl-env-pm.png)
* [perl-env.png](http://cse135byleon.site/screenshots.hw2/perl-env.png)
* [perl-general-echo.png](http://cse135byleon.site/screenshots.hw2/perl-general-echo.png)
* [perl-get-echo.png](http://cse135byleon.site/screenshots.hw2/perl-get-echo.png)
* [perl-hello-html-world.png](http://cse135byleon.site/screenshots.hw2/perl-hello-html-world.png)
* [perl-hello-json-world.png](http://cse135byleon.site/screenshots.hw2/perl-hello-json-world.png)
* [perl-post-echo.png](http://cse135byleon.site/screenshots.hw2/perl-post-echo.png)
* [perl-sessions-1.png](http://cse135byleon.site/screenshots.hw2/perl-sessions-1.png)
* [perl-sessions-2.png](http://cse135byleon.site/screenshots.hw2/perl-sessions-2.png)
* [c-cgiform.png](http://cse135byleon.site/screenshots.hw2/c-cgiform.png)
* [c-destroy-session.png](http://cse135byleon.site/screenshots.hw2/c-destroy-session.png)
* [c-env.png](http://cse135byleon.site/screenshots.hw2/c-env.png)
* [c-general-request-echo.png](http://cse135byleon.site/screenshots.hw2/c-general-request-echo.png)
* [c-get-echo.png](http://cse135byleon.site/screenshots.hw2/c-get-echo.png)
* [c-hello-html-world.png](http://cse135byleon.site/screenshots.hw2/c-hello-html-world.png)
* [c-hello-json-world.png](http://cse135byleon.site/screenshots.hw2/c-hello-json-world.png)
* [c-post-echo.png](http://cse135byleon.site/screenshots.hw2/c-post-echo.png)
* [c-sessions-1.png](http://cse135byleon.site/screenshots.hw2/c-sessions-1.png)
* [c-sessions-2.png](http://cse135byleon.site/screenshots.hw2/c-sessions-2.png)
* [ga-dashboard.png](http://cse135byleon.site/screenshots.hw2/ga-dashboard.png)
* [php-cgiform.png](http://cse135byleon.site/screenshots.hw2/php-cgiform.png)
* [php-cookie-sessions-1.png](http://cse135byleon.site/screenshots.hw2/php-cookie-sessions-1.png)
* [php-cookie-sessions-2.png](http://cse135byleon.site/screenshots.hw2/php-cookie-sessions-2.png)
* [php-destroy-cookie-session.png](http://cse135byleon.site/screenshots.hw2/php-destroy-cookie-session.png)
* [php-env.png](http://cse135byleon.site/screenshots.hw2/php-env.png)
* [php-general-echo.png](http://cse135byleon.site/screenshots.hw2/php-general-echo.png)
* [php-get-echo.png](http://cse135byleon.site/screenshots.hw2/php-get-echo.png)
* [php-hello-html-world.png](http://cse135byleon.site/screenshots.hw2/php-hello-html-world.png)
* [php-hello-json-world.png](http://cse135byleon.site/screenshots.hw2/php-hello-json-world.png)
* [php-post-echo.png](http://cse135byleon.site/screenshots.hw2/php-post-echo.png)
* [py-cgiform.png](http://cse135byleon.site/screenshots.hw2/py-cgiform.png)
* [py-destroy-session.png](http://cse135byleon.site/screenshots.hw2/py-destroy-session.png)
* [py-env.png](http://cse135byleon.site/screenshots.hw2/py-env.png)
* [py-general-echo.png](http://cse135byleon.site/screenshots.hw2/py-general-echo.png)
* [py-get-echo.png](http://cse135byleon.site/screenshots.hw2/py-get-echo.png)
* [py-hello-html-world.png](http://cse135byleon.site/screenshots.hw2/py-hello-html-world.png)
* [py-hello-json-world.png](http://cse135byleon.site/screenshots.hw2/py-hello-json-world.png)
* [py-post-echo.png](http://cse135byleon.site/screenshots.hw2/py-post-echo.png)
* [py-sessions-1.png](http://cse135byleon.site/screenshots.hw2/py-sessions-1.png)
* [py-sessions-2.png](http://cse135byleon.site/screenshots.hw2/py-sessions-2.png)

* [ga-dashboard](http://cse135byleon.site/screenshots.hw2/ga-dashboard.png)

* [logrocket](http://cse135byleon.site/screenshots.hw2/logrocket.png)



## HW1

* [Home Page](http://cse135byleon.site/)

* [About Page for Leon Tan](http://cse135byleon/members/leontan.html)

* [Favicon](http://cse135byleon.site/favicon.ico)

* [Robots.txt](http://cse135byleon.site/rebots.txt)

* [Hello PHP](http://cse135byleon.site/hello.php)

* [Report.html(http://cse135byleon.site/report.html)

* Deployment setup:
   - To make changes:
       . edit html files
       . git commit
       . git push
   - To deploy changes to website:
       . bash deploy.sh
       . The `deploy.sh` script will mirror the website files in this
         github to `/var/www` locally assuming that apacheserves pages
	 out of `/var/www`.

* *Username/password*: please use grader/Grader,135

* After enabling mod-deflate in apache2, we curl with header
   `Accept-Encoding: gzip`. Look for `Content-Encoding: gzip` in HTTP
   reply header from the server in this
   [screenshot](http://cse135byleon.site/screenshots.hw1/compression-verify.png).

* I made changes to `apache2.conf` to return a different `Server`
   header.  Look for `Server: CSE135 Server` in the
   [screenshot](http://cse135byleon.site/screenshots.hw1/header-verify.png).

* [initial-index](http://cse135byleon.site/screenshots.hw1/initial-index.jpg)

* [modified-index](http://cse135byleon.site/screenshots.hw1/modified-index.png)

* [validator-initial](http://cse135byleon.site/screenshots.hw1/validator-initial.png)

* [vhosts-verify](http://cse135byleon.site/screenshots.hw1/vhosts-verify.png)

* [SSL-verify](http://cse135byleon.site/screenshots.hw1/SSL-verify.png)

* I elected not to use github deploy. Instead, I used a simple shell script to rsync
    my repo to /var/www.

* [php-verification](http://cse135byleon.site/screenshots.hw1/php-verification.jpg)

* [compress-verify](http://cse135byleon.site/screenshots.hw1/compress-verify.png)

* [header-verify](http://cse135byleon.site/screenshots.hw1/header-verify.png)

* [error-page](http://cse135byleon.site/screenshots.hw1/error-page.png)

* [log-verification](http://cse135byleon.site/screenshots.hw1/log-verification.png)

* [report-verification](http://cse135byleon.site/screenshots.hw1/report-verification.png)
