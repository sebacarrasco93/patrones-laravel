<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\PDFFactory;
use Illuminate\Http\Request;

class FactoryController extends Controller
{
    public function __invoke(Request $request)
    {
        $pdf = PDFFactory::make($request);

        $pdf->loadView('pdf.users', [
            'users' => User::get(),
        ]);

        return $pdf->download('users_report.pdf');
    }
}
