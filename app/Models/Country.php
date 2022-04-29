<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model 
{
    use HasFactory;
    
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
