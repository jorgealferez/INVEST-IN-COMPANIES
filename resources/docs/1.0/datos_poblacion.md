#Poblacion::

---

- [Propiedades](#propiedades)
- [Valores](#valores)

Modelo de datos usado para la asignación de la poblacion donde está ubicada una empresa. Las poblaciones únicamente son válidas para el territorio Español.

> {info} Las posibles poblaciones son datos estáticos de la tabla `poblaciones`.

<a name="propiedades"></a>

## Propiedades

`provincia_id` [_int_]

Devuelve el id de la provincia asociada a la población.

`name` [_string_]

Devuelve el nombre la poblacion.

`slug` [_string_]

Devuelve el nombre la poblacion acortado en formato URL.

`latitud` [_string_]

Devuelve la latitud de la población.

`longitud` [_string_]

Devuelve la longitud de la población.

```bash
$poblacion = Poblacion::find(28);
echo $poblacion->name;

->"Lantarón"

```

<a name="valores"></a>

## Valores

Listado de las posibles poblaciones de una empresa.

> {danger} El número de registros es mayor de 8.000, su consulta puede ser muy lenta.

|    ID    | PROVINCIA_ID | NAME        | SLUG        | LATITUD    | LONGITUD   |
| :------: | :----------: | ----------- | ----------- | ---------- | ---------- |
|  **1**   |      1       | Amurrio     | amurrio     | 43.0526489 | -3.0010217 |
|  **2**   |      2       | Añana       | aana        | 42.802352  | -2.982607  |
|   ...    |
| **4426** |      28      | Tres Cantos | tres-cantos | 40.5990717 | -3.7122577 |
|   ...    |

Para obtener un listado de todas los poblaciones, podemos usar el siguiente comando:

```php
$poblaciones = poblacion::all();
```

<br>
Nos devuelve una colección de datos con todos las posibles poblaciones de la tabla  `poblaciones`.

```json
 Illuminate\Database\Eloquent\Collection {#3041
     all: [
       App\Poblacion {#13646
         id: 1,
         provincia_id: 1,
         name: "Amurrio",
         slug: "amurrio",
         latitud: "43.0526489",
         longitud: "-3.0010217",
       },
       App\Poblacion {#3036
         id: 2,
         provincia_id: 1,
         name: "Añana",
         slug: "aana",
         latitud: "42.802352",
         longitud: "-2.982607",
       },
       App\Poblacion {#13643
         id: 3,
         provincia_id: 1,
         name: "Aramaio",
         slug: "aramaio",
         latitud: "43054",
         longitud: "-2566",
       },
       App\Poblacion {#13642
         id: 4,
         provincia_id: 1,
         name: "Armiñón",
         slug: "armin",
         latitud: "42.7230453",
         longitud: "-2.872574",
       },
       App\Poblacion {#13641
         id: 5,
         provincia_id: 1,
         name: "Arraia-Maeztu",
         slug: "arraia-maeztu",
         latitud: "42.7398149",
         longitud: "-2.4459801",
       },
     ],
	...

   }

```
