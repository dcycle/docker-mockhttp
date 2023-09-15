Mock HTTP
=====

A Docker-based mock HTTP service to test microservices and third-party integrations.

Quick setup
-----

    docker run --rm -d -p 8123:80 --name mockhttp dcycle/mockhttp:1

Now visit:

    curl -d "post_b=c&post_a=z" "http://0.0.0.0:8123/a/b/c?d=f&a=b"

The default response is 404 Not found, and the default response is empty, but you can see how to define valid paths below.

However you can now know that http://0.0.0.0:8123/a/b/c?d=f&a=b has been called.

    curl "0.0.0.0:8123/_mockhttp/requests?format=print_r"

(notice that we put $_GET and $_POST parameters in alphabetical order) or

    curl "0.0.0.0:8123/_mockhttp/requests?format=json"

You can also confirm that a specific call was actually made by running

    docker exec mockhttp /bin/bash -c \
      'php check.php /a/b/c?d=f&a=b post_b=c&post_a=z'

This will throw an exception if the request has not been made. If you want to debug why you are getting an exception you can run:

    docker exec mockhttp /bin/bash -c \
      'php check.php /a/b/c?d=f&a=b post_b=c&post_a=z DEBUG'

If you would like to clear requests from memory, you can run:

    curl "0.0.0.0:8123/_mockhttp/clear"

You can now destroy the running container:

    docker kill mockhttp
    docker rm mockhttp

Simulate responses from the server
-----

Let's say that when you POST to the following page:

    curl -d "post_b=c&post_a=z" "http://0.0.0.0:8123/a/b/c?d=f&a=b"

and you want to get a specfic simple response from the server.

You will create a new directory structure []().

Development
-----

If you would like to clone this repo and modify the code, you can create a development environment by running:

    ./scripts/develop.sh

This shares the files between this repo and the container, which is useful for development.

Similar projects
-----

* [Smocker](https://smocker.dev)
* [HTTP Bin](https://httpbin.org)

Resources
-----

* Built with [Dcycle Starterkit PHP](https://github.com/dcycle/starterkit-php)
