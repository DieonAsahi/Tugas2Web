<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder lainnya
        $this->call([
            CategoriesSeeder::class,
            ProductSeeder::class,
            ThemeSeeder::class,
        ]);

        // Tambah user admin
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'athawaguth@gmail.com',
            'password' => Hash::make('Anto1737F'), // gunakan password aman
            'email_verified_at' => now(),
        ]);
    }
}
