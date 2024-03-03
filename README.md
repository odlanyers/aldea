# aldea
# Proyecto - Prueba Aldea

# Requerimientos
Composer
npm

# 1. Clonar proyecto
1.1. Ir al directorio en donde deseas clonar el proyecto.
1.2. Clonar el proyecto git clone <i>https://github.com/odlanyers/aldea.git</i>

# 2. Intalación
2.1. Correr en consola el comando <i>composer install</i> para instalar el vendor de Laravel y las dependencias del proyecto.
2.2. Correr en consola el comando <i>npm install</i> para instalar las dependencias de ui bootstrap.

# 3 Configuración del ambiente local
3.1. Correr en consola el comando <i>npm run build</i> para compilar las configuraciones necesarias para vite.
3.2. Ejecutar el archivo aldea_test.sql que se encuentra en la raíz del proyecto, en un gestor de base de datos de MySQL, para crear la base de datos.
3.3. Copiar el archivo <b>.env.example</b> y renombrarlo como .env
3.4. Correr en consola el comando <i>php artisan key:generate</i> para generar la llave de encriptación de Laravel.
3.5. Abrir el archivo y ubicar las variables de entorno <i>DB_DATABASE, DB_USERNAME y DB_PASSWORD</i>, y editar la configuración para la conexión a la base de datos, según se requiera.
3.6. En el archivo .env ubicar la variable de entorno <i>QUEUE_CONNECTION</i> y cambiar el valor a <i>database</i>
3.7. Abrir el archivo y ubicar las variables de entorno <i>MAIL_MAILER, MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD, MAIL_ENCRYPTION y MAIL_FROM_ADDRESS</i>, y editar la configuración para la conexión al servidor de correo electrónico, según se requiera.
3.8. Finalmente, correr el comando <i>php artisan optimize</i> para limpiar/generar configuración, caché y rutas.

# 4 Seeders
4.1. Abrir el archivo database/seeders/DatabaseSeeder.php y editar el nombre de usuario y correo electrónico según se requiera. La contraseña del usuario por default será <i>password</i>, definida por UserFactory, o descomentar la clave <b>password</b> y escribir una contraseña personalizada, en el array de atributos que es pasado dentro del método create.

# 5 Migraciones
5.1. Correr las migraciones y el seeder para poblar la tabla categories <i>php artisan migrate --seed</i>
5.2. Si se require crear otro usuario, puede hacerse usando el UserFactyory desde tinker. En la consola correr el comando <i>php artisan tinker</i> y ejecutar lo siguiente: <b>\App\Models\User::factory()->create(['name' => 'usuario', 'email' => 'correo@correo.com',]);</b>, recuerda cambiar los valores dentro del array y agregar la clave <i>password</i> si deseas una contraseña personalizada, de lo contrario la contraseña será <i>password</i>, por default. Salir de tinker al finalizar <i>Ctrl+C</i>
