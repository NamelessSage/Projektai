@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Sablono kurimas') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register_sablonas') }}">
                            @csrf
                            <div>
                                <input type="text" name="pavadinimas" class="form-control" required
                                       placeholder="Sablono pavadinimas"><br>

                                <input type="text" name="tema" class="form-control" required
                                       placeholder="Tema"><br>

                                <textarea id="sablonas" type="text" class="form-control" name="sablonas" required
                                          cols="100" rows="50">
                                </textarea><br>

                                <input type="text" name="parasas" class="form-control" required
                                       placeholder="Parasas"><br>

                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .wrapper {
        padding: 2px;
        margin: 1px 0;
        background-color: #000000;
    }

    textarea {
        font-size: 20px;
        width: 100%;
    }
</style>
