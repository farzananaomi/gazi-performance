<?php
namespace GaziWorks\Performance\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * GaziWorks\Performance\Data\Models\ProductSale
 *
 * @property integer $id
 * @property integer $header_id
 * @property integer $product_id
 * @property float $retail_quantity
 * @property float $corporate_quantity
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\ProductSale whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\ProductSale whereHeaderId($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\ProductSale whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\ProductSale whereRetailQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\ProductSale whereCorporateQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\ProductSale whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\ProductSale whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\ProductSale whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductSale extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_sales';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}