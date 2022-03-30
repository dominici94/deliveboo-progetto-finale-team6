@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-header mb-4">
                <a href="{{route('dishes.create')}}"><button type="button" class="btn btn-success">Crea Piatto</button></a>
            </div>
            <div class="card-header">
                <span>Piatti</span>
            </div>
            @if(isset(Auth::user()->restaurants->dishes[0]))
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Prezzo</th>
                    <th scope="col">Visibile</th>
                    <th class="responsive-not-visible" scope="col">Immagine</th>
                    <th scope="col">Azioni</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($dishes->where('restaurant_id', Auth::user()->restaurants->id) as $dish)
                    <tr>
                        <td>{{$dish->name}}</td>
                        <td class="w-25"><span class="description">{{$dish->description}}</span></td>
                        <td class="px-3">{{$dish->price}} &euro;</td>
                        <td class="pr-4">
                            @if ($dish->visible)
                                <span class="bg-success text-white p-1 rounded visible">Visibile</span>
                                <span class="bg-success text-white rounded visible-resp">V</span>
                            @else
                                <span class="bg-secondary text-white p-1 rounded not-visible">Non Visibile</span>
                                <span class="bg-secondary text-white rounded not-visible-resp">X</span>
                            @endif
                        </td>
                        <td class="w-25 pl-4 responsive-not-visible">
                            <div>
                                @php
                                if (strpos(asset($dish->image), '/img') == true) $default = true;  
                                else $default = false;
                                @endphp
                                @if($default)
                                <img class="immagine-piatto-index" src="{{asset($dish->image)}}" alt="">
                                @else
                                <img class="immagine-piatto-index" src="{{asset("storage/{$dish->image}")}}" alt="">
                                @endif
                            </div>
                        </td>
                        <td><a href="{{route('dishes.show', $dish->id)}}"><button type="button" class="btn btn-primary">Visualizza</button></a></td>
                    </tr>
                @endforeach
                </tbody>
              </table>
            @endif
        </div>
    </div>
</div>
@endsection