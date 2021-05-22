@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Sablonai') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="{{route('register_sablonas')}}">
                            <button class="btn btn-primary">Registruoti sablona</button>
                        </a><br><br>

                    </div>
                    @foreach($sablonai as $sablonas)
                        <hr>

                        <div class="card-body">
                            <a href="{{route('update_sablonas', $sablonas->id)}}">
                                <button class="btn btn-primary" style="margin: 5px">Update</button>
                            </a>
                            <a href="{{route('delete_sablonas', $sablonas->id)}}">
                                <button class="btn btn-primary" style="margin: 5px">Delete</button>
                            </a>
                            <input type="text" name="pavadinimas" class="form-control" readonly
                                   value="{{$sablonas->pavadinimas}}"><br>

                            <input type="text" name="tema" class="form-control" readonly
                                   value="{{$sablonas->tema}}"><br>

                            <textarea id="sablonas" type="text" class="form-control" name="sablonas" readonly
                                      cols="100" rows="50">{{$sablonas->sablonas}}</textarea><br>

                            <input type="text" name="parasas" class="form-control" readonly
                                   value="{{$sablonas->parasas}}"><br>

                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
    {{--    </div>--}}
@endsection

