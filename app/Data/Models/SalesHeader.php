<?php
namespace GaziWorks\Performance\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * GaziWorks\Performance\Data\Models\SalesHeader
 *
 * @property integer $id
 * @property string $month
 * @property integer $year
 * @property float $package_commission
 * @property float $special_commission
 * @property float $yearly_commission
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\SalesHeader whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\SalesHeader whereMonth($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\SalesHeader whereYear($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\SalesHeader wherePackageCommission($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\SalesHeader whereSpecialCommission($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\SalesHeader whereYearlyCommission($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\SalesHeader whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\SalesHeader whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\SalesHeader whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SalesHeader extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sales_headers';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function salesData()
    {
        return $this->hasMany(ProductSale::class, 'header_id', 'id');
    }
}