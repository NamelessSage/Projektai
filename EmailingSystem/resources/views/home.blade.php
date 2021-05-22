@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>
                            <a href="{{route('Klientas', 0)}}">
                                <button class="btn btn-primary">Klientai</button>
                            </a>

                            <a href="{{route('Sablonas')}}">
                                <button class="btn btn-primary">Sablonai</button>
                            </a>

                            <a href="{{route('Suplanuoti')}}">
                                <button class="btn btn-primary">Suplanuoti</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
