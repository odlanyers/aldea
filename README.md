# aldea
# Proyecto - Prueba Aldea

# Clonar proyecto
1. Clonar el proyecto git clone <i>https://github.com/odlanyers/aldea.git</i>

# Configuración del ambiente local
1. Ejecutar el archivo aldea_test.sql que se encuentra en la raíz del proyecto, en un gestor de base de datos de MySQL, para crear la base de datos.
2. Copiar el archivo <b>.env.example</b> y renombrarlo como .env
3. Abrir el archivo y ubicar las variables de entorno <i>DB_DATABASE, DB_USERNAME y DB_PASSWORD</i>, y editar la configuración, según se requiera.

# Migraciones
1. Correr las migraciones <i>php artisan migrate</i>

# Seeders
1. Abrir el archivo database/seeders/DatabaseSeeder.php y editar el nombre de usuario y correo electrónico según se requiera. La contraseña del usuario por default será password, definida por UserFactory, o descomentar la clave "password" y crear una contraseña personalizada, dentro del array de atributos que es pasado dentro del método create.
2. Correr el seeder DatabaseSeeder para poblar las tablas users y categories <i>php artisan db:seed</i>
