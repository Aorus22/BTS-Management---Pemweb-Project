<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PilihanKuesionerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_kuesioner' => 'required|exists:kuesioner,id',
            'pilihan_jawaban' => 'required|string|max:255',
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
            'id_kuesioner.required' => 'Kolom kuesioner harus dipilih.',
            'id_kuesioner.exists' => 'Kuesioner yang dipilih tidak valid.',
            'pilihan_jawaban.required' => 'Kolom pilihan jawaban harus diisi.',
            'pilihan_jawaban.string' => 'Kolom pilihan jawaban harus berupa teks.',
            'pilihan_jawaban.max' => 'Kolom pilihan jawaban tidak boleh lebih dari :max karakter.',
        ];
    }
}
