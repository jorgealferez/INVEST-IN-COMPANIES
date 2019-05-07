#Provincia::

---

- [Propiedades](#propiedades)
- [Valores](#valores)

Modelo de datos usado para la asignación de la provincia donde está ubicada una empresa.

> {info} Las posibles provincias son datos estáticos de la tabla `provincias`.

<a name="propiedades"></a>

## Propiedades

`name` [_string_]

Devuelve el nombre la provincia.

```bash
$provincia = Provincia::find(28);
echo $provincia->name;

->"Madrid"

```

<a name="valores"></a>

## Valores

Listado de las posibles provincias de una empresa.

|   ID   | NAME                   |
| :----: | :--------------------- |
| **1**  | Álava                  |
| **2**  | Albacete               |
| **3**  | Alicante               |
| **4**  | Almería                |
| **5**  | Ávila                  |
| **6**  | Badajoz                |
| **7**  | Illes Balears          |
| **8**  | Barcelona              |
| **9**  | Burgos                 |
| **10** | Cáceres                |
| **11** | Cádiz                  |
| **12** | Castellón              |
| **13** | Ciudad Real            |
| **14** | Córdoba                |
| **15** | A Coruña               |
| **16** | Cuenca                 |
| **17** | Girona                 |
| **18** | Granada                |
| **19** | Guadalajara            |
| **20** | Guipúzcoa              |
| **21** | Huelva                 |
| **22** | Huesca                 |
| **23** | Jaén                   |
| **24** | León                   |
| **25** | Lleida                 |
| **26** | La Rioja               |
| **27** | Lugo                   |
| **28** | Madrid                 |
| **29** | Málaga                 |
| **30** | Murcia                 |
| **31** | Navarra                |
| **32** | Ourense                |
| **33** | Asturias               |
| **34** | Palencia               |
| **35** | Las Palmas             |
| **36** | Pontevedra             |
| **37** | Salamanca              |
| **38** | Santa Cruz de Tenerife |
| **39** | Cantabria              |
| **40** | Segovia                |
| **41** | Sevilla                |
| **42** | Soria                  |
| **43** | Tarragona              |
| **44** | Teruel                 |
| **45** | Toledo                 |
| **46** | Valencia               |
| **47** | Valladolid             |
| **48** | Vizcaya                |
| **49** | Zamora                 |
| **50** | Zaragoza               |
| **51** | Ceuta                  |
| **52** | Melilla                |

Para obtener un listado de todas los provincias, podemos usar el siguiente comando:

```php
$provincias = Provincia::all();
```

<br>
Nos devuelve una colección de datos con todos las posibles provincias de la tabla  `provincias`.

```json
Illuminate\Database\Eloquent\Collection {#3091
     all: [
       App\Provincia {#3092
         id: 1,
         name: "Álava",
       },
       App\Provincia {#3093
         id: 2,
         name: "Albacete",
       },
       App\Provincia {#3094
         id: 3,
         name: "Alicante",
       },
       App\Provincia {#3095
         id: 4,
         name: "Almería",
       },
       App\Provincia {#3096
         id: 5,
         name: "Ávila",
       },

	...

   }

```
