<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Exports\TransactionsExport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    /**
     * Display sales report page
     */
    public function index()
    {
        // Ambil semua transaksi dengan status paid
        $transactions = Transaction::where('status', 'paid')
            ->with(['user', 'ticketType.event'])
            ->latest()
            ->get();

        // Hitung total tiket terjual dan total pendapatan
        $totalTiketTerjual = Transaction::where('status', 'paid')->sum('quantity');
        $totalPendapatan = Transaction::where('status', 'paid')->sum('total_price');

        return view('admin.reports.index', compact('transactions', 'totalTiketTerjual', 'totalPendapatan'));
    }

    /**
     * Export report to PDF
     */
    public function exportPDF()
    {
        $transactions = Transaction::where('status', 'paid')
            ->with(['user', 'ticketType.event'])
            ->latest()
            ->get();

        $totalTiketTerjual = Transaction::where('status', 'paid')->sum('quantity');
        $totalPendapatan = Transaction::where('status', 'paid')->sum('total_price');

        $pdf = Pdf::loadView('admin.reports.pdf', compact('transactions', 'totalTiketTerjual', 'totalPendapatan'));
        
        return $pdf->download('laporan-penjualan-tiket-' . date('Y-m-d') . '.pdf');
    }

    /**
     * Export report to Excel
     */
    public function exportExcel()
    {
        return Excel::download(new TransactionsExport, 'laporan-penjualan-tiket-' . date('Y-m-d') . '.xlsx');
    }
}
