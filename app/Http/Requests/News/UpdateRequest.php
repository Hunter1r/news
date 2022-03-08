<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Category;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $tableNameCategory = (new Category())->getTable();
        return [
            'date' => ['required', 'date'],
            'title' => ['required', 'max:150'],
            'author' => ['required', 'max:100'],
            'category_id' => ["required", "exists:{$tableNameCategory},id"],
            'description' => ['nullable'],
            'image' => ['nullable'],

        ];
    }
}
