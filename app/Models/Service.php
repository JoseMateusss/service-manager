<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'completion_date',
        'description',
        'protocol',
        'user_id'
    ];

    public function getNextProtocol(): string
    {
        $date = Carbon::now()->format('d.m.y');
        $todayServices = self::whereDate('created_at', Carbon::today())->count();
        $nextService = $todayServices >= 9 ? strval($todayServices + 1) : '0'. strval($todayServices + 1);
        return $date . '.' . $nextService;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
