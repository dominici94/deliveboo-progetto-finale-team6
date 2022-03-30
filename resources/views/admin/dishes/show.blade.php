@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card my-4">
                <div class="card-header">
                    <h3>{{$dish->name}}</h3>
                    <h6>Categoria: {{$dish->category->category}}</h6>
                </div>
                <div class="card-body">
                    <img class="immagine-show" src="{{asset("storage/{$dish->image}")}}" alt="">
                    <img class="immagine-show" src="{{asset("{$dish->image}")}}" alt="">
                </div>
                <div class="card-body">
                    <p class="">{{$dish->description}}</p>
                    <span>Costo: </span>
                    <span class="text-success">{{$dish->price}}</span>
                    <div class="mt-3">
                        <span>Stato: </span>
                        @if ($dish->visible)
                            <span class="text-success">Pubblicato</span>
                        @else
                            <span class="text-secondary">Non Pubblicato</span>
                        @endif
                    </div>
                </div>
                <div class="card-body d-flex">
                    <a href="{{route('dishes.index')}}"><button type="button" class="btn btn-primary">Torna ai Piatti</button></a>
                    <a href="{{route('dishes.edit', $dish->id)}}" class="mx-2"><button type="button" class="btn btn-warning">Modifica</button></a>
                    <form action="{{route("dishes.destroy", $dish->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="sumbit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection