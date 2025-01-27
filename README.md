# Backend - Sistema de Gestión de Hoteles

Este es el backend de un sistema de gestión de hoteles desarrollado en Laravel. Permite manejar información sobre hoteles, habitaciones, y asignaciones de habitaciones. Utiliza una base de datos PostgreSQL y proporciona una API RESTful para la administración de los datos.

## Tecnologías utilizadas

-   **PHP 8.x** - Lenguaje de programación.
-   **Laravel 8.x** - Framework PHP para aplicaciones web.
-   **PostgreSQL** - Sistema de gestión de bases de datos.
-   **Composer** - Herramienta para gestionar dependencias PHP.
-   **Laravel Sanctum** - Autenticación API.
-   **Xdebug** - Depuración en el entorno local (opcional).

## Requisitos

Antes de comenzar, asegúrate de tener instalados los siguientes programas:

-   [PHP 8.x](https://www.php.net/)
-   [Composer](https://getcomposer.org/)
-   [PostgreSQL](https://www.postgresql.org/)
-   [Node.js](https://nodejs.org/)

## Instalación

Sigue estos pasos para instalar y configurar el proyecto en tu máquina local:

### 1. Clonar el repositorio

git clone https://github.com/tu-usuario/decameron-mod.git

### 2. configurar archivo .env

Se debe configurar el archivo .env, igual al archivo .env.example, para eso copia lo que está en el archivo .env.example
a .env

### 3. Instala las dependencias

composer install

### 4. Genara la clave de la aplicacion

php artisan key:generate

### 5. ejecutar las migraciones mediante la interfaz de linea de comando de laravel

php artisan migrate

### 6. ejecutar los seeders con artisan

php artisan serve

### 7. Levantar el servidor

php artisan serve, si desea cambiar el puerto php artisan serve --port=
