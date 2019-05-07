#Inversion::

---

- [Propiedades](#propiedades)
- [Funciones](#funciones)

Este modelo de datos es usado para las posibles **inversiones** en empresas ofertadas de la plataforma.

```php
$inversion = Inversion::find(1);
```

<a name="campos-asociados"></a>

## Propiedades

`oferta_id` [_string_]

Devuelve el ID de la oferta asociada.

`user_id` [_string_]

Devuelve el ID del usuario que desea realizar la inversión.

`estado_id` [_string_]

Devuelve el ID del estado actual que tiene la inversión.

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

| Método                        | Descripción                                                                                                              |
| :---------------------------- | :----------------------------------------------------------------------------------------------------------------------- |
| `oferta()`                    | Devuelve la oferta asociada a la inversión.                                                                              |
| `usuario()`                   | Devuelve el usuario que realizó la posible inversión.                                                                    |
| `estado()`                    | Devuelve el estado actual de la inversión.                                                                               |
| `NotificacionNuevoInversor()` | Crea una notificación de **Nuevo Inversor** a los administradores, como a los asesores y usuarios asociados a la oferta. |

Podemos usar el siguiente ejemplo para obtener el estado de la inversión.

```php
$inversion->estado->name;

->"Nueva"
```
