php_flag display_errors on
php_value error_reporting 9999

RewriteEngine On

RewriteBase /secondhome/
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-l
RewriteRule ^(.+)$ index.php?url=$1 [QSA,L]

RewriteRule ^([^/\.]+)/([^/\.]+)?$ url.php?type=$1&id=$2

RewriteRule ^(.+)/(.+)/(.+)$ url_1.php?actionn=$1&idd=$2&name=$3 [QSA,L]


php_flag display_errors on
php_value error_reporting 9999

RewriteEngine On

#RewriteBase /secondhome/



RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-l

RewriteRule ^u/(.+)/(.+)$ url.php?u_id=$1&action=$2 [QSA,L]
RewriteRule ^url/(.+)/(.+)$ url.php?u_id=$1&action=$2 [QSA,L]
RewriteRule ^url.php/(.+)/(.+)$ url.php?u_id=$1&action=$2 [QSA,L]

RewriteRule ^uu/(.+)/(.+)/(.+)$ urll.php?u_id=$1&action=$2&name=$3 [QSA,L]
RewriteRule ^urll.php/(.+)/(.+)/(.+)$ urll.php?u_id=$1&action=$2&name=$3 [QSA,L]

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME}.php -f
RewriteRule ^(.*)$ $0.php

#Return 404 if orginal request is .php
RewriteCond %{THE_REQUEST} "^[^ ]* .*?\.php[? ].*$"
RewriteRule .* - [L,R=404]