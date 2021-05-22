@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Suplanuoti laiskai') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    @foreach($suplanuoti as $suplanuotas)
                        <hr>
                        <div class="card-body">
                            <input type="text" name="pavadinimas" class="form-control" readonly
                                   value="{{$suplanuotas->klientas->vardas}}"><br>

                            <input type="text" name="tema" class="form-control" readonly
                                   value="{{$suplanuotas->sablonas->pavadinimas}}"><br>
                            <a href="{{route('delete_suplanuotas', $suplanuotas->id)}}">
                                <button class="btn btn-primary" style="margin: 5px">Delete</button>
                            </a>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
@endsection

