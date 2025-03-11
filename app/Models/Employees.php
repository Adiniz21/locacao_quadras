<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employees extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['user_id', 'position', 'salary', 'hired_date'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'hired_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
