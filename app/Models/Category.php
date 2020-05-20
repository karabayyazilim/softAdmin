<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_name',
        'up_categoryId',
        'category_slug',
        'category_status',
    ];

    public function children(){
        return $this->hasMany('App\Models\Category','up_categoryId');
    }
}
