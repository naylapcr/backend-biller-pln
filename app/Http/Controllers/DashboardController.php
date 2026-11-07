<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biller;

class DashboardController extends Controller
{
    public function ranking()
    {
        // 1. Ambil semua data biller berserta data relasinya
        $billers = Biller::with(['invoices.workOrder', 'koreksiRekenings'])->get();

        // 2. Hitung skor untuk masing-masing biller
        $billerScores = $billers->map(function ($biller) {
            
            // Hitung total poin dari Invoice (WO yang sudah selesai)
            $totalPoinWO = $biller->invoices->sum(function ($invoice) {
                return $invoice->workOrder ? $invoice->workOrder->poin_reward : 0;
            });

            // Hitung total poin minus dari Koreksi Rekening
            $totalMinusKoreksi = $biller->koreksiRekenings->sum('jumlah_minus');

            // RUMUS SKOR AKHIR
            $skorAkhir = $totalPoinWO - $totalMinusKoreksi;

            return [
                'id' => $biller->id,
                'nama' => $biller->nama,
                'area' => $biller->area,
                'total_poin_wo' => $totalPoinWO,
                'total_minus_koreksi' => $totalMinusKoreksi,
                'skor_akhir' => $skorAkhir
            ];
        });

        // 3. Urutkan data berdasarkan skor_akhir tertinggi ke terendah
        $sortedBillers = $billerScores->sortByDesc('skor_akhir')->values();

        // 4. Pisahkan Top 5 dan Bottom 5
        $top5 = $sortedBillers->take(5);
        $bottom5 = $sortedBillers->slice(-5)->values(); // Ambil 5 dari urutan paling bawah

        // 5. Kembalikan respons dalam bentuk JSON
        return response()->json([
            'status' => 'success',
            'pesan' => 'Data Ranking Biller Berhasil Diambil',
            'data' => [
                'top_5' => $top5,
                'bottom_5' => $bottom5
            ]
        ]);
    }
}