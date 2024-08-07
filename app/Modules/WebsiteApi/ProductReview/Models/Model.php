<?php

namespace App\Modules\WebsiteApi\ProductReview\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Str;

class Model extends EloquentModel
{
    protected $table = "product_reviews";
    protected $guarded = [];

    static $ProductModel = \App\Modules\ProductManagement\Product\Models\Model::class;

    static $ProductReviewImageModel = \App\Modules\WebsiteApi\ProductReview\Models\ReviewImageModel::class;


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

    public function product()
    {
        return $this->belongsTo(self::$ProductModel, 'product_id');
    }

    public function product_review_images()
    {
        return $this->hasMany(self::$ProductReviewImageModel, 'product_review_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Modules\UserManagement\User\Models\Model::class, 'user_id');
    }
}
