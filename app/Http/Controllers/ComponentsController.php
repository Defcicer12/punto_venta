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

    /**
     * Display maps page
     *
     * @return \Illuminate\View\View
     */
    public function userEditModal(Request $request)
    {
        session()->flashInput($request->all());
        return view('users.components.modal-edit');
    }
}
