@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Nuovo Ristorante</div>

                <div class="card-body">
                    
                    <form action="{{route("restaurants.store")}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="number" name="user_id" value="{{Auth::user()->id}}" hidden>
                        <div class="form-group">
                            <label for="name">Nome*</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Inserisci nome" value="{{old('name')}}" required>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Contenuto*</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10" placeholder="Inserisci la descrizione del tuo ristorante" required>{{old('description')}}</textarea>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">Indirizzo*</label>
                            <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Inserisci l'indirizzo del tuo ristorante" value="{{old('address')}}" required>
                            @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="vat">Partita IVA*</label>
                            <input type="number" name="vat" id="vat" class="form-control @error('vat') is-invalid @enderror" placeholder="Inserisci la partita iva del tuo ristorante" value="{{old('vat')}}" required>
                            @error('vat')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div id="vat-sbagliato" class="nope alert alert-danger">Il numero deve essere di 11 cifre</div>
                        </div>

                        <div class="form-group">
                            <label for="telephone">Telefono*</label>
                            <input type="tel" name="telephone" id="telephone" class="form-control @error('telephone') is-invalid @enderror" placeholder="Inserisci il numero di telefono del tuo ristorante" value="{{old('telephone')}}" required>
                            @error('telephone')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div id="numero-sbagliato" class="nope alert alert-danger">Il numero deve essere di 10 cifre</div>
                        </div>

                        <div class="mb-3 form-group">
                            <p>Seleziona le categorie*</p>
                            @foreach ($typologies as $tipology)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" name="typologies[]" id="{{$tipology->category}}" value="{{$tipology->id}}" {{in_array($tipology->id, old("typologies", [])) ? 'checked' : ''}}>
                                <label class="form-check-label" for="{{$tipology->category}}">{{$tipology->category}}</label>
                            </div>
                            @endforeach
                            @error('typologies')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div id="typologies_sbagliata" class="nope alert alert-danger">Devi selezionare almeno una categoria</div>
                        </div>

                        <div class="form-group @error('image') is-invalid @enderror">
                            <img id="uploadPreview" width='100' src="https://via.placeholder.com/350x150">
                            <label for="image">Aggiungi immagine*</label>
                            <input type="file" id="image" name="image" onchange="PreviewImage();" required>
                            <script type="text/javascript">
                                function PreviewImage() {
                                    var oFReader = new FileReader();
                                    oFReader.readAsDataURL(document.getElementById("image").files[0]);
                                    oFReader.onload = function (oFREvent) {
                                        document.getElementById("uploadPreview").src = oFREvent.target.result;
                                    };
                                };
                            </script>
                        </div>
                        @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <button type="submit" id="crea-ristorante" class="btn btn-primary">Crea ristorante</button>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection