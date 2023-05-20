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
            'index'=>$request->index,
            'type'=>$request->type,
            'x'=>$request->x,
            'y'=>$request->y,
        ]);
        return response()->json('successfully', 200, );
        // return to_route('document.edit.document', $request->docId);
    }

    public function signments($data, $type)
    {
        $array =  $data->filter(function ($res) use ($type) {
            return $res->type == $type;
        });
        $datas = [];
        foreach ($array as $key => $value) {
            $datas[] = $value;
        }
        return ($datas);
    }

    public function edit(Document $document, $recipient) : Response
    {
        $data = DocumentResult::where('document_id', $document->id)->where('nonuser_id', $recipient)->get();
        $signatures = $this->signments($data, "signature");
        $texts = $this->signments($data, "text");
        $dates = $this->signments($data, "date");
        $document['user'] = $document->user->name;
        $document['signatures'] = $signatures;
        $document['texts'] = $texts;
        $document['doc_res_id'] = $data->first()->id;
        $document['doc_user_id'] = $data->first()->nonuser_id;
        $document['status'] = $data->first()->status;
        return Inertia::render("Recipients/Documents/EditDocument", [
            'documents'=>$document
        ]);
    }

    public function update(Document $document, $recipient, Request $request) : RedirectResponse
    {
        $document = $document->results()->where('type', $request->type)->where('id', $request->id)->first();
        $document->update([
            'result'=>$request->signature
        ]);
        $documents = Document::where('id', $document->document_id)->first();
        $ress = DocumentResult::where('document_id', $document->document_id)->get();
        $signments = $ress->map(function ($res) {
            return array('id'=>$res->id,'user_id'=>$res->nonuser_id,'email'=>$res->recipient->email,'x'=>$res->x,'y'=>$res->y,'result'=>$res->result);
        });
        $documents['signatures'] = $signments;
        broadcast(new DocumentEvent('text'));

        return to_route('recipient.edit.document', [$request->doc_id,$recipient]);
    }

    public function updateStatus(DocumentResult $document, Request $request)
    {
        $document->update([
            'status'=>$request->status
        ]);
        return to_route('recipient.edit.document', [$request->doc_id,$request->user_id]);
    }
}
