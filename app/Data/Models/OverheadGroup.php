<?php

namespace GaziWorks\Performance\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * GaziWorks\Performance\Data\Models\OverheadGroup
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\GaziWorks\Performance\Data\Models\OverheadTitle[] $titles
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadGroup whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadGroup whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadGroup whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadGroup whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\OverheadGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OverheadGroup extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'overhead_groups';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function titles()
    {
        return $this->hasMany(OverheadTitle::class, 'overhead_group_id', 'id');
    }
}
