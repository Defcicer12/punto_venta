<?php

namespace App\Http\Controllers;

use App\Orden_servicio;
use Barryvdh\DomPDF\Facade as PDF;

class PDFController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ticketCliente($id)
    {
        $orden = Orden_servicio::whereId($id)->first();

        $pdf = \PDF::loadView('ticket-cliente',['orden' => $orden ])->save(public_path('Alta-servicio.pdf'))->setPaper('legal', 'portrait');
        return response()->download(public_path('Alta-servicio.pdf'));
    }

    public function ticketPago($id)
    {
        $orden = Orden_servicio::whereId($id)->first();
        $subtotal= $orden->costo_servicio;
        foreach ($orden->insumos as $insumo) {
            $subtotal += $insumo->cantidad * $insumo->precio;
        }
        $pdf = \PDF::loadView('ticket-pago',['orden' => $orden ,'subtotal' => $subtotal])->save(public_path('Ticket-pago.pdf'))->setPaper('legal', 'portrait');
        return response()->download(public_path('Ticket-pago.pdf'));
    }
}
