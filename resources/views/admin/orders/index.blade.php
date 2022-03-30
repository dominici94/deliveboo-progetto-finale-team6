@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-header">
                <span>Ordini</span>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nome e cognome</th>
                            <th scope="col">Indirizzo</th>
                            <th scope="col">Costo totale</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Data</th>
                            <th scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        @if($order->dishes[0]->restaurant_id == Auth::user()->restaurants->id)
                        <tr>
                            <td>{{$order->name}} {{$order->surname}}</td>
                            <td>{{$order->address}}</td>
                            <td>{{$order->price}} &euro;</td>
                            <td>{{$order->telephone}}</td>
                            <td>{{$order->created_at}}</td>
                            <td><a href="{{route('orders.show', $order->id)}}"><button type="button" class="btn btn-primary">Visualizza</button></a></td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection