<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Events\DocumentEvent;
use App\Http\Requests\DocumentRequest;
use App\Http\Requests\RecipientRequest;
use App\Http\Resources\DocumentResource;
use App\Models\Document;
use App\Models\DocumentResult;
use App\Models\Nonuser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with(['sends','sends.recipient'])->paginate(5);
        return Inertia::render('Documents/Index', [
            'documents'=> $documents
        ]);
    }
}
