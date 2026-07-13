<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AntrianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menghapus data lama terlebih dahulu agar tidak double saat di-seed ulang
        DB::table('antrian')->truncate();

        // Mengisi data antrian nomor 1 sampai 5 otomatis
        for ($i = 1; $i <= 5; $i++) {
            DB::table('antrian')->insert([
                'nomor_antrian' => $i,
                'status' => 'menunggu',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}