<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'nama_event',
        'tanggal_event',
        'lokasi',
        'deskripsi',
    ];

    public function ticketTypes()
    {
        return $this->hasMany(TicketType::class, 'event_id');
    }
}
