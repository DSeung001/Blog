<?php

namespace App\Http\Controllers;

use App\Exports\RandomGeneratorExport;
use Maatwebsite\Excel\Facades\Excel;

class RandomGeneratorController extends Controller
{
    public function export()
    {
        $date = date('Y-m-d');
        return Excel::download(new RandomGeneratorExport(10, 100), 'random_number_'.$date.'.csv');
    }
}
