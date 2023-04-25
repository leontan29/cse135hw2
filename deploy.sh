set -x
#rsync -av collector.cse135byleon.site /var/www
#rsync -av reporting.cse135byleon.site /var/www
rsync -av html /var/www
rsync -av cgi-bin /var/www
