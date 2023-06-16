<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Input;
use Inertia\Inertia;
use Inertia\Response;

class InputController extends Controller
{
    public function index() : Response
    {
        // $documents = Document::with(['sends','sends.recipient'])->get();
        $inputs  = Input::with('document', 'recipient', 'requester')->get();
        return Inertia::render('Input/Index', [
            'inputs'=>$inputs
        ]);
    }

}
