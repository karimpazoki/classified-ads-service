<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Province;

class Country extends Model 
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 
        'code',
    ];

    /**
     * Get the provinces of the province.
     */
    public function provinces()
    {
        return $this->hasMany(Province::class);
    }
}
