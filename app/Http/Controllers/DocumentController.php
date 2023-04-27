<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DocumentController extends Controller
{
    public function index() : Response
    {
        return Inertia::render('Documents/Index');
    }

    public function bulkImport() : Response
    {
        return Inertia::render('Documents/BulkImport');
    }

    public function send() : Response
    {
        return Inertia::render('Documents/Send');
    }
}
