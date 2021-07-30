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
- [x] Factory
- [ ] Factory Method
- [ ] Builder
- [ ] State
- [ ] Pipeline
- [ ] Adapter
- [ ] Strategy
- [ ] Strategy
- [ ] Chain of Responsability
- [ ] Command

## Testing
```shell
php artisan test # --parallel
```
