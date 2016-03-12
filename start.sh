#!/bin/sh

docker run -d -p 8080:80 --name gtmurmur-cvp-proxy_1 -v /var/www/gtmurmur-cvp-proxy/src:/var/www/html/ gtmurmur-cvp-proxy
