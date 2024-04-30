✨ Sistema de Gestión de Inventarios
Sistema de Gestión de Inventarios con Laravel 10 y MySql.

Tablero de Control

💀 Diseño de Base de Datos
Diagrama de Clases

😎 Funcionalidades
Punto de Venta (POS)
Pedidos
Pedidos Pendientes
Pedidos Completos
Pagos Pendientes
Compras
Todas las Compras
Compras Aprobadas
Informe de Compras
Productos
Clientes
Proveedores
🚀 Cómo Usarlo
Clonar el Repositorio
bash
Copy code
git clone https://github.com/fajarghifar/inventory-management-system
Ingresar al repositorio
bash
Copy code
cd inventory-management-system
Instalar Paquetes
bash
Copy code
composer install
Copiar el archivo .env
bash
Copy code
cp .env.example .env
Generar clave de la aplicación
bash
Copy code
php artisan key:generate
Configurar las credenciales de la base de datos en tu archivo .env.
Poblar la base de datos:
bash
Copy code
php artisan migrate:fresh --seed
Crear enlace de almacenamiento
bash
Copy code
php artisan storage:link
Instalar dependencias de NPM
bash
Copy code
npm install && npm run dev
Ejecutar
bash
Copy code
php artisan serve
Intentar iniciar sesión con el correo electrónico:
bash
Copy code
admin@admin.com
y contraseña:

bash
Copy code
password
🚀 Configuración
Configurar el CarritoAbre el archivo ./config/cart.php. Puedes configurar impuestos, formateo de números, etc.
Para más detalles, visita este enlace hardevine/shoppingcart.

