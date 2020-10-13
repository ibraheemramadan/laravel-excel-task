<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Imports\UsersImport;
use App\Upload\UploadFile;
use Illuminate\Http\Request;


class ImportController extends Controller
{

    public function import(FileRequest $request)
    {

        $file = UploadFile::upload($request);

        $import = new UsersImport;

        $import->queue($file);

        return redirect('/')->with('success', 'file uploaded successfully');
    }
}
