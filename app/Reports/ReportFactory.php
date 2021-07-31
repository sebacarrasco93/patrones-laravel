<?php

namespace App\Reports;

use http\Exception\InvalidArgumentException;

class ReportFactory implements ReportFactoryInterface
{
    private $app;

    private $aliases = [
        'dompdf' => 'dompdf.wrapper',
        'snappy' => 'snappy.pdf.wrapper',
    ];

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function create($type) : ReportInterface
    {
        $reportClass = __NAMESPACE__ . '\\' . ucfirst($type) . 'Report';

        if (! array_key_exists(($type), $this->aliases)) {
            throw new InvalidArgumentException("El reporte {$type} no existe");
        }

        if (! class_exists($reportClass)) {
            throw new InvalidArgumentException("La clase {$reportClass} no existe");
        }

        return new $reportClass($this->app->make($this->aliases[$type]));
    }
}
