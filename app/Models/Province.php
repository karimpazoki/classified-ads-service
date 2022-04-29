<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\country;

class Province extends Model 
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 
    ];

    /**
     * Get the country that owns the province.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the cities of the province.
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
