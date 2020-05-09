<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Movimiento_inventario;
use App\Productos;
use App\User;
use App\Venta;

class PageController extends Controller
{
    /**
     * Display icons page
     *
     * @return \Illuminate\View\View
     */
    public function icons()
    {
        return view('pages.icons');
    }

    /**
     * Display maps page
     *
     * @return \Illuminate\View\View
     */
    public function maps()
    {
        return view('pages.maps',[
            'productos' => Productos::all(),
            'clientes' => Cliente::all()
        ]);
    }

    /**
     * Display tables page
     *
     * @return \Illuminate\View\View
     */
    public function tables()
    {
        return view('pages.tables');
    }

    /**
     * Display notifications page
     *
     * @return \Illuminate\View\View
     */
    public function notifications()
    {
        return view('pages.notifications');
    }

    /**
     * Display rtl page
     *
     * @return \Illuminate\View\View
     */
    public function rtl()
    {
        return view('pages.rtl');
    }

    /**
     * Display typography page
     *
     * @return \Illuminate\View\View
     */
    public function typography()
    {
        return view('pages.typography');
    }

    /**
     * Display upgrade page
     *
     * @return \Illuminate\View\View
     */
    public function upgrade()
    {
        return view('pages.upgrade');
    }

    public function clients()
    {
        return view('clients.index',['clients' => Cliente::all()]);
    }

    public function products()
    {
        return view('products.index',['products' => Productos::all()]);
    }

    public function sales()
    {
        return view('sales.index',['sales' => Venta::all()]);
    }

    public function refunds()
    {
        return view('refunds.index',['sales' => Venta::all()]);
    }

    public function inventory()
    {
        return view('inventory.index',['movements' => Movimiento_inventario::all()]);
    }

    public function adjusment()
    {
        return view('adjusments.index',['adjusments' => Movimiento_inventario::all()]);
    }

    public function flux()
    {
        return view('flux.index',['flux' => Movimiento_inventario::all()]);
    }

    public function cash()
    {
        return view('cash.index',['cash' => Movimiento_inventario::all()]);
    }

    public function corte()
    {
        return view('corte',['corte' => Movimiento_inventario::all()]);
    }
}
