<?php

namespace App\Modules\BlogManagement\Blog\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Str;

class Model extends EloquentModel
{
    protected $table = "blogs";
    protected $guarded = [];
    protected $casts = [
        "image" => "array",
    ];

    static $blogCategoryModel = \App\Modules\BlogManagement\BlogCategory\Models\Model::class;


    protected static function booted()
    {
        static::created(function ($data) {
            $random_no = random_int(100, 999) . $data->id . random_int(100, 999);
            $slug = $data->title . " " . $random_no;
            $data->slug = Str::slug($slug); //use Illuminate\Support\Str;
            if (strlen($data->slug) > 150) {
                $data->slug = substr($data->slug, strlen($data->slug) - 150, strlen($data->slug));
            }
            if (auth()->check()) {
                $data->creator = auth()->user()->id;
            }
            $data->save();
        });
    }

    public function scopeActive($q)
    {
        return $q->where('status', 'active');
    }

    public function blog_categories()
    {
        return $this->belongsToMany(self::$blogCategoryModel, 'blog_post_categories', 'blog_id', 'blog_category_id');
    }
}
