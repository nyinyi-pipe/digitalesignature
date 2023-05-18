<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Mail\SendDocumentMail;
use App\Models\Document;
use App\Models\Nonuser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail(Document $document, Request $request)
    {
        $document['subject'] = $request->subject;
        $document['message'] = $request->message;
        if($request->toMails) {
            foreach ($request->toMails as $index=>$mail) {
                $to = Nonuser::where('email', $mail)->first();
                if($to == null) {
                    $to = User::where('email', $mail)->first();
                }
                $document['link'] = route('recipient.edit.document', [$document->id,$to->id]);
                if($request->ccMails) {
                    Mail::to($to->email)->cc($request->ccMails)->send(new SendDocumentMail($document));
                } else {
                    Mail::to($to->email)->send(new SendDocumentMail($document));
                }
            }
        }

        // Mail::to($request->toMails)->cc($request->ccMails)->send(new SendDocumentMail($document));
    }
}
