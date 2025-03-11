<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'sports_facilities_id',
        'user_id',
        'reservation_date',
        'start_time',
        'end_time',
        'total_price',
        'payment_status',
        'recurrence',
        'notification_sent',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'reservation_date' => 'date',
        'notification_sent' => 'boolean',
    ];

    public function sportsFacilities()
    {
        return $this->belongsTo(SportsFacilities::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
