#!/usr/bin/python
import os

# parse cookie
# If key is username and name is not set, drop the old cookie entry.
# Otherwise, keep the old cookie entry.
cookie = []
str = os.environ.get('HTTP_COOKIE') or ""
for item in str.split(';'):
  if '=' not in item:
    cookie += [item]
    continue

  (key, value) = item.split('=', 1)
  if key.strip() != 'username':
    cookie += [item]

# Save our cookie
cookie += ['username = destroyed']

# print header
httpheader = ["Cache-Control: no-cache", "Content-type: text/html"]
for c in cookie:
  httpheader += ['Set-Cookie: %s' % c]
  
print("\n".join(httpheader))
print()

# print html
print("""<html>
<head><title>Python Session Destroyed</title></head>
<body>
<h1>Python Session Destroyed</h1>

<br />
<a href="/cgi-bin/py-sessions-1.py">Session Page 1</a>
<br />
<a href="/cgi-bin/py-sessions-2.py">Session Page 2</a>
<br />
<a href="/py-cgiform.html">CGI Form</a>
<br /><br />

</body>
</html>""")

