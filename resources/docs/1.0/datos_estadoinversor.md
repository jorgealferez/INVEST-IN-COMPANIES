#Estadoinversor::

---

- [Propiedades](#propiedades)
- [Valores](#valores)

Modelo de datos usado para la asignación de los diferentes estados de una Inversión.

> {info} Los posibles estados son datos estáticos de la tabla `estados_inversores`.

<a name="propiedades"></a>

## Propiedades

`name` [_string_]

Devuelve el nombre del estado de la inverión.

```bash
$inversion = Inversion::find(1);
echo $inversion->estado->name;

->"En proceso"

```

<a name="valores"></a>

## Valores

Listado de los posibles estados de una inversión.

| Método | Descripción          |
| :----: | :------------------- |
| **#1** | Nueva                |
| **#2** | En proceso.          |
| **#3** | Volver a contactar.  |
| **#4** | Esperando respuesta. |
| **#5** | Finalizado.          |
| **#5** | Rechazado.           |

Podemos acceder a todos los estados posibles con el siguiente comando:

```php
$estadosInversiones = Estadoinversor::all();
```

<br>
Nos devuelve una colección de datos con todos los posibles estado de la tabla `estados_inversores`.

```json
Illuminate\Database\Eloquent\Collection {#3038
     all: [
       App\Estadoinversor {#3039
         id: 1,
         name: "Nueva",
       },
       App\Estadoinversor {#3040
         id: 2,
         name: "En proceso",
       },
       App\Estadoinversor {#3041
         id: 3,
         name: "Volver a contactar",
       },
       App\Estadoinversor {#3042
         id: 4,
         name: "Esperando respuesta",
       },
       App\Estadoinversor {#3043
         id: 5,
         name: "Finalizado",
       },
       App\Estadoinversor {#3044
         id: 6,
         name: "Rechazado",
       },
     ],
   }
```
