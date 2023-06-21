<?php

namespace App\Http\Controllers;

use App\Events\DocumentEvent;
use App\Mail\EditDocumentMail;
use App\Mail\SendDocumentMail;
use App\Models\Document;
use App\Models\DocumentResult;
use App\Models\Input;
use App\Models\Nonuser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
        foreach($data as $key) {
            if($key->view == null) {
                $view = Carbon::now("Asia/Yangon");
                $key->update([
                    'view' => $view->toDateTimeString()
                ]);
            }
        }
        $signatures = $this->signments($data, "signature");
        $texts = $this->signments($data, "text");
        $dates = $this->signments($data, "date");
        $document['user'] = $document->user->name;
        $document['signatures'] = $signatures;
        $document['texts'] = $texts;
        $document['dates'] = $dates;
        $document['doc_res_id'] = $data->first()->id;
        $document['doc_user_id'] = $data->first()->nonuser_id;
        $document['status'] = $data->first()->status;
        return Inertia::render("Recipients/Documents/EditDocument", [
            'documents'=>$document
        ]);
    }

    public function update(Document $document, $recipient, Request $request) : RedirectResponse
    {
        $user = (User::where('id', $recipient)->first() ?? Nonuser::where('id', $recipient)->first());
        $requester = $document->user->email;
        $view = $document->id;
        $doc_name = $document->doc_name;
        $document = $document->results()->where('type', $request->type)->where('id', $request->id)->first();
        $document->update([
            'result'=>$request->signature,
            'ip'=>$request->ip,
            'city'=>$request->city,
            'country'=>$request->country,
        ]);
        $documents = Document::where('id', $document->document_id)->first();
        $ress = DocumentResult::where('document_id', $document->document_id)->get();
        $signments = $ress->map(function ($res) {
            return array('id'=>$res->id,'user_id'=>$res->nonuser_id,'email'=>$res->recipient->email,'x'=>$res->x,'y'=>$res->y,'result'=>$res->result);
        });
        $documents['signatures'] = $signments;
        $res['name'] = $user->name;
        $res['type'] = $request->type;
        broadcast(new DocumentEvent($res));
        // $document['link'] = route('document.view.document', $view);
        // $document['email'] = $user->email;
        // $document['name'] = $user->name;
        // $document['doc_name'] = $doc_name;
        // Mail::to($requester)->send(new EditDocumentMail($document));
        return redirect()->back();
        // return to_route('recipient.edit.document', [$request->doc_id,$recipient]);
    }

    public function updateStatus(DocumentResult $document, Request $request)
    {
        $doc = Document::findOrFail($request->doc_id);
        $recipient = Nonuser::findOrFail($request->user_id) ?? User::findOrFail($request->user_id);

        Input::create([
            'document_id'=>$doc->id,
            'requester_id'=>$doc->user->id,
            'recipient_id'=>$recipient->id,
            'content'=>$doc->doc_name." "."document has been completed by"." ".$recipient->name
        ]);
        $doc['link'] = route('document.view.document', $doc->id);
        $doc['email'] = $recipient->email;
        $doc['name'] = $recipient->name;
        Mail::to($doc->user->email)->send(new EditDocumentMail($doc));


        $document->update([
            'status'=>$request->status
        ]);
        return to_route('recipient.edit.document', [$request->doc_id,$request->user_id]);
    }
}
