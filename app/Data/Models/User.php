<?php

namespace GaziWorks\Performance\Data\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * GaziWorks\Performance\Data\Models\User
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GaziWorks\Performance\Data\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}
