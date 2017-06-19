<?php

namespace GaziWorks\Performance\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * GaziWorks\Performance\Data\Models\OverheadCostHeader
 *
 * @property integer $id
 * @property string $month
 * @property integer $year
 * @property string $state
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\GaziWorks\Performance\Data\Models\OverheadCost[] $costs
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadCostHeader whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadCostHeader whereMonth($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadCostHeader whereYear($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadCostHeader whereState($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadCostHeader whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadCostHeader whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadCostHeader whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OverheadCostHeader extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'overhead_cost_headers';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = ['month', 'year'];

    public function costs()
    {
        return $this->hasMany(OverheadCost::class, 'header_id', 'id');
    }
}
