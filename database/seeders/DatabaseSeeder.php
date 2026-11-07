<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Biller;
use App\Models\WorkOrder;
use App\Models\CatatMeter;
use App\Models\KoreksiRekening;
use App\Models\Invoice;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Menggunakan data acak format Indonesia
        $faker = Faker::create('id_ID');

        // 1. Buat 3 Master Data Work Order
        $wos = [];
        for ($i = 1; $i <= 3; $i++) {
            $wos[] = WorkOrder::create([
                'deskripsi_wo' => 'Pemasangan Meteran Tipe ' . $i,
                'poin_reward' => $faker->randomElement([10, 15, 20])
            ]);
        }

        // 2. Buat 15 Data Biller beserta transaksinya
        for ($i = 1; $i <= 15; $i++) {
            // Buat Biller
            $biller = Biller::create([
                'nama' => $faker->name,
                'area' => 'Rayon ' . $faker->randomElement(['Utara', 'Selatan', 'Barat', 'Timur'])
            ]);

            // Buat data Catat Meter untuk biller ini
            CatatMeter::create([
                'biller_id' => $biller->id,
                'waktu_mulai' => now()->subMinutes(15),
                'waktu_selesai' => now(),
                'lama_membaca' => $faker->numberBetween(5, 20) // lama membaca 5-20 menit
            ]);

            // Buat 1-3 Invoice acak untuk biller ini
            $jumlahInvoice = rand(1, 3);
            for ($j = 0; $j < $jumlahInvoice; $j++) {
                Invoice::create([
                    'biller_id' => $biller->id,
                    'work_order_id' => $wos[array_rand($wos)]->id,
                    'status' => 'selesai',
                    'tanggal_invoice' => now()->format('Y-m-d')
                ]);
            }

            // Acak: Beberapa biller melakukan kesalahan (Koreksi Rekening)
            if (rand(0, 1) == 1) { // Peluang 50%
                KoreksiRekening::create([
                    'biller_id' => $biller->id,
                    'jumlah_minus' => 5,
                    'keterangan' => 'Salah input angka meter',
                    'tanggal' => now()->format('Y-m-d')
                ]);
            }
        }
    }
}