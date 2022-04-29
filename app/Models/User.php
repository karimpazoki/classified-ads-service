<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use App\Models\City;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 
        'email',
        'gender',
        'mobile',
        'city_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'password',
    ];

    /**
     * types of users gender
     *
     * @var string[]
     */
    const GENDER = [
        "male" => "male",
        "female" => "female",
    ];
    
    /**
     * retrurns genders
     *
     * @return string[]
     */
    public function genders(): array
    {
        return self::GENDER;
    }

    public function city()
    {
        return $tis->belongsTo(City::class);
    }
}
