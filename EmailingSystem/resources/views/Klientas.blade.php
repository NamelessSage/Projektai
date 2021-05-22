@extends('layouts.app')
@section('content')
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Klientai') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>
                            <a href="{{route('register_klientas')}}">
                                <button class="btn btn-primary">Registruoti klietą</button>
                            </a>

                            <a href="{{route('Klientas', 1)}}">
                                <button class="btn btn-primary" style="margin: 5px">Order by ascending</button>
                            </a>

                            <a href="{{route('Klientas', 2)}}">
                                <button class="btn btn-primary" style="margin: 5px">Order by descending</button>
                            </a>
                        </div>
                        <br>
                        <div>
                            <button class="btn btn-primary reveal" id="revealb" onclick="openFormMarking()">Siusti
                            </button>
                            <button class="btn btn-primary send" id="sendb" onclick="markedForm()"
                                    style="display: none">Siusti
                            </button>
                        </div>
                        <br>

                        <div class="table-responsive">
                            <table class="table table-bordered" style="text-align: center; vertical-align: middle;">
                                <thead class="table-dark">
                                <tr>
                                    <th>Vardas</th>
                                    <th>Pavarde</th>
                                    <th>El pastas</th>
                                    <th>Kategorija</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                    <th>Siųsti</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($klientai as $klientas)
                                    <tr>
                                        <td>{{$klientas->vardas}}</td>
                                        <td>{{$klientas->pavarde}}</td>
                                        <td>{{$klientas->elpastas}}</td>
                                        <td>{{$klientas->kategorija}}</td>
                                        <td><a href="{{route('update_klientas', $klientas->id)}}">
                                                <button class="btn btn-primary" style="margin: 5px">Update</button>
                                            </a></td>
                                        <td><a href="{{route('delete_klientas', $klientas->id)}}">
                                                <button class="btn btn-primary" style="margin: 5px">Delete</button>
                                            </a></td>
                                        <td class="checkbox">

                                            <button class="btn btn-primary siuntimas"
                                                    onclick="updateValue({{$klientas->id}})">Siusti
                                            </button>
                                            <input class="markingForm" type="checkbox" id="{{$klientas->id}}"
                                                   name="markingForm" style="display: none;margin: auto; "
                                            >

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="modal" id="popup" style="display: none">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                            <div class="modal-content">
                                                <span class="close" id="closepopup" onclick="closeForm()">&times;</span>
                                                <label for="sablonas_id">Sablonai</label>
                                                <select class="form-control" name="sablonas_id" id="sablonas_id">
                                                    @foreach($sablonai as $sablonas)
                                                        <option
                                                            value="{{$sablonas->id}}">{{$sablonas->pavadinimas}}</option>
                                                    @endforeach
                                                </select><br>

                                                <label for="start_date">Data</label>
                                                <input type="datetime-local" id="start_date" name="start_date"
                                                       onchange="dateSelected()"><br>

                                                <label for="repeat" id="repeat_label"
                                                       style="display: none">Kartoti</label>
                                                <select class="form-control" name="repeat" id="repeat"
                                                        onchange="repeatChange()" style="display: none">
                                                    <option value="norepeat">Nekartoti</option>
                                                    <option value="repeat">Kartoti</option>
                                                </select><br>

                                                <select class="form-control" name="frequency" id="frequency"
                                                        style="display: none">
                                                    <option value="daily">Kas diena</option>
                                                    <option value="weekly">Kas savaite</option>
                                                    <option value="monthly">Kas menesi</option>
                                                    <option value="yearly">Kas metus</option>
                                                </select><br>

                                                <select class="form-control" name="length" id="length"
                                                        style="display: none">
                                                    <option value="week">Savaite</option>
                                                    <option value="month">Menesi</option>
                                                    <option value="year">Metus</option>
                                                </select><br>


                                                <button class="btn btn-primary" id="siuntimas" onclick="send()">Siusti
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" value="-2" id="idvalue" name="idvalue">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    function send() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var values = $('input[name="markingForm"]:checked')
        var x = Array();

        if (document.getElementById('idvalue').value == -1) {
            for (var i = 0; i < values.length; i++) {
                x[i] = values[i].id
            }
        } else {
            x[0] = document.getElementById('idvalue').value
        }
        var sablonas_id = document.getElementById('sablonas_id').value
        var start_date = document.getElementById('start_date').value
        var length = document.getElementById('length').value
        var frequency = document.getElementById('frequency').value
        var repeat = document.getElementById('repeat').value
        $.ajax({
            type: 'POST',
            url: "{{route('send')}}",
            headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
            data: {
                klientas_id: x,
                sablonas_id: sablonas_id,
                start_date: start_date,
                length: length,
                frequency: frequency,
                repeat: repeat,
            },
            success: function (data) {
                location.reload();
                //alert(data.success);
            }
        });
    }
</script>
