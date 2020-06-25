<?php

namespace App\Http\Controllers;

use App\User;
use Symfony\Component\HttpFoundation\Request;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index',['users' => $model->all()]);
    }

    public function tableSearch(Request $request)
    {
        $q= $request->get('q');
        $users = User::where('name','LIKE','%'.$q.'%')
        ->orWhere('email','LIKE','%'.$q.'%')
        ->orWhere('tipo','LIKE','%'.$q.'%')
        ->orWhere('telefono','LIKE','%'.$q.'%')
        ->get();
        return view('users.components.users-table', ['users' => $users]);
    }
}
