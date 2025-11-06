@extends('layouts.app')

@section('content')

<div class="form-page d-flex flex-column justify-content-center align-items-center">

    {{-- ✅ Card del formulario --}}
    <div class="form-glass shadow-lg">

        <h2 class="text-center mb-4 fw-bold text-white">Nuevo Karting</h2>

        <form action="{{ route('kartings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">

                <!-- LEFT -->
                <div class="col-md-6">

                    {{-- Nombre --}}
                    <div class="floating-group">
                        <input type="text" name="nombre" value="{{ old('nombre') }}" required placeholder=" ">
                        <label>Nombre</label>
                        @error('nombre') 
                            <span class="text-danger">{{ $message }}</span> 
                        @enderror
                    </div>

                    {{-- Cilindrada --}}
                    <div class="floating-group">
                        <input type="number" name="cilindrada" value="{{ old('cilindrada') }}" required placeholder=" ">
                        <label>Cilindrada (cc)</label>
                        @error('cilindrada') 
                            <span class="text-danger">{{ $message }}</span> 
                        @enderror
                    </div>

                    {{-- Año --}}
                    <div class="floating-group">
                        <input type="number" name="anio" value="{{ old('anio') }}" required placeholder=" ">
                        <label>Año</label>
                        @error('anio') 
                            <span class="text-danger">{{ $message }}</span> 
                        @enderror
                    </div>

                </div>

                <!-- RIGHT -->
                <div class="col-md-6">

                    {{-- Precio --}}
                    <div class="floating-group">
                        <input type="number" step="0.01" name="precio" value="{{ old('precio') }}" required placeholder=" ">
                        <label>Precio</label>
                        @error('precio') 
                            <span class="text-danger">{{ $message }}</span> 
                        @enderror
                    </div>

                    {{-- Imagen --}}
                    <label class="text-white fw-semibold mt-2 mb-1">Imagen</label>
                    <div class="file-box">
                        <input type="file" name="imagen" accept="image/*">
                    </div>
                    @error('imagen') 
                        <span class="text-danger">{{ $message }}</span> 
                    @enderror

                    {{-- BOTONES --}}
                   
                </div>
 <div class="d-flex gap-2 mt-4">
                        <button class="btn btn-dark w-50 py-2 fw-semibold shadow-sm">
                            <i class="bi bi-save2 me-2"></i> Guardar
                        </button>

                        <a href="{{ route('kartings.index') }}" class="btn btn-outline-light w-50 py-2 fw-semibold">
                            <i class="bi bi-x-circle me-2"></i> Cancelar
                        </a>
                    </div>
            </div>

        </form>

    </div>

</div>

@endsection


<style>

/* ✅ Fondo fijo elegante */
.form-page {
    min-height: 50vh;
    background: url("{{ asset('fondo-login4.jpg') }}") center/cover no-repeat fixed;
    padding: 10px 0;
    margin-top: 0px;
}

/* ✅ Card centrada y sin scroll */
.form-glass {
    width: 850px;
    padding: 35px 45px;
    border-radius: 18px;

    background: rgba(0, 0, 0, 0.55);
    border: 1px solid rgba(255,255,255,0.15);
    backdrop-filter: blur(16px);

    animation: fadeSlide .6s ease;
}

/* Animación de entrada */
@keyframes fadeSlide {
    from { opacity: 0; transform: translateY(40px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ✅ Inputs modernos tipo premium */
.floating-group {
    position: relative;
    margin-bottom: 28px;
}

.floating-group input {
    width: 100%;
    padding: 14px 14px;
    border-radius: 10px;
    border: 1px solid rgba(255,255,255,0.25);

    background: rgba(255,255,255,0.07);
    color: #fff;

    transition: all .25s ease;
}

/* Animación del input */
.floating-group input:focus {
    border-color: #0d6efd;
    background: rgba(255,255,255,0.15);
    transform: scale(1.015);
    outline: none;
}

/* Label flotante */
.floating-group label {
    position: absolute;
    top: 50%;
    left: 14px;
    transform: translateY(-50%);
    color: #d7e3ff;
    pointer-events: none;
    transition: .25s;
}

/* ✅ Flotante automático */
.floating-group input:focus + label,
.floating-group input:not(:placeholder-shown) + label {
    top: 0;
    left: 10px;
    font-size: 12px;
    padding: 0 6px;
    background: rgba(0,0,0,0.55);
    border-radius: 6px;
}

/* ✅ File input */
.file-box input {
    width: 100%;
    padding: 12px;
    border-radius: 10px;

    background: rgba(255,255,255,0.10);
    border: 1px solid rgba(255,255,255,0.25);
    color: white;
}

/* ✅ Estilo error interno */
.text-danger {
    font-size: 13px;
}

/* ✅ Alerta más estética */
.alert-danger {
    border-radius: 14px;
}

</style>
