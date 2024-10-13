<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use function Pest\Laravel\json;

class Check extends Model
{
    /** @use HasFactory<\Database\Factories\CheckFactory> */
    use HasFactory, HasUlids;
    protected $fillable = ['name', 'path', 'method', 'body', 'headers', 'parameters', 'credential_id', 'service_id'];
    public function casts()
    {
        return [
            'body' => 'json',
            'headers' => AsCollection::class,
            'parameters' => AsCollection::class
        ];
    }
    public function credential(): BelongsTo
    {
        return $this->belongsTo(related: Credential::class, foreignKey: 'credential_id');
    }
    public function service(): BelongsTo
    {
        return $this->belongsTo(related: Service::class, foreignKey: 'service_id');
    }
}