<?php

namespace App\Reports;

use Barryvdh\Snappy\PdfWrapper;
use Illuminate\Http\Response;

class SnappyReport implements ReportInterface
{
    private $view = 'pdf.users';

    private $pdf;

    public function __construct(PdfWrapper $pdf)
    {
        $this->pdf = $pdf;
    }

    public function fromRequest($data) : ReportInterface
    {
        $this->pdf->loadView($this->view, ['users' => $data]);

        return $this;
    }

    public function download($filename) : Response
    {
        return $this->pdf->download($filename);
    }
}
