<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    protected $table = 'customers';

    protected  $fillable=[
        'profile_image',
        'fullname',
        'email',
        'phone',
        'country',
        'state',
        'city',
        'address_1',
        'address_2',
        'zipcode',
        'password',
        'status',
    ];
}