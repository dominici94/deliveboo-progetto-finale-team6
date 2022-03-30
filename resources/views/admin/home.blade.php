@extends('layouts.app')

@section('content')
{{-- <a href="{{route("restaurants.show",$post->id)}}"><button type="button" class="btn btn-primary">Sfoglia</button></a> --}}
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">
            
            <div class="card">

                {{-- Se il ristorante esiste già dati ristorante altrimenti bottone per creare ristorante --}}

                @if(isset(Auth::user()->restaurants->user_id))

                {{-- nome ristorante --}}
                <div class="card-header">
                    <h1 class="mt-1">{{Auth::user()->restaurants->name}}</h1>
                </div>
               
                <div class="card-body">

                    {{-- descrizione ristorante --}}
                    <div>
                        <p>{{Auth::user()->restaurants->description}}</p>
                    </div>

                    <div class="row">

                        {{-- immagine ristorante --}}
                        <div class="col-md-6 col-lg-4">
                            @if (strpos(Auth::user()->restaurants->image, 'uploads') !== false)
                            <div class="img-container">
                                <img class="img-fluid img-thumbnail" src="{{asset("/storage/" . Auth::user()->restaurants->image)}}" alt="{{Auth::user()->restaurants->name}}">
                            </div>
                            @else
                            <div class="img-container">
                                <img class="img-fluid img-thumbnail mb-3" src="{{asset(Auth::user()->restaurants->image)}}" alt="{{Auth::user()->restaurants->name}}">
                            </div>
                            @endif
                        </div>

                        <div class="col-md-6 col-lg-8">
                            
                            {{-- indirizzo ristorante --}}
                            <div>
                                <h5><strong>Indirizzo</strong>: {{Auth::user()->restaurants->address}}</h5>
                            </div>

                            {{-- partita iva ristorante --}}
                            <div>
                                <h5>
                                    <strong>Partita IVA</strong>: {{Auth::user()->restaurants->vat}}
                                </h5>
                            </div>

                            {{-- numero di telefono ristorante --}}
                            <div>
                                <h5>
                                    <strong>Numero di telefono</strong>: {{Auth::user()->restaurants->telephone}}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>

                @else
                <div class="card-body">
                    <a href="{{route("restaurants.create")}}"><button type="button" class="btn btn-success my-3">Aggiungi Ristorante</button></a>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
    
@endsection
