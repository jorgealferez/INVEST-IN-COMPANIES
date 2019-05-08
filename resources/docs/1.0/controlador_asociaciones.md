#AsociacionesController

---

- [index(_$request_)](#indexrequest)
- [create()](#create)
- [store(_$request)](#storerequest)
- [show(_$asociacion_,_$tab_,_$request_)](#showasociaciontabrequest)
- [update(_$request_,_$tab)](#updaterequesttab)
- [updateUsers(_$request_)](#updateusersrequest)
- [delete(_$asociacion,_$request_)](#deleteasociacionrequest)

Controlador para la páginas y métodos de las _Entidades_ del panel de administración.

<a name="indexrequest"></a>

## index(_$request_)

Devuelve la página con el listado de _Entidades_ de la plataforma.

###@Parámetros

Objeto tipo ***Request*** con los campos de búsqueda.

```php
$request->name;
$request->phone;
$request->email;
$request->address;
```

<br><br>

<a name="create"></a>

## create()

Devuelve la página el formulario de creación de entidad.

<br><br>

<a name="storerequest"></a>

## store(_$request)

Almacena los datos enviados por formulario para crear una nueva entidad. Una vez guardados, redirecciona a la página de listado de entidades.

###@Parámetros

Objeto tipo ***AsociacionRequest*** con los datos del formulario.

```php
$request->name;
$request->address;
$request->email;
$request->phone;

$request->contact;
$request->contactSurname;
$request->contactEmail;
$request->contactPhone;
```

<br><br>

<a name="showasociaciontabrequest"></a>

## show(_$asociacion_,_$tab_,_$request_)

Muestra la página con el detalle de la entidad.

###@Parámetros

`$asociacion`

Objeto tipo ***Asociacion*** con los datos de la entidad.

`$tab` [_usuarios_]

Cadena de texto para obtener el foco sobre una de pestañas.

`$request->tab`  [_usuarios_]

Cadena de texto para obtener el foco sobre una de pestañas.

<br><br>

<a name="updaterequesttab"></a>

## update(_$request_,_$tab)

Actualiza los datos del registro para la entidad seleccionada.

###@Parámetros

`$request`

Objeto tipo ***AsociacionRequest*** con los datos modificados de la entidad.

```php
$request->name;
$request->address;
$request->email;
$request->phone;

$request->contact;
$request->contactSurname;
$request->contactEmail;
$request->contactPhone;
```

`$tab` [_usuarios_]

Cadena de texto para obtener el foco sobre una de pestañas.

<br><br>

<a name="updateusersrequest"></a>

## updateUsers(_$request_)

Actualiza los usuarios que pertenecen a la entidad.

###@Parámetros

`$request`

Array con los ID's de los usuarios que pertenecen a la entidad.

```php
$request->id = 3; // ID de la entidad actual.
$request->usuarios = 
	array(
        25,
        32,
    	1
);
```

`$tab` [_usuarios_]

Cadena de texto para obtener el foco sobre una de pestañas.

<br><br>

<a name="updateusersrequest"></a>

## delete(_$asociacion,_$request_)

Desactiva/Activa la asociación de la plataforma.

> {info} El registro no se elimina, se pone el valor 0 en el campo `active`.

###@Parámetros

`$asociacion`

Objeto tipo ***Asociacion*** con los datos de la entidad.

```php
$asociacion->id = 3; // ID de la entidad actual.
```

`$request`

Valor numérico para activar o desactivar la entidad.

```php
$request->modalborrar_action = 0; // Desactiva la entidad. 
$request->modalborrar_action = 1; // Activa la entidad. 
```
