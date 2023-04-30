#!/usr/bin/python
from datetime import datetime;
import os

print("""Cache-Control: no-cache
Content-type: text/html

<html>
  <head><title>Hello CGI World</title></head>
  <body><h1 align=center>Hello HTML World</h1>
  <hr/>

Leon was here - Hello Python World<br/>
This program was generated at: %s\n<br/>
Your current IP address is: %s<br/>
""" % (
    datetime.now(),
    os.environ.get("REMOTE_ADDR")))


