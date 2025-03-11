<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SportsFacilities extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'type',
        'capacity',
        'price_per_hour',
        'availabilitiy',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'sports_facilities';

    protected $casts = [
        'availabilitiy' => 'boolean',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }
}
