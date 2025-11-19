<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
          'religious',
            'Spanish-Language Movies',
            'French-Language Movies',
            'German-Language Movies',
            'Italian-Language Movies',
            'Korean-Language Movies',
            'Japanese-Language Movies',
            'Chinese-Language Movies',
            'Other Languages',
        ];

        foreach ($types as $type) {
            DB::table('types')->insert([
                'name' => $type
            ]);
        }
    }
}
