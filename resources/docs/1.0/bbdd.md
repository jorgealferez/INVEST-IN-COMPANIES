#Bases de datos

---

- [Tablas](#tablas)

Una vez configurado el archivo de entorno, tendremos que instalar las tablas necesarias dentro de la base de datos especificada en archivo de configuración [`.env`](/docs/{{version}}/configuracion).

```bash
php artisan migrate:fresh --seed
```

Este comando nos crea automáticamente las tablas necesarias para el proyecto e incluirá los datos por defecto en las mismas.

<a name="tablas"></a>

## Tablas



| Tabla                  | Descripción                            |
| :--------------------- | :------------------------------------- |
| asociacion_user        | Relación Entidad-Usuario               |
| asociaciones           | Entidades                              |
| estados_inversores     | Estados posibles de inversor           |
| formas                 | Formas Jurídicas de empresa            |
| inversiones            | Inversiones                            |
| migrations             | Registro de migraciones                |
| notifications          | Notificaciones dentro de la plataforma |
| ofertas                | Ofertas                                |
| password_resets        | Reinicios de contraseñas               |
| poblaciones            | Poblaciones de España                  |
| provincias             | Provincias de España                   |
| role_user              | Relación Role-Usuario                  |
| roles                  | Diferentes Roles de la plataforma      |
| sectores               | Sectores de actividad de empresas      |
| telescope_entries      |
| telescope_entries_tags |
| telescope_monitoring   |
| users                  |


Podemos usar el siguiente ejemplo para obtener los usuarios de la entidad.

```php
$entidad->usuarios()->get();
```

Nos devolverá una colección con todos los usuarios que tiene la entidad.

```bash

=> Illuminate\Database\Eloquent\Collection {#3034
     all: [
       App\User {#3044
         id: 4,
         name: "Antonio",
         surname: "Linares",
         phone: "666666666",
         email: "antonio@gmail.com",
         email_verified_at: "2019-03-28 18:15:22",
         LOPD: 1,
         active: 1,
         created_at: "2019-03-28 18:15:13",
         updated_at: "2019-03-28 18:15:13",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#3030
           asociacion_id: 1,
           user_id: 4,
           created_at: "2019-04-08 21:32:14",
           updated_at: "2019-04-08 21:32:14",
         },
       },
     ],
   }
```
