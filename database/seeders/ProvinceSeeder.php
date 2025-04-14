<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [
            'Aceh',
            'North Sumatra',
            'West Sumatra',
            'Riau',
            'Jambi',
            'South Sumatra',
            'Bengkulu',
            'Lampung',
            'Bangka Belitung Islands',
            'Riau Islands',
            'Jakarta',
            'West Java',
            'Central Java',
            'East Java',
            'Yogyakarta',
            'Banten',
            'Bali',
            'West Nusa Tenggara',
            'East Nusa Tenggara',
            'West Kalimantan',
            'Central Kalimantan',
            'South Kalimantan',
            'East Kalimantan',
            'North Kalimantan',
            'North Sulawesi',
            'Central Sulawesi',
            'South Sulawesi',
            'Southeast Sulawesi',
            'Gorontalo',
            'West Sulawesi',
            'Maluku',
            'North Maluku',
            'Papua',
            'West Papua',
        ];

        foreach ($provinces as $province) {
            Province::create(['name' => $province]);
        }
    }
}
