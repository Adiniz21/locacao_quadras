<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SportsFacility extends Model
{
    use HasFactory; 

    protected $fillable = [
        'venue_id','owner_id','name','type','capacity',
        'hourly_price','availability','city','address',
    ];

    public function venue() { return $this->belongsTo(Venue::class); }
    public function owner() { return $this->belongsTo(User::class,'owner_id'); }
    public function reservations() { return $this->hasMany(Reservation::class,'sports_facilities_id'); }
}
