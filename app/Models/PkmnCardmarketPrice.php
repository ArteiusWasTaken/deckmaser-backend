<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static updateOrCreate(array $array, array $array1)
 */
class PkmnCardmarketPrice extends Model
{
//    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['card_id', 'url', 'prices'];

    protected $casts = [
        'prices' => 'array',
    ];

    public function card(): BelongsTo
    {
        return $this->belongsTo(PkmnCard::class, 'card_id');
    }
}
