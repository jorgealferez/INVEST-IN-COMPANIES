#Role::

---

- [Propiedades](#propiedades)
- [Funciones](#funciones)
- [Valores](#valores)

Este modelo de datos es usado para los diferentes perfiles de usuario que hay dentro de la plataforma.

> {info} Los posibles roles son datos estáticos de la tabla `roles`.

```php
$role = Role::find(2);
```

<a name="campos-asociados"></a>

## Propiedades

`name` [_string_]

Devuelve el nombre asociado al Role.

`description` [_string_]

Devuelve la descripción del Role.

`created_at` [_date_time_]

Devuelve la fecha de creación de la inversión.

`updated_at` [_date_time_]

Devuelve la fecha de la última modificación de la inversión.

```bash
echo $inversion->user_id;

->"25"

```

<a name="funciones"></a>

## Funciones

Listado de métodos posibles para las entidades.

| Método    | Descripción                                           |
| :-------- | :---------------------------------------------------- |
| `users()` | Devuelve los usuarios que tengan el rol seleccionado. |

Podemos usar el siguiente ejemplo para obtener todos los usuarios con el rol "Asesor".

```php
$role->users()->get();
```

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

<a name="valores"></a>

## Valores

Listado de los diferentes roles de la plataforma.

|   ID   | NAME     | DESCRIPTION               |
| :----: | :------- | :------------------------ |
| **#1** | Admin    | Administrador             |
| **#2** | Asesor   | Responsable de la entidad |
| **#3** | Inversor | Inversores registrados    |

Para obtener un listado de todos los sectores, podemos usar el siguiente comando:

```php
$roles = Role::all();
```

<br>
Nos devuelve una colección de datos con todos las posibles sectores jurídicas de la tabla  `roles`.

```json
Illuminate\Database\Eloquent\Collection {#3061
     all: [
       App\Role {#3054
         id: 1,
         name: "Admin",
         description: "Administrator",
         created_at: "2019-03-28 18:05:27",
         updated_at: "2019-03-28 18:05:27",
       },
       App\Role {#3074
         id: 2,
         name: "Asesor",
         description: "Responsable de la entidad",
         created_at: "2019-03-28 18:05:27",
         updated_at: "2019-03-28 18:05:27",
       },
       App\Role {#3073
         id: 4,
         name: "Inversor",
         description: "Inversores registrados",
         created_at: "2019-03-28 18:05:27",
         updated_at: "2019-03-28 18:05:27",
       },
     ],
   }

	...

   }

```
