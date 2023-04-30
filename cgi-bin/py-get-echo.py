#!/usr/bin/python
import os
import cgi, cgitb

rawquerystring = os.environ.get("QUERY_STRING")

body = []
if os.environ.get("REQUEST_METHOD") == "GET":
  form = cgi.FieldStorage()
  body= ["<li><b>%s</b> = %s</li>" % (key, form[key].value) for key in form]

print("""Cache-Control: no-cache
Content-type: text/html

<html>
  <head><title>GET Request Echo</title></head>
  <body>
    <h1 align=center>GET query string</h1>
    <hr />
    <h3>Raw</h3>
    %s
    <br /><br />
    <h3>Formatted</h3>
    <ul>
    %s
    </ul>
  </body>
</html>
""" % (rawquerystring, "\n".join(body))
)


