<?php

namespace App\Http\Controllers;

use App\Events\DocumentEvent;
use App\Http\Requests\DocumentRequest;
use App\Http\Requests\RecipientRequest;
use App\Http\Resources\DocumentResource;
use App\Models\Document;
use App\Models\DocumentResult;
use App\Models\Nonuser;
use App\Models\User;
use Carbon\Carbon;
use Faker\Provider\File;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use Imagick;

class DocumentController extends Controller
{
    public function index()
    {
        $documents  = auth()->user()->documents()->count() ? auth()->user()->documents->load(['sends','sends.recipient'])->toQuery()->paginate(5) : '';
        return Inertia::render('Documents/Index', [
            'documents'=> $documents
        ]);
    }

    public function create() : Response
    {
        return Inertia::render('Documents/CreateDocument');
    }

    public function store(DocumentRequest $request) :RedirectResponse
    {
        $request->validated();
        $folder = uniqid();
        $pdf = $request->file('document')->store('documents');
        $imagick = new Imagick();
        $imagick->readImage(public_path("storage/".$pdf));
        mkdir($folder);
        $filename = uniqid();
        $saveImagePath = public_path($folder."/".$filename.".jpeg");
        $imagick->writeImages($saveImagePath, true);

        $converted = [];
        $files = FacadesFile::allFiles(public_path($folder));
        foreach ($files as $file) {
            $converted[] = "data:image/jpeg;base64,".base64_encode(file_get_contents($file));
        }
        $doc_type = $request->type;
        $newDocument = Document::create([
            'user_id'=>auth()->user()->id,
            'doc_name'=> $request->name,
            'doc_docs'=> $converted,
            'folder'=>$folder,
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
        foreach ($request->email as $key=>$email) {
            $user = User::where('email', $email)->first();
            $nonuser = Nonuser::where('email', $email)->first();
            try {
                DB::beginTransaction();
                if($user == null && $nonuser == null) {
                    $nonuser = Nonuser::create([
                        'name'=>$request->firstName[$key]." ".$request->lastName[$key],
                        'first_name'=>$request->firstName[$key],
                        'last_name'=>$request->lastName[$key],
                        'email'=>$email
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
        }

        return to_route('document.edit.document', ['document'=>$document->id]);
    }

    public function addRecipients(Document $document, RecipientRequest $request)
    {
        $request->validated();
        $user = User::where('email', $request->email)->first();
        $nonuser = Nonuser::where('email', $request->email)->first();
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
        $recipients = $document->documentnonuser->map(fn ($doc) => ['name'=>$doc->name,'email'=>$doc->email])->toArray();

        return response()->json([
            'data'=>$recipients
        ]);
    }

    public function editDocument(Document $document, Request $request)
    {
        if($document->doc_status == 3) {
            return to_route('document.index');
        }
        $data = DocumentResult::where('document_id', $document->id)->get();
        $signatures = $this->signments($data, "signature");
        $texts = $this->signments($data, "text");
        $dates = $this->signments($data, "date");
        $document['user'] = $document->user->name;
        $document['signatures'] = $signatures;
        $document['texts'] = $texts;
        $document['dates'] = $dates;
        $document['recipients'] = $document->documentnonuser->map(fn ($doc) => ['name'=>$doc->name,'email'=>$doc->email])->toArray();
        return Inertia::render("Documents/EditDocument", [
            'documents'=>$document
        ]);
    }

    public function newDocumentName(Document $document, Request $request)
    {
        $doc_docs = null;
        if($request->file('newDocument')) {
            $pdf = $request->file('newDocument')->store('documents');
            $imagick = new Imagick();
            $imagick->readImage(public_path("storage/".$pdf));
            $filename = uniqid();
            $saveImagePath = public_path($document->folder."/".$filename.".jpeg");
            $imagick->writeImages($saveImagePath, true);

            $converted = [];
            $files = FacadesFile::allFiles(public_path($document->folder));
            foreach ($files as $file) {
                $converted[] = "data:image/jpeg;base64,".base64_encode(file_get_contents($file));
            }

            $doc_docs = $converted;
        }

        // $doc_docs = $document->doc_docs;
        // $docs = [];
        // if($request->newDocument != null) {

        //     if(is_array($doc_docs)) {
        //         $docs = $doc_docs;
        //         foreach ($request->newDocument as $doc) {
        //             $docs[] = $doc;
        //         }
        //     }
        //     // } else {
        //     //     $docs[] = $doc_docs;
        //     //     foreach ($request->newDocument as $doc) {
        //     //         $docs[] = $doc;
        //     //     }
        //     // }
        // }

        $document->update([
            'doc_name'=>$request->newDocumentName??$document->doc_name,
            'doc_docs'=>$request->newDocument != null?$doc_docs :$document->doc_docs
        ]);
        // return back();
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
        // return to_route('document.edit.document', $document->id);
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
        // dd($document->update([
        //     'doc_status'=>0
        // ]));
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

    public function ccview(Document $document, Request $request) : Response
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

        return Inertia::render("Documents/CCViewDocument", [
            'documents'=>$document
        ]);

    }

    public function finishUpdate(Document $document, Request $request) : void
    {
        $pdf = $request->file('file')->store('documents');
        $document->update([
            'doc_status'=>$request->doc_status,
            'finish_datetime'=>Carbon::now("Asia/Yangon")->toDateTimeString()
        ]);
        $sends = $document->sends()->get();
        foreach ($sends as $send) {
            $send->update([
                'file'=>$pdf
            ]);
        }
    }

    public function destroy(Document $document) :void
    {
        $document->delete();
    }
}
