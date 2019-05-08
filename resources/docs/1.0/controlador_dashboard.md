#DashBoardController

---
- [RolesCheck()](#rolescheck)

Controlador intermedio para todas la secciones del panel de administración.

<a name="index"></a>

## RolesCheck()

Genera variables globales para comprobar el perfil del usuario que ha hecho login.

> {info} Este método tendrá que ejecutarse al principio de todos los métodos del panel de Administración.

###@Variables

| $Variable  | Descripción                                                       |
| ---------- | :---------------------------------------------------------------- |
| isAdmin    | Devuelve `verdadero` si el usuario tiene perfil de Administrador. |
| isAsesor   | Devuelve `verdadero` si el usuario tiene perfil de Asesor.        |
| isGestor   | Devuelve `verdadero` si el usuario tiene perfil de Gestor.        |
| isInversor | Devuelve `verdadero` si el usuario tiene perfil de Inversor.      |
| authUser   | Devuelve los datos del usuario logado actualmente.                |

Objeto tipo ***NuevaEmpresaRequest*** con los datos del formulario.

```php
echo $this->isAdmin;
// Devuelve True si el usuario tiene perfil de Administrador.
```

