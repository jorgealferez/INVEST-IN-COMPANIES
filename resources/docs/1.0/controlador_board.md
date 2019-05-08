#BoardController

---

- [index()](#index)
- [borrarNotificacion(_$request_)](#borrarnotificacionrequest)
- [getElementosDashboard(_$type_)](#getelementosdashboardtype)

Controlador para la página de DashBoard dentro del panel de administración.

<a name="index"></a>

## index()

Devuelve la página de resumen del panel de control.

> {info} Dependiendo del perfil de usuario se mostrarán diferentes valores de resumen.

<br><br>

<a name="borrarnotificacionrequest"></a>

## borrarNotificacion(_$request_)

Método usado para borrar las notificaciones de usuario dentro del panel de control.

###@Parámetros

Objeto tipo ***Request*** con el ID de la notificación.

```php
$request->notificacion_id;
```

<br><br>

<a name="getelementosdashboardtype"></a>

## getElementosDashboard(_$type_)

Método usado mostrar diferente bloques de contenido dentro del panel de control.

###@Parámetros

Cadena de texto para especificar el bloque a mostrar.

| $type              | Descripción                                              |
| :----------------- | :------------------------------------------------------- |
| solicitudesEmpresa | Muestra el bloque de contenido `Solicitudes de Empresa`. |
| inversores         | Muestra el bloque de contenido `Inversores`.             |