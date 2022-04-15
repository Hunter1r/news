<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use UniSharp\LaravelFilemanager\Lfm;
use App\Models\News;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Upload files
     *
     * @param void
     *
     * @return JsonResponse
     */
    public function store(Request $request) {

        $uploaded_files = request()->file('upload')->store('uploads');
        
    }

     /**
     * @param  News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        Storage::disk('public')->delete($news->image);
        $news->image = null;
        $news->save();
        return response()->json(['message'=>'ok']);
    }
}
