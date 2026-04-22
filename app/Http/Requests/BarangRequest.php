<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BarangRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'kondisi' => 'required|in:baik,rusak,tidak aktif',
            'status' => 'required|in:tersedia,dipinjam',
            'tanggal_masuk' => 'required|date',
            'deskripsi' => 'nullable|string',
        ];
    }
}
