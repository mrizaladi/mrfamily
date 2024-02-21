<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tps; 

class ImportTps extends Command
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

     protected $signature = 'import:tps {file}';

     protected $description = 'Import data tps from CSV file';
 
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
            Tps::create([
                'regency_id' => $row[0],
                'district_id' => $row[1],
                'subdistrict_id' => $row[2],
                'tps' => $row[3],
                'total_voters' => $row[4],
                'golkars'=> $row[5],
                'officer' => $row[6],
                'chec'=> $row[7],
                'isFastCount' => true,
                
                // Tambahkan kolom-kolom lainnya sesuai dengan struktur CSV
            ]);
        }

        $this->info('Data imported successfully!');
        return 0;
    }
}
