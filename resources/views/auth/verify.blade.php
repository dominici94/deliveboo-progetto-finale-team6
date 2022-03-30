@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifica il tuo indirizzo Email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __("E' stato inviato un nuovo link al tuo indirizzo email") }}
                        </div>
                    @endif

                    {{ __('Prima di procedere controlla il tuo indirizzo email per il link di verifica') }}
                    {{ __('Se non hai ricevuto il link') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __("clicca qui per richiederne un'altro") }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
