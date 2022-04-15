<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Category;

class CreateRequest extends FormRequest
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
            'image' => ['nullable', 'file', 'image', 'mimes:jpg,png'],

        ];
    }

    public function attributes() {
        return [
            'date' => 'Дата',
            'title' =>'Заголовок',
            'author' =>'Автор',
            'category_id' =>'Категория',
            'description' =>'Описание',
            'image' =>'Картинка',
        ];
    }

    public function messages() {
        return [
            'required' => 'Поле :attribute необходимо заполнить',
            'date' => 'Необходимо установить дату в поле :attribute',
            'max' => 'Поле :attribute превышает максимально допустимую длину',
            'exists' => 'Необходимо заполнить поле :attribute',
        ];
    }
}
