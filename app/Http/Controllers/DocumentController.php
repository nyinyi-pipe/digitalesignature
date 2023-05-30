<?php

namespace App\Http\Controllers;

use App\Events\DocumentEvent;
use App\Http\Requests\DocumentRequest;
use App\Http\Requests\RecipientRequest;
use App\Models\Document;
use App\Models\DocumentResult;
use App\Models\Nonuser;
use App\Models\User;
use Carbon\Carbon;
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
        $doc_type = $request->type;
        $newDocument = Document::create([
            'user_id'=>auth()->user()->id,
            'doc_name'=> $request->name,
            'doc_docs'=> $request->document,
            'doc_type'=> $doc_type,
            'doc_key'=>'TEST'
        ]);
        $request->session()->put('editDoc', $newDocument);
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

    public function editDocument(Document $document, Request $request) : Response
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
        if($request->newDocument != null) {

            if(is_array($doc_docs)) {
                $docs = $doc_docs;
                foreach ($request->newDocument as $doc) {
                    $docs[] = $doc;
                }
            } else {
                $docs[] = $doc_docs;
                foreach ($request->newDocument as $doc) {
                    $docs[] = $doc;
                }
            }
        }

        $document->update([
            'doc_name'=>$request->newDocumentName??$document->doc_name,
            'doc_docs'=>$request->newDocument != null?$docs:$doc_docs
        ]);
        return response()->json([
            'document'=>$document
        ]);

    }

    public function deleteDoc(Document $document, Request $request)
    {
        $docs = array_filter($document->doc_docs, fn ($doc) => $doc != $request->doc);
        $document->update([
            'doc_docs'=>$docs
        ]);
        return to_route('document.edit.document', $document->id);
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

    public function viewUpdate(Document $document)
    {
        $data = DocumentResult::where('document_id', $document->id)->get();
        $signatures = $this->signments($data, "signature");
        $texts = $this->signments($data, "text");
        $dates = $this->signments($data, "date");
        $document['user'] = $document->user->name;
        $document['signatures'] = $signatures;
        $document['texts'] = $texts;
        $document['dates'] = $dates;
        $document['recipients'] = $document->documentnonuser->map(fn ($doc) => ['name'=>$doc->name,'email'=>$doc->email])->toArray();

        return response()->json([
            'document'=>$document
        ]);
    }


    public function view(Document $document, Request $request) : Response
    {
        $data = DocumentResult::where('document_id', $document->id)->get();
        $signatures = $this->signments($data, "signature");
        $texts = $this->signments($data, "text");
        $dates = $this->signments($data, "date");
        $document['user'] = $document->user->name;
        $document['signatures'] = $signatures;
        $document['texts'] = $texts;
        $document['dates'] = $dates;
        $document['recipients'] = $document->documentnonuser->map(fn ($doc) => ['name'=>$doc->name,'email'=>$doc->email])->toArray();
        $request->session()->forget('editDoc');

        return Inertia::render("Documents/ViewDocument", [
            'documents'=>$document
        ]);

    }

    public function finishUpdate(Document $document, Request $request)
    {
        $document->update([
            'doc_status'=>$request->doc_status,
            'finish_datetime'=>Carbon::now()->toDateTimeString()
        ]);
        return redirect()->back();
    }
}
