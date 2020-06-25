<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Devolucion;
use App\Productos;
use App\Venta;
use App\Venta_producto;
use Symfony\Component\HttpFoundation\Request;

class ComponentsController extends Controller
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

    public function userEditModal(Request $request)
    {
        session()->flashInput($request->all());
        return view('users.components.modal-edit');
    }

    public function clientEditModal(Request $request)
    {
        session()->flashInput($request->all());
        return view('clients.components.modal-edit');
    }

    public function productEditModal(Request $request)
    {
        session()->flashInput($request->all());
        return view('products.components.modal-edit');
    }

    public function refundEditModal(Request $request)
    {
        $detalles = $request->get('detalles');
        $id_venta = $detalles[0]['id_venta'];
        $productos = Venta_producto::where('id_venta',$id_venta)->get();
        $devoluciones = Devolucion::where('id_venta',$id_venta)->get();
        session()->flashInput($request->all());
        return view('refunds.components.modal-edit',['productos' => $productos,'suma' => $productos->sum('precio'),'devoluciones' => $devoluciones]);
    }

    public function refundtableSearch(Request $request)
    {
        $q= $request->get('q');
        $sales = Venta::select('venta.id','venta.estado','venta.fecha','venta.id_empleado','venta.id_cliente','venta.precio')
        ->join('cliente','venta.id_cliente','=','cliente.id')
        ->join('users','venta.id_empleado','=','users.id')
        ->where('venta.id','LIKE','%'.$q.'%')
        ->orWhere('venta.estado','LIKE','%'.$q.'%')
        ->orWhere('cliente.nombre','LIKE','%'.$q.'%')
        ->orWhere('users.name','LIKE','%'.$q.'%')
        ->get();
        return view('refunds.components.refunds-table', ['sales' => $sales]);
    }
    public function clientSelect()
    {
        $clientes = Cliente::all();
        return view('pages\components\clients-select',['clientes' => $clientes]);
    }
    public function saleTotals(Request $r)
    {
        $data= $r->all();
        $iva = $data['subtotal'] * 0.16;
        $importe = $iva+$data['subtotal'];
        return view('pages\components\total-layer',['subtotal' => $data['subtotal'],'iva' => $iva, 'importe' => $importe]);
    }
    public function productTable()
    {
        $clientes = Productos::all();
        return view('products\components\products-table',['products' => $clientes]);
    }

}
