<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    const PARENT_CATEGORY = 0;

    protected $table = 'm_category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'parent_id'
    ];


    public function children() 
    { 
        return $this->hasMany(self::class, 'parent_id');
    }
}
