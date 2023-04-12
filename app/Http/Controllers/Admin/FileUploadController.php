<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function getFileUploadForm()

    {
        $list_paths = Storage::disk('s3')->allFiles();
        $path = Storage::cloud()->temporaryUrl(
            'leanhduc/anhbia.jpg/fQfiospNvZHIyfHpEuFoUKpx6btWK4KtiOG66nQ8.jpg',
            Carbon::now()->addMinute(5)
        );

//        dd($path);
        return view('file-upload', compact('list_paths', 'path'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);
        $fileName = $request->file->getClientOriginalName();
        $filePath = 'leanhduc/' . $fileName;
//        dd(file_get_contents($request->file));

        $path = Storage::disk('s3')->put($filePath, file_get_contents($request->file));
        $path = Storage::disk('s3')->url($path);
//        dd($path);
        // Perform the database operation here

        return back()
            ->with('success', 'File has been successfully uploaded.');
    }
}
