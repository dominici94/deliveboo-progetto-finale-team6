@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card my-4">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h3>Ordine: {{$order[0]->name}} {{$order[0]->surname}}</h3>
                        <h5>Indirizzo: {{$order[0]->address}}</h5>
                        <h5>Telefono: {{$order[0]->telephone}}</h5>
                        <h5>Email: {{$order[0]->email}}</h5>
                    </div>
                    <div>
                        <h3>{{$order[0]->created_at}}</h3>
                        <h5>Id ordine: #{{$order[0]->id}}</h5>
                    </div>
                </div>
                <div class="card-header">
                    <span>Costo: {{$order[0]->price}} &euro; - </span>
                    <span>
                        Stato:
                        @if($order[0]->is_paid == 1)
                            <span class="badge badge-success">Evaso</span>
                        @else
                            <span class="badge badge-danger">Non Evaso</span>
                        @endif
                    </span>
                </div>
                <div class="card-body">
                    <div class="h4">
                        Note: {{$order[0]->notes}}
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Piatto</th>
                                <th scope="col">Immagine</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order[0]->dishes as $dish)
                            <tr>
                                <td class="h1">{{$dish->name}} x {{$dish->pivot->quantity}}</td>
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
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-body d-flex">
                    <a href="{{route('orders.index')}}"><button type="button" class="btn btn-primary mr-3">Torna indietro</button></a>
                    <form action="{{route("orders.destroy", $order[0]->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="sumbit" class="btn btn-danger">Elimina</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection