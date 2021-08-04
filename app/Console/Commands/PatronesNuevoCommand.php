<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class PatronesNuevoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'patrones:nuevo {NombreCapitalizado}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea los archivos necesarios para un patrón nuevo';

    private string $laravelCase;
    private string $viewCase;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $nombre = $this->argument('NombreCapitalizado');

        $this->convertNameToLaravelCase($nombre);
        $this->convertNameToViewCase($nombre);

        $this->createTest();
        $this->createController();

        $this->rememberToCreateView($nombre);

        $this->rememberToAddRouteToIndex();
        $this->rememberToAddRouteToWebFile();

        return 0;
    }

    protected function convertNameToLaravelCase(string $nombre)
    {
        $this->laravelCase = Str::ucfirst(
            Str::remove('-',
                Str::camel($nombre)
            )
        ); // TODO: 🦁 Te toca a ti aplicar algún patrón para mejorar esto!
    }

    protected function convertNameToViewCase(string $nombre)
    {
        $this->viewCase = Str::slug(Str::snake($nombre)); // TODO: 🦁 Aquí también!
    }

    protected function createTest()
    {
        $name = $this->laravelCase . 'Test';
        $location = 'tests/Feature/' . $name . '.php';

        Artisan::call('make:test ' . $name);

        $this->info('Se creó el Test en ' . $location);
    }

    protected function createController()
    {
        $name = $this->laravelCase . 'Controller';
        $location = 'app/Http/Controllers/' . $name . '.php';

        Artisan::call('make:controller ' . $name);

        $this->info('Se creó el Controller en ' . $location);
    }

    protected function rememberToCreateView($nombre)
    {
        $name = $this->viewCase;
        $location = 'resources/views/patrones/' . $name . '.blade.php';

        $this->comment('Recuerda crear la vista de muestra en ' . $location);
    }

    protected function rememberToAddRouteToIndex()
    {
        $location = 'resources/views/index.blade.php';

        $this->comment('Recuerda agregar la ruta de muestra en ' . $location);
    }

    protected function rememberToAddRouteToWebFile()
    {
        $location = 'routes/web.php';

        $this->comment('Recuerda agregar los métodos GET Y POST de muestra en ' . $location);
    }
}
