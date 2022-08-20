<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pilihan;
use App\Models\Peserta;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Admin Pendaftaran',
            'email' => 'admin@sipiropinjateng.com',
            'password' => bcrypt('sipiropinjateng')
        ]);

        Pilihan::create([
            'jenis' => 'offline',
            'deskripsi' => '2 Hari (17-18 September 2022) - 8 SKP',
            'harga' => '500000'
        ]);
        Pilihan::create([
            'jenis' => 'offline',
            'deskripsi' => '1 Hari (17 September 2022) - 4 SKP',
            'harga' => '250000'
        ]);
        Pilihan::create([
            'jenis' => 'offline',
            'deskripsi' => '1 Hari (18 September 2022) - 4 SKP',
            'harga' => '250000'
        ]);
        Pilihan::create([
            'jenis' => 'online',
            'deskripsi' => '2 Hari (17-18 September 2022) - 4 SKP',
            'harga' => '200000'
        ]);
        Pilihan::create([
            'jenis' => 'online',
            'deskripsi' => '1 Hari (17 September 2022) - 2 SKP',
            'harga' => '100000'
        ]);
        Pilihan::create([
            'jenis' => 'online',
            'deskripsi' => '1 Hari (18 September 2022) - 2 SKP',
            'harga' => '100000'
        ]);

        Peserta::factory(100)->create();
    }
}
