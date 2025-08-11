<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Reservation extends Model
{
    protected $fillable = [
        'sports_facilities_id','user_id',
        'reservation_date','start_time','end_time',
        'total_price','payment_status','recurrence','notification_sent',
    ];

    protected $casts = [
        'reservation_date' => 'date',
        'notification_sent' => 'boolean',
    ];

    public function user()     { return $this->belongsTo(User::class); }
    public function facility() { return $this->belongsTo(SportsFacility::class, 'sports_facilities_id'); }

    public function getStartAtAttribute(): ?Carbon
    {
        if (!$this->reservation_date || !$this->start_time) return null;
        return Carbon::parse($this->reservation_date->toDateString().' '.$this->start_time);
    }

    public function getEndAtAttribute(): ?Carbon
    {
        if (!$this->reservation_date || !$this->end_time) return null;
        return Carbon::parse($this->reservation_date->toDateString().' '.$this->end_time);
    }

    public static function overlaps(int $facilityId, string $date, string $startTime, string $endTime): bool
    {
        return static::where('sports_facilities_id', $facilityId)
            ->whereDate('reservation_date', $date)
            ->whereNotIn('payment_status', ['cancelled'])
            ->where(function ($q) use ($startTime, $endTime) {
                $q->whereBetween('start_time', [$startTime, $endTime])
                  ->orWhereBetween('end_time',   [$startTime, $endTime])
                  ->orWhere(function ($q2) use ($startTime, $endTime) {
                      $q2->where('start_time', '<=', $startTime)
                         ->where('end_time',   '>=', $endTime);
                  });
            })->exists();
    }
}
