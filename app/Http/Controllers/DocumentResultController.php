<?php

namespace App\Http\Controllers;

use App\Events\DocumentEvent;
use App\Models\Document;
use App\Models\DocumentResult;
use App\Models\Nonuser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DocumentResultController extends Controller
{
    public function store(Request $request)
    {
        $recipient = Nonuser::where('email', $request->email)->first();
        DocumentResult::create([
            'document_id'=>$request->docId,
            'nonuser_id'=>$recipient->id,
            'x'=>$request->x,
            'y'=>$request->y,
        ]);
        return to_route('document.edit.document', $request->docId);
    }

    public function edit(Document $document, $recipient) : Response
    {
        $ress = DocumentResult::where('document_id', $document->id)->where('nonuser_id', $recipient)->get();
        $signments = $ress->map(function ($res) {
            return array('id'=>$res->id,'user_id'=>$res->nonuser_id,'email'=>$res->recipient->email,'x'=>$res->x,'y'=>$res->y,'result'=>$res->result);
        });
        $document['signatures'] = $signments;
        return Inertia::render("Recipients/Documents/EditDocument", [
            'documents'=>$document
        ]);
    }

    public function update(DocumentResult $document, $recipient, Request $request) : RedirectResponse
    {
        // $documents = Document::where('id', $document->document_id)->first();
        // $ress = DocumentResult::where('document_id', $document->document_id)->get();
        // $signments = $ress->map(function ($res) {
        //     return array('id'=>$res->id,'user_id'=>$res->nonuser_id,'email'=>$res->recipient->email,'x'=>$res->x,'y'=>$res->y,'result'=>$res->result);
        // });
        // $documents['signatures'] = $signments;
        broadcast(new DocumentEvent('text'));
        $document->update([
            'result'=>$request->signature
        ]);
        return to_route('recipient.edit.document', [$request->doc_id,$recipient]);
    }
}
