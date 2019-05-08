#Middleware

---

El sistema utiliza el filtrado de solicitudes middleware de Laravel en las diferentes URL del proyecto.<br><br>

- [Métodos](#m%C3%A9todos)
  
<a name="m%C3%A9todos"></a>

## Métodos ##

| Tabla      | Descripción                                           |
| :--------- | :---------------------------------------------------- |
| `auth`     | Usuarios logeados en el sistema.                      |
| `verified` | Usuarios con email verficado.                         |
| `admin`    | Usuarios con perfil de Administrador                  |
| `asesor`   | Usuarios con perfil de Administrador, y Asesor        |
| `editor`   | Usuarios con perfil de Administrador, Asesor y Gestor |

<br><br>

```bash
Route::get('admin/profile', function () {
})->middleware('auth');
```

<br>

Con este método se puede restringir el acceso a la url `admin/profile` a los usuarios que se hayan logeado correctamente en la plataforma.