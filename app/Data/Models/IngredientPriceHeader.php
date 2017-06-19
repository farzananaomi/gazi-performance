<?php

namespace GaziWorks\Performance\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * GaziWorks\Performance\Data\Models\IngredientPriceHeader
 *
 * @property integer $id
 * @property string $month
 * @property integer $year
 * @property string $state
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\GaziWorks\Performance\Data\Models\IngredientPrice[] $prices
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\IngredientPriceHeader whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\IngredientPriceHeader whereMonth($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\IngredientPriceHeader whereYear($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\IngredientPriceHeader whereState($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\IngredientPriceHeader whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\IngredientPriceHeader whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\IngredientPriceHeader whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class IngredientPriceHeader extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ingredient_price_headers';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = ['month', 'year'];

    public function prices()
    {
        return $this->hasMany(IngredientPrice::class, 'header_id', 'id');
    }
}
