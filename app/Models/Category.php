<?php

namespace App\Models;
use App\Observers\MainCategoryObserver;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     *
     *
     */
    protected $with = ['translations'];


    protected $translatedAttributes = ['name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['parent_id', 'slug', 'is_active','photo'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = ['translations'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];


    protected static function boot()
    {
        parent::boot();
        Category::observe(MainCategoryObserver::class);
    }


    public function getPhotoAttribute($val) {
        return $val != null ? asset('assets/'.$val) : "";
    }

    public function scopeParent($query){
        return $query -> whereNull('parent_id');
    }
    public function scopeChild($query){
        return $query -> whereNotNull('parent_id');
    }

    public function getActive(){
        return  $this -> is_active  == 0 ?  __('admin\category.inactive')   :  __('admin\category.active')  ;
    }



}
