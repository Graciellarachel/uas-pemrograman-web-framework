<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\TicketType;
use App\Models\Transaction;

class AdminController extends Controller
{
    /**
     * Display admin dashboard with statistics
     */
    public function index()
    {
        // Statistics
        $totalUsers = User::where('role', 'user')->count();
        $totalEvents = Event::count();
        $totalTicketTypes = TicketType::count();
        $totalSales = Transaction::where('status', 'paid')->sum('total_price');
        $totalTicketsSold = Transaction::where('status', 'paid')->sum('quantity');

        // Chart Data: Penjualan per Event
        $salesByEvent = Transaction::where('status', 'paid')
            ->with('ticketType.event')
            ->get()
            ->groupBy(function($transaction) {
                return $transaction->ticketType->event->nama_event;
            })
            ->map(function($group) {
                return $group->sum('total_price');
            });

        $eventNames = $salesByEvent->keys()->toArray();
        $eventSales = $salesByEvent->values()->toArray();

        // Recent Transactions
        $recentTransactions = Transaction::where('status', 'paid')
            ->with(['user', 'ticketType.event'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalEvents',
            'totalTicketTypes',
            'totalSales',
            'totalTicketsSold',
            'eventNames',
            'eventSales',
            'recentTransactions'
        ));
    }
}
