set -x
curl -i --user leon:gugudog -X POST -d 'json={"user_agent": "Dummy", "language": "en-US", "cookie_enabled": 0, "screen_height": 200, "screen_width": 100, "window_height": 200, "window_width": 100, "page": "/dummy"}' https://cse135byleon.site/api/static
