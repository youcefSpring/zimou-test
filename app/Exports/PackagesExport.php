<?php

// app/Exports/PackagesExport.php

namespace App\Exports;

use App\Models\Package;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PackagesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Fetch all packages with relationships for export.
     */
    public function collection()
    {
        return Package::with(['store', 'status', 'commune.wilaya', 'deliveryType'])
            ->get();
    }

    /**
     * Define column headers for the export.
     */
    public function headings(): array
    {
        return [
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
    }

    /**
     * Map each package's data to the specified columns.
     */
    public function map($package): array
    {
        return [
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
        ];
    }
}

