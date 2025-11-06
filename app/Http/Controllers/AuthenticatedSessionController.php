<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator; // Necesitamos esta fachada
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request)
    {
        // 1. Definir las reglas de validación
        $rules = [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ];

        // 2. Definir los mensajes de error personalizados (SOLO para reglas de formato/obligatoriedad)
        $messages = [
            // EMAIL (Formato y Obligatoriedad)
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo electrónico no es válido.',
            'email.max' => 'El correo electrónico no debe superar los :max caracteres.',
            
            // PASSWORD (Formato y Obligatoriedad)
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            // El mensaje de 'string' rara vez se muestra, pero se deja por robustez.
            'password.string' => 'La contraseña debe ser una cadena de texto válida.', 
        ];

        // 3. Crear el validador
        $validator = Validator::make($request->all(), $rules, $messages);

        // 4. Ejecutar la validación y capturar los errores de formato/obligatoriedad
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        
        // El array $credentials ya está validado
        $credentials = $request->only('email', 'password');

        // 5. Intentar autenticación (Fallo por credenciales incorrectas)
        if ( ! Auth::attempt($credentials, $request->boolean('remember')) ) {
            // AHORA FORZAMOS EL MENSAJE ESPECÍFICO QUE QUIERES, EN LUGAR DE USAR __('auth.failed')
            throw ValidationException::withMessages([
                // En Laravel, el mensaje de fallo de Auth se vincula comúnmente al campo 'email'
                'email' => 'Las credenciales proporcionadas no son correctas.' 
            ]);
        }

        // Si la autenticación es exitosa
        $request->session()->regenerate();

        return redirect()->intended()
            ->with('status', 'You are logged in');
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return to_route('login')
            ->with('status', 'You are logged out!');
    }
}