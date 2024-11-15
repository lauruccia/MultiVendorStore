<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'description',
        'image',
        'status',
        'slug'
    ];

    public static function rules($id=0)
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'filter:html,php,laravel',
                Rule::unique('categories', 'name')->ignore($id),
               // new Filter(['laravel','php','html']),
            // 'slug' => 'required|string|max:255|unique:categories,slug',
            // function ($attribute, $value, $fail) {
            // if(strtolower($value)=='laravel'){
            //     $fail('The :attribute is reserved');
            // }
            // }
        ],
            'parent_id' => 'nullable|numeric|exists:categories,id',
            'image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'nullable|string|max:255',
            'status' => 'required|in:archived,active',
        ];
    }
}
