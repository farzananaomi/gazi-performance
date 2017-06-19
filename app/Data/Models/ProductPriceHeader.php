<?php

namespace GaziWorks\Performance\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * GaziWorks\Performance\Data\Models\ProductPriceHeader
 *
 * @property integer $id
 * @property string $month
 * @property integer $year
 * @property string $state
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\GaziWorks\Performance\Data\Models\ProductPrice[] $prices
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\ProductPriceHeader whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\ProductPriceHeader whereMonth($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\ProductPriceHeader whereYear($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\ProductPriceHeader whereState($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\ProductPriceHeader whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\ProductPriceHeader whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\ProductPriceHeader whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductPriceHeader extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_price_headers';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = ['month', 'year'];

    public function prices()
    {
        return $this->hasMany(ProductPrice::class, 'header_id', 'id');
    }
}
