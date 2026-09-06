# CRUD DE ARTÍCULOS CATEGORIZADOS CON AUTENTICACIÓN

## 1. Instalar la aplicación

Clonar el proyecto y seguir los mismos pasos establecidos para su instalación, los cuales se encuentran detallados en el Ejercicio 02: CRUD de Artículos Categorizados

## 2. Instalar el sistema de autenticación

Debido a la simplicidad de los ejercicios y a que el proyecto utiliza **Bootstrap** como framework de CSS, se instalará el paquete **Laravel UI**, que proporciona el scaffolding necesario para implementar las funcionalidades básicas de autenticación.

### 2.1. Instalación del paquete Laravel UI

Desde la terminal, dentro del directorio del proyecto, ejecutar:

```bash
composer require laravel/ui
```

Este comando instala el paquete **Laravel UI** y lo incorpora a las dependencias del proyecto, ubicadas en el directorio `vendor/`.

A continuación, ejecutar:

```bash
php artisan ui bootstrap --auth
```

Este comando genera el scaffolding de autenticación basado en **Bootstrap**, incluyendo las vistas y componentes necesarios para funcionalidades como:

* Inicio de sesión.
* Registro de usuarios.
* Recuperación de contraseña.
* Confirmación de contraseña.
* Verificación del correo electrónico.
* Cierre de sesión.

Las vistas generadas se encuentran principalmente en:

```text
resources/views/auth
resources/views/layouts
```

Una vez generado el scaffolding, realizar el ajuste de las rutas de la aplicación.

### 2.2. Configuración de las rutas

En el archivo `routes/web.php`, importar la fachada `Auth` y registrar las rutas de autenticación mediante:

```php
use Illuminate\Support\Facades\Auth;

// AUTENTICACIÓN
Auth::routes();
```

Posteriormente, proteger las rutas propias de la aplicación mediante el middleware `auth`.

El archivo `routes/web.php` quedará de la siguiente manera:

```php

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CPrincipal;
use App\Http\Controllers\CCategoria;
use App\Http\Controllers\CArticulo;
use App\Http\Controllers\CReporte;
use Illuminate\Support\Facades\Auth;


// AUTENTICACIÓN
Auth::routes();

// RUTAS PROTEGIDAS
Route::middleware('auth')->group(function () {

    // PRINCIPAL
    Route::get('/', [CPrincipal::class, 'showVDashboard']);

    // RUTAS PARA LAS CATEGORÍAS
    Route::get('/categoria/index', [CCategoria::class, 'index']);
    Route::get('/categoria/search', [CCategoria::class, 'search']);
    Route::get('/categoria/create', [CCategoria::class, 'create']);
    Route::post('/categoria/store', [CCategoria::class, 'store']);
    Route::get('/categoria/edit/{id}', [CCategoria::class, 'edit']);
    Route::put('/categoria/update/{id}', [CCategoria::class, 'update']);
    Route::get('/categoria/destroy/{id}', [CCategoria::class, 'destroy']);

    // RUTAS PARA LOS ARTÍCULOS
    Route::get('/articulo/index', [CArticulo::class, 'index']);
    Route::get('/articulo/search', [CArticulo::class, 'search']);
    Route::get('/articulo/create', [CArticulo::class, 'create']);
    Route::post('/articulo/store', [CArticulo::class, 'store']);
    Route::get('/articulo/edit/{id}', [CArticulo::class, 'edit']);
    Route::put('/articulo/update/{id}', [CArticulo::class, 'update']);
    Route::get('/articulo/destroy/{id}', [CArticulo::class, 'destroy']);

    // RUTAS REPORTES
    Route::get('/reporte/stock', [CReporte::class, 'reporteStock']);
});

```

Con esta configuración, las rutas de autenticación permanecen disponibles públicamente, mientras que las funcionalidades principales del sistema quedan protegidas mediante el middleware `auth`.

Finalmente, ejecutar:

```bash
php artisan optimize
```

Este comando permite optimizar la aplicación mediante la generación y actualización de las cachés correspondientes.

### 2.3. Ajustes y configuración de Bootstrap

En la vista principal del layout, ubicada en:

```text
resources/views/layouts/app.blade.php
```

modificar las referencias a las hojas de estilo y archivos JavaScript de Bootstrap.

Debido a que el proyecto utiliza **Bootstrap de forma local**, se reemplazan las referencias externas por los archivos almacenados dentro del directorio `public`.

Por ejemplo:

```html
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap y estilos del proyecto -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <title>CRUD-CATEGORIZADO-AUTH</title>
</head>

...

<main class="py-4">
    @yield('content')
</main>

</div>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>
```

De esta manera, Bootstrap se carga directamente desde los archivos locales del proyecto, evitando depender de un CDN para los recursos principales de la interfaz.

### 2.4. Ajustes para el inicio de la aplicación

El scaffolding generado por Laravel UI puede utilizar `/home` como ruta de redirección después de determinadas acciones de autenticación.

Como el proyecto ya dispone de una vista principal definida en la ruta `/`, se debe modificar la ruta de redirección.

En los controladores de autenticación correspondientes, como:

```text
LoginController.php
RegisterController.php
ResetPasswordController.php
ConfirmPasswordController.php
VerificationController.php
```

reemplazar:

```php
protected $redirectTo = '/home';
```

por:

```php
protected $redirectTo = '/';
```

De esta forma, después de iniciar sesión, registrarse o completar las operaciones correspondientes, el usuario será dirigido a la página principal del sistema.

Además, eliminar las vistas y controladores que ya no serán utilizados por el proyecto, como:

```text
resources/views/home.blade.php
HomeController.php
welcome.blade.php
```

El sistema quedará configurado para iniciar directamente sobre la estructura principal definida en el proyecto.

### 2.5. Agregar el botón de cierre de sesión

En el `header` de la vista principal, agregar el siguiente segmento de código:

```blade
<!-- CERRAR SESIÓN -->
<form action="{{ route('logout') }}" method="POST">
    @csrf

    <button type="submit" class="nav-link bg-transparent text-white px-3">
        <strong>&#9211;</strong> Cerrar sesión
    </button>
</form>
```

Este formulario permite al usuario cerrar su sesión de forma segura mediante la ruta `logout` proporcionada por el sistema de autenticación.

El método utilizado es `POST`, de acuerdo con la definición de la ruta de cierre de sesión generada por Laravel UI.

Una vez implementado, el sistema contará con las operaciones básicas de autenticación y con la protección de las rutas principales mediante el middleware `auth`.
