<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportPackagesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $fileIndex = 1;
        $totalRecords = Package::count();
        $batchSize = 2000;
        $files = [];

        for ($offset = 0; $offset < $totalRecords; $offset += $batchSize) {
            $filePath = "export_part_{$fileIndex}.xlsx";

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

            Excel::store(new PackagesExport($packages), $filePath, 'public');

            $files[] = storage_path("app/public/{$filePath}");
            $fileIndex++;
        }

        $finalFilePath = storage_path("app/public/final_export.xlsx");
        $this->mergeExcelFiles($files, $finalFilePath);
    }

    private function mergeExcelFiles($filePaths, $finalFilePath)
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->removeSheetByIndex(0);

        foreach ($filePaths as $filePath) {
            $tempSpreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);

            foreach ($tempSpreadsheet->getAllSheets() as $sheet) {
                $sheetClone = $sheet->copy();
                $sheetClone->setTitle("Sheet " . ($spreadsheet->getSheetCount() + 1));
                $spreadsheet->addSheet($sheetClone);
            }
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save($finalFilePath);
    }
}
