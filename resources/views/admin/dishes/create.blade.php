@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Nuovo Piatto</h2>
                </div>
                <div class="card-body">
                    <form action="{{route("dishes.store")}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="number" name="restaurant_id" value="{{Auth::user()->restaurants->id}}" hidden>
                        <div class="form-group">
                            <label for="name">Nome*</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="name" name="name" placeholder="Inserisci il nome del piatto" value="{{old('name')}}" required>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Descrizione*</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Inserisci la descrizione del piatto" rows="6" required>{{old('description')}}</textarea>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Prezzo*</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Inserisci il prezzo del piatto" value="{{old('price')}}" required min="0" step="0.01">
                            @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category">Categoria*</label>
                            <select class="custom-select @error('category_id') is-invalid @enderror" name="category_id" id="category" required>
                                <option value="">Seleziona una categoria</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{old("category_id") == $category->id ? "selected" : ""}}>{{$category->category}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input @error('visible') is-invalid @enderror" id="visible" name="visible" {{old('visible') ? 'checked' : ''}}>
                            <label class="form-check-label" for="visible">Visibile*</label>
                            @error('visible')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <img id="uploadPreview" width="100" src="https://via.placeholder.com/300x200">
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
                                // Replace the <textarea id="editor1"> with a CKEditor 4
                                // instance, using default configuration.
                                CKEDITOR.replace( 'content' );
                            
                            </script>

                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Crea</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection