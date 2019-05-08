#UsuariosController

---

- [index(_$request_)](#indexrequest)
- [create()](#create)
- [store(_$request)](#storerequest)
- [show(_$usuario_,_$tab_,_$request_)](#showusuariotabrequest)
- [profile(_$request_)](#profilerequest)
- [profileUpdate(_$request_)](#profileupdaterequest)
- [update(_$request_)](#updaterequest)
- [updateEstado(_$request_)](#updateestadorequest)
- [updateRol(_$request_)](#updaterolrequest)
- [delete(_$usuario_,_$request_)](#deleteusuariorequest)
- [searchUsuariosByAsociacion(_$request_)](#searchusuariosbyasociacionrequest)
- [searchpoblacionesbyprovincia(_$request_)](#searchpoblacionesbyprovinciarequest)
- [reiniciarPassword(_$email_)](#reiniciarpasswordemail)

Controlador para la páginas y métodos de las _Usuarios_ del panel de administración.

<a name="indexrequest"></a>

## index(_$request_)

Devuelve la página con el listado de _Usuarios_ de la plataforma.

###@Parámetros

Objeto tipo ***Request*** con los campos de búsqueda.

```php
$request->name;
$request->email;
$request->phone;
$request->asociacion_id;
```

<br><br>

<a name="create"></a>

## create()

Devuelve la página el formulario de creación de un usuario.

<br><br>

<a name="storerequest"></a>

## store(_$request)

Almacena los datos enviados por formulario para crear un nuevo usuario. Una vez guardados, redirecciona a la página de listado de usuarios.

###@Parámetros

Objeto tipo ***UsuarioRequest*** con los datos del formulario.

```php
$request->name;
$request->surname;
$request->email;
$request->password;
$request->phone;
$request->role;
```

<br><br>

<a name="showusuariotabrequest"></a>

## show(_$usuario_,_$tab_,_$request_)

Muestra la página con el detalle del usuario.

###@Parámetros

`$usuario`

Objeto tipo ***User*** con los datos del usuario.

`$request->tab`  [_modificar_]

Cadena de texto para obtener el foco sobre una de pestañas.

<br><br>

<a name="profilerequest"></a>

## profile(_$request_)

Muestra la página con el detalle del perfil de usuario logeado.

###@Parámetros

`$usuario`

Objeto tipo ***UsuarioRequest*** con los datos del usuario.

<br><br>

<a name="profileupdaterequest"></a>

## profileUpdate(_$request_)

Modifica los valores del usuario en la página de perfil.

###@Parámetros

`$usuario`

Objeto tipo ***UsuarioRequest*** con los datos modificados del usuario.

<br><br>

<a name="updaterequest"></a>

## update(_$request_)

Actualiza los datos del registro del usuario desde la página de usuarios.

###@Parámetros

`$usuario`

Objeto tipo ***UsuarioRequest*** con los datos modificados del usuario.

<br><br>

<a name="updateestadorequest"></a>

## updateEstado(_$request_)

Actualiza el estado del usuario.

###@Parámetros

`$request`

Objeto tipo ***usuarioRequest*** con los datos de activación y aprobación del usuario.

```php
$request->active = 1; // Activa el usuario.
$request->active = 0; // Desactiva el usuario.
```

<br><br>

<a name="updaterolrequest"></a>

## updateRol(_$request_)

Actualiza el perfil del usuario.

###@Parámetros

`$request`

Objeto tipo ***UsuarioRequest*** con el ID del usuario y el ID de perfil.

```php
$request->id = 2; 
$request->role = 2; // Cambia el Perfil a Asesor
```

<br><br>

<a name="deleteusuariorequest"></a>

## delete(_$usuario_,_$request_)

Desactiva/Activa el usuario de la plataforma.

> {info} El registro no se elimina, se pone el valor 0 en el campo `active`.

###@Parámetros

`$usuario`

Objeto tipo ***User*** con los datos del usuario.

```php
$usuario->id = 3; // ID del usuario actual.
```

`$request`

Valor numérico para activar o desactivar la usuario.

```php
$request->modalborrar_action = 0; // Desactiva la usuario. 
$request->modalborrar_action = 1; // Activa la usuario. 
```

<br><br>

<a name="searchusuariosbyasociacionrequest"></a>

## searchUsuariosByAsociacion(_$request_)

Devuelve un Json con los el listado de usuario que pertenecen a una entidad.

###@Parámetros

`$asociacion`

Objeto tipo ***Asociacion*** con los datos de la entidad.

```json
{
	"usuarios":
		{
			"4":"Pedro"
		},
	"status":true
}
```

<br><br>

<a name="searchpoblacionesbyprovinciarequest"></a>

## searchpoblacionesbyprovincia(_$request_)

Devuelve un Json con los el listado de poblaciones que pertenecen una provincia.

###@Parámetros

`$provincia_id`

Id de la provincia.

```json
{ 
	"poblaciones":
		{
			"1":"Amurrio",
			"2":"Añana",
			"3":"Aramaio",
			"4":"Armiñón"

			....

			}
	"status":true
}
```

<br><br>

<a name="reiniciarpasswordemail"></a>

## reiniciarPassword(_$email_)

Envía un email para el reinicio de contraseña.

###@Parámetros

`$email`

Email del usuario al que se enviará la notificación por Email.
