<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Mail\SendDocumentMail;
use App\Models\Document;
use App\Models\Nonuser;
use App\Models\Send;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    private function sentStore($request) : void
    {
        foreach($request->toMails as $mail) {
            $recipient = Nonuser::where("email", $mail)->first() ?? User::where("email", $mail)->first();
            Send::create([
                'document_id'=>$request->documentId,
                'requester_id'=>auth()->user()->id,
                'recipient_id'=>$recipient->id,
                'subject'=>$request->subject,
                'content'=>$request->message,
                'cc_mails'=>json_encode($request->ccMails),
                'status'=>1,
            ]);
        }
    }
    public function sendMail(Document $document, Request $request)
    {
        try {
            $this->sentStore($request);
            $document['subject'] = $request->subject;
            $document['message'] = $request->message;
            if($request->toMails) {
                foreach ($request->toMails as $index=>$mail) {
                    $to = Nonuser::where('email', $mail)->first();
                    if($to == null) {
                        $to = User::where('email', $mail)->first();
                    }
                    $document['link'] = route('recipient.edit.document', [$document->id,$to->id]);
                    Mail::to($to->email)->send(new SendDocumentMail($document));
                }
                if($request->ccMails != null) {
                    $document['link'] = route('document.cc.view.document', $document->id);
                    Mail::to(auth()->user()->email)->cc($request->ccMails)->send(new SendDocumentMail($document));
                }
                return;
            }
            $document['link'] = route('document.view.document', $document->id);
            Mail::to(auth()->user()->email)->cc($request->ccMails)->send(new SendDocumentMail($document));
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

}
