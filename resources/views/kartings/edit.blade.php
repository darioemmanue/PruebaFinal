@extends('layouts.app')

@section('content')

<div class="form-page d-flex flex-column justify-content-center align-items-center">

    <div class="form-glass shadow-lg">

        <h2 class="text-center mb-4 fw-bold text-white">Editar Karting</h2>

        <form action="{{ route('kartings.update', $karting) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4">

                <!-- LEFT -->
                <div class="col-md-6">

                    {{-- Nombre --}}
                    <div class="floating-group">
                        <input type="text" name="nombre" value="{{ old('nombre', $karting->nombre) }}" required placeholder=" ">
                        <label>Nombre</label>
                        @error('nombre') 
                            <span class="text-danger">{{ $message }}</span> 
                        @enderror
                    </div>

                    {{-- Cilindrada --}}
                    <div class="floating-group">
                        <input type="number" name="cilindrada" value="{{ old('cilindrada', $karting->cilindrada) }}" required placeholder=" ">
                        <label>Cilindrada (cc)</label>
                        @error('cilindrada') 
                            <span class="text-danger">{{ $message }}</span> 
                        @enderror
                    </div>

                    {{-- Año --}}
                    <div class="floating-group">
                        <input type="number" name="anio" value="{{ old('anio', $karting->anio) }}" required placeholder=" ">
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
                        <input type="number" step="0.01" name="precio" value="{{ old('precio', $karting->precio) }}" required placeholder=" ">
                        <label>Precio</label>
                        @error('precio') 
                            <span class="text-danger">{{ $message }}</span> 
                        @enderror
                    </div>

                    {{-- Imagen actual --}}
                    @if($karting->imagen)
                        <label class="text-white fw-semibold mt-2 mb-1">Imagen actual</label>
                        <div class="text-center mb-2">
                            <img src="{{ asset('storage/' . $karting->imagen) }}" 
                                 class="img-fluid rounded shadow-sm"
                                 style="max-height:150px; object-fit:cover;">
                        </div>
                    @endif

                    {{-- Subir nueva imagen --}}
                    <label class="text-white fw-semibold mt-2 mb-1">Nueva imagen</label>
                    <div class="file-box">
                        <input type="file" name="imagen" accept="image/*">
                    </div>
                    @error('imagen') 
                        <span class="text-danger">{{ $message }}</span> 
                    @enderror

                </div>

                {{-- BOTONES --}}
                <div class="d-flex gap-2 mt-4">
                    <button class="btn btn-dark w-50 py-2 fw-semibold shadow-sm">
                        <i class="bi bi-save2 me-2"></i> Actualizar
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


{{-- ✅ Misma hoja de estilos del CREATE --}}
<style>
.form-page {
    min-height: 50vh;
    background: url("{{ asset('fondo-login4.jpg') }}") center/cover no-repeat fixed;
    padding: 10px 0;
    margin-top: 0px;
}

.form-glass {
    heigth:100px;
    width: 900px;
    padding: 30px 45px;
    border-radius: 18px;
    background: rgba(0, 0, 0, 0.55);
    border: 1px solid rgba(255,255,255,0.15);
    backdrop-filter: blur(16px);
    animation: fadeSlide .6s ease;
}

@keyframes fadeSlide {
    from { opacity: 0; transform: translateY(40px); }
    to   { opacity: 1; transform: translateY(0); }
}

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

.floating-group input:focus {
    border-color: #0d6efd;
    background: rgba(255,255,255,0.15);
    transform: scale(1.015);
    outline: none;
}

.floating-group label {
    position: absolute;
    top: 50%;
    left: 14px;
    transform: translateY(-50%);
    color: #d7e3ff;
    pointer-events: none;
    transition: .25s;
}

.floating-group input:focus + label,
.floating-group input:not(:placeholder-shown) + label {
    top: 0;
    left: 10px;
    font-size: 12px;
    padding: 0 6px;
    background: rgba(0,0,0,0.55);
    border-radius: 6px;
}

.file-box input {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    background: rgba(255,255,255,0.10);
    border: 1px solid rgba(255,255,255,0.25);
    color: white;
}

.text-danger {
    font-size: 13px;
}
</style>
