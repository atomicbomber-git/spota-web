<?php

use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_faculties = [
            'Kedokteran', 'Ekonomi', 'Matematika dan IPA', 'Teknik',
            'Pertanian', 'Hukum', 'Keguruan dan Ilmu Pendidikan', 'Kehutanan',
            'Ilmu Sosial dan Ilmu Politik'
        ];

        foreach ($default_faculties as $faculty) {
            factory(App\Faculty::class)->create([
                'name' => $faculty
            ]);
        }
    }
}
