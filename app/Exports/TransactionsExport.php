<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Return collection of transactions
     */
    public function collection()
    {
        return Transaction::where('status', 'paid')
            ->with(['user', 'ticketType.event'])
            ->latest()
            ->get();
    }

    /**
     * Define column headings
     */
    public function headings(): array
    {
        return [
            'No. Transaksi',
            'Nama User',
            'Nama Event',
            'Jenis Tiket',
            'Jumlah Tiket',
            'Harga Satuan',
            'Total Harga',
            'Tanggal Transaksi',
        ];
    }

    /**
     * Map data for each row
     */
    public function map($transaction): array
    {
        return [
            $transaction->id,
            $transaction->user->name,
            $transaction->ticketType->event->nama_event,
            $transaction->ticketType->nama_tiket,
            $transaction->quantity,
            'Rp ' . number_format($transaction->ticketType->harga, 0, ',', '.'),
            'Rp ' . number_format($transaction->total_price, 0, ',', '.'),
            $transaction->created_at->format('d M Y H:i'),
        ];
    }
}
