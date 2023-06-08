<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InformationController extends Controller
{
    public function update(Request $request) : RedirectResponse
    {

        $request->validate([
            'firstName'=>['required'],
            'lastName'=>['required'],
            'email'=>['required',Rule::unique('users', 'email')->ignore($request->user()->id)],
        ]);

        $request->user()->update([
            'fist_name'=>$request->firstName,
            'last_name'=>$request->lastName,
            'name'=>$request->firstName." ".$request->lastName,
            'email'=>$request->email
        ]);
        return back();
    }
}
