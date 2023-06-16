<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Traits\Calculate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    use Calculate;
    public function index()
    {
        $results = $this->calculate(Document::all());
        $documents = Document::with(['sends','sends.recipient'])->paginate(5);

        return Inertia::render('Admin/Dashboard', [
            'documents'=> $documents,
            'results'=>$results
        ]);
    }

}
