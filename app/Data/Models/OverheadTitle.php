<?php

namespace GaziWorks\Performance\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * GaziWorks\Performance\Data\Models\OverheadTitle
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $type
 * @property integer $overhead_group_id
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \GaziWorks\Performance\Data\Models\OverheadGroup $group
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadTitle whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadTitle whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadTitle whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadTitle whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadTitle whereOverheadGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadTitle whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadTitle whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadTitle whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OverheadTitle extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'overhead_titles';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function group()
    {
        return $this->belongsTo(OverheadGroup::class, 'overhead_group_id');
    }
}
