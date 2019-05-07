#Asociacion::

---

- [Propiedades](#propiedades)
- [Funciones](#funciones)

Este modelo de datos es la gestión de **Usuarios** de la plataforma.


```php
$usuario = User::find(1);
```

<a name="campos-asociados"></a>

## Propiedades

`name` [_string_]

Devuelve el nombre del usuario.

`surname` [_string_]

Devuelve el apellido del usuario.

`phone` [_string_]

Devuelve el teléfono del usuario.

`email` [_string_]

Devuelve la dirección de email del usuario.


`active` [_boolean_]

Devuelve el estado del usuario true/false (activo/eliminado).


`created_at` [_date_time_]

Devuelve la fecha de creación del usuario.

`updated_at` [_date_time_]

Devuelve la fecha de la última modificación del usuario.


```bash
echo $usuario->name;

->"Pedro"

```

> {info} Las tabla `role_user` gestiona las asociaciones de usuario con su perfil.

<a name="funciones"></a>

## Funciones

Listado de métodos posibles para los usuarios.

| Método                                                   | Descripción                                                                                      |
| :------------------------------------------------------- | :----------------------------------------------------------------------------------------------- |
| `roles()`                                                | Lista los role/s del usuario.                                                                    |
| `authorizeRoles(array())`                                | Devuelve verdadero si el usuario tiene asignado un rol autorizado.Si no devuelve un error 404.   |
| `hasAnyRole(array())`                                    | Devuelve verdadero si el usuario tiene un rol del aaray pasado como parámetro asignado.          |
| `hasRole(array())`                                       | Devuelve verdaero .                                                                              |
| `asociaciones()`                                         | Lista las entidades a las que pertence el usuario.                                               |
| `getFullNameAttribute()`                                 | Devuelve el nombre y apellidos del usuario.                                                      |
| `ofertas()`                                              | Devuelve el listado de ofertas que ha publicado el usuario.                                      |
| `inversiones()`                                          | Devuelve las inversiones que ha relizado el usuario.                                             |
| `isAdmin()`                                              | Devuelve verdadero si el usuario tiene perfil Administrador.                                     |
| `isAsesor()`                                             | Devuelve verdadero si el usuario tiene perfil Asesor.                                            |
| `isGestor()`                                             | Devuelve verdadero si el usuario tiene perfil Gestor.                                            |
| `isInversor()`                                           | Devuelve verdadero si el usuario tiene perfil Inversor.                                          |
| `getRoleClass()`                                         | Devuelve las dos primeras letras del nombre del perfil del usuario.                              |
| `statusClass()`                                          | Devuelve el nombre de la clase asignada al role del usuario.                                     |
| `statusName()`                                           | Devuelve una cadena de texto con el estado del usuario.                                          |
| `getAsociacionesDelUsario()`                             | Devuelve el listado de ID's de las entidades que ha publicado el usuario.                        |
| `permisoOferta($oferta_id)`                              | Devuelve verdadero si el usuario tiene permisos en la oferta pasada como parámetro .             |
| `asociacionesDisponiblesByRole()`                        | Devuelve el listado de asociaciones posibles con el Rol del usuario.                             |
| `usuariosDeMiAsociacion()`                               | Devuelve un listado de usuarios que tiene asignado a la que pertence el usuario.                 |
| `getUsersFromThisAsociacion()`                           | Devuelve un listado de ID's de usuarios que tiene asignado la entidad a la que pertence usuario. |
| `NotificacionNuevoUsuario()`                             | Crea una notificación de **Nuevo Usuario** a los Administradores del site.                       |
| `NotificacionNuevoUsuarioVerificado()`                   | Envia una notificación de **Usuario verificado** cuando el usuario ha verificado su email.       |
| `sendPasswordResetNotification($user_token)`             | Crea una notificación de **Reseteo de Password** al usuario.                                     |
| `sendPasswordResetNotificationConfirmacion($user_token)` | Crea una notificación de **Confirmación de cambio de Password** al usuario.                      |


Podemos usar el siguiente ejemplo para obtener los usuarios del usuario.

```php
$usuario->roles()->get();
```

Nos devolverá una colección con todos los usuarios que tienel usuario.

```bash

=> Illuminate\Database\Eloquent\Collection {#172
     all: [
       App\Role {#3048
         id: 1,
         name: "Admin",
         description: "Administrator",
         created_at: "2019-03-28 18:05:27",
         updated_at: "2019-03-28 18:05:27",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#3040
           user_id: 1,
           role_id: 1,
           created_at: "2019-03-28 18:05:52",
           updated_at: "2019-03-28 18:05:52",
         },
       },
     ],
```
