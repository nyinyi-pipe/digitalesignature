<?php

namespace App\Http\Controllers;

use App\Events\DocumentEvent;
use App\Http\Requests\DocumentRequest;
use App\Http\Requests\RecipientRequest;
use App\Models\Document;
use App\Models\DocumentResult;
use App\Models\Nonuser;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class DocumentController extends Controller
{
    public function index() : Response
    {
        return Inertia::render('Documents/Index');
    }

    public function create() : Response
    {
        return Inertia::render('Documents/CreateDocument');
    }

    public function store(DocumentRequest $request) :RedirectResponse
    {
        $request->validated();
        $document = $request->file('document');
        $doc_name = $document->getClientOriginalName();
        $doc_type = $document->getClientOriginalExtension();
        $docs = uniqid().".".$doc_type;
        $request->file('document')->storeAs('documents', $docs);
        $newDocument = Document::create([
            'user_id'=>auth()->user()->id,
            'doc_name'=> $doc_name,
            'doc_docs'=> [$docs],
            'doc_type'=> $doc_type,
            'doc_key'=>'TEST'
        ]);
        return to_route('document.add-recipients', ['document'=>$newDocument->id]);
    }

    public function send() : Response
    {
        return Inertia::render('Documents/Send');
    }

    public function recipients(Document $document) : Response
    {
        return Inertia::render("Documents/Recipient", [
            'AddedDocument'=>$document
        ]);
    }

    public function storeRecipients(Document $document, RecipientRequest $request) :RedirectResponse
    {
        $request->validated();
        $user = User::where('email', $request->email)->first();
        $nonuser = Nonuser::where('email', $request->email)->first();
        try {
            DB::beginTransaction();
            if($user == null && $nonuser == null) {
                $nonuser = Nonuser::create([
                    'name'=>$request->firstName." ".$request->lastName,
                    'first_name'=>$request->firstName,
                    'last_name'=>$request->lastName,
                    'email'=>$request->email
                ]);
            }
            $document->documentnonuser()->attach($nonuser->id??$user->id);
            $document->update([
                'doc_name'=>$request->docName??$document->doc_name,
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
        return to_route('document.edit.document', ['document'=>$document->id]);
    }

    public function editDocument(Document $document) : Response
    {
        $document['recipients'] = $document->documentnonuser->map(fn ($doc) => ['name'=>$doc->name,'email'=>$doc->email])->toArray();
        return Inertia::render("Documents/EditDocument", [
            'documents'=>$document
        ]);
    }

    public function newDocumentName(Document $document, Request $request)
    {
        $doc_docs = $document->doc_docs;
        $docs = [];
        if($request->file('newDocument')) {
            $file = $request->file('newDocument');
            $doc_type = $file->getClientOriginalExtension();
            $doc = uniqid().".".$doc_type;
            $file->storeAs('documents', $doc);

            if(is_array($doc_docs)) {
                $docs = $doc_docs;
                $docs[] = $doc;
            } else {
                $docs[] = $doc_docs;
                $docs[] = $doc;
            }
        }
        $document->update([
            'doc_name'=>$request->newDocumentName??$document->doc_name,
            'doc_docs'=>$request->file('newDocument')?$docs:$doc_docs
        ]);

        return to_route('document.edit.document', $document->id);
    }

    public function deleteDoc(Document $document, Request $request)
    {
        $docs = array_filter($document->doc_docs, fn ($doc) => $doc != $request->doc);
        $document->update([
            'doc_docs'=>$docs
        ]);
        return to_route('document.edit.document', $document->id);
    }

    public function view(Document $document) : Response
    {
        $ress = DocumentResult::where('document_id', $document->id)->get();
        $document['recipients'] = $document->documentnonuser->map(fn ($doc) => ['name'=>$doc->name,'email'=>$doc->email])->toArray();
        $signments = $ress->map(function ($res) {
            return array('id'=>$res->id,'index'=>$res->index,'user_id'=>$res->nonuser_id,'email'=>$res->recipient->email,'x'=>$res->x,'y'=>$res->y,'result'=>$res->result);
        });
        $document['signatures'] = $signments;
        return Inertia::render("Documents/ViewDocument", [
            'documents'=>$document
        ]);

    }
}
