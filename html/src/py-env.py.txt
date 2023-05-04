#!/usr/bin/python
import os

envarr = [("<b>%s</b> = %s" % (key, os.environ[key])) for key in os.environ]

print("""Cache-Control: no-cache
Content-type: text/html

<html>
  <head><title>Environment Variables</title></head>
  <body>
    <h1 align=center>Environment Variables</h1>
    <hr />
    %s
  </body>
</html>
""" % "<br />\n".join(envarr))


