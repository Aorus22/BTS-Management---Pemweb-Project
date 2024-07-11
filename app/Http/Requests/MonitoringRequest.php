<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MonitoringRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_bts' => 'required|exists:bts,id',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'tanggal_kunjungan' => 'required|date',
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
            'id_bts.required' => 'Kolom BTS harus dipilih.',
            'id_bts.exists' => 'BTS yang dipilih tidak valid.',
            'tahun.required' => 'Kolom tahun harus diisi.',
            'tahun.integer' => 'Kolom tahun harus berupa angka.',
            'tahun.min' => 'Kolom tahun harus lebih besar dari :min.',
            'tahun.max' => 'Kolom tahun tidak boleh lebih dari :max.',
            'tanggal_kunjungan.required' => 'Kolom tanggal kunjungan harus diisi.',
            'tanggal_kunjungan.date' => 'Kolom tanggal kunjungan harus berupa tanggal.',
        ];
    }
}
