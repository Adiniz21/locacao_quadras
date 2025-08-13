<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use app\Models\User;

class Employees extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'position', 'salary', 'hired_date'];

    protected $casts = [
        'salary'     => 'decimal:2',
        'hired_date' => 'date',
    ];

    // valores possíveis do ENUM (devem bater com a migration)
    public const POSITIONS = ['manager', 'referee', 'cleaner', 'staff'];

    public static function positions(): array
    {
        return self::POSITIONS;
    }

    public function user()
    {
        // <<< Adicione este import no topo do arquivo, se faltar:
        // use App\Models\User;
        return $this->belongsTo(User::class);
    }
}
