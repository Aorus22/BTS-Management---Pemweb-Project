<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BTSRequest extends FormRequest
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
            'alamat' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'tinggi_tower' => 'required|numeric',
            'panjang_tanah' => 'required|numeric',
            'lebar_tanah' => 'required|numeric',
            'ada_genset' => 'required|boolean',
            'ada_tembok_batas' => 'required|boolean',
            'id_jenis_bts' => 'required|exists:jenis_bts,id',
            'id_pemilik' => 'required|exists:pemilik,id',
            'id_wilayah' => 'required|exists:wilayah,id',
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
            'latitude.required' => 'Kolom latitude harus diisi.',
            'latitude.numeric' => 'Kolom latitude harus berupa angka.',
            'longitude.required' => 'Kolom longitude harus diisi.',
            'longitude.numeric' => 'Kolom longitude harus berupa angka.',
            'tinggi_tower.required' => 'Kolom tinggi tower harus diisi.',
            'tinggi_tower.numeric' => 'Kolom tinggi tower harus berupa angka.',
            'panjang_tanah.required' => 'Kolom panjang tanah harus diisi.',
            'panjang_tanah.numeric' => 'Kolom panjang tanah harus berupa angka.',
            'lebar_tanah.required' => 'Kolom lebar tanah harus diisi.',
            'lebar_tanah.numeric' => 'Kolom lebar tanah harus berupa angka.',
            'ada_genset.required' => 'Kolom ada genset harus diisi.',
            'ada_genset.boolean' => 'Kolom ada genset harus berupa benar atau salah.',
            'ada_tembok_batas.required' => 'Kolom ada tembok batas harus diisi.',
            'ada_tembok_batas.boolean' => 'Kolom ada tembok batas harus berupa benar atau salah.',
            'id_jenis_bts.required' => 'Kolom jenis BTS harus diisi.',
            'id_jenis_bts.exists' => 'Jenis BTS yang dipilih tidak valid.',
            'id_pemilik.required' => 'Kolom pemilik harus diisi.',
            'id_pemilik.exists' => 'Pemilik yang dipilih tidak valid.',
            'id_wilayah.required' => 'Kolom wilayah harus diisi.',
            'id_wilayah.exists' => 'Wilayah yang dipilih tidak valid.',
        ];
    }
}
