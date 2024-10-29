<?php

namespace App\Http\Requests;

use App\Models\Medicament;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DeleteMedicamentRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge(['id' => $this->route('id')]);
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $medicament = Medicament::find($this->route('id'));
        return $this->user()->can('delete', $medicament);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return ['id' => 'required|integer|exists:medicaments,id'];
    }
}
