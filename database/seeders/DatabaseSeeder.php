<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Karyawan;
use App\Models\Supplier;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Menambahkan data admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('admin'),
        ]);
        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'role' => 'user',
            'password' => bcrypt('user'),
        ]);
        User::create([
            'name' => 'Rizky',
            'email' => 'rizky@gmail.com',
            'role' => 'user',
            'password' => bcrypt('user'),
        ]);

        // Menambahkan data karyawan
        Karyawan::create([
            'name' => 'Anton',
            'pekerjaan' => 'Penjahit',
            'upah' => '2000',
        ]);
        Karyawan::create([
            'name' => 'Yanto',
            'pekerjaan' => 'Penjahit',
            'upah' => '3000',
        ]);
        Karyawan::create([
            'name' => 'Tylil',
            'pekerjaan' => 'Pemotong',
            'upah' => '3000',
        ]);
        Karyawan::create([
            'name' => 'Ulil',
            'pekerjaan' => 'Pemotong',
            'upah' => '3000',
        ]);

        // Menambahkan data supplier
        Supplier::create([
            'name' => 'Supplier A',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Raya No. 1, Jakarta',
            'email' => 'supplierA@example.com',
            'bahan_utama' => 'Combed 20',
            'bahan_tambahan' => 'Parasut',
            'jenis_kancing' => 'Wangki',
            'jenis_sleting' => 'Gigi Halus',
        ]);

        // Menambahkan data customer
        Customer::create([
            'name' => 'Arul',
            'no_hp' => '080000567890',
            'email' => 'arul10@example.com',
        ]);
        Customer::create([
            'name' => 'Mupti',
            'no_hp' => '081234567000',
            'email' => 'Mupti@example.com',
        ]);
    }
}
