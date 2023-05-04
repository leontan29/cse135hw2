#!/usr/bin/python
import os
import cgi, cgitb

post = []
if os.environ.get("REQUEST_METHOD") == "POST":
  form = cgi.FieldStorage()
  post = ["<li><b>%s</b> = %s</li>" % (key, form[key].value) for key in form]

query = []
if os.environ.get("REQUEST_METHOD") == "GET":
  form = cgi.FieldStorage()
  query = ["<li><b>%s</b> = %s</li>" % (key, form[key].value) for key in form]

proto = os.environ.get('SERVER_PROTOCOL')
method = os.environ.get('REQUEST_METHOD')

print("""Cache-Control: no-cache
Content-type: text/html

<!DOCTYPE html>
<html>
  <head>
    <title>General Request Echo</title>
  </head>
  <body>
    <h1 align='center'>General Request Echo</h1>
    <hr>

    <p><b>HTTP Protocol:</b> %s</p>
    <p><b>HTTP Method:</b> %s</p>
    <p><b>Query:</b></p>
    <ul>
      %s
    </ul>
    <p><b>Message Body:</b></p>
    <ul>
      %s
    </ul>
  </body>
</html>
""" % (proto, method, "\n".join(query), "\n".join(post))
)


