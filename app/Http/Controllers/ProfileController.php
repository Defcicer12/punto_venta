<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Rules\CurrentPasswordCheckRule;
use Illuminate\Support\Facades\Validator;
use App\User;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @param  array  $rules
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, array $rules)
    {
        if(isset($data['email']))
        {
            if($data['email'] == User::whereId($data['id'])->first()->email)
                unset($data['email']);
        }
        return Validator::make($data, $rules);
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    public function updateSeparate(Request $request)
    {
        $validator = $this->validator($request->all(),User::reglasEditar());

        if ($validator->fails()) {
            session()->flashInput($request->all());
            return view('users\components\edit-profile-form')
            ->withErrors($validator->errors());
        }

        User::whereId($request->get('id'))->update($request->except('_token','_method'));

        session()->flashInput($request->all());
        session()->flash('status','Usuario modificado correctamente');

        return view('users\components\edit-profile-form');
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }

    public function passwordSeparate(Request $request)
    {
        $validator = $this->validator($request->all(),[
            'password' => ['required', 'min:6', 'confirmed', 'different:old_password'],
            'password_confirmation' => ['required', 'min:6'],
        ]);

        if ($validator->fails()) {
            session()->flashInput($request->all());
            return view('users\components\edit-password-form')
            ->withErrors($validator->errors());
        }

        User::whereId($request->get('id'))->update(['password' => Hash::make($request->get('password'))]);
        session()->flash('status','Contraseña modificada correctamente');
        return view('users\components\edit-password-form');
    }
}
