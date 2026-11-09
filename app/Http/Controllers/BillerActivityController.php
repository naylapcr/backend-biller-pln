<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatatMeter;
use App\Models\KoreksiRekening;
use App\Models\Invoice;
use Carbon\Carbon;

class BillerActivityController extends Controller
{
    // Menu 1A: Tombol Mulai Catat Meter
    public function mulaiCatat(Request $request)
    {
        $catat = CatatMeter::create([
            'biller_id' => $request->biller_id,
            'waktu_mulai' => Carbon::now(),
        ]);

        return response()->json([
            'pesan' => 'Proses catat meter dimulai',
            'data' => $catat
        ]);
    }

    // Menu 1B: Tombol Selesai Catat Meter
    public function selesaiCatat(Request $request, $id)
    {
        $catat = CatatMeter::findOrFail($id);
        
        $waktuSelesai = Carbon::now();
        // Menghitung selisih waktu dalam menit
        $lamaMembaca = $waktuSelesai->diffInMinutes(Carbon::parse($catat->waktu_mulai));

        $catat->update([
            'waktu_selesai' => $waktuSelesai,
            'lama_membaca' => $lamaMembaca
        ]);

        return response()->json([
            'pesan' => 'Proses catat meter selesai',
            'data' => $catat
        ]);
    }

    // Menu 2: Input Koreksi Rekening (Poin Minus)
    public function inputKoreksi(Request $request)
    {
        $koreksi = KoreksiRekening::create([
            'biller_id' => $request->biller_id,
            'jumlah_minus' => $request->jumlah_minus,
            'keterangan' => $request->keterangan,
            'tanggal' => Carbon::now()->format('Y-m-d')
        ]);

        return response()->json([
            'pesan' => 'Koreksi rekening berhasil dicatat',
            'data' => $koreksi
        ]);
    }

    // Menu 3: Simpan Penyelesaian Work Order (Invoice)
    public function simpanInvoice(Request $request)
    {
        $invoice = Invoice::create([
            'biller_id' => $request->biller_id,
            'work_order_id' => $request->work_order_id,
            'status' => 'selesai',
            'tanggal_invoice' => Carbon::now()->format('Y-m-d')
        ]);

        return response()->json([
            'pesan' => 'Invoice berhasil disimpan, poin ditambahkan',
            'data' => $invoice
        ]);
    }
}