# Sistema de Gestión de Inventarios

Este es un sistema de gestión de inventarios construido con Laravel 10 y MySQL.

**Autor:** Samantha Del Salto

## Tablero de Control

[Imagen del tablero de control]

## Diseño de Base de Datos

[Diagrama de Clases]

## Funcionalidades

  * Punto de Venta (POS)
  * Pedidos
      * Pedidos Pendientes
      * Pedidos Completos
  * Pagos Pendientes
  * Compras
      * Todas las Compras
      * Compras Aprobadas
      * Informe de Compras
  * Productos
  * Clientes
  * Proveedores

## Cómo Usarlo

## Desconprimir el archivo 

### Instalación
1.  **Instalar Paquetes de Composer:**

    ```bash
    composer install
    ```

2.  **Copiar el archivo .env:**

    ```bash
    cp .env.example .env
    ```

3.  **Generar clave de la aplicación:**

    ```bash
    php artisan key:generate
    ```

4.  **Configurar las credenciales de la base de datos en tu archivo .env.**

5.  **Poblar la base de datos:**

    ```bash
    php artisan migrate
    php artisan migrate:fresh --seed
    ```

6.  **Crear enlace de almacenamiento:**

    ```bash
    php artisan storage:link
    ```

7.  **Instalar dependencias de NPM:**

    ```bash
    npm install
    npm run dev
    ```

8. **Ejecutar:**

    ```bash
    php artisan serve
    ```

9. **Credenciales de inicio de sesión:**

      * Correo electrónico: `admin@admin.com`
      * Contraseña: `password`

## Configuración

### Configurar el Carrito

Abre el archivo `./config/cart.php`. Puedes configurar impuestos, formateo de números, etc. Para más detalles, visita este enlace: [hardevine/shoppingcart](https://www.google.com/search?q=https://github.com/hardevine/shoppingcart).

### Entorno de Desarrollo en Windows

Si estás utilizando Windows, puedes configurar tu entorno de desarrollo con XAMPP o Laragon:

#### XAMPP

1.  Descarga e instala XAMPP desde [apachefriends.org](https://www.google.com/url?sa=E&source=gmail&q=https://www.apachefriends.org/es/index.html).
2.  Inicia los servicios de Apache y MySQL.
3.  Crea una base de datos en phpMyAdmin.
4.  Configura las credenciales de la base de datos en el archivo `.env`.
5.  Sigue los pasos de instalación desde el punto 3.

#### Laragon

1.  Descarga e instala Laragon desde [laragon.org](https://www.google.com/url?sa=E&source=gmail&q=https://laragon.org/).
2.  Crea una base de datos en Laragon.
3.  Configura las credenciales de la base de datos en el archivo `.env`.
4.  Sigue los pasos de instalación desde el punto 3.

### Composer

Si aún no tienes Composer instalado, puedes descargarlo desde [getcomposer.org](https://www.google.com/url?sa=E&source=gmail&q=https://getcomposer.org/download/).

### NPM

Asegúrate de tener Node.js y npm instalados. Puedes descargarlos desde [nodejs.org](https://www.google.com/url?sa=E&source=gmail&q=https://nodejs.org/).


