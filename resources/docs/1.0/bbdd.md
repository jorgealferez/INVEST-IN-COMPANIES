#Bases de datos

---

- [Tablas](#tablas)

Una vez configurado el archivo de entorno, tendremos que instalar las tablas necesarias dentro de la base de datos especificada en archivo de configuración [`.env`](/docs/{{version}}/configuracion).

```bash
php artisan migrate:fresh --seed
```

Este comando nos crea automáticamente las tablas necesarias para el proyecto.

<a name="tablas"></a>

## Tablas



| Tabla                                          | Descripción                                                                                               |
| :--------------------------------------------- | :-------------------------------------------------------------------------------------------------------- |
| `usuarios()`                                   | Lista los usuarios que pertenecen a la entidad.                                                           |
| `asesores()`                                   | Lista los Asesores que pertenecen a la entidad.                                                           |
| `gestores()`                                   | Lista los Gestores que pertenecen a la entidad.                                                           |
| `ofertas()`                                    | Listado de ofertas que hay dentro de la entidad.                                                          |
| `getUsers()`                                   | Lista los usuarios que pertenecen a la entidad en forrmato Array.                                         |
| `Asociacion()`                                 | Listado de ID's de todas las entidades en formato Array.                                                  |
| `getFullNameAttribute()`                       | Devuelve el nombre y apellidos de la persona de contacto.                                                 |
| `NotificacionNuevaAsociacion()`                | Crea una notificación de **Nueva entidad** a los Administradores del site.                                |
| `NotificacionEliminadoDeLaAsociacion(array())` | Crea una nueva notificación de **Eliminación de Usuario** al listado de usuarios enviados como parámetro. |
| `NotificacionNuevoEnLaAsociacion(array())`     | Crea una nueva notificación de **Nuevo de Usuario** a los usuarios enviados como parámetro.               |

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
