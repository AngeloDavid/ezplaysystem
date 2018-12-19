# Proyecto de laravel / Comandos
1. Primero se debe bajar el proyecto con `laravel new name`
2. Luego se debe colocar ` composer install`
3. Tambien se debe configurar el archivo *.env* que contiene la configuracion global del proyecto y al final colocar el comando `php artisan key:generate`
4. Acontinuacion, si el proyecto ya tiene las *migraciones* se debe colocar `php artisan migrate` previa creacion de la base datos.

## Vistas.
Todas las vistas se crean conmo *blade.php*  en la carpeta 
- resources
    - views

Los assets se coloca en la carpeta *public*, y se hace referencia en las plantillas de la siguiente manera
`<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">`

## Controladores
Para crear un controlador se coloca el siguiente comando `php artisan make:controller UserController` o `$ php artisan make:controller CustomerController --resource --model=Costumer`

Luego se crea las rutas ` Route::get('/usuarios', 'UserController@index');` 0 `Route::resource('Clientes', 'CustomerController');`

## forma de pago
    .transferencia
    .cheque

## Modelos

Para crear una migration se lo hace con `php artisan make:migration add_foreign_key_invoice_table`

