<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    const PARENT_CATEGORY = 0;

    protected $table = 'm_category';

    protected $appends = ['label', 'value'];

    protected $visible = ['id', 'label', 'value', 'options'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'parent_id'
    ];

    public function getLabelAttribute()
    {
        return $this->name;
    }

    public function getValueAttribute()
    {
        return $this->id;
    }

    public function options() 
    { 
        return $this->hasMany(self::class, 'parent_id');
    }
}
