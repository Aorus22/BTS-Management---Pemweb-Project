<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WilayahRequest extends FormRequest
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
            'id_parent' => 'nullable|exists:wilayahs,id',
            'level' => 'required|integer|between:1,2',
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
            'nama.required' => 'Kolom nama wilayah harus diisi.',
            'nama.string' => 'Kolom nama wilayah harus berupa teks.',
            'nama.max' => 'Kolom nama wilayah tidak boleh lebih dari :max karakter.',
            'id_parent.exists' => 'Wilayah yang dipilih sebagai induk tidak valid.',
            'level.required' => 'Kolom level wilayah harus diisi.',
            'level.integer' => 'Kolom level wilayah harus berupa angka.',
            'level.between' => 'Kolom level wilayah harus di antara :min dan :max.',
        ];
    }
}
