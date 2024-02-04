<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class SimpatisanExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $updatedBy;
    protected $regency_id;
    protected $district_id;

    public function __construct($updatedBy, $regency_id, $district_id)
    {
        $this->updatedBy = $updatedBy;
        $this->regency_id = $regency_id;
        $this->district_id = $district_id;
    }

    public function collection()
    {
        $query = '
        SELECT
            ROW_NUMBER() OVER (ORDER BY s.id) as no, s.nik, s.name, s.age, r.name as regency_name, 
            d.name as district_name, sd.name as subdistrict_name, s.tps, s.rt, s.rw, s.phone, u.name as user_name
        FROM
            simpatisans s
        JOIN regencies r ON r.id = s.regency_id
        JOIN districts d ON d.id = s.district_id
        JOIN subdistricts sd ON sd.id = s.subdistrict_id
        JOIN users u ON u.id = s.user_id
        WHERE
            nik IS NOT NULL';

        // Tambahkan kondisi untuk regency_id dan district_id
        if ($this->regency_id) {
            $query .= ' AND s.regency_id = :regency_id';
        }

        if ($this->district_id) {
            $query .= ' AND s.district_id = :district_id';
        }

        // Tambahkan kondisi untuk updated_by
        if ($this->updatedBy) {
            $query .= ' AND u.id = :updated_by';
        }

        // Eksekusi query dengan parameter
        $parameters = [];

        if ($this->regency_id) {
            $parameters['regency_id'] = $this->regency_id;
        }

        if ($this->district_id) {
            $parameters['district_id'] = $this->district_id;
        }

        if ($this->updatedBy) {
            $parameters['updated_by'] = $this->updatedBy;
        }

        $result = DB::select($query, $parameters);

        return collect($result)->map([$this, 'mapData']);
    }




    public function headings(): array
    {
        return [
            'No',
            'NIK',
            'Nama',
            'Umur',
            'Kota/Kabupaten',
            'Kecamatan',
            'Kelurahan',
            'TPS',
            'RT',
            'RW',
            'No HP',
            'Updated By'
        ];
    }

    public static function mapData($row): array
    {
        return [
            $row->no,
            "`".$row->nik,
            $row->name,
            $row->age,
            $row->regency_name,
            $row->district_name,
            $row->subdistrict_name,
            $row->tps,
            $row->rt,
            $row->rw,
            $row->phone,
            $row->user_name,
        ];
    }
}
