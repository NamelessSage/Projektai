<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use App\Models\Klientas;
use App\Models\Sablonas;
use App\Models\Suplanuoti;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function Klientas($type = 0)
    {
        if ($type == 1) {
            $klientai = Klientas::orderBy('kategorija', 'asc')->get();
            $sablonai = Sablonas::all();
        } elseif ($type == 2) {
            $klientai = Klientas::orderBy('kategorija', 'desc')->get();
            $sablonai = Sablonas::all();
        } else {
            $klientai = Klientas::all();
            $sablonai = Sablonas::all();
        }

        return view('Klientas', ['klientai' => $klientai, 'sablonai' => $sablonai]);
    }

    function register_klientas()
    {
        return view('klientas_create');
    }

    function register_klientas_post(Request $request)
    {
        Klientas::create([
            'vardas' => $request->vardas,
            'pavarde' => $request->pavarde,
            'elpastas' => $request->elpastas,
            'kategorija' => $request->kategorija,
        ]);
        return redirect(route('Klientas'));
    }

    function update_klientas($id)
    {
        $klientas = Klientas::find($id);
        return view('klientas_update', ['klientas' => $klientas]);
    }

    function update_klientas_post($id, Request $request)
    {
        $klientas = Klientas::find($id);
        $klientas->vardas = $request->vardas;
        $klientas->pavarde = $request->pavarde;
        $klientas->elpastas = $request->elpastas;
        $klientas->kategorija = $request->kategorija;
        $klientas->save();
        return redirect(route('Klientas'));
    }


    function delete_klientas($id)
    {
        $klientas = Klientas::find($id);
        $klientas->delete();
        return redirect(route('Klientas'));
    }

