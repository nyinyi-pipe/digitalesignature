<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function approvement() : Response
    {
        return Inertia::render('Admin/User/Approvement', [
            'users' => User::with('roles')->get()
        ]);
    }

    public function status(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->update([
            'status'=>$user->status?0:1
        ]);
    }


    public function destory(User $user)
    {
        $user->delete();
    }
}
