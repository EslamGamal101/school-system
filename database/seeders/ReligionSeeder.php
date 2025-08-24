<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $religions = [
            ['name_en' => 'Islam', 'name_ar' => 'الإسلام'],
            ['name_en' => 'Christianity', 'name_ar' => 'المسيحية'],
        ];

        DB::table('religions')->insert($religions);
    }
}
