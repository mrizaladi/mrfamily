<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Simpatisan; 

class ImportSimpatisan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'app:import-simpatisan';

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description';

    /**
     * Execute the console command.
     */

     protected $signature = 'import:simpatisan {file}';

     protected $description = 'Import data simpatisan from CSV file';
 
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $file = $this->argument('file');

        if (!file_exists($file)) {
            $this->error('File not found!');
            return 1;
        }

        // Baca file CSV dan lakukan operasi impor di sini
        $data = array_map('str_getcsv', file($file));
        
        // Misalnya, lakukan iterasi pada setiap baris dan simpan ke dalam database
        foreach ($data as $row) {
            Simpatisan::create([
                'name' => $row[0],
                'sex' => $row[1],
                'age' => $row[2],
                'regency_id' => $row[3],
                'district_id' => $row[4],
                'subdistrict_id' => $row[5],
                'rt' => $row[6],
                'rw' => $row[7],
                'tps' => $row[8],
                // Tambahkan kolom-kolom lainnya sesuai dengan struktur CSV
            ]);
        }

        $this->info('Data imported successfully!');
        return 0;
    }
}
