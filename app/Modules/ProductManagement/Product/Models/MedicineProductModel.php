<?php

namespace App\Modules\ProductManagement\Product\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Str;

class MedicineProductModel extends EloquentModel
{


    protected $table = "product_medicines";
    protected $guarded = [];
}
