<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Mail\SendDocumentMail;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail(Document $document, Request $request)
    {
        $document['subject'] = $request->subject;
        $document['message'] = $request->message;
        Mail::to($request->toMails['mail'], $request->toMails['name'])->send(new SendDocumentMail($document));
    }
}
