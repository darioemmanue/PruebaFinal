<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KartingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:30',
            'cilindrada' => 'required|integer|min:50',
            'anio' => 'required|integer|min:2000|max:' . date('Y'),
            'precio' => 'required|numeric|min:1000',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [

            // Nombre
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser texto.',
            'nombre.max' => 'El nombre no puede superar los 255 caracteres.',

            // Cilindrada
            'cilindrada.required' => 'La cilindrada es obligatoria.',
            'cilindrada.integer' => 'La cilindrada debe ser un número entero.',
            'cilindrada.min' => 'La cilindrada mínima permitida es :min cc.',

            // Año
            'anio.required' => 'El año es obligatorio.',
            'anio.integer' => 'El año debe ser un número válido.',
            'anio.min' => 'El año mínimo permitido es :min.',
            'anio.max' => 'El año máximo permitido es :max.',

            // Precio
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.min' => 'El precio mínimo permitido es :min.',

            // Imagen
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser formato: jpg, jpeg, png o webp.',
            'imagen.max' => 'La imagen no puede superar los 2MB.',
        ];
    }
}
