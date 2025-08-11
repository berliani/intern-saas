<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectorSeeder extends Seeder
{
 public function run(): void
    {
        DB::table('sectors')->insert([
            ['name' => 'Pemerintahan', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kesehatan', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pendidikan', 'created_at' => now(), 'updated_at' => now()],

        ]);
    }

}
