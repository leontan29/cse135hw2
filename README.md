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
