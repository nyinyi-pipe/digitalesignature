<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentResult;
use App\Models\Nonuser;
use App\Models\Send;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SendController extends Controller
{
    public function index() : Response
    {
        $documents = Document::with(['sends','sends.recipient'])->paginate(5);
        return Inertia::render('Sends/Index', [
            'documents' => $documents
        ]);
    }

}
