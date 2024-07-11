<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenggunaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "nama" => "required|string|max:255",
            "alamat" => "required|string|max:255",
            "telepon" => "required|string|max:255",
            'id_bts' => 'required|exists:bts,id',
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
            'nama.required' => 'Kolom nama harus diisi.',
            'nama.string' => 'Kolom nama harus berupa teks.',
            'nama.max' => 'Kolom nama tidak boleh lebih dari :max karakter.',
            'alamat.required' => 'Kolom alamat harus diisi.',
            'alamat.string' => 'Kolom alamat harus berupa teks.',
            'alamat.max' => 'Kolom alamat tidak boleh lebih dari :max karakter.',
            'telepon.required' => 'Kolom telepon harus diisi.',
            'telepon.string' => 'Kolom telepon harus berupa teks.',
            'telepon.max' => 'Kolom telepon tidak boleh lebih dari :max karakter.',
            'id_bts.required' => 'Kolom BTS harus dipilih.',
            'id_bts.exists' => 'BTS yang dipilih tidak valid.',
        ];
    }
}
