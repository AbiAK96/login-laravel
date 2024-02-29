<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    public $table = 'menu';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'api_id',
        'name',
        'category',
        'price',
        'description',
        'image',
        'qty',
        'is_veg'
    ];

    protected $casts = [
        'category' => 'string',
        'api_id'  => 'string',
        'name'  => 'string',
        'category'  => 'string',
        'price'  => 'integer',
        'description'  => 'string',
        'image'  => 'string',
        'qty' => 'integer',
        'is_veg' => 'boolean'
    ];
}
