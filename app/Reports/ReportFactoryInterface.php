<?php

namespace App\Reports;

interface ReportFactoryInterface
{
    public function create($type) : ReportInterface;
}
