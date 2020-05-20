<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menu_name',
        'page_id',
        'menu_slug',
        'up_menu',
        'menu_status',
        'list',
    ];

    public function children(){
        return $this->hasMany('App\Models\Menu','up_menu');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pageName()
    {
        return $this->hasOne('App\Models\Pages', 'id', 'page_id');
    }
}