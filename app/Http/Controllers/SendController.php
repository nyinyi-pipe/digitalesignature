<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentResult;
use App\Models\Nonuser;
use App\Models\Send;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SendController extends Controller
{
    public function index() : Response
    {
        $documents  = auth()->user()->documents()->count() ? auth()->user()->documents->load(['sends','sends.recipient']) : '';
        return Inertia::render('Sends/Index', [
            'documents' => $documents
        ]);
    }

    public function signments($data, $type)
    {
        $array =  $data->filter(function ($res) use ($type) {
            return $res->type == $type;
        });
        $datas = [];
        foreach ($array as $key => $value) {
            $value['name'] = $value->recipient->name;
            $value['email'] = $value->recipient->email;
            $datas[] = $value;
        }
        return ($datas);
    }

    public function show(Document $document)
    {
        $documents = $document->with(['sends','sends.recipient','sends.requester'])->get();
        $doc = $documents->find($document->id);
        $data = DocumentResult::where('document_id', $document->id)->get();
        $signatures = $this->signments($data, "signature");
        $texts = $this->signments($data, "text");
        $dates = $this->signments($data, "date");
        $doc['user'] = $document->user->name;
        $doc['signatures'] = $signatures;
        $doc['texts'] = $texts;
        $doc['dates'] = $dates;
        $doc['recipients'] = $document->documentnonuser->map(fn ($doc) => ['name'=>$doc->name,'email'=>$doc->email])->toArray();

        return Inertia::render('Sends/Show', [
            'documents' => $doc
        ]);
    }

    public function update(Document $document, Request $request)
    {
        $send = $document->sends()->where('id', $request->send)->first();
        $file = $request->file('file')->store('documents');
        $send->update([
            'file'=>$file
        ]);
    }

}
