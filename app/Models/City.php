<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Province;

class City extends Model 
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
     * Get the province that owns the province.
     */
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
