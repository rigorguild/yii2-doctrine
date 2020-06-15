# Yii2 – Doctrine ORM Integration

* [Instructions in english](#english-instructions)
* [Instrucciones en Español](#instrucciones-en-español)

## English instructions

### How to execute the application

    docker-compose up -d
    composer install
    php bin/doctrine-migrations migrations:migrate --no-interaction --all-or-nothing
    open http://127.0.0.1:8888/
    
### Application URLs

To create new Orders

    http://127.0.0.1:8888/index.php?r=orders/emit
    
This endpoint use a Command Handler defined in the folder [`src/Application/Command`](src/Application/Command).

To see all Orders (JSON formatted)

    http://127.0.0.1:8888/index.php?r=orders/view&id=<id>

### Application points of interest

* This is a standard Yii2 distribution with Doctrine ORM embedded into Yii2's DI.
* Tactical DDD code lives in the `src` folder under the `YiiDoctrineExample` namespace by means of PSR-4, using composer.
* Yii2 standard config files (`config/web.php` and `config/console.php`) include [`config/di.php`](config/di.php) file. This file wires commands handlers, infrastructure as well as Doctrine's Entity Manager.
* Doctrine connection parameters live in [`config/doctrine-orm.php`](config/doctrine-orm.php) and [`config/doctrine-orm_dev.php`](config/doctrine-orm_dev.php) files.
* Doctrine ORM mapping files can be found at [`src/Infrastructure/Persistence/doctrine-mappings`](src/Infrastructure/Persistence/doctrine-mappings) folder.
* Doctrine's CLI configuration lives in [`config/cli-config.php`](config/cli-config.php) (this is one of the standard places where Doctrines looks for CLI config).
* `Doctrine Migrations` integration has also been included. Migrations configuration (besides database config), lives in the [`migrations.php`](migrations.php) file. And migrations can be found at [`migrations`](migrations) folder.
* A specific controller has been created, [`controllers/OrdersController.php`](controllers/OrdersController.php).
* There are three different Doctrine CLI available (available after a `composer install`)
    * `bin/doctrine` => Doctrine ORM console
    * `bin/doctrine-dbal` => DBAL console.
    * `bin/doctrine-migrations` => Doctrine Migrations console.

## Instrucciones en Español

### Como ejecutar la aplicación

    docker-compose up -d
    composer install
    php bin/doctrine-migrations migrations:migrate --no-interaction --all-or-nothing
    open http://127.0.0.1:8888/
    
### URLs de la aplicación

Para crear nuevas Orders

    http://127.0.0.1:8888/index.php?r=orders/emit
    
Este endpoint usa un command handler definido en la carpeta [`src/Application/Command`](src/Application/Command).

Para verlas (formato JSON)

    http://127.0.0.1:8888/index.php?r=orders/view&id=<id>

### Puntos de interés de la aplicación

* Esta aplicación es un Yii2, estándard con Doctrine ORM incrustado en su DI.
* En la carpeta `src` reside código estilo DDD táctico. El código de esta carpeta está bajo el namespace `YiiDoctrineExample` usando PSR-4 (via composer).
* Todo se vincula a través del DI de Yii2. La configuración la incluye el archivo [`config/di.php`](config/di.php). Este archivo hace el wiring tanto de los commands handlers y la infra, como del Entity Manager de Doctrine.
* Los parámetros de doctrine residen en los archivos [`config/doctrine-orm.php`](config/doctrine-orm.php) y [`config/doctrine-orm_dev.php`](config/doctrine-orm_dev.php).
* Los mappings de doctrine se pueden encontrar en la carpeta [`src/Infrastructure/Persistence/doctrine-mappings`](src/Infrastructure/Persistence/doctrine-mappings).
* La configuración para la consola de doctrine reside en el archivo [`config/cli-config.php`](config/cli-config.php) (es uno de los sitios dónde Doctrine va a buscar la configuración de la consola).
* Se ha includo integración con `Doctrine Migrations`. La configuración de las migrations (a parte de la conexión a la base de datos), reside en el archivo [`migrations.php`](migrations.php). Y las migraciones se pueden encontrar en la carpeta [`migrations`](migrations).
* Se ha creado un controlador específico, [`controllers/OrdersController.php`](controllers/OrdersController.php).
* Hay tres CLIs disponibles de doctrine (disponibles después de hacer `composer install`)
    * `bin/doctrine` => Esta es la consola del ORM
    * `bin/doctrine-dbal` => Ésta es la consola de DBAL (la capa de abstración de base de datos que usa el ORM).
    * `bin/doctrine-migrations` => Ésta es la consola de las migrations de Doctrine.
