#	Configuración


Dentro del directorio donde se ha copiado el proyecto hay un archivo de configuración de entorno llamdao `.env.example`, hacemos una copia y lo renombramos como `.env`. Podemos usar el siguiente comando en Linux para hacer la copia.

---

- [Base de datos](#base-de-datos)
- [Email](#email)
  


```bash
cp .env.example .env
```
<br><br>

Lo primero que tenemos que hacer es generar una clave de propyecto, para ello usamos el comando:

```bash
php artisan key:generate
```
<br><br>
Una vez creada la clave editaremos los valores de configuración del proyecto dentro del archivo `.env`:

```bash
sudo nano .env
```
<br><br>

`APP_NAME` [_InvestinCompanies_]

Nombre de la aplicación.

`APP_ENV` [_`production`_]

Tipo de entorno. 

`APP_KEY` [_`string`_]

La clave generada con el comando anterior.

`APP_URL` [_http://investincompanies.es_]

Url de la aplicación.

`APP_DEBUG` [_false_] [_true_]

Si queremos poner la aplicación en modo depuración de errores.


> {danger} Si se actualizan valores se deberán cambiar también en el archivo `config/app.php` .

<a name="base-de-datos"></a>

## Base de datos

Para crear la conexión con la base de datos podemos editar los siguientes valores dentro del archivo `.env`. <br><br>


`DB_CONNECTION` [_mysql_]

Tipo de conexión servidor BBDD.

`DB_HOST` [_&ast;.&ast;.&ast;.&ast;_] [_localhost_]

Host de conexión.

`DB_PORT` [_3306_]

Puerto de conexión al servidor de base de datos.

`DB_DATABASE` [_InvestBD_]

Nombre de la base de datos.

`DB_USERNAME` [_username_]

Nombre de usuario del servidor de la base de datos.

`DB_PASSWORD` [_userpassword_]

Contraseña usuario del servidor de la base de datos.

> {danger} Si se actualizan valores se deberán cambiar también en el archivo `config/database.php` .

<a name="email"></a>
## Email 

También podemos configurar los datos de acceso al servidor de correo dentro del archivo `.env`.<br><br>

`MAIL_DRIVER` [_smtp_] 

Tipo de conexión con el servidor de correo.

`MAIL_HOST` [_smtp.gmail.com_] [_&ast;.&ast;.&ast;.&ast;_]

Dirección del servidor de correo.

`MAIL_PORT` [_25_] [_587_]

Puerto de conexión al servidor de correo.

`MAIL_USERNAME` [_username_]

Nombre de usuario del servidor de correo.

`MAIL_PASSWORD` [_userpassword_]

Contraseña usuario del servidor de correo.


`MAIL_ENCRYPTION` [_smtp_] [_ssl_]

Tipo de cifrado con el servidor de correo.


> {danger} Si se actualizan valores se deberán cambiar también en el archivo `config/mail.php` .





