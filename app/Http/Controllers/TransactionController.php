<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TicketType;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Show purchase form for specific event
     */
    public function create(Event $event)
    {
        // Load ticket types dengan relasi event
        $ticketTypes = $event->ticketTypes()->where('stok', '>', 0)->get();
        
        return view('transactions.create', compact('event', 'ticketTypes'));
    }

    /**
     * Process ticket purchase with stock management
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'ticket_type_id' => 'required|exists:ticket_types,id',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            // Gunakan DB Transaction untuk atomicity
            DB::transaction(function () use ($request) {
                // Lock ticket type untuk mencegah race condition
                $ticketType = TicketType::where('id', $request->ticket_type_id)
                    ->lockForUpdate()
                    ->first();

                // Cek ketersediaan stok
                if ($ticketType->stok < $request->quantity) {
                    throw new \Exception('Stok tiket tidak mencukupi. Tersedia: ' . $ticketType->stok);
                }

                // Hitung total harga
                $totalPrice = $ticketType->harga * $request->quantity;

                // Kurangi stok
                $ticketType->decrement('stok', $request->quantity);

                // Simpan transaksi
                Transaction::create([
                    'user_id' => Auth::id(),
                    'ticket_type_id' => $ticketType->id,
                    'quantity' => $request->quantity,
                    'total_price' => $totalPrice,
                    'status' => 'paid',
                ]);
            });

            return redirect()->route('transactions.history')
                ->with('success', 'Pembelian tiket berhasil!');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show user's transaction history
     */
    public function history()
    {
        $transactions = Auth::user()->transactions()
            ->with(['ticketType.event'])
            ->latest()
            ->get();

        return view('transactions.history', compact('transactions'));
    }

    /**
     * Download ticket as PDF
     */
    public function downloadTicket(Transaction $transaction)
    {
        // Pastikan user hanya bisa download tiket miliknya sendiri
        if ($transaction->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('transactions.ticket-pdf', compact('transaction'));
        
        return $pdf->download('tiket-' . $transaction->ticketType->event->nama_event . '-' . $transaction->id . '.pdf');
    }
}
