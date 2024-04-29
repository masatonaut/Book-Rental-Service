<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genres')->insert([
            [
                'name' => 'fantasy',
                'style' => 'dark'
            ],
            [
                'name' => 'romance',
                'style' => 'primary'
            ],
            [
                'name' => 'adventure',
                'style' => 'secondary'
            ],
            [
                'name' => 'thriller',
                'style' => 'warning'
            ],
            [
                'name' => 'action',
                'style' => 'danger'
            ],
            [
                'name' => 'historical',
                'style' => 'info'
            ],
            [
                'name' => 'drama',
                'style' => 'success'
            ]
        ]);
    }
}
