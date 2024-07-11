<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JenisBtsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
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
            'nama.required' => 'Kolom nama jenis BTS harus diisi.',
            'nama.string' => 'Kolom nama jenis BTS harus berupa teks.',
            'nama.max' => 'Kolom nama jenis BTS tidak boleh lebih dari :max karakter.',
        ];
    }
}
