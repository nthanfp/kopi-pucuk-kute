<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Menampilkan halaman utama laporan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.reports.index');
    }

    /**
     * Menampilkan laporan penjualan.
     *
     * @return \Illuminate\View\View
     */
    public function salesReport(Request $request)
    {
        // Validasi input
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Inisialisasi filter tanggal dengan nilai default
        $startDate = null;
        $endDate = null;

        // Cek apakah terdapat parameter start_date dan end_date di request
        if ($request->has(['start_date', 'end_date'])) {
            // Jika ada, gunakan nilai dari request
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
        }

        // Ambil data laporan penjualan berdasarkan filter tanggal dari request
        $salesReport = Transaction::query();

        // Filter data berdasarkan tanggal jika parameter diberikan
        if ($startDate && $endDate) {
            $salesReport->whereBetween('transaction_date', [$startDate, $endDate]);
        }

        // Ambil hasil laporan
        $salesReport = $salesReport->get();

        // Kemudian kirim data laporan ke view
        return view('admin.reports.sales', ['salesReport' => $salesReport]);
    }

    /**
     * Menampilkan laporan inventaris.
     *
     * @return \Illuminate\View\View
     */
    public function inventoryReport(Request $request)
    {
        // Validasi input
    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    // Ambil tanggal mulai dan selesai dari request
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Ambil data produk yang terjual berdasarkan rentang tanggal
    $salesReport = TransactionDetail::whereHas('transaction', function ($query) use ($startDate, $endDate) {
        $query->whereBetween('transaction_date', [$startDate, $endDate]);
    })->with('product')->get();

    // Kirim data produk yang terjual ke view
    return view('admin.reports.inventory', ['salesReport' => $salesReport]);
    }

    /**
     * Menampilkan laporan pelanggan.
     *
     * @return \Illuminate\View\View
     */
    public function customerReport()
    {
        // Logika untuk mengambil dan menampilkan laporan pelanggan
        return view('admin.reports.customer');
    }

    // Tambahkan method lain untuk laporan tambahan jika diperlukan
}
