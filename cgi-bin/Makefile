EXEC = c-destroy-session.cgi \
	c-env.cgi \
	c-general-request-echo.cgi \
	c-get-echo.cgi \
	c-hello-html-world.cgi \
	c-hello-json-world.cgi \
	c-post-echo.cgi \
	c-sessions-1.cgi \
	c-sessions-2.cgi

all: $(EXEC)


c-destroy-session.cgi: c-destroy-session.c
	gcc -o $@ $^

c-env.cgi: c-env.c
	gcc -o $@ $^

c-general-request-echo.cgi: c-general-request-echo.c
	gcc -o $@ $^

c-get-echo.cgi: c-get-echo.c
	gcc -o $@ $^

c-hello-html-world.cgi: c-hello-html-world.c
	gcc -o $@ $^

c-hello-json-world.cgi: c-hello-json-world.c
	gcc -o $@ $^

c-post-echo.cgi: c-post-echo.c
	gcc -o $@ $^

c-sessions-1.cgi: c-sessions-1.c
	gcc -o $@ $^

c-sessions-2.cgi: c-sessions-2.c
	gcc -o $@ $^


