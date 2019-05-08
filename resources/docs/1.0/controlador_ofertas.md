#OfertasController

---

- [index(_$request_)](#indexrequest)
- [create()](#create)
- [store(_$request)](#storerequest)
- [show(_$oferta_,_$request_)](#showofertarequest)
- [update(_$request_,_$tab)](#updaterequesttab)
- [updateEstado(_$request_)](#updateestadorequest)
- [updateEstadoInversor(_$request_)](#updateestadoinversorrequest)
- [delete(_$oferta_,_$request_)](#deleteofertarequest)
- [convierteNUM(_$valor_)](#conviertenumvalor)

Controlador para la páginas y métodos de las _Ofertas_ del panel de administración.

<a name="indexrequest"></a>

## index(_$request_)

Devuelve la página con el listado de _Ofertas_ de la plataforma.

###@Parámetros

Objeto tipo ***Request*** con los campos de búsqueda.

```php
$request->name;
$request->cif;
$request->provincia_id;
$request->asociacion_id;
```

<br><br>

<a name="create"></a>

## create()

Devuelve la página el formulario de creación de una oferta.

<br><br>

<a name="storerequest"></a>

## store(_$request)

Almacena los datos enviados por formulario para crear una nueva oferta. Una vez guardados, redirecciona a la página de listado de ofertas.

###@Parámetros

Objeto tipo ***OfertaRequest*** con los datos del formulario.

```php
$request->name;
$request->descripcion;

$request->cif;
$request->año;
$request->forma_id;
$request->socios;
$request->empleados;
$request->motivo;
$request->sector_id;
$request->local;
$request->address;
$request->provincia_id;
$request->poblacion_id;
$request->web;
$request->valoracion;
$request->endeudamiento;

$request->asociacion_id;
$request->user_id;


$request->contact;
$request->contactSurname;
$request->contactEmail;
$request->contactPhone;
```

<br><br>

<a name="showofertarequest"></a>

## show(_$oferta_,_$request_)

Muestra la página con el detalle de la oferta.

###@Parámetros

`$oferta`

Objeto tipo ***Oferta*** con los datos de la oferta.

`$request->tab`  [_inversores_]

Cadena de texto para obtener el foco sobre una de pestañas.

<br><br>

<a name="updaterequesttab"></a>

## update(_$request_,_$tab)

Actualiza los datos del registro para la oferta seleccionada.

###@Parámetros

`$request`

Objeto tipo ***OfertaRequest*** con los datos modificados de la entidad.

`$tab` [_inversores_]

Cadena de texto para obtener el foco sobre una de pestañas.

<br><br>

<a name="updateestadorequest"></a>

## updateEstado(_$request_)

Actualiza el estado de la oferta.

###@Parámetros

`$request`

Objeto tipo ***OfertaRequest*** con los datos de activación y aprobación de la oferta.

```php
$request->approved = 1; // Aprueba la oferta.
$request->active = 0; // Desactiva la oferta.
```

<br><br>

<a name="updateestadoinversorrequest"></a>

## updateEstadoInversor(_$request_)

Actualiza el estado de la inversión.

###@Parámetros

`$request`

Objeto tipo ***OfertaRequest*** con el ID de estado de la inversión.

```php
$request->estado_id = 2; // En proceso.
```

<br><br>

<a name="deleteofertarequest"></a>

## delete(_$oferta_,_$request_)

Desactiva/Activa la oferta de la plataforma.

> {info} El registro no se elimina, se pone el valor 0 en el campo `active`.

###@Parámetros

`$oferta`

Objeto tipo ***Oferta*** con los datos de la oferta.

```php
$oferta->id = 3; // ID de la oferta actual.
```

`$request`

Valor numérico para activar o desactivar la oferta.

```php
$request->modalborrar_action = 0; // Desactiva la oferta. 
$request->modalborrar_action = 1; // Activa la oferta. 
```

<br><br>

<a name="conviertenumvalor"></a>

## convierteNUM(_$valor_)

Convierte un valor en formato de Moneda española.

###@Parámetros

`$valor`

Número en formato ###.##

```php
$numero = 1500.36
echo $oferta->convierteNUM($numero); // Devuelve 1.500,36
```
