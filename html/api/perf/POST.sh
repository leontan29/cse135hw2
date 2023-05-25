set -x
curl -i --user leon:gugudog -X POST -d 'json={"page_load_time": 100, "page": "/dummy"}' https://cse135byleon.site/api/perf
