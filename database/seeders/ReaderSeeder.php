<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ReaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('readers')->insert([
            [
                'name' => 'reader1',
                'email' => 'reader@brs.com',
                'password' => Hash::make('test0000')
            ],
            [
                'name' => 'reader2',
                'email' => 'reader2@brs.com',
                'password' => Hash::make('test0000')
            ],
        ]);
    }
}