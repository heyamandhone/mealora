<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class MenuCategoryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => $this->slug ?: Str::slug($this->name),
        ]);
    }

    public function rules(): array
    {
        $menuCategory = $this->route('menu_category');

        return [
            'restaurant_id' => ['required', 'exists:restaurants,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('menu_categories', 'slug')
                    ->where('restaurant_id', $this->restaurant_id)
                    ->ignore($menuCategory?->id),
            ],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ];
    }
}
