<?php

namespace App\Traits;
use Illuminate\Http\Request;

trait UploadImageTrait{

    public function uploadImage(Request $request, $folderName){

        $image = $request->file('attachment')->getClientOriginalName();
        $path = $request->file('attachment')->storeAs($folderName,$image,'local');
        return $path;

    }
}