@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Modifica Piatto</h2>
                </div>
                <div class="card-body">
                    <form action="{{route("dishes.update", $dish->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <input type="number" name="restaurant_id" value="{{Auth::user()->restaurants->id}}" hidden>
                        <div class="form-group">
                            <label for="name">Nome*</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="name" name="name" placeholder="Inserisci il nome del piatto" value="{{old('name', $dish->name)}}" required>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Descrizione*</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Inserisci la descrizione del piatto" rows="6" required>{{old('description', $dish->description)}}</textarea>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Prezzo*</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Inserisci il prezzo del piatto" value="{{old('price', $dish->price)}}" required min="0" step="0.01">
                            @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category">Categoria*</label>
                            <select class="custom-select @error('category_id') is-invalid @enderror" name="category_id" id="category" required>
                                <option value="">Seleziona una categoria</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{old("category_id", $dish->category_id) == $category->id ? "selected" : ""}}>{{$category->category}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input @error('visible') is-invalid @enderror" id="visible" name="visible" {{old('visible', $dish->visible) ? 'checked' : ''}}>
                            <label class="form-check-label" for="visible">Visibile*</label>
                            @error('visible')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            @if (strpos($dish->image, 'uploads') !== false)
                            <img id="uploadPreview" width="100" src="{{asset("storage/{$dish->image}")}}">
                            @else
                            <img id="uploadPreview" width="100" src="{{asset("{$dish->image}")}}">
                            @endif
                            <label for="image">Aggiungi immagine*</label>
                            <input type="file" id="image" name="image" onchange="PreviewImage();">

                            <script type="text/javascript">
                                function PreviewImage() {
                                    var oFReader = new FileReader();
                                    oFReader.readAsDataURL(document.getElementById("image").files[0]);
                            
                                    oFReader.onload = function (oFREvent) {
                                        document.getElementById("uploadPreview").src = oFREvent.target.result;
                                    };
                                };
                                // Replace the <textarea id="editor1"> with a CKEditor 4
                                // instance, using default configuration.
                                CKEDITOR.replace( 'content' );
                            
                            </script>

                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-warning">Modifica</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection