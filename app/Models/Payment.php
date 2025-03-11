<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'reservation_id',
        'amount',
        'payment_method',
        'status',
        'transaction_date',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'transaction_date' => 'datetime',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
