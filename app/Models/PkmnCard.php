<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static updateOrCreate(array $array, array $array1)
 */
class PkmnCard extends Model
{
//    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id', 'name', 'set_id', 'supertype', 'subtypes', 'hp', 'types',
        'evolves_from', 'abilities', 'attacks', 'weaknesses', 'retreat_cost',
        'converted_retreat_cost', 'rarity', 'artist', 'flavor_text',
        'national_pokedex_numbers', 'legalities', 'images'
    ];

    protected $casts = [
        'subtypes' => 'array',
        'types' => 'array',
        'abilities' => 'array',
        'attacks' => 'array',
        'weaknesses' => 'array',
        'retreat_cost' => 'array',
        'national_pokedex_numbers' => 'array',
        'legalities' => 'array',
        'images' => 'array',
    ];

    public function set(): BelongsTo
    {
        return $this->belongsTo(PkmnCardSet::class, 'set_id');
    }

    /** @noinspection PhpUnused */
    public function cardmarketPrice(): HasOne
    {
        return $this->hasOne(PkmnCardmarketPrice::class, 'card_id');
    }

    /** @noinspection PhpUnused */
    public function tcgplayerPrice(): HasOne
    {
        return $this->hasOne(PkmnTcgplayerPrice::class, 'card_id');
    }
}
