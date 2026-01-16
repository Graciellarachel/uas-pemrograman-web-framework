<?php

namespace App\Http\Controllers;

use App\Models\TicketType;
use App\Models\Event;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menampilkan daftar jenis tiket beserta relasi event
        $tickets = TicketType::with('event')->get();
        return view('admin.tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengambil semua data event untuk pilihan dropdown
        $events = Event::all();
        return view('admin.tickets.create', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input data tiket
        $request->validate([
            'event_id'   => 'required|exists:events,id',
            'nama_tiket' => 'required|string|max:255',
            'harga'      => 'required|numeric|min:0',
            'stok'       => 'required|numeric|min:0',
        ]);

        TicketType::create($request->all());

        return redirect()->route('tickets.index')->with('success', 'Jenis Tiket berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TicketType $ticket)
    {
        // Mengambil semua event untuk pilihan dropdown saat edit
        $events = Event::all();
        return view('admin.tickets.edit', compact('ticket', 'events'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TicketType $ticket)
    {
        // Validasi data tiket saat update
        $request->validate([
            'event_id'   => 'required|exists:events,id',
            'nama_tiket' => 'required|string|max:255',
            'harga'      => 'required|numeric|min:0',
            'stok'       => 'required|numeric|min:0',
        ]);

        $ticket->update($request->all());

        return redirect()->route('tickets.index')->with('success', 'Jenis Tiket berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketType $ticket)
    {
        // Menghapus data tiket
        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Jenis Tiket berhasil dihapus.');
    }
}
