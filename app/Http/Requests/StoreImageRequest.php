<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file' => 'required|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'Por favor, sube una imagen.',
            'file.mimes' => 'Solo se permiten formatos de imagen: JPG, JPEG, PNG, BMP, GIF, SVG, WEBP.',
            'file.max' => 'El tamaño máximo del archivo es de 2 MB.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 422));
    }
}
