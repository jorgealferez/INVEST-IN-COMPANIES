#Instalación

---

- [Requisitos](#requisitos)
- [Composer](#composer)
- [Npm](#npm)
  

<a name="requisitos"></a>

## Requisitos

Para instalar el site se deben cumplir los siguientes requisitos en el servidor:

- Laravel 5.7
- PHP >= 7.1.3
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- BCMath PHP Extension
- Composer
- NPM
- Git

Una vez comprobados los requisitos del sistema se puede realizar la copia con el siguiente comando, reemplazando `DIRECTORIO` por el directorio deseado dentro del servidor.

```bash
git clone https://github.com/darkraul79/PGS.git DIRECTORIO
```

<a name="composer"></a>
## Composer

Para instalar las depencias de la parte backend del proyecto mediante composer nos situamos en el directorio raíz del proyecto y ejecutamos el siguiente comando. Esto instalará todas las depencias de `php`.

```bash
composer install
```

Este comando creará la carpeta `vendor` dentro de nuestro proyecto.

<a name="npm"></a>

## Npm

Para instalar las depencias de la parte frontend del proyecto mediante npm nos situamos en el directorio raíz del proyecto y ejecutamos el siguiente comando. Esto instalará todas las depencias de `js`.

```bash
npm install
```

Este comando creará la carpeta `node_modules` dentro de nuestro proyecto.
