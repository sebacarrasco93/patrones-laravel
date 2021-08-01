<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Patrones de Diseño con Laravel

Esta es una recopilación de diferentes Patrones de Diseño que se pueden utilizar con el Framework Laravel.

Testeado en **Laravel 8** y **PHP 8**, pero puede servir en futuras versiones (y también anteriores).

## Importante, antes de usar:

Si usas Windows:
1. Instala [wkhtmltopdf](https://wkhtmltopdf.org/downloads.html), de preferencia en la ruta ```C:\wkhtmltopdf``` 
2. Abre el archivo `.env` y busca la llave `WKHTML_PDF_BINARY`. Pon la ruta completa del ejecutable de wkhtmltopdf (si instalaste en ```C:\wkhtmltopdf```, sólo debes descomentar esa línea, de lo contrario, ya sabes qué hacer: Escribirla completa)

## Recursos utilizados:
- Patrones de Diseño, [Blog de Herminio Heredia](https://herminioheredia.com.mx/)

## Patrones disponibles:
- [x] [Factory](https://github.com/sebacarrasco93/patrones-laravel/commit/16c29acafb6f4136ff0b52b121e8d215e2092890)
- [x] [Factory Method](https://github.com/sebacarrasco93/patrones-laravel/commit/02b3950fbb9b8177c37ff7e03f36422600bdeb3f)
- [ ] Builder
- [ ] State
- [ ] Pipeline
- [ ] Adapter
- [ ] Strategy
- [ ] Chain of Responsability
- [ ] Command

## Testing
```shell
php artisan test # --parallel
```

## Contribuir
Crea un Pull Request con los cambios.

Para agregar un patrón nuevo y mantener la misma consistencia de datos, debes seguir lo siguiente:

---
Actualización: Usa este comando para crear el Test y Controller automáticamente:
```shell
php artisan patrones:nuevo (nuevo-patron)
```
---

Si quieres hacer todo a mano, debes escribir:

```shell
php artisan make:test NombrePatronTest
```

tests/Feature/NombrePatronTest.php
```php
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NombrePatronTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function puede_descargar_un_reporte_de_usuarios_usando_dompdf_con_nombre_del_patron()
    {
        $users = User::factory(5)->create();

        $response = $this->post(route('nombrePatron', 'dompdf'));

        $response->assertOk();

        $contentType = $response->headers->get('content-type');
        $contentDisposition = $response->headers->get('content-disposition');

        $this->assertEquals('application/pdf', $contentType);
        $this->assertEquals('attachment; filename="users_report_nombre_patron.pdf"', $contentDisposition);
    }

    /** @test */
    function puede_descargar_un_reporte_de_usuarios_usando_snappy_con_nombre_del_patron()
    {
        $users = User::factory(5)->create();

        $response = $this->post(route('nombrePatron', 'snappy'));

        $response->assertOk();

        $contentType = $response->headers->get('content-type');
        $contentDisposition = $response->headers->get('content-disposition');

        $this->assertEquals('application/pdf', $contentType);
        $this->assertEquals('attachment; filename="users_report_nombre_patron.pdf"', $contentDisposition);
    }

    /** @test */
    function no_puede_descargar_un_reporte_de_usuarios_usando_un_parametro_invalido_con_nombre_del_patron()
    {
        $user = User::factory(5)->create();

        $response = $this->post(route('nombrePatron', 'invalido'));

        $response->assertStatus(500);
    }
}
```

Crear controller:
```shell
php artisan make:controller NombrePatronController
```

app/Http/Controllers/NombrePatronController.php
```php
public function __invoke(Request $request)
{
    // ...
}

```

resources/views/index.blade.php
```html
@section('contenido')
    <!-- Después del último... -->
    <a href="{{ route('patrones.nombrePatron') }}">Nombre Patrón</a>
@endsection
```

resources/views/patrones/nombre-patron.blade.php
```html
@extends('layout')
@section('titulo', 'Nombre Patrón')

@section('contenido')
<form action="{{ route('nombrePatron', 'dompdf') }}" method="POST">
    <h2>Descargar con Dompdf</h2>
    @csrf
    <button>Descargar</button>
</form>

<form action="{{ route('nombrePatron', 'snappy') }}" method="POST">
    <h2>Descargar con Snappy</h2>
    @csrf
    <button>Descargar</button>
</form>
@endsection
```

routes/web.php
```php
use App\Http\Controllers\NombrePatronController;

// Abajo del último con métodos GET
Route::get('nombre-patron', [PatronesController::class, 'nombrePatron'])->name('patrones.nombrePatron');

// Abajo del último con métodos POST
Route::post('nombre-patron/{report}', NombrePatronController::class)->name('nombrePatron');
```

README.md
```markdown
## Patrones disponibles:

- [x] Nombre Patrón
```
