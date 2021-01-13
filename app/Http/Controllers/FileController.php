<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    //
    public function index()
    {
        return Storage::files('upload-folder');
    }

    public function uploadFile(Request $request)
    {

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            $file->storeAs('upload-folder', $file_name);
        } else {
            return response()->json(['error' => 'File not exist!']);
        }
        return response()->json($file_name);
    }

    public function downloadFile($file)
    {
        $path = '../storage/app/upload-folder/' . $file;
        $header = [
            'Content-Type' => 'application/*',
        ];
        return response()->download($path, $file, $header);
    }

    public function deleteFile($file)
    {
        $file_exist = '../storage/app/upload-folder/' . $file;
        if ($file_exist) {
            @unlink($file_exist);
        } else {
            return response()->json(['error' => 'File not exist!']);
        }
        return response()->json(['success' => 'Delete Successfully.']);
    }
}
