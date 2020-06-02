<?php

namespace App\Http\Controllers;

use App\Devolucion;
use App\Flujo_efectivo;
use App\Pago;
use App\Venta;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $pagosPorTipo = Pago::selectRaw('tipo,sum(monto) as monto')->groupBy('tipo')->whereDay('fecha',date('d'))->get();

        $pagosPorMes = Pago::selectRaw('sum(monto) as monto,HOUR(fecha) as hora')->groupBy('hora')->orderBy('hora', 'ASC')->whereDay('fecha',date('d'))->get();

        return view('dashboard',['devoluciones' =>Devolucion::whereDay('fecha',date('d'))->get(),'total'=> Pago::whereDay('fecha',date('d'))->sum('monto'),'montos' => $pagosPorTipo->pluck('monto'),'pagos' =>$pagosPorMes->pluck('monto'),'horas' => $pagosPorMes->pluck('hora'),'flujos' => Flujo_efectivo::whereDay('fecha',date('d'))->get()]);
    }
}
