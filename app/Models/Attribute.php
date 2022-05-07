<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attribute extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'field_type_id',
        'attributes_category_id',
    ];

    /**
     * Get all of the items for the Attribute
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(AttributeItem::class);
    }

    /**
     * Get the fieldType that owns the Attribute
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fieldType()
    {
        return $this->belongsTo(FieldType::class);
    }

    /**
     * The ads that belong to the Attribute
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ads()
    {
        return $this->belongsToMany(Ad::class);
    }
}
