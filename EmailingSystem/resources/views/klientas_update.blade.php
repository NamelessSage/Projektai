@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Update') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('update_klientas', $klientas->id) }}">
                            @csrf

                            <div class="form-group row">
                                <label for="vardas"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Vardas') }}</label>
                                <div class="col-md-6">
                                    <input id="vardas" type="text" class="form-control" name="vardas"
                                           value="{{$klientas->vardas}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pavarde"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Pavarde') }}</label>
                                <div class="col-md-6">
                                    <input id="pavarde" type="text" class="form-control" name="pavarde"
                                           value="{{$klientas->pavarde}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="elpastas"
                                       class="col-md-4 col-form-label text-md-right">{{ __('El pastas') }}</label>
                                <div class="col-md-6">
                                    <input id="elpastas" type="email" class="form-control" name="elpastas"
                                           value="{{$klientas->elpastas}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kategorija"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Kategorija') }}</label>
                                <div class="col-md-6">
                                    <input id="kategorija" type="text" class="form-control" name="kategorija"
                                           value="{{$klientas->kategorija}}" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
