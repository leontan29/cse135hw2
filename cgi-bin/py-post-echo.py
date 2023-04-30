#!/usr/bin/python
import os
import cgi, cgitb

body = []
if os.environ.get("REQUEST_METHOD") == "POST":
  form = cgi.FieldStorage()
  body= ["<li><b>%s</b> = %s</li>" % (key, form[key].value) for key in form]

print("""Cache-Control: no-cache
Content-type: text/html

<html>
  <head><title>POST Request Echo</title></head>
  <body>
    <h1 align=center>POST Request Echo</h1>
    <hr />
    <h3>Message Body</h3>
    <ul>
       %s
    </ul>
  </body>
</html>
""" % "\n".join(body)
)


