<?php
namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SimpatisanExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        $result = DB::select(
        '
            SELECT
                s.id, s.nik, s.name, s.sex, s.age, r.name as regency_name, d.name as district_name, sd.name as subdistrict_name, s.rt, s.rw, s.phone, u.name as user_name
            FROM
                simpatisans s
            JOIN regencies r ON r.id = s.regency_id
            JOIN districts d ON d.id = s.district_id
            JOIN subdistricts sd ON sd.id = s.subdistrict_id
            JOIN users u ON u.id = s.user_id
            WHERE
                nik IS NOT NULL
        ');

        return collect($result);
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
            'No HP',
            'Updated By'
        ];
    }
}
