<?php

namespace GaziWorks\Performance\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * GaziWorks\Performance\Data\Models\ProductSubGroup
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\GaziWorks\Performance\Data\Models\Product[] $products
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\ProductSubGroup whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\ProductSubGroup whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\ProductSubGroup whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\ProductSubGroup whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\ProductSubGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\ProductSubGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductSubGroup extends Model
{
    use SoftDeletes;

    public $_products;
    public $_sales;
    public $_amount;
    public $_ingredients;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_sub_groups';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function products() {
        return $this->hasMany(Product::class);
    }
}
