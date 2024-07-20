<?php

namespace App\Http\Controllers;

use Auth;
use App\Barang;
use App\Merek;
use App\Order;
use App\Favorite;
use App\Http\Controllers\PDF;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatistikController extends Controller
{
    public function index(Request $request)
    {
        $selectedMonth = $request->input('bulan', date('m'));
        $selectedYear = $request->input('tahun', date('Y'));
        $selectedMerek = $request->input('merek', '');
        $merekOptions = Barang::join('merek', 'barang.merek_id', '=', 'merek.id')
        ->distinct('merek.name')
        ->pluck('merek.name');

        // Ambil bulan dan tahun dari input, default ke bulan dan tahun saat ini
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));


        $salesData = Order::selectRaw('merek.name as brand_name, SUM(order.quantity) as total_quantity')
        ->join('barang', 'order.barang_id', '=', 'barang.id')
        ->join('merek', 'barang.merek_id', '=', 'merek.id')
        ->where('order.payment_status', 'Sudah Dibayar')
        ->whereMonth('order.created_at', $bulan)
        ->whereYear('order.created_at', $tahun)
        ->when($selectedMerek, function ($query, $selectedMerek) {
            return $query->where('merek.name', $selectedMerek);
        })
        ->groupBy('merek.name')
        ->get();

        $bulanNames = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        $totalSalesData = DB::table('order')
            ->select(DB::raw('MONTH(created_at) as bulan'), DB::raw('YEAR(created_at) as tahun'), DB::raw('SUM(total) as total_sales'))
            ->groupBy('bulan', 'tahun')
            ->get();

        return view('admin.statistik.index', compact('salesData', 'selectedMonth', 'selectedYear', 'bulanNames', 'totalSalesData', 'selectedMerek', 'merekOptions'));

    }
}
