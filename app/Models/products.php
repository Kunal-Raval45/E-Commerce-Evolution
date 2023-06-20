<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'product_name',
        'product_brand',
        'product_code',
        'product_thumbnail',
        'product_price',
        'product_description',
        'product_stock_quantity',
       'product_status',
        'category_id',
    ];
}