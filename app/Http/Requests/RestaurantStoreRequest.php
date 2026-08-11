<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RestaurantStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:restaurants,slug'],
            'description' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'logo' => ['nullable', 'string', 'max:255'],
            'cover_image' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'delivery_fee' => ['required', 'numeric', 'min:0'],
            'minimum_order_amount' => ['required', 'numeric', 'min:0'],
            'delivery_time_min' => ['nullable', 'integer', 'min:1'],
            'delivery_time_max' => ['nullable', 'integer', 'gte:delivery_time_min'],
            'is_active' => ['boolean'],
            'is_featured' => ['boolean'],
        ];
    }
}
