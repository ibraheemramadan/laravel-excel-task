<?php


namespace App\Upload;


class UploadFile
{

    public static function upload($request): string
    {

        $filenameWithExt = $request->file('file')->getClientOriginalName();

        return $request->file('file')->storeAs('app/users/import',$filenameWithExt);

    }

}
