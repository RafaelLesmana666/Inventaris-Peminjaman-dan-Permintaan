<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'nama' => 'agung',
            'password' => Hash::make('2'),
            'role' => 'admin',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('barangs')->insert([
            'kode_barang' => 'a11b23',
            'nama_barang' => 'laptop',
            'jenis_barang' => 'Inventaris',
            'kategori_barang' => 'Elektronik',
            'satuan' => 'Unit',
            'baik' => 100,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
