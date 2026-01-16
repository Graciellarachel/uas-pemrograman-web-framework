<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class UserEventController extends Controller
{
    /**
     * Display list of all events for users
     */
    public function index()
    {
        $events = Event::where('tanggal_event', '>=', now())
            ->orderBy('tanggal_event', 'asc')
            ->get();
            
        return view('user.events.index', compact('events'));
    }

    /**
     * Show event detail with available tickets
     */
    public function show(Event $event)
    {
        $event->load(['ticketTypes' => function($query) {
            $query->where('stok', '>', 0);
        }]);
        
        return view('user.events.show', compact('event'));
    }
}
