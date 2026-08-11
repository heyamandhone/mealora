<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'phone',
        'email',
        'logo',
        'cover_image',
        'address',
        'city',
        'state',
        'postal_code',
        'latitude',
        'longitude',
        'delivery_fee',
        'minimum_order_amount',
        'delivery_time_min',
        'delivery_time_max',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'delivery_fee' => 'decimal:2',
        'minimum_order_amount' => 'decimal:2',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];
}
