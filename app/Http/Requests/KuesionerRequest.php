<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KuesionerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pertanyaan' => 'required|string|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'pertanyaan.required' => 'Kolom pertanyaan harus diisi.',
            'pertanyaan.string' => 'Kolom pertanyaan harus berupa teks.',
            'pertanyaan.max' => 'Kolom pertanyaan tidak boleh lebih dari :max karakter.',
        ];
    }
}
