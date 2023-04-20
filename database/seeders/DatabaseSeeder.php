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
            'nip' => '12007938',
            'email' => 'admin@smkwikrama.sch.id',
            'password' => Hash::make('2'),
            'role' => 'admin',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // DB::table('peminjamans')->insert([
        //     'nip' => 4,
        //     'nama_guru' => 'oliver sykes',
        //     'nama_barang' => 'gergaji mesin',
        //     'tgl_peminjaman' => Carbon::today(),
        //     'jml_barang_dipinjam' => 4,
        //     'id_barang' => 1,
        //     'status_peminjaman' => 'kembali',
        //     'keterangan' => 'buat cebok',
        //     'kategori_barang' => 'inventaris',
        //     'ruangan' => '203',
        //     'created_at' => Carbon::today(),
        //     'updated_at' => Carbon::today(),
        // ]);

        // DB::table('peminjamans')->insert([
        //     'nip' => 5,
        //     'nama_guru' => 'Corey Taylor',
        //     'nama_barang' => 'rantai besi',
        //     'tgl_peminjaman' => Carbon::today(),
        //     'jml_barang_dipinjam' => 2,
        //     'id_barang' => 5,
        //     'status_peminjaman' => 'dipinjam',
        //     'keterangan' => 'buat cebok',
        //     'kategori_barang' => 'non-inventaris',
        //     'ruangan' => '253',
        //     'created_at' => Carbon::today(),
        //     'updated_at' => Carbon::today(),
        // ]);
    }
}
