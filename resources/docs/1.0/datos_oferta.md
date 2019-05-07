#Oferta::

---

- [Propiedades](#propiedades)
- [Funciones](#funciones)

Modelo de datos usado para las empresas que se **ofertan** dentro de la plataforma.

```php
$oferta = Oferta::find(1);
```

<a name="campos-asociados"></a>

## Propiedades

`asociacion_id` [_int_]

ID de la entidad asociada a la oferta

`user_id` [_int_]

ID del usuario asociado que creó la oferta

`forma_id` [_int_]

ID de la forma jurídica asociada a la oferta

`sector_id` [_int_]

ID del sector de actividad asociada a la oferta

`provincia_id` [_int_]

ID de la provincia asociada a la oferta

`poblacion_id` [_int_]

ID de la población asociada a la oferta

`socios` [_int_] `default:0`

Número de socios en la empresa

`motivo` [_text_]

Motivo de la venta de la empresa

`empleados` [_int_]

Número de empleados en la empresa

`año` [_string_]

Año de constitución de la empresa

`name` [_string_]

Nombre de la empresa

`cif` [_string_] `unico`

CIF/NIF de la empresa.**Obligatorio**

`contact` [_string_]

Nombre de la persona de contacto en la empresa

`contactSurname` [_string_]

Apellidos de la persona de contacto en la empresa

`contactPhone` [_string_]

Teléfono de la persona de contacto en la empresa

`contactEmail` [_string_]

Dirección de email de la persona de contacto en la empresa

`address` [_string_]

Dirección de la empresa

`web` [_string_]

Url de la dirección web de la empresa

`valoracion` [_bigint_]

Valoración económica de la empresa

`endeudamiento` [_string_]

Endeudamiento económico de la empresa

`local` [_boolean_]

Si/No dispone de local propio la empresa.

`active` [_boolean_]

Si la oferta está disponible en la plataforma

`approved` [_boolean_]

Si la oferta está visible en la parte pública en la plataforma

`created_at` [_datetime_]

Devuelve la fecha de creación de la oferta

`updated_at` [_datetime_]

Devuelve la fecha de la última modificación de la oferta

<br/>

```bash
echo $oferta->contactEmail;

->"pedro.lopez@empresa.com"

```

<a name="funciones"></a>

## Funciones

Listado de métodos posibles para las entidades.

| Método                             | Descripción                                                                                                                  |
| :--------------------------------- | :--------------------------------------------------------------------------------------------------------------------------- |
| `usuario()`                        | Devuelve el usuario asociado con la oferta.                                                                                  |
| `asociacion()`                     | Devuelve la entidad que está asociada con la oferta.                                                                         |
| `forma()`                          | Devuelve la forma jurídica que tiene la empresa.                                                                             |
| `sector()`                         | Devuelve el sector de actividad de la empresa.                                                                               |
| `provincia()`                      | Devuelve la provincia de la empresa.                                                                                         |
| `poblacion()`                      | Devuelve la población de la empresa.                                                                                         |
| `inversiones()`                    | Devuelve las posibles inversiones que tiene la oferta.                                                                       |
| `getContactFullNameAttribute()`    | Devuelve el nombre y apellidos de la persona de contacto.                                                                    |
| `NotificacionNuevaOferta()`        | Crea una notificación de **Nueva Oferta** a los Administradores del site y Asesores asociados con la oferta.                 |
| `NotificacionOfertaAprobada()`     | Crea una nueva notificación de **Oferta Aprobada** al usuario que creó la oferta.                                            |
| `NotificacionOfertaRecordatorio()` | Crea una nueva notificación de **Recordatorio** a los Administradores del site, Asesores y usuarios asociados con la oferta. |

Podemos usar el siguiente ejemplo para obtener la población de la oferta.

```php
$oferta->usuario()->get();
```

Nos devolverá una colección con todos los usuarios que tiene la entidad.

```bash
 Illuminate\Database\Eloquent\Collection {#13641
     all: [
       App\User {#11155
         id: 4,
         name: "Pedro",
         surname: "Lopez",
         phone: "666666666",
         email: "pedro.lopez@gmail.com",
         email_verified_at: "2019-03-28 18:15:22",
         LOPD: 1,
         active: 1,
         created_at: "2019-03-28 18:15:13",
         updated_at: "2019-03-28 18:15:13",
       },
     ],
   }
```
