<?php
// app/Http/Controllers/PackageController.php

namespace App\Http\Controllers;

use App\Exports\PackagesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Package;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ExportPackagesJob;
class PackageController extends Controller
{


// public function export(Request $request)
// {
//     ExportPackagesJob::dispatch();

//     return response()->json([
//         'message' => 'Export job has been started. You will be notified once it completes.',
//     ]);
// }
public function export(Request $request)
{
    ini_set('max_execution_time', 180);

    $headers = [
        'Tracking Code',
        'Store Name',
        'Package Name',
        'Status',
        'Client Full Name',
        'Client Phone',
        'Wilaya',
        'Commune',
        'Delivery Type',
        'Status Name',
    ];

    $fileIndex = 1;
    $totalRecords = Package::count();
    $batchSize = 5000;

    // Array to store paths of temporary files for each batch
    $tempFiles = [];

    for ($offset = 0; $offset < $totalRecords; $offset += $batchSize) {
        // Generate file path for the current batch
        $filePath = $this->generateFilePath($fileIndex);
        $tempFiles[] = $filePath;

        $handle = fopen($filePath, 'w');

        // Write headers for each batch file
        fputcsv($handle, $headers);

        // Retrieve a batch of records
        $packages = Package::with([
            'store:id,name',
            'status:id,name',
            'commune:id,name,wilaya_id',
            'commune.wilaya:id,name',
            'deliveryType:id,name'
        ])
        ->offset($offset)
        ->limit($batchSize)
        ->get();

        // Write each package's data to the CSV file
        foreach ($packages as $package) {
            fputcsv($handle, [
                $package->tracking_code,
                $package->store->name ?? '',
                $package->name ?? '',
                $package->status->name ?? '',
                "{$package->client_first_name} {$package->client_last_name}",
                $package->client_phone,
                $package->commune->wilaya->name ?? '',
                $package->commune->name ?? '',
                $package->deliveryType->name ?? '',
                $package->status->name ?? '',
            ]);
        }

        fclose($handle);  // Close the file for this batch
        $fileIndex++;
    }

    // Merge all batch files into one final file
    $finalFilePath = public_path("storage/final_export.csv");
    $finalHandle = fopen($finalFilePath, 'w');
    fputcsv($finalHandle, $headers); // Write headers to the final file

    foreach ($tempFiles as $filePath) {
        $tempHandle = fopen($filePath, 'r');

        // Skip the header row in each temporary file after the first one
        $firstLine = true;
        while (($data = fgetcsv($tempHandle)) !== false) {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }
            fputcsv($finalHandle, $data);
        }
        fclose($tempHandle);

        // Delete the temporary file after merging
        unlink($filePath);
    }

    fclose($finalHandle);

    return redirect()->back()->with([
        'message' => 'Export completed successfully.',
        'final_file' => asset("storage/final_export.csv"),
    ]);
}

// Helper function to generate the file path for each part
private function generateFilePath($index)
{
    return public_path("storage/export_part_{$index}.csv");
}

    public function export_with_seperate_files(Request $request)
{
    ini_set('max_execution_time', 180);
    $headers = [
        'Tracking Code',
        'Store Name',
        'Package Name',
        'Status',
        'Client Full Name',
        'Client Phone',
        'Wilaya',
        'Commune',
        'Delivery Type',
        'Status Name',
    ];

    $fileIndex = 1;
    $totalRecords = Package::count();
    $batchSize = 5000;

    for ($offset = 0; $offset < $totalRecords; $offset += $batchSize) {
        // Create a new file for each batch
        $filePath = $this->generateFilePath_single($fileIndex);
        $handle = fopen($filePath, 'w');

        // Write headers for each file
        fputcsv($handle, $headers);

        // Retrieve a batch of 2000 records with offset
        $packages = Package::with([
            'store:id,name',
            'status:id,name',
            'commune:id,name,wilaya_id',
            'commune.wilaya:id,name',
            'deliveryType:id,name'
        ])
        ->offset($offset)
        ->limit($batchSize)
        ->get();

        // Write each package's data to the CSV
        foreach ($packages as $package) {
            fputcsv($handle, [
                $package->tracking_code,
                $package->store->name ?? '',
                $package->name ?? '',
                $package->status->name ?? '',
                "{$package->client_first_name} {$package->client_last_name}",
                $package->client_phone,
                $package->commune->wilaya->name ?? '',
                $package->commune->name ?? '',
                $package->deliveryType->name ?? '',
                $package->status->name ?? '',
            ]);
        }

        // Close the file for this batch
        fclose($handle);

        // Increment file index for the next batch
        $fileIndex++;
    }

    // Merge all smaller files into one final file
    $finalFilePath = public_path("storage/final_export.csv");
    $finalHandle = fopen($finalFilePath, 'w');
    fputcsv($finalHandle, $headers); // Write headers to the final file

    for ($i = 1; $i < $fileIndex; $i++) {
        $tempFilePath = $this->generateFilePath($i);
        $tempHandle = fopen($tempFilePath, 'r');

        // Skip headers for all files except the first one
        $firstLine = true;
        while (($data = fgetcsv($tempHandle)) !== false) {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }
            fputcsv($finalHandle, $data);
        }
        fclose($tempHandle);
    }

    fclose($finalHandle);

    return response()->json([
        'message' => 'Export completed successfully.',
        'final_file' => asset("storage/final_export.csv"),
    ]);
}

// Helper function to generate the file path for each part
private function generateFilePath_single($index)
{
    return public_path("storage/export_part_{$index}.csv");
}


}
