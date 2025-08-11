<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SportsFacility extends Model
{
    protected $fillable = ['venue_id','owner_id','name','city','address','hourly_price'];

    public function venue()        { return $this->belongsTo(Venue::class); }
    public function owner()        { return $this->belongsTo(User::class,'owner_id'); }
    public function reservations() { return $this->hasMany(Reservation::class, 'sports_facilities_id'); }
}
