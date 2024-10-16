<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMedicamentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'dose' => 'required|integer',
            'unit' =>  Rule::in(['mg', 'ug', 'ml']),
            'pieces_morning' => 'required|integer',
            'pieces_midday' => 'required|integer',
            'pieces_evening' => 'required|integer',
            'pieces_night' => 'required|integer'
        ];
    }
}
