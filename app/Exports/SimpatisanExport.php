<?php
namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class SimpatisanExport implements FromCollection, WithHeadings, WithColumnFormatting
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    protected $updatedBy;

    public function __construct($updatedBy)
    {
        $this->updatedBy = $updatedBy;
    }

    public function collection()
    {
        $query = '
            SELECT
                ROW_NUMBER() OVER (ORDER BY s.id) as no, s.nik, s.name, s.sex, s.age, r.name as regency_name, 
                d.name as district_name, sd.name as subdistrict_name, s.rt, s.rw, s.phone, u.name as user_name
            FROM
                simpatisans s
            JOIN regencies r ON r.id = s.regency_id
            JOIN districts d ON d.id = s.district_id
            JOIN subdistricts sd ON sd.id = s.subdistrict_id
            JOIN users u ON u.id = s.user_id
            WHERE
                nik IS NOT NULL';

        if ($this->updatedBy) {
            $query .= ' AND u.id = :updated_by';
        }

        
        if($this->updatedBy) {
            $result = DB::select($query, [
                'updated_by' => $this->updatedBy,
            ]);
        }else {
            $result = DB::select($query);
        }

        return collect($result);
    }


    public function headings(): array
    {
        return [
            'No',
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

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER
        ];
    }
}
