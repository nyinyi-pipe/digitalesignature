<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Input;
use Illuminate\Http\Request;
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

    public function show(Input $input) : Response
    {
        $input = Input::with('document', 'recipient', 'requester')->get()->filter(fn ($inputs) => $inputs->id == $input->id)->first();
        return Inertia::render('Input/Show', [
            'input'=>$input
        ]);
    }
}
