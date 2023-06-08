<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SignatureController extends Controller
{
    public function update(Request $request) : RedirectResponse
    {
        $request->user()->update([
            'signature'=>$request->signature
        ]);

        return back();
    }
}
