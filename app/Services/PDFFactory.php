<?php

namespace App\Services;

use Illuminate\Http\Request;

class PDFFactory
{
    public static function make(Request $request)
    {
        if ($request->report == 'dompdf') {
             return app('dompdf.wrapper');
         }

        if ($request->report == 'snappy') {
            return app('snappy.pdf.wrapper');
        }

        throw new \BadMethodCallException("El método {$request->report} es no existe");
    }
}
