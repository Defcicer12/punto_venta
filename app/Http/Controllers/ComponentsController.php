<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Productos;
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
        session()->flashInput($request->all());
        return view('refunds.components.modal-edit',['productos' => $request->get('detalles')]);
    }
}
