#Sector::

---

- [Propiedades](#propiedades)
- [Valores](#valores)

Modelo de datos usado para la asignación de los diferentes Sectores de Actividad de una empresa.

> {info} Los posibles sectores son datos estáticos de la tabla `sectores`.

<a name="propiedades"></a>

## Propiedades

`name` [_string_]

Devuelve el nombre descriptivo del sector de actividad.

```bash
$sector = Sector::find(1);
echo $sector->name;

->"Agricultura, ganadería, silvicultura y pesca"

```

<a name="valores"></a>

## Valores

Listado de los posibles sectores de una empresa ofertada.

|   ID    | NAME                                                                                   |
| :-----: | :------------------------------------------------------------------------------------- |
| **#1**  | Agricultura, ganadería, silvicultura y pesca                                           |
| **#2**  | Industrias extractivas                                                                 |
| **#3**  | Industria manufacturera                                                                |
| **#4**  | Suministro de energía eléctrica, gas, vapor y aire acondicionado                       |
| **#5**  | Suministro de agua, actividades de saneamiento, gestión de residuos y descontaminación |
| **#6**  | Construcción                                                                           |
| **#7**  | Comercio                                                                               |
| **#8**  | Transporte y almacenamiento                                                            |
| **#9**  | Hostelería                                                                             |
| **#10** | Información y comunicaciones                                                           |
| **#11** | Actividades financieras y de seguros                                                   |
| **#12** | Actividades inmobiliarias                                                              |
| **#13** | Actividades profesionales, científicas y técnicas                                      |
| **#14** | Actividades administrativas y servicios auxliares                                      |
| **#15** | Administración Pública y defensa                                                       |
| **#16** | Educación                                                                              |
| **#17** | Actividades sanitarias y de servicios sociales                                         |
| **#18** | Actividades artísticas, recreativas y de entrenimiento                                 |
| **#19** | Otros Servicios                                                                        |
| **#20** | Actividades de los hogares como empleadores de personal doméstico                      |
| **#21** | Actividades de organizaciones y organismos extraterritoriales                          |

Para obtener un listado de todos los sectores, podemos usar el siguiente comando:

```php
$sectores = Sector::all();
```

<br>
Nos devuelve una colección de datos con todos las posibles sectores jurídicas de la tabla  `sectores`.

```json
Illuminate\Database\Eloquent\Collection {#3139
     all: [
       App\Sector {#3140
         id: 1,
         name: "Agricultura, ganadería, silvicultura y pesca",
       },
       App\Sector {#3144
         id: 2,
         name: "Industrias extractivas",
       },
       App\Sector {#3142
         id: 3,
         name: "Industria manufacturera",
       },
       App\Sector {#3150
         id: 4,
         name: "Suministro de energía eléctrica, gas, vapor y aire acondicionado",
       },
       App\Sector {#3143
         id: 5,
         name: "Suministro de agua, actividades de saneamiento, gestión de residuos y descontaminación",
       },

	...

   }

```
