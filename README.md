# speak

<h2>php5.3 ����</h2>
<h2>#nginx����</h2>

<h2>���ݿ⣺speak.sql</h2>
<h2>�����ַ��/index.php/admin/</h2>

<h3>
����Ա��admin
���룺123456
</h3>
<pre>server {
        listen       80;
        server_name  speak.test.cn;
        location / {
            root   D:/nginx_www/speak/public;
            index  index.php index.html index.htm;			
			 if (!-e $request_filename) {
				rewrite ^/(.*)$ /index.php/$1 last;
			}
        }		
		location ~ \.php  {
			root           D:/nginx_www/speak/public;
			fastcgi_pass   127.0.0.1:9010;
			
            fastcgi_index  index.php;
			fastcgi_split_path_info    ^(.+\.php)(/.+)$; 
			fastcgi_param PATH_INFO    $fastcgi_path_info; 		
			
			fastcgi_param PATH_TRANSLATED $document_root$fastcgi_path_info; 
			fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name; 	
			include        fastcgi_params;
        }
        location ~ /\.ht {
            deny  all;
        }
    }</pre>