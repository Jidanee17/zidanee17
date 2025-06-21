<?php

namespace Database\Seeders;

use App\Models\barang;
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
        // User::factory(10)->create();

        User::create([
            'username' => 'kasir',
            'password' => Hash::make('123'),
        ]);
        
        barang::create([
            'kode' => 'BRG001',
            'nama' => 'Pensil',
            'harga' => '5000',
            'stok' => '100',
        ]);
    }
}
