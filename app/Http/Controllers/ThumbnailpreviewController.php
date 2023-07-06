<?php

namespace App\Http\Controllers;

use App\Models\Thumbnailpreview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ThumbnailpreviewController extends Controller
{
    public function upload(Request $request)
    {
        $path = $request->file('file')->store('thumbnailpreviews');
        Thumbnailpreview::create([
            'image'=>$path
        ]);
        $getFile = public_path('storage/'.$path);
        $file =   "data:image/jpeg;base64,".base64_encode(file_get_contents($getFile));
        return [$path,$file];
    }

    public function destroy($folder, $path)
    {
        Storage::delete($folder."/".$path);
        Thumbnailpreview::where('image', $folder."/".$path)->first()->delete();
        return '';
    }
}
