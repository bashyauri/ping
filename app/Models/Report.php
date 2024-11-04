<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    /** @use HasFactory<\Database\Factories\ReportFactory> */
    use HasFactory, HasUlids;
    protected $fillable = [
        'url',
        'content_type',
        'status',
        'header_size',
        'request_size',
        'redirect_count',
        'http_version',
        'appconnect_time',
        'connect_time',
        'namelookup_time',
        'pretransfer_time',
        'starttransfer_time',
        'redirect_time',
        'total_time',
        'check_id',
        'started_at',
        'finished_at',

    ];

    public function check(): BelongsTo
    {
        return $this->belongsTo(related: Check::class, foreignKey: 'check_id');
    }

    public function casts(): array
    {
        return [
            'status' => 'integer',
            'header_size' => 'integer',
            'request_size' => 'integer',
            'redirecT_count' => 'integer',
            'http_version' => 'integer',
            'appconnect_time' => 'integer',
            'connect_time' => 'integer',
            'namelookup_time' => 'integer',
            'pretransfer_time' => 'integer',
            'redirect_time' => 'integer',
            'starttransfer_time' => 'integer',
            'total_time' => 'integer',
            'started_at' => 'datetime',
            'finished_at' => 'datetime',

        ];
    }
}
