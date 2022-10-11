<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'todo_id' => 'required|integer|exists:todos,id',
            'file' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ];
    }
}
