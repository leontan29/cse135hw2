Leon's CSE 135 Site
---

This github contains a website for CSE135.

To make changes:

	- edit html files
	- git commit
	- git push


To deploy changes to the website:

	- bash deploy.sh

The `deploy.sh` script will mirror the website files in this github
project to `/var/www` locally assuming that apache serves pages out of
`/var/www`.


Password
--

To access the site:

	- username: myta
	- password: hellothere

To access the machine:

	- username: grader
	- password: Grader,135
