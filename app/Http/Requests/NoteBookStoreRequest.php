<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NoteBookStoreRequest extends FormRequest
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
            'initials' => ['required', 'string'],
            'company' => ['nullable', 'string'],
            'phone' => ['required'],
            'email' => ['required', 'email', Rule::unique('notebooks')->ignore($this->id)],
            'birthday' => ['nullable', 'date'],
            'photo' => ['image', 'mimes:jpg,jpeg,png', 'max:2048']
        ];
    }
}
