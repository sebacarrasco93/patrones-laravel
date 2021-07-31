<?php

namespace App\Reports;

use Illuminate\Http\Response;

interface ReportInterface
{
    public function fromRequest($data) : ReportInterface;

    public function download($filename) : Response;
}
