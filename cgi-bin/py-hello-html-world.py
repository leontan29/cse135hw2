#!/usr/bin/python
from datetime import datetime;
import os

print("""Cache-Control: no-cache
Content-type: text/html

<html>
  <head><title>Hello CGI World</title></head>
  <body>
  <h1>Leon was here - Hello Python!</h1>
  <p>This page was generated with the Python programming language.</p>

  <p>Current time: %s</p>
  <p>Your IP address: %s</p>
""" % (
    datetime.now(),
    os.environ.get("REMOTE_ADDR")))


