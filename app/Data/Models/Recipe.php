<?php

namespace GaziWorks\Performance\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * GaziWorks\Performance\Data\Models\Recipe
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\GaziWorks\Performance\Data\Models\Ingredient[] $ingredients
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Recipe whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Recipe whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Recipe whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Recipe whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Recipe whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\Recipe whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Recipe extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $casts = [
        'name' => 'string',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function ingredients() {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredients', 'recipe_id', 'ingredient_id')->withPivot('quantity');
    }
}
