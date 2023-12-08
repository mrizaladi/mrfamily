<?php

namespace App\Exports;

use App\Models\Simpatisan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SimpatisanExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Simpatisan::whereNotNull('nik')
                            ->take(10)
                            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'NIK',
            'Nama',
            'Jenis Kelamin',
            'Umur',
            'Kota/Kabupaten',
            'Kecamatan',
            'Kelurahan',
            'RT',
            'RW',
            'TPS',
            'No HP',
            'KTP',
            'User ID',
            'Created At',
            'Updated At',
            'Status'
        ];
    }
}
