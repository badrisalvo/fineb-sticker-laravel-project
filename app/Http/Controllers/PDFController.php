<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PDF;
use App\Barang;
use App\Merek;
use App\Order;
use App\Statistik;
use App\Favorite;
use Illuminate\Support\Str;
use Session;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
{
    public function generatePDF(Request $request)
{
    // Mendapatkan bulan, tahun, dan merek yang dipilih dari permintaan
    $selectedMonth = $request->query('bulan', now()->month);
    $selectedYear = $request->query('tahun', now()->year);
    $selectedMerek = $request->query('merek');

    // Fetch data penjualan sesuai dengan bulan, tahun, dan merek yang dipilih
    $orders = Order::select('order.*', 'merek.name as merek_name')
        ->join('barang', 'order.barang_id', '=', 'barang.id')
        ->join('merek', 'barang.merek_id', '=', 'merek.id')
        ->where('order.payment_status', 'Sudah Dibayar')
        ->whereMonth('order.created_at', $selectedMonth)
        ->whereYear('order.created_at', $selectedYear);

    if ($selectedMerek) {
        $orders->where('merek.name', $selectedMerek);
    }

    $orders = $orders->get();

    $totalPenjualan = $orders->sum('total');

    // Generate the PDF
    $pdf = PDF::loadView('pdf.laporan_penjualan', compact('orders', 'totalPenjualan', 'selectedMonth', 'selectedYear', 'selectedMerek'));

    // Return the PDF as a download
    return $pdf->download('laporan_penjualan_'.$selectedMonth.'_'.$selectedYear.'_merek_'.$selectedMerek.'.pdf');
}

    
}