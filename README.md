# Sistema de Gestión de Inventarios
Este es un sistema de gestión de inventarios construido con Laravel 10 y MySql.

## Tablero de Control

## Diseño de Base de Datos
Diagrama de Clases

## Funcionalidades
- Punto de Venta (POS)
- Pedidos
- Pedidos Pendientes
- Pedidos Completos
- Pagos Pendientes
- Compras
- Todas las Compras
- Compras Aprobadas
- Informe de Compras
- Productos
- Clientes
- Proveedores

## Cómo Usarlo
1. Clonar el Repositorio
```bash
git clone git@github.com:WilsonParedes11/inventario.git

2. Ingresar al repositorio

cd inventario

3. Instalar Paquetes

composer install

4. Copiar el archivo .env

cp .env.example .env

5. Generar clave de la aplicación

php artisan key:generate

6. Configurar las credenciales de la base de datos en tu archivo .env.
7. Poblar la base de datos:

php artisan migrate
php artisan migrate:fresh --seed

8. Crear enlace de almacenamiento

php artisan storage:link

9. Instalar dependencias de NPM

npm install 
npm run dev

10. Ejecutar

php artisan serve

11. Intentar iniciar sesión con el correo electrónico:

admin@admin.com

y contraseña:

password

Configuración
Configurar el Carrito: Abre el archivo ./config/cart.php. Puedes configurar impuestos, formateo de números, etc. Para más detalles, visita este enlace hardevine/shoppingcart.
