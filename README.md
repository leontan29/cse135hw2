Leon Tan's CSE 135 Site
---

This github contains a website for CSE135.

My name is Leon Tan; I am doing this as a solo project.

Password
--

To access the site or machine:

	- username: grader
	- password: Grader,135

Compression
--

Mod-deflate is enabled on text/html files in apache2.conf. To verify that
it is working, look for HTTP reply header that says: 

    Content-Encoding: gzip


HW1 Links
--

1. [Home Page](http://cse135byleon.site/)

2. [About Page for Leon Tan](http://cse135byleon/members/leontan.html)

3. [Favicon](http://cse135byleon.site/favicon.ico)

4. [Robots.txt](http://cse135byleon.site/rebots.txt)

5. [Hello PHP](http://cse135byleon.site/hello.php)

6. [Report.html(http://cse135byleon.site/report.html)

7. Deployment setup:
   - To make changes:
       . edit html files
       . git commit
       . git push
   - To deploy changes to website:
       . bash deploy.sh
       . The `deploy.sh` script will mirror the website files in this
         github to `/var/www` locally assuming that apacheserves pages
	 out of `/var/www`.

8. User/password: please use grader/Grader,135

9. After enabling mod-deflate in apache2, when we curl with header `Accept-Encoding: gzip`,
   we see reply from the server with `Content-Encoding: gzip`, and we can verify that
   that the `Content-Length` is smaller than the size of the html file requested.
   [Screenshot](http://cse135byleon.site/screenshots.hw1/compression-verify.png)

10. I made changes to `apache2.conf` to return a different `Server` header.
   [Screenshot](http://cse135byleon.site/screenshots.hw1/header-verify.png)


11. [initial-index](http://cse135byleon.site/screenshots.hw1/initial-index.jpg)

12. [modified-index](http://cse135byleon.site/screenshots.hw1/modified-index.png)

13. [validator-initial](http://cse135byleon.site/screenshots.hw1/validator-initial.png)

14. [vhosts-verify](http://cse135byleon.site/screenshots.hw1/vhosts-verify.png)

15. [SSL-verify](http://cse135byleon.site/screenshots.hw1/SSL-verify.png)

16. I elected not to use github deploy. Instead, I used a simple shell script to rsync
    my repo to /var/www.

17. [php-verification](http://cse135byleon.site/screenshots.hw1/php-verification.jpg)

18. [compress-verify](http://cse135byleon.site/screenshots.hw1/compress-verify.png)

19. [header-verify](http://cse135byleon.site/screenshots.hw1/header-verify.png)

20. [error-page](http://cse135byleon.site/screenshots.hw1/error-page.png)

21. [log-verification](http://cse135byleon.site/screenshots.hw1/log-verification.png)

21. [report-verification](http://cse135byleon.site/screenshots.hw1/report-verification.png)
