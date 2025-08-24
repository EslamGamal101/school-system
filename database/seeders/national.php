<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class national extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['name_en' => 'Egypt', 'name_ar' => 'مصر'],
            ['name_en' => 'Saudi Arabia', 'name_ar' => 'السعودية'],
            ['name_en' => 'United States', 'name_ar' => 'الولايات المتحدة'],
            ['name_en' => 'United Kingdom', 'name_ar' => 'المملكة المتحدة'],
            ['name_en' => 'France', 'name_ar' => 'فرنسا'],
            ['name_en' => 'Germany', 'name_ar' => 'ألمانيا'],
            ['name_en' => 'Italy', 'name_ar' => 'إيطاليا'],
            ['name_en' => 'Canada', 'name_ar' => 'كندا'],
            ['name_en' => 'India', 'name_ar' => 'الهند'],
            ['name_en' => 'China', 'name_ar' => 'الصين'],
            ['name_en' => 'Japan', 'name_ar' => 'اليابان'],
            ['name_en' => 'Brazil', 'name_ar' => 'البرازيل'],
            ['name_en' => 'Russia', 'name_ar' => 'روسيا'],
            ['name_en' => 'South Africa', 'name_ar' => 'جنوب أفريقيا'],
            ['name_en' => 'Turkey', 'name_ar' => 'تركيا'],
           
        ];
        DB::table('nationals')->insert($countries);
    }
}
