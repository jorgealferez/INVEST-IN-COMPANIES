#PublicController

---

- [index()](#index)
- [quienes()](#quienes)
- [privacidad()](#privacidad)
- [proteccion()](#proteccion)
- [aviso()](#aviso)
- [socio()](#socio)
- [vende(_$request_)](#venderequest)
- [compra(_$request_)](#comprarequest)
- [registro(_$request_)](#registrorequest)
- [buscador(_$request_)](#buscadorrequest)
- [inversion(_$request_)](#inversionrequest)
- [vendeContacto(_$request_)](#vendecontactorequest)

Controlador para la parte pública del site.


<a name="index"></a>

## index()

Devuelve la home del site.

<br><br>

<a name="quienes"></a>

## quienes()

Devuelve la página de Quienes Somos.

<br><br>

<a name="privacidad"></a>

## privacidad()

Devuelve la página de Política de Privacidad.

<br><br>

<a name="proteccion"></a>

## proteccion()

Devuelve la página de Protección de datos.

<br><br>

<a name="aviso"></a>

## aviso()

Devuelve la página de Aviso Legal.

<br><br>

<a name="socio"></a>

## socio()

Devuelve la página de Busca un Socio.

<br><br>

<a name="venderequest"></a>

## vende(_$request_)

Devuelve la página de Vende tu empresa.

<br><br>

<a name="comprarequest"></a>

## compra(_$request_)

Devuelve la página de Compra una empresa.

###@Parámetros

Objeto tipo ***NuevaEmpresaRequest*** con los datos del formulario.

```php
$request->name;
$request->surname;
$request->email;
$request->phone;
$request->password;
$request->password-confirm;
```

<br><br>

<a name="registrorequest"></a>

## registro(_$request_)

Almacena el usuario del formulario con el perfil de `Inversor`.

###@Parámetros

Objeto tipo ***RegistroRequest*** con los datos del formulario.

```php
$request->name;
$request->surname;
$request->email;
$request->phone;
$request->password;
```

<br><br>

<a name="buscadorrequest"></a>

## buscador(_$request_)

Devuelve la página de Buscador de ofertas.

###@Parámetros

Objeto tipo ***Request*** con los datos del formulario.

```php
$request->name;
$request->asociacion_id;
$request->provincia_id;
$request->sector_id;
$request->precio;
```

<br><br>

<a name="inversionrequest"></a>

## inversion(_$request_)

Almacena una nueva inversión en la base de datos, del usuario que ha solicitado información de una empresa.

###@Parámetros

Objeto tipo ***Request*** con los datos del formulario.

```php
$request->oferta_id;
```

<br><br>

<a name="vendecontactorequest"></a>

## vendeContacto(_$request_)

Envía un correo a los administradores con los datos de formulario para iniciar un contacto con la empresa.

###@Parámetros

Objeto tipo ***NuevaEmpresaRequest*** con los datos del formulario.

```php
$request->name;
$request->email;
$request->phone;
```

<br><br>

