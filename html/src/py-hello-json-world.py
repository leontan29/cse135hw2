#!/usr/bin/python
from datetime import datetime;
import os

print("""Cache-Control: no-cache
Content-type: application/json

{
    "message": "Hello World",
    "date": "%s",
    "currentIP": "%s"
}
""" % (
    datetime.now(),
    os.environ.get("REMOTE_ADDR")))


