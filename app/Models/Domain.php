<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Domain extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'm_domains';

    protected $appends = ['label', 'value'];

    protected $visible = ['id', 'label', 'value'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'description'
    ];

    public function getLabelAttribute()
    {
        return $this->name;
    }

    public function getValueAttribute()
    {
        return $this->id;
    }

    public function companies()
    {
        return $this->belongsToMany(Companies::class, 't_company_domains',  'domain_id', 'company_id');
    }
}
