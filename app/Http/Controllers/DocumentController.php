<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentRequest;
use App\Http\Requests\RecipientRequest;
use App\Models\Document;
use App\Models\NonUser;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
            'doc_docs'=> $docs,
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
        try {
            DB::beginTransaction();
            if($user == null) {
                $nonUser = NonUser::create([
                    'name'=>$request->firstName." ".$request->lastName,
                    'first_name'=>$request->firstName,
                    'last_name'=>$request->lastName,
                    'email'=>$request->email
                ]);
                $nonusers = [];
                //ongoing
                if($document->nonuser_id) {
                    $users = json_decode($document->nonuser_id);
                    $users[] = $nonUser->id;
                } else {
                    $nonusers[] = $nonUser->id;
                }
                $document->update([
                    'nonuser_id'=>$document->nonuser_id??$nonusers
                ]);
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
        }
        return to_route('document.edit.document', ['document'=>$document->id]);
    }

    public function editDocument(Document $document) : Response
    {
        return Inertia::render("Documents/EditDocument", [
            'documents'=>$document
        ]);
    }

    public function newDocumentName(Document $document, Request $request)
    {
        $document->update([
            'doc_name'=>$request->newDocumentName??$document->doc_name
        ]);

        return response()->json([
            'documents' => $document
        ]);
    }
}
