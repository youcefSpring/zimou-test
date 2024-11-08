<?php
// app/Http/Controllers/PackageController.php

namespace App\Http\Controllers;

use App\Exports\PackagesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Export packages as a CSV or Excel file.
     */
    public function export(Request $request)
    {
        $format = $request->get('format', 'csv'); // Default to CSV
        $fileName = 'packages.' . $format;

        return Excel::download(new PackagesExport, $fileName, $format === 'csv' ? \Maatwebsite\Excel\Excel::CSV : \Maatwebsite\Excel\Excel::XLSX);
    }
}
