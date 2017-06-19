<?php

namespace GaziWorks\Performance\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * GaziWorks\Performance\Data\Models\Product
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property string $standard
 * @property string $length
 * @property string $min_thickness
 * @property string $max_thickness
 * @property string $weight
 * @property string $color
 * @property string $image_path
 * @property integer $recipe_id
 * @property integer $product_group_id
 * @property integer $product_sub_group_id
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \GaziWorks\Performance\Data\Models\ProductGroup $group
 * @property-read \GaziWorks\Performance\Data\Models\ProductSubGroup $subgroup
 * @property-read \GaziWorks\Performance\Data\Models\Recipe $recipe
 * @property-read \Illuminate\Database\Eloquent\Collection|\GaziWorks\Performance\Data\Models\ProductPrice[] $prices
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Product whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Product whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Product whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Product whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Product whereStandard($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Product whereLength($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Product whereMinThickness($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Product whereMaxThickness($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Product whereWeight($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Product whereColor($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Product whereImagePath($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Product whereRecipeId($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Product whereProductGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Product whereProductSubGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    use SoftDeletes;

    public $_price;
    public $_sales;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function group() {
        return $this->belongsTo(ProductGroup::class, 'product_group_id', 'id');
    }

    public function subgroup() {
        return $this->belongsTo(ProductSubGroup::class, 'product_sub_group_id', 'id');
    }

    public function recipe() {
        return $this->belongsTo(Recipe::class);
    }

    public function prices() {
        return $this->hasMany(ProductPrice::class);
    }
}
