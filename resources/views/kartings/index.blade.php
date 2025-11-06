@extends('layouts.app')

@section('content')

<div class="mb-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
    
    <h1 class="fw-bold mb-3 mb-md-0" style="text-shadow:0 3px 6px rgba(0,0,0,0.45);">
        Kartings
    </h1>

    <div class="d-flex flex-column flex-md-row align-items-center gap-3">

        {{-- ✅ Barra de búsqueda estilo Twitter --}}
        <form action="{{ route('kartings.index') }}" method="GET" class="twitter-form">
            <label for="search">
                <input 
                    class="twitter-input" 
                    type="text" 
                    name="search"
                    value="{{ request('search') }}"
                    required 
                    placeholder="Buscar karting..."
                    id="search"
                >
                <div class="fancy-bg"></div>

                <div class="search">
                    <svg viewBox="0 0 24 24">
                        <g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 
                        20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 
                        9 9c2.215 0 4.24-.804 5.808-2.13l3.66 
                        3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767
                        .002-1.06zM3.5 11c0-4.135 3.365-7.5 
                        7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 
                        7.5-7.5-3.365-7.5-7.5z"></path></g>
                    </svg>
                </div>

                <button class="close-btn" type="button" onclick="window.location='{{ route('kartings.index') }}'">
                    <svg viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" 
                            d="M4.293 4.293a1 1 0 
                            011.414 0L10 8.586l4.293-4.293a1 1 
                            0 111.414 1.414L11.414 10l4.293 
                            4.293a1 1 0 01-1.414 
                            1.414L10 11.414l-4.293 
                            4.293a1 1 0 01-1.414-1.414L8.586 
                            10 4.293 5.707a1 1 0 
                            010-1.414z">
                        </path>
                    </svg>
                </button>
            </label>
        </form>

        {{-- ✅ Botón Nuevo --}}
        <a href="{{ route('kartings.create') }}" 
           class="btn btn-dark btn-add-karting d-flex align-items-center gap-2">
            <i class="bi bi-plus-lg"></i> Nuevo Karting
        </a>

    </div>

</div>

<div class="row mt-3">

@forelse($kartings as $karting)

    <div class="col-md-4 mb-4">
        <div class="card kart-card">

            <div class="img-wrap">
                <img src="{{ $karting->imagen ? asset('storage/'.$karting->imagen) : 'https://via.placeholder.com/400x400?text=Karting' }}"
                     alt="{{ $karting->nombre }}">
            </div>

            <div class="card-body">

                <h5 class="text-center fw-semibold mb-3">{{ $karting->nombre }}</h5>

                <div class="kart-info-row mb-3">
                    <div class="kart-info-item">
                        <i class="bi bi-speedometer2"></i> {{ $karting->cilindrada }} cc
                    </div>

                    <div class="kart-info-item">
                        <i class="bi bi-calendar"></i> {{ $karting->anio }}
                    </div>

                    <div class="kart-info-item">
                        <i class="bi bi-currency-dollar"></i> {{ number_format($karting->precio,2,',','.') }}
                    </div>
                </div>

                <div class="d-flex gap-2 justify-content-center">

                    <a href="{{ route('kartings.edit', $karting) }}" class="btn btn-secondary-custom btn-sm">
                        <i class="bi bi-pencil-square me-1"></i> Editar
                    </a>

                    <form action="{{ route('kartings.destroy', $karting) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Seguro que deseas eliminarlo?')">
                            <i class="bi bi-trash me-1"></i> Eliminar
                        </button>
                    </form>

                </div>

            </div>

        </div>
    </div>

@empty

    <div class="col-12 text-center py-5 fs-4">
        No hay kartings cargados.
        <a href="{{ route('kartings.create') }}" class="text-info">Agregar uno</a>.
    </div>

@endforelse

</div>


<style>

        /* ====================== */
        /* ✅ Barra estilo Twitter */
        /* ====================== */

        .twitter-form {
        --input-text-color: #fff;
        --input-bg-color: #283542;
        --focus-input-bg-color: transparent;
        --text-color: #a8b3c0;
        --active-color: #1da1f2;
        --inline-padding: 1.3em;
        --width: 260px;

        display: flex;
        align-items: center;
        width: var(--width);
        position: relative;
        isolation: isolate;
        font-size: .9rem;
        }

        .twitter-form label {
        width: 100%;
        padding: .8em;
        padding-inline: var(--inline-padding);
        height: 42px;
        display: flex;
        align-items: center;
        position: relative;
        }

        .fancy-bg {
        position: absolute;
        inset: 0;
        background: var(--input-bg-color);
        border-radius: 30px;
        z-index: -1;
        transition: .3s;
        box-shadow: rgba(0,0,0,0.16) 0px 1px 6px;
        }

        .twitter-input {
        color: var(--input-text-color);
        width: 100%;
        background: none;
        border: none;
        margin-inline: 2.5em;
        }

        .twitter-input:focus {
        outline: none;
        }

        .twitter-input::placeholder {
        color: var(--text-color);
        }

        .twitter-input:focus ~ .fancy-bg {
        border: 1px solid var(--active-color);
        background: var(--focus-input-bg-color);
        }

        .twitter-input:focus ~ .search svg {
        fill: var(--active-color);
        }

        .search,
        .close-btn {
        position: absolute;
        }

        .search {
        left: var(--inline-padding);
        fill: var(--text-color);
        }

        svg {
        width: 17px;
        display: block;
        }

        .close-btn {
        right: var(--inline-padding);
        border: none;
        background: var(--active-color);
        color: white;
        width: 21px;
        height: 21px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        opacity: 0;
        visibility: hidden;
        transition: .25s;
        }

        .twitter-input:valid ~ .close-btn {
        opacity: 1;
        visibility: visible;
        }

        input:-webkit-autofill {
        -webkit-text-fill-color: #fff !important;
        box-shadow: 0 0 0px 1000px #283542 inset;
        }

        /* ====================== */
        /* ✅ Tarjetas Kartings */
        /* ====================== */

        .kart-card {
            background: #ffffff;
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        .kart-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.12);
        }

        .kart-card .img-wrap {
            height: 250px;
            border-bottom: 1px solid #bfc1c5ff;
            overflow: hidden;
        }

        .kart-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .35s ease;
        }

        .kart-card:hover img {
            transform: scale(1.06);
        }

        .kart-info-row {
            display: flex;
            gap: 6px;
        }

        .kart-info-item {
            flex: 1;
            font-size: .88rem;
            background: #f9fafb;
            padding: 7px 9px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            color: #374151;
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .btn-secondary-custom {
            background: #4b5563;
            color: #fff;
            border-radius: 10px;
            padding: 6px 12px;
            border: none;
            transition: .2s ease;
        }

        .btn-secondary-custom:hover {
            background: #374151;
        }

</style>

@endsection
