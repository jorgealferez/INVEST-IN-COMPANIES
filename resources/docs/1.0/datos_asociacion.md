#Asociacion::

---

- [Propiedades](#propiedades)
- [Funciones](#funciones)

Este modelo de datos es usado para las **Entidades** de la plataforma.

```php
$entidad = Asociacion::find(1);
```

<a name="campos-asociados"></a>

## Propiedades

`name` [_string_]

Devuelve el nombre de la entidad.

`address` [_string_]

Devuelve la dirección de la entidad.

`email` [_string_]

Devuelve la dirección de email de la entidad.

`phone` [_string_]

Devuelve el teléfono de la entidad.

`contact` [_string_]

Devuelve el nombre de la persona de contacto.

`contactSurname` [_string_]

Devuelve los apellidos de la persona de contacto de la entidad.

`contactPhone` [_string_]

Devuelve el teéfono de la persona de contacto de la entidad.

`contactEmail` [_string_]

Devuelve la dirección de email de la persona de contacto de la entidad.

`created_at` [_date_time_]

Devuelve la fecha de creación de la entidad.

`updated_at` [_date_time_]

Devuelve la fecha de la última modificación de la entidad.

`active` [_boolean_]

Devuelve valor del estado de la entidad.

```bash
echo $entidad->name;

->"Gestora de Empresas"

```

<a name="funciones"></a>

## Funciones

Listado de métodos posibles para las entidades.

| Método                                         | Descripción                                                                                               |
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
