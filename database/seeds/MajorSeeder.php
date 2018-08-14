<?php

use Illuminate\Database\Seeder;
use App\Major;
use App\Faculty;
use App\Configuration;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_major_faculties = [
            'Kedokteran' => [
                'Ilmu Kedokteran',
                'Keperawatan',
                'Farmasi'
            ],
            'Ekonomi' => [
                'Manajemen',
                'Akuntansi',
                'Ilmu Ekonomi'
            ],
            'Matematika dan IPA' => [
                'Matematika',
                'Kimia',
                'Fisika'
            ],
            'Teknik' => [
                'Informatika',
                'Sipil',
                'Elektro'
            ],
            'Pertanian' => [
                'Peternakan',
                'Pertanian'
            ],
            'Hukum' => [

            ],
            'Keguruan dan Ilmu Pendidikan' => [

            ],
            'Kehutanan' => [

            ],
            'Ilmu Sosial dan Ilmu Politik' => [
                
            ]
        ];

        $faculties = Faculty::all();

        foreach($faculties as $faculty){
            if (isset($default_major_faculties[$faculty->name])) {
                foreach ($default_major_faculties[$faculty->name] as $major_name) {
                    factory(Major::class)->create([
                        'name' => $major_name
                    ]);
                } 
            }
        }
    }
}
