#Forma::

---

- [Propiedades](#propiedades)
- [Valores](#valores)

Modelo de datos usado para la asignación de las diferentes Formas Jurídicas de una empresa.

> {info} Los posibles formas son datos estáticos de la tabla `formas`.

<a name="propiedades"></a>

## Propiedades

`name` [_string_]

Devuelve el nombre descriptivo de la forma jurídica.

```bash
$forma = Forma::find(1);
echo $forma->name;

->"Autónomo"

```

<a name="valores"></a>

## Valores

Listado de los posibles formas jurídicas de una empresa ofertada.

|   ID   | NAME                                  |
| :----: | :------------------------------------ |
| **#1** | Autónomo.                             |
| **#2** | Aociedad de Responsabilidad Limitada. |
| **#3** | Sociedad Anónima.                     |
| **#4** | Comunidad de Bienes.                  |
| **#5** | Otras formas jurídicas.               |

Para obtener un listado de todos las formas jurídicas, podemos usar el siguiente comando:

```php
$formas = Forma::all();
```

<br>
Nos devuelve una colección de datos con todos las posibles formas jurídicas de la tabla  `formas`.

```json
Illuminate\Database\Eloquent\Collection {#3024
     all: [
       App\Forma {#3026
         id: 1,
         name: "Autónomo",
       },
       App\Forma {#172
         id: 2,
         name: "Sociedad de Responsabilidad Limitada",
       },
       App\Forma {#3046
         id: 3,
         name: "Sociedad Anónima",
       },
       App\Forma {#3047
         id: 4,
         name: "Comunidad de Bienes",
       },
       App\Forma {#3048
         id: 5,
         name: "Otras formas jurídicas",
       },
     ],
   }
```
