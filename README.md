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

[HW3](#hw3)

[HW4](#hw4)


## HW4
* Site Links
  - [Live](http://reporting.cse135byleon.site/)

* Login Info for graders
  - For site access, username: <em>grader</em>. Password: <em>Grader,135</em>
  - For regular grader login, username: <em>grader</em>, Password: (same as above).
  - For admin grader login, username: <em>graderadmin</em>, Password: (same as above).

* Design decisions
  - I used PHP as the scripting language for the backend and Javascript as front-end.
  - The database is a local mysql database.

  - For authentication, I store only hashed password in the Users
    table. On login, I authenticate the password like this: <em>if
    (password_verify($password, $storedHashedPassword)) then SUCCESS
    else FAILED.</em>

  - If authentication was successful, I store the <em>identifier</em>
    (which may be either username or email), and a <em>is_admin</em>
    flag in the <em>_SESSION[]</em> provided by PHP-session. Pages
    that are accessible by authorized users only must check to see if
    <em>_SESSION["identifier"]</em> is set. Pages that are accessible
    by admin users only must check the flag
    <em>_SESSION["is_admin"]</em>. At logout, I simply destroy the
    session.

  - For the dashboard, I created 3 charts:
  
      1. Hourly Users: This line-chart shows the #users on the site
      over 24-hour period. It tells you when the machine is most busy
      and most free.

      2. This Week Hourly Errors: This bar-chart shows the number of
      errors that have occured at users' end. If you pushed out a
      buggy release, you will likely see a spike right after you
      deployed the new code.

      3. User Agents: This pie-chart indicates which browser your
      customers are using. You may want to tune your javascript to
      work nicely with the popular browsers.

  - For the report, I used the Hourly Users Chart to determine when is
    the best time in the day to shutdown the machines for maintenance.

* Source Code
  - [login]

## HW3
* Site Links
  - [Live](http://cse135byleon.site/)
  - [database.html](http://cse135byleon.site/database.html)
  - [hellodataviz.html](http://cse135byleon.site/hellodataviz.html)

* Source Code
  - [database.html](https://github.com/leontan29/cse135hw2/blob/main/html/database.html)
  - [hellodataviz.html](https://github.com/leontan29/cse135hw2/blob/main/html/hellodataviz.html)
  - [collector.js](https://github.com/leontan29/cse135hw2/blob/main/html/collector.js)
  - REST Handlers for Static Data: [api/static/index.php](https://github.com/leontan29/cse135hw2/blob/main/html/api/static/index.php)
  - REST Handlers for Perf Data: [api/perf/index.php](https://github.com/leontan29/cse135hw2/blob/main/html/api/perf/index.php)
  - Rest Handlers for Activity Data: [api/activity/index.php](https://github.com/leontan29/cse135hw2/blob/main/html/api/activity/index.php)
  - DB Access Functions: [api/lib/helper.php](https://github.com/leontan29/cse135hw2/blob/main/html/api/lib/helper.php)
  - Generic REST Handlers: [api/lib/rest.php](https://github.com/leontan29/cse135hw2/blob/main/html/api/lib/rest.php)
* Media
  - [postman.png](https://github.com/leontan29/cse135hw2/blob/main/html/screenshots.hw3/postman.png)
  - [REST.png](https://github.com/leontan29/cse135hw2/blob/main/html/screenshots.hw3/REST.png)
  - [database.png](https://github.com/leontan29/cse135hw2/blob/main/html/screenshots.hw3/database.png)
  - [routes.pdf](https://github.com/leontan29/cse135hw2/blob/main/html/screenshots.hw3/routes.pdf)
  

## HW2
* [perl-hello-html-world.png](http://cse135byleon.site/screenshots.hw2/perl-hello-html-world.png)
* [perl-hello-json-world.png](http://cse135byleon.site/screenshots.hw2/perl-hello-json-world.png)
* [perl-env.png](http://cse135byleon.site/screenshots.hw2/perl-env.png)
* [perl-env-pm.png](http://cse135byleon.site/screenshots.hw2/perl-env-pm.png)
* [perl-get-echo.png](http://cse135byleon.site/screenshots.hw2/perl-get-echo.png)
* [perl-post-echo.png](http://cse135byleon.site/screenshots.hw2/perl-post-echo.png)
* [perl-general-echo.png](http://cse135byleon.site/screenshots.hw2/perl-general-echo.png)
* [perl-cgiform.png](http://cse135byleon.site/screenshots.hw2/perl-cgiform.png)
* [perl-sessions-1.png](http://cse135byleon.site/screenshots.hw2/perl-sessions-1.png)
* [perl-sessions-2.png](http://cse135byleon.site/screenshots.hw2/perl-sessions-2.png)
* [perl-destroy-session.png](http://cse135byleon.site/screenshots.hw2/perl-destroy-session.png)

* [c-hello-html-world.png](http://cse135byleon.site/screenshots.hw2/c-hello-html-world.png)
* [c-hello-json-world.png](http://cse135byleon.site/screenshots.hw2/c-hello-json-world.png)
* [c-env.png](http://cse135byleon.site/screenshots.hw2/c-env.png)
* [c-get-echo.png](http://cse135byleon.site/screenshots.hw2/c-get-echo.png)
* [c-post-echo.png](http://cse135byleon.site/screenshots.hw2/c-post-echo.png)
* [c-general-request-echo.png](http://cse135byleon.site/screenshots.hw2/c-general-request-echo.png)
* [c-cgiform.png](http://cse135byleon.site/screenshots.hw2/c-cgiform.png)
* [c-sessions-1.png](http://cse135byleon.site/screenshots.hw2/c-sessions-1.png)
* [c-sessions-2.png](http://cse135byleon.site/screenshots.hw2/c-sessions-2.png)
* [c-destroy-session.png](http://cse135byleon.site/screenshots.hw2/c-destroy-session.png)

* [php-hello-html-world.png](http://cse135byleon.site/screenshots.hw2/php-hello-html-world.png)
  - source [php-hello-html-world.php.txt](http:/cse135byleon.site/src/php-hello-html-world.php.txt) 
* [php-hello-json-world.png](http://cse135byleon.site/screenshots.hw2/php-hello-json-world.png)
  - source [php-hello-json-world.php.txt](http:/cse135byleon.site/src/php-hello-json-world.php.txt) 
* [php-env.png](http://cse135byleon.site/screenshots.hw2/php-env.png)
  - source [php-env.php.txt](http:/cse135byleon.site/src/php-env.php.txt) 
* [php-get-echo.png](http://cse135byleon.site/screenshots.hw2/php-get-echo.png)
  - source [php-get-echo.php.txt](http:/cse135byleon.site/src/php-get-echo.php.txt) 
* [php-post-echo.png](http://cse135byleon.site/screenshots.hw2/php-post-echo.png)
  - source [php-post-echo.php.txt](http:/cse135byleon.site/src/php-post-echo.php.txt) 
* [php-general-echo.png](http://cse135byleon.site/screenshots.hw2/php-general-echo.png)
  - source [php-general-echo.php.txt](http:/cse135byleon.site/src/php-general-echo.php.txt)
* [php-cgiform.png](http://cse135byleon.site/screenshots.hw2/php-cgiform.png)
* [php-cookie-sessions-1.png](http://cse135byleon.site/screenshots.hw2/php-cookie-sessions-1.png)
  - source [php-cookie-sessions-1.php.txt](http:/cse135byleon.site/src/php-cookie-sessions-1.php.txt)
* [php-cookie-sessions-2.png](http://cse135byleon.site/screenshots.hw2/php-cookie-sessions-2.png)
  - source [php-cookie-sessions-2.php.txt](http:/cse135byleon.site/src/php-cookie-sessions-2.php.txt)
* [php-destroy-cookie-session.png](http://cse135byleon.site/screenshots.hw2/php-destroy-cookie-session.png)
  - source [php-destroy-cookie-session.php.txt](http:/cse135byleon.site/src/php-destroy-cookie-session.php.txt)
* [php-URL-sessions-1.png](http://cse135byleon.site/screenshots.hw2/php-URL-sessions-1.png)
  - source [php-URL-sessions-1.php.txt](http:/cse135byleon.site/src/php-URL-sessions-1.php.txt)
* [php-URL-sessions-2.png](http://cse135byleon.site/screenshots.hw2/php-URL-sessions-2.png)
  - source [php-URL-sessions-2.php.txt](http:/cse135byleon.site/src/php-URL-sessions-2.php.txt)

* [py-hello-html-world.png](http://cse135byleon.site/screenshots.hw2/py-hello-html-world.png)
  - source [py-hello-html-world.py.txt](http://cse135byleon.site/src/py-hello-html-world.py.txt)
* [py-hello-json-world.png](http://cse135byleon.site/screenshots.hw2/py-hello-json-world.png)
  - source [py-hello-json-world.py.txt](http://cse135byleon.site/src/py-hello-json-world.py.txt)
* [py-env.png](http://cse135byleon.site/screenshots.hw2/py-env.png)
  - source [py-env.py.txt](http://cse135byleon.site/src/py-env.py.txt)
* [py-get-echo.png](http://cse135byleon.site/screenshots.hw2/py-get-echo.png)
  - source [py-get-echo.py.txt](http://cse135byleon.site/src/py-get-echo.py.txt)
* [py-post-echo.png](http://cse135byleon.site/screenshots.hw2/py-post-echo.png)
  - source [py-post-echo.py.txt](http://cse135byleon.site/src/py-post-echo.py.txt)
* [py-general-echo.png](http://cse135byleon.site/screenshots.hw2/py-general-echo.png)
  - source [py-general-echo.py.txt](http://cse135byleon.site/src/py-general-echo.py.txt)
* [py-cgiform.png](http://cse135byleon.site/screenshots.hw2/py-cgiform.png)
* [py-sessions-1.png](http://cse135byleon.site/screenshots.hw2/py-sessions-1.png)
  - source [py-sessions-1.py.txt](http://cse135byleon.site/src/py-sessions-1.py.txt)
* [py-sessions-2.png](http://cse135byleon.site/screenshots.hw2/py-sessions-2.png)
  - source [py-sessions-2.py.txt](http://cse135byleon.site/src/py-sessions-2.py.txt)
* [py-destroy-session.png](http://cse135byleon.site/screenshots.hw2/py-destroy-session.png)
  - source [py-destroy-session.py.txt](http://cse135byleon.site/src/py-destroy-session.py.txt)

* [ga-dashboard](http://cse135byleon.site/screenshots.hw2/ga-dashboard.png)

* [logrocket](http://cse135byleon.site/screenshots.hw2/logrocket.png)





## HW1

* [Home Page](http://cse135byleon.site/)

* [About Page for Leon Tan](http://cse135byleon.site/members/leontan.html)

* [Favicon](http://cse135byleon.site/favicon.ico)

* [Robots.txt](http://cse135byleon.site/robots.txt)

* [Hello PHP](http://cse135byleon.site/hello.php)

* [Report.html](http://cse135byleon.site/report.html)

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
    my repo to `/var/www`.

* [php-verification](http://cse135byleon.site/screenshots.hw1/php-verification.jpg)

* [compress-verify](http://cse135byleon.site/screenshots.hw1/compress-verify.png)

* [header-verify](http://cse135byleon.site/screenshots.hw1/header-verify.png)

* [error-page](http://cse135byleon.site/screenshots.hw1/error-page.png)

* [log-verification](http://cse135byleon.site/screenshots.hw1/log-verification.png)

* [report-verification](http://cse135byleon.site/screenshots.hw1/report-verification.png)
