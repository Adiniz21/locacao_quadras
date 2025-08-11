<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $fillable = ['owner_id','name','city','address'];

    public function owner()  { return $this->belongsTo(User::class, 'owner_id'); }
    public function courts() { return $this->hasMany(SportsFacility::class, 'venue_id'); } // "courts" = semântica
}