///////////////////////////////////
    function Sablonas()
    {
        $sablonai = Sablonas::all();
        return view('Sablonas', ['sablonai' => $sablonai]);
    }


    function register_sablonas()
    {
        return view('sablonas_create');
    }

    function register_sablonas_post(Request $request)
    {
        Sablonas::create([
            'pavadinimas' => $request->pavadinimas,
            'tema' => $request->tema,
            'sablonas' => $request->sablonas,
            'parasas' => $request->parasas,
        ]);
        return redirect(route('Sablonas'));
    }

    function update_sablonas($id)
    {
        $sablonas = Sablonas::find($id);
        return view('sablonas_update', ['sablonas' => $sablonas]);
    }

    function update_sablonas_post($id, Request $request)
    {
        $sablonas = Sablonas::find($id);
        $sablonas->pavadinimas = $request->pavadinimas;
        $sablonas->tema = $request->tema;
        $sablonas->sablonas = $request->sablonas;
        $sablonas->parasas = $request->parasas;
        $sablonas->save();
        return redirect(route('Sablonas'));
    }


    function delete_sablonas($id)
    {
        $sablonas = Sablonas::find($id);
        $sablonas->delete();
        return redirect(route('Sablonas'));
    }

    function send(Request $request)
    {
        foreach ($request->klientas_id as $klientas_id) {
            $suplanuotas = new Suplanuoti;
            $suplanuotas->klientas_id = $klientas_id;
            $suplanuotas->sablonas_id = $request->sablonas_id;
            $suplanuotas->start_date = $request->start_date;
            $suplanuotas->how_long = $request->length;
            $suplanuotas->frequency = $request->frequency;
            $suplanuotas->repeat = $request->repeat;
            $suplanuotas->last_sent = $request->start_date;
            $suplanuotas->save();

        }
        $this->check_mail();
        return response()->json(['success' => 'Great success']);
    }

    function Suplanuoti()
    {
        $suplanuoti = Suplanuoti::get();
        return view('Suplanuoti', ['suplanuoti' => $suplanuoti]);
    }

    function delete_suplanuotas($id)
    {
        $suplanuotas = Suplanuoti::find($id);
        $suplanuotas->delete();
        return redirect(route('Suplanuoti'));
    }

    function check_mail()
    {
        $suplanuoti = Suplanuoti::all();
        foreach ($suplanuoti as $suplanuotas) {
            if ($suplanuotas->start_date == null) {
                $this->send_mail($suplanuotas);
                $this->delete_suplanuotas($suplanuotas->id);
            } elseif ($suplanuotas->repeat == 'repeat') {
                if ($suplanuotas->frequency == 'daily') {
                    $this->is_daily($suplanuotas);
                } elseif ($suplanuotas->frequency == 'weekly') {
                    $this->is_weekly($suplanuotas);
                } elseif ($suplanuotas->frequency == 'monthly') {
                    $this->is_monthly($suplanuotas);
                } elseif ($suplanuotas->frequency == 'yearly') {
                    $this->is_yearly($suplanuotas);
                }
            } elseif ($suplanuotas->repeat == 'norepeat') {
                $this->once($suplanuotas);
            }
        }
    }

    function Check_single($suplanuotas)
    {
        if ($suplanuotas->start_date == null) {
            $this->send_mail($suplanuotas);
            $this->delete_suplanuotas($suplanuotas->id);
        } elseif ($suplanuotas->repeat == 'repeat') {
            if ($suplanuotas->frequency == 'daily') {
                $this->is_daily($suplanuotas);
            } elseif ($suplanuotas->frequency == 'weekly') {
                $this->is_weekly($suplanuotas);
            } elseif ($suplanuotas->frequency == 'monthly') {
                $this->is_monthly($suplanuotas);
            } elseif ($suplanuotas->frequency == 'yearly') {
                $this->is_yearly($suplanuotas);
            }
        } elseif ($suplanuotas->repeat == 'norepeat') {
            $this->once($suplanuotas);
        }
    }

    function once($suplanuotas)
    {
        $end = $this->end_date($suplanuotas);
        $now = Carbon::now();

        if ($end->isPast()) {
            $this->send_mail($suplanuotas);
            $this->delete_suplanuotas($suplanuotas->id);
        }
    }

    function is_daily($suplanuotas)
    {
        $end = $this->end_date($suplanuotas);
        $now = Carbon::now();
        $last = Carbon::createFromFormat('Y-m-d H:i:s', $suplanuotas->last_sent);
        if (!$end->isPast()) {
            if ($last->isPast()) {
                if ($now->diffInDays($end) % 1 == 0) {
                    $this->send_mail($suplanuotas);
                    $suplanuotas->last_sent = $last->addDays(1)->format('Y-m-d H:i:s');
                    $suplanuotas->save();
                }
            }
        } else {
            $this->delete_suplanuotas($suplanuotas->id);
        }
    }

    function is_weekly($suplanuotas)
    {
        $end = $this->end_date($suplanuotas);
        $now = Carbon::now();
        $last = Carbon::createFromFormat('Y-m-d H:i:s', $suplanuotas->last_sent);
        if (!$end->isPast()) {
            if ($last->isPast()) {
                if ($now->diffInDays($end) % 7 == 0) {
                    $this->send_mail($suplanuotas);
                    $suplanuotas->last_sent = $last->addDays(7)->format('Y-m-d H:i:s');
                    $suplanuotas->save();
                }
            }
        } else {
            $this->delete_suplanuotas($suplanuotas->id);
        }
    }

    function is_monthly($suplanuotas)
    {
        $end = $this->end_date($suplanuotas);
        $now = Carbon::now();
        $last = Carbon::createFromFormat('Y-m-d H:i:s', $suplanuotas->last_sent);
        if (!$end->isPast()) {
            if ($last->isPast()) {
                if ($now->diffInDays($end) % 30 == 0) {
                    $this->send_mail($suplanuotas);
                    $suplanuotas->last_sent = $last->addDays(30)->format('Y-m-d H:i:s');
                    $suplanuotas->save();
                }
            }
        } else {
            $this->delete_suplanuotas($suplanuotas->id);
        }
    }

    function is_yearly($suplanuotas)
    {
        $end = $this->end_date($suplanuotas);
        $now = Carbon::now();
        $last = Carbon::createFromFormat('Y-m-d H:i:s', $suplanuotas->last_sent);
        if (!$end->isPast()) {
            if ($last->isPast()) {
                if ($now->diffInDays($end) % 365 == 0) {
                    $this->send_mail($suplanuotas);
                    $suplanuotas->last_sent = $last->addDays(365)->format('Y-m-d H:i:s');
                    $suplanuotas->save();
                }
            }
        } else {
            $this->delete_suplanuotas($suplanuotas->id);
        }
    }

    function end_date($suplanuotas)
    {
        $temp = Suplanuoti::find($suplanuotas->id);
        $end = Carbon::createFromFormat('Y-m-d H:i:s', $temp->start_date);
        if ($suplanuotas->repeat == 'repeat') {
            if ($suplanuotas->length == 'week') {
                $end = $end->addDays(7);
            } elseif ($suplanuotas->length == 'month') {
                $end = $end->addDays(30);
            } else {
                $end = $end->addDays(365);
            }
        }
        return $end;
    }

    function send_mail($suplanuotas)
    {
        $vardas = $suplanuotas->klientas->vardas;
        $email = $suplanuotas->klientas->elpastas;
        $parasas = $suplanuotas->sablonas->parasas;
        $sablonas = $suplanuotas->sablonas->sablonas;
        $tema = $suplanuotas->sablonas->tema;
        $message = "Sveiki, " . $vardas . "\n \n" . $sablonas . "\n\n" . $parasas;
        $data = ["message" => $message, "tema" => $tema];
        Mail::to($email)->send(new Email($data));
    }


}
