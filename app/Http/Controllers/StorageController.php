<?php

namespace App\Http\Controllers;

use App\Learner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class StorageController extends Controller
{
    public function preview(Request $request, $disk, $filename)
    {
        $filename = Learner::first()->photo_path;
        // $path = storage_path('images/photos/' . $filename);
        $path = Storage::disk($disk)->path($filename);
            if (!File::exists($path)) {
                abort(404);
            }

            $file = File::get($path);
            $type = File::mimeType($path);

            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);

            return $path;
    }
}
