<?php

namespace GaziWorks\Performance\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * GaziWorks\Performance\Data\Models\OverheadCost
 *
 * @property integer $id
 * @property integer $header_id
 * @property integer $overhead_id
 * @property float $cost
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \GaziWorks\Performance\Data\Models\OverheadTitle $title
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadCost whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadCost whereHeaderId($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadCost whereOverheadId($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadCost whereCost($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadCost whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadCost whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadCost whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OverheadCost extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'overhead_costs';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function title()
    {
        return $this->belongsTo(OverheadTitle::class, 'overhead_id');
    }
}
