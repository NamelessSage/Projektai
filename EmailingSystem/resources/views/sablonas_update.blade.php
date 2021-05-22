@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Update') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update_sablonas', $sablonas->id) }}">
                            @csrf
                            <div>
                                <input type="text" name="pavadinimas" class="form-control" required
                                       value="{{$sablonas->pavadinimas}}"><br>

                                <input type="text" name="tema" class="form-control" required
                                       value="{{$sablonas->tema}}"><br>

                                <textarea id="sablonas" type="text" class="form-control" name="sablonas" required
                                          cols="100" rows="50">
                                    {{$sablonas->sablonas}}
                                </textarea><br>

                                <input type="text" name="parasas" class="form-control" required
                                       value="{{$sablonas->parasas}}"><br>

                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
