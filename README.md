# Integración Yii2 – Doctrine ORM

## Como ejecutar la aplicación

    docker-compose up -d
    php bin/doctrine-migrations migrations:migrate --no-interaction --all-or-nothing
    open http://127.0.0.1:8888/
    
## URLs de la aplicación

Para crear nuevas Orders

    http://127.0.0.1:8888/index.php?r=orders/emit
    
Este endpoint usa un command handler definido en la carpeta `src/Application/Command`.

Para verlas (formato JSON)

    http://127.0.0.1:8888/index.php?r=orders/view&id=<id>

## Puntos de interés de la aplicación

* Esta aplicación es un Yii2, estándard con Doctrine ORM incrustado en su DI.
* En la carpeta `src` reside código estilo DDD táctico. El código de esta carpeta está bajo el namespace `YiiDoctrineExample` usando PSR-4 (via composer).
* Todo se vincula a través del DI de Yii2. La configuración la incluye el archivo `config/di.php`. Este archivo hace el wiring tanto de los commands handlers y la infra, como del Entity Manager de Doctrine.
* Los parámetros de doctrine residen en los archivos `config/doctrine-orm.php` y `config/doctrine-orm_dev.php`.
* Los mappings de doctrine se pueden encontrar en la carpeta `src/Infrastructure/Persistence/doctrine-mappings`.
* La configuración para la consola de doctrine reside en el archivo `config/cli-console.php` (es uno de los sitios dónde Doctrine va a buscar la configuración de la consola).
* Se ha includo integración con `Doctrine Migrations`. La configuración de las migrations (a parte de la conexión a la base de datos), reside en el archivo `migrations.php`. Y las migraciones se pueden encontrar en la carpeta `migrations`.
