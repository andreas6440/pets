# Laravel

prueba de pets

# Requerimientos

-   Tener [Docker compose][dockercompose] instalado en la máquina local.

[dockercompose]: https://docs.docker.com/compose/install/

## Instalar Laravel

1. Clonar repositorio desde github e instalar dependencias ejecutando el comando:

`composer install` #laravel vendor
`npm install`
`npm run dev`

2.  Verificar variables en `.env` comparando con las opciones
    requeridas por Laravel en el archivo `.env.example`.

3.  Levantar la aplicación ejecutando

        ./vendor/bin/sail up

    Verificar que funciona correctamente ingresando a la URL
    http://localhost/

4.  Ejecutar migraciones

        1.  ejecutar el la terminar el comando `docker ps` posteriormente copiar el id de la imagen sail-8.0/app
        2.  ejecutar `docker exec -i -t ID_IMAGEN /bin/bash`
        3.  ejecutar `php artisan migrate`
        4.  Verificar que funciona correctamente ingresando a la URL http://localhost/

## Aclaraciones

El problema sugeria crear un template para realizar el cliclo de registro. por ende esa fue la opción que realicé. Una aclaracion sobre el problema es que la unica forma de que un pago se considere fallido es que no exista deuda de suscripcion.
