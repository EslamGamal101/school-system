<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialties = [
            ['name' => json_encode(['ar' => 'رياضيات', 'en' => 'Mathematics'])],
            ['name' => json_encode(['ar' => 'فيزياء', 'en' => 'Physics'])],
            ['name' => json_encode(['ar' => 'كيمياء', 'en' => 'Chemistry'])],
            ['name' => json_encode(['ar' => 'أحياء', 'en' => 'Biology'])],
            ['name' => json_encode(['ar' => 'لغة عربية', 'en' => 'Arabic Language'])],
            ['name' => json_encode(['ar' => 'لغة إنجليزية', 'en' => 'English Language'])],
          
        ];

        foreach ($specialties as $specialty) {
            DB::table('specialists')->insert($specialty);
        }
    }
}
