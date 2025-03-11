<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Maintenance extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'sports_facilities_id',
        'description',
        ' scheduled_date',
        'status',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        ' scheduled_date' => 'date',
    ];

    public function sportsFacilities()
    {
        return $this->belongsTo(SportsFacilities::class);
    }
}
