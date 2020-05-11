<?php

namespace App\Http\Controllers;

use App\Devolucion;
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
        $pagosPorTipo = Pago::selectRaw('tipo,sum(monto) as monto')->groupBy('tipo')->get();

        $pagosPorMes = Pago::selectRaw('sum(monto) as monto,MONTH(fecha) as mes')->groupBy('mes')->orderBy('mes', 'ASC')->get();

        return view('dashboard',['devoluciones' =>Devolucion::all(),'total'=> Pago::all()->sum('monto'),'montos' => $pagosPorTipo->pluck('monto'),'pagos' =>$pagosPorMes->pluck('monto')]);
    }
}
