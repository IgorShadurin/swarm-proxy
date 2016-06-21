# SWARM PHP Proxy
Ethereum SWARM proxy

Add this lines for Apache config (not in .htaccess) where last params are your local files
Alias "/bzzr:/" "D:/web/swarmproxy.loc/bzzr.php"
Alias "/bzz:/" "D:/web/swarmproxy.loc/bzz.php"

=========

RewriteEngine on
# If a directory or a file exists, use it directly


#RewriteRule ^f44327c9a9b5b3723083bf601a4c4607490541c94b3fe84ee0cb19b65f418628/ /index.html
#RewriteRule ^f44327c9a9b5b3723083bf601a4c4607490541c94b3fe84ee0cb19b65f418628/(.*) /$1
#RewriteCond %{REQUEST_URI} ^/test/$
Redirect 301 ^.*$ /proxy$1