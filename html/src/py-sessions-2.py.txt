#!/usr/bin/python
import os

name = None
httpheader = ["Cache-Control: no-cache", "Content-type: text/html"]

# parse cookie
str = os.environ.get('HTTP_COOKIE') or ""
for item in str.split(';'):
  httpheader += ["Set-Cookie: %s" % item]
  if '=' in item:
    (key, value) = item.split('=', 1)
    if key.strip() == 'username':
      name = value.strip()
      if name == 'destroyed':
        name = None
  
# print header
print("\n".join(httpheader))
print()

# print html
print("""<html>
<head><title>Python Sessions</title></head>
<body>
<h1>Python Sessions Page 2</h1>
<p>
<b>Name:</b> %s
</p>

<br />
<a href="/cgi-bin/py-sessions-1.py">Session Page 1</a>
<br />
<a href="/py-cgiform.html">CGI Form</a>
<br /><br />

<form action="/cgi-bin/py-destroy-session.py" method="get">
<button type="submit">Destroy Session</button>
</form>

</body>
</html>""" % (name and name or "You do not have a name set"))

