...........::::::::README:::::::..............

Configurar Host local para asignar dominio

 - Servidor local Apache (Wamp)
 - En el fichero httpd-vhosts con ruta C:\wamp\bin\apache\apache2.4.54.2\conf\extra\httpd-vhosts
   Se configura el host agregando lo siguiente:
   Dominio asignado (tecnicalaravel.com.devel)

 - Clonar aplicacion del repositorio bajo esta ruta Mejora_Soluciones/api-laravel

# VHOST MEJORAS Y SOLUCIONES
#
<VirtualHost *:80>
  ServerName tecnicalaravel.com.devel
  ServerAlias www.tecnicalaravel.com.devel
  DocumentRoot "C:/wamp/www/Mejora_Soluciones/api-laravel/public"
  <Directory "C:/wamp/www/Mejora_Soluciones/api-laravel/public">
    Options +Indexes +Includes +FollowSymLinks +MultiViews
    AllowOverride All
    Require local
  </Directory>
</VirtualHost>

 - En el fichero hosts con la ruta C:\Windows\System32\drivers\etc\hosts
   agregar la siguiente linea:
   127.0.0.1 tecnicalaravel.com.devel

- Crear base  de datos (mejorasoluciones) MySql

- Ejecutar el script en la base dedatos MySql que se encuentra en el ficheron database.sql

- Reininciar servidor local



