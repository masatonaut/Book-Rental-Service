<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LibrarianSeeder::class,
            ReaderSeeder::class,
            GenreSeeder::class,
            BookSeeder::class,
            BookGenreSeeder::class,
            BorrowSeeder::class
        ]);
    }
}
