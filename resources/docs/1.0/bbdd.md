#Bases de datos

---

- [Tablas](#tablas)

Una vez configurado el archivo de entorno, tendremos que instalar las tablas necesarias dentro de la base de datos especificada en archivo de configuración [`.env`](/docs/{{version}}/configuracion).<br><br>

```bash
php artisan migrate:fresh --seed
```
<br>
Este comando nos crea automáticamente las tablas necesarias para el proyecto e incluirá los datos por defecto en las mismas.

<a name="tablas"></a>

## Tablas



| Tabla                | Descripción                            |
| :------------------- | :------------------------------------- |
| `asociacion_user`    | Relación Entidad-Usuario               |
| `asociaciones`       | Entidades                              |
| `estados_inversores` | Estados posibles de inversor           |
| `formas`             | Formas Jurídicas de empresa            |
| `inversiones`        | Inversiones                            |
| `migrations`         | Registro de migraciones                |
| `notifications`      | Notificaciones dentro de la plataforma |
| `ofertas`            | Ofertas                                |
| `password_resets`    | Reinicios de contraseñas               |
| `poblaciones`        | Poblaciones de España                  |
| `provincias`         | Provincias de España                   |
| `role_user`          | Relación Role-Usuario                  |
| `roles`              | Diferentes Roles de la plataforma      |
| `sectores`           | Sectores de actividad de empresas      |
| `users`              | Usuarios                               |



