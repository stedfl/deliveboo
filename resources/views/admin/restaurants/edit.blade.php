@extends('layouts.app')

@section('title')
    | Edit {{ $restaurant->name }}
@endsection

@section('content')
    <div class="container mt-5">
        <h1 class="my-5">
            Modifica {{ $restaurant->name }}
        </h1>
        <div class="container">

            {{-- @include('admin.partials.action-in-page') --}}

            @if ($errors->any())
                <div class="alert alert-danger m-5" role="alert">
                    <h2><i class="fa-solid fa-triangle-exclamation"></i>Error</h2>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.restaurants.update', $restaurant) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nome *</label>
                    <input category="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $restaurant->name) }}" placeholder="Aggiungi nome..." required
                        autocomplete="name" autofocus minlength="2" maxlength="100"
                        title="Campo obbligatorio, inserire almeno 2 caratteri"
                        oninvalid="this.setCustomValidity('Il campo è obbligatorio, inserire almeno 2 caratteri ed un massimo di 100.')"
                        onchange="this.setCustomValidity('')">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Indirizzo *</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                        name="address" value="{{ old('address', $restaurant->address) }}" placeholder="Add address..."
                        required minlength="8" maxlength="100" autocomplete="address" autofocus
                        oninvalid="this.setCustomValidity('Il campo è obbligatorio, inserire un indirizzo valido.')"
                        onchange="this.setCustomValidity('')">
                    @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="img" class="form-label">Immagine</label>
                    <input type="file" class="form-control @error('img') is-invalid @enderror" id="img"
                        name="img" value="{{ old('img', $restaurant->img) }}" placeholder="Add URL for image..."
                        onchange="showImage(event)" size="3100">
                    @error('img')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    @if ($restaurant->img)
                        <div class="cover-image mt-3">
                            <img class="w-25" id="output-image" src="{{ asset('storage/' . $restaurant->img) }}"
                                alt="{{ $restaurant->img_original_name }}">
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="telephone" class="form-label">Telefono *</label>
                    <input type="phone" class="form-control @error('telephone') is-invalid @enderror" id="telephone"
                        name="telephone" value="{{ old('telephone', $restaurant->telephone) }}"
                        placeholder="Aggiungi numero telefonico..." required autocomplete="telephone" autofocus
                        title="Campo obbligatorio, inserire un numero di telefono valido" minlength="5"
                        pattern="[0-9-+\s()]{5,20}"
                        oninvalid="this.setCustomValidity('Il campo è obbligatorio, inserire un numero di telefono valido.')"
                        onchange="this.setCustomValidity('')">
                    @error('telephone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="iva" class="form-label">Partita IVA *</label>
                    <input type="text" class="form-control @error('iva') is-invalid @enderror" id="iva"
                        name="iva" value="{{ old('iva', $restaurant->iva) }}" placeholder="Aggiungi partita IVA..."
                        required autocomplete="iva" autofocus pattern="[0-9]{11}"
                        title="Campo obbligatorio, inserire una p.iva valida composta da 11 cifre"
                        oninvalid="this.setCustomValidity('Il campo è obbligatorio, richiede un numero di 11 cifre.')"
                        onchange="this.setCustomValidity('')">
                    @error('iva')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button category="submit" class="btn btn-dark mb-5">Invia
                    <i class="fa-solid fa-file-import"></i>
                </button>
            </form>
        </div>

        <script>
            function showImage(event) {
                const tagImage = document.getElementById('output-image');
                tagImage.src = URL.createObjectURL(event.target.files[0]);
            }
        </script>
    </div>
@endsection