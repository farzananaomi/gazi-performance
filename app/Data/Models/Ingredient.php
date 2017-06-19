<?php

namespace GaziWorks\Performance\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * GaziWorks\Performance\Data\Models\Ingredient
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Ingredient whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Ingredient whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Ingredient whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Ingredient wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Ingredient whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Ingredient whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Ingredient whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Ingredient extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ingredients';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}
