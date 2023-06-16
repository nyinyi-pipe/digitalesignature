<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Traits\Calculate;

class DashboardController extends Controller
{
    use Calculate;
    public function index()
    {
        $results = $this->calculate(auth()->user()->documents);
        $documents  = auth()->user()->documents->load(['sends','sends.recipient'])->toQuery()->paginate(5);

        return Inertia::render('Dashboard', [
            'documents'=>$documents,
            'results'=>$results
        ]);
    }


}
