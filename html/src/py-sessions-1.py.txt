#!/usr/bin/python
import os
import cgi

name = None
if os.environ.get("REQUEST_METHOD") == "POST":
  form = cgi.FieldStorage()
  if 'username' in form:
      name = form['username'].value

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
  if key.strip() == 'username' and not name:
    name = value.strip()
    if name == 'destroyed':
      name = None
  else:
    cookie += [item]

# Save our cookie
cookie += ['username = %s' % (name and name or 'destroyed')]

# print header
httpheader = ["Cache-Control: no-cache", "Content-type: text/html"]
for c in cookie:
  httpheader += ['Set-Cookie: %s' % c]
  
print("\n".join(httpheader))
print()

# print html
print("""<html>
<head><title>Python Sessions</title></head>
<body>
<h1>Python Sessions Page 1</h1>
<p>
<b>Name:</b> %s
</p>

<br />
<a href="/cgi-bin/py-sessions-2.py">Session Page 2</a>
<br />
<a href="/py-cgiform.html">CGI Form</a>
<br /><br />

<form action="/cgi-bin/py-destroy-session.py" method="get">
<button type="submit">Destroy Session</button>
</form>

</body>
</html>""" % (name and name or "You do not have a name set"))

