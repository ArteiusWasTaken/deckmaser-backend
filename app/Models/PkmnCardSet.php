<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static updateOrCreate(array $array, array $array1)
 * @method static orderByDesc(string $string)
 */
class PkmnCardSet extends Model
{
//    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id', 'name', 'series', 'printed_total',
        'total', 'ptcgo_code', 'release_date', 'legalities', 'images'
    ];

    protected $casts = [
        'legalities' => 'array',
        'images' => 'array',
    ];

    /** @noinspection PhpUnused */
    public function cards(): HasMany
    {
        return $this->hasMany(PkmnCard::class, 'set_id');
    }
}
