<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AntrianController extends Controller
{
    public function index(Request $request)
    {
        if (!session()->has('operator_login')) {
            return redirect('/')->withErrors(['username' => 'Silakan login terlebih dahulu untuk mengakses meja layanan.']);
        }

        $divisi_aktif = session('operator_role');
        $hari_ini = \Carbon\Carbon::today();

        $jumlah_antrian = DB::table('antrian')
            ->where('divisi', $divisi_aktif)
            ->whereDate('created_at', $hari_ini)
            ->count();

        $sekarang = DB::table('antrian')
            ->where('status', 'dipanggil')
            ->where('divisi', $divisi_aktif)
            ->whereDate('created_at', $hari_ini)
            ->orderBy('id', 'desc')
            ->first();
        $antrian_sekarang = $sekarang ? $sekarang->nomor_antrian : '-';

        $selanjutnya = DB::table('antrian')
            ->where('status', 'menunggu')
            ->where('divisi', $divisi_aktif)
            ->whereDate('created_at', $hari_ini)
            ->orderBy('id', 'asc')
            ->first();

        $antrian_selanjutnya = $selanjutnya ? $selanjutnya->nomor_antrian : '-';
        $next_id = $selanjutnya ? $selanjutnya->id : null;

        $sisa_antrian = DB::table('antrian')
            ->where('status', 'menunggu')
            ->where('divisi', $divisi_aktif)
            ->whereDate('created_at', $hari_ini)
            ->count();

        $semua_antrian = DB::table('antrian')
            ->where('divisi', $divisi_aktif)
            ->whereDate('created_at', $hari_ini)
            ->orderByRaw("FIELD(status, 'dipanggil', 'menunggu', 'dilewati', 'selesai') ASC")
            ->orderBy('id', 'asc')
            ->paginate(9);

        return view('antrian', compact(
            'jumlah_antrian',
            'antrian_sekarang',
            'antrian_selanjutnya',
            'sisa_antrian',
            'semua_antrian',
            'divisi_aktif',
            'next_id'
        ));
    }

    public function panggil($id)
    {
        return DB::transaction(function () use ($id) {

            $antrian_target = DB::table('antrian')->where('id', $id)->first();
            if (!$antrian_target) {
                return response()->json(['success' => false, 'message' => 'Data tidak ditemukan']);
            }

            $divisi_aktif = $antrian_target->divisi;
            $hari_ini = \Carbon\Carbon::today();

            DB::table('antrian')
                ->where('status', 'dipanggil')
                ->where('divisi', $divisi_aktif)
                ->whereDate('created_at', $hari_ini)
                ->update([
                    'status' => 'selesai',
                    'updated_at' => now()
                ]);

            DB::table('antrian')
                ->where('id', $id)
                ->update([
                    'status' => 'dipanggil',
                    'updated_at' => now()
                ]);

            $antrian_sekarang = DB::table('antrian')
                ->where('status', 'dipanggil')
                ->where('divisi', $divisi_aktif)
                ->whereDate('created_at', $hari_ini)
                ->orderBy('id', 'desc')
                ->value('nomor_antrian') ?? '-';

            $selanjutnya = DB::table('antrian')
                ->where('status', 'menunggu')
                ->where('divisi', $divisi_aktif)
                ->whereDate('created_at', $hari_ini)
                ->orderBy('id', 'asc')
                ->first();
            $antrian_selanjutnya = $selanjutnya ? $selanjutnya->nomor_antrian : '-';

            $jumlah_antrian = DB::table('antrian')
                ->where('divisi', $divisi_aktif)
                ->whereDate('created_at', $hari_ini)
                ->count();

            $sisa_antrian = DB::table('antrian')
                ->where('status', 'menunggu')
                ->where('divisi', $divisi_aktif)
                ->whereDate('created_at', $hari_ini)
                ->count();

            return response()->json([
                'success' => true,
                'jumlah_antrian' => $jumlah_antrian,
                'antrian_sekarang' => $antrian_sekarang,
                'antrian_selanjutnya' => $antrian_selanjutnya,
                'sisa_antrian' => $sisa_antrian
            ]);
        });
    }

    public function halamanAmbil()
    {
        return view('ambil');
    }

    public function simpanAntrian(Request $request)
    {
        try {
            $divisiInput = $request->input('divisi');
            $hari_ini = \Carbon\Carbon::today();

            switch ($divisiInput) {
                case 'A':
                case 'Kesektariatan':
                case 'Kesekretariatan':
                    $prefix = 'S';
                    $divisiDatabase = 'Kesekretariatan';
                    break;

                case 'B':
                case 'Kepanitraan':
                case 'Kepaniteraan':
                    $prefix = 'P';
                    $divisiDatabase = 'Kepaniteraan';
                    break;

                case 'C':
                case 'Informasi':
                    $prefix = 'I';
                    $divisiDatabase = 'Informasi';
                    break;

                case 'D':
                case 'Konsultasi':
                case 'Konsultasi dan Pengaduan':
                    $prefix = 'K';
                    $divisiDatabase = 'Konsultasi';
                    break;

                default:
                    $prefix = 'S';
                    $divisiDatabase = 'Kesekretariatan';
            }

            $jumlah_hari_ini = DB::table('antrian')
                ->where('divisi', $divisiDatabase)
                ->whereDate('created_at', $hari_ini)
                ->count();

            $nomor_urut = $jumlah_hari_ini + 1;
            $nomor_baru = $prefix . '-' . str_pad($nomor_urut, 3, '0', STR_PAD_LEFT);

            DB::table('antrian')->insert([
                'nomor_antrian' => $nomor_baru,
                'divisi' => $divisiDatabase,
                'status' => 'menunggu',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'nomor_baru' => $nomor_baru
            ]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function halamanDisplay()
    {
        return view('display');
    }

    public function dataMonitorJson()
    {
        $divisi_list = [
            'Kesekretariatan' => 'kesekretariatan',
            'Kepaniteraan' => 'kepaniteraan',
            'Informasi' => 'informasi',
            'Konsultasi' => 'konsultasi_dan_pengaduan'
        ];

        $data_respon = [];
        $hari_ini = \Carbon\Carbon::today();

        foreach ($divisi_list as $namaDb => $slugNama) {
            $sekarang = DB::table('antrian')
                ->where('status', 'dipanggil')
                ->where('divisi', $namaDb)
                ->whereDate('created_at', $hari_ini)
                ->orderBy('id', 'desc')
                ->first();

            $selanjutnya = DB::table('antrian')
                ->where('status', 'menunggu')
                ->where('divisi', $namaDb)
                ->whereDate('created_at', $hari_ini)
                ->orderBy('id', 'asc')
                ->first();

            $sisa = DB::table('antrian')
                ->where('status', 'menunggu')
                ->where('divisi', $namaDb)
                ->whereDate('created_at', $hari_ini)
                ->count();

            $dilewati = DB::table('antrian')
                ->where('status', 'dilewati')
                ->where('divisi', $namaDb)
                ->whereDate('created_at', $hari_ini)
                ->orderBy('updated_at', 'asc')
                ->pluck('nomor_antrian')
                ->toArray();

            $data_respon['divisi_' . $slugNama] = [
                'sekarang' => $sekarang ? $sekarang->nomor_antrian : '-',
                'waktu_update' => $sekarang ? $sekarang->updated_at : null,
                'selanjutnya' => $selanjutnya ? $selanjutnya->nomor_antrian : '-',
                'sisa' => $sisa,
                'dilewati' => $dilewati
            ];
        }

        return response()->json($data_respon);
    }


    public function skip($id)
    {
        DB::table('antrian')
            ->where('id', $id)
            ->update([
                'status' => 'dilewati',
                'updated_at' => date('Y-m-d H:i:s')
            ]);


        return response()->json(['success' => true]);
    }
}