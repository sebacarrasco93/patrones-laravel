<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Reports\ReportFactory;
use Illuminate\Http\Request;

class FactoryMethodController extends Controller
{
    public function __invoke(Request $request)
    {
        $report = (new ReportFactory(app()))->create($request->report);

        return $report->fromRequest(User::get())->download('users_report_factory_method.pdf');
    }
}
