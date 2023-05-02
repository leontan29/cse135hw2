set -x
set -e
rsync -av collector.cse135byleon.site /var/www
rsync -av reporting.cse135byleon.site /var/www
(cd cgi-bin && make)
rsync -av html /var/www
rsync -av cgi-bin /var/www
