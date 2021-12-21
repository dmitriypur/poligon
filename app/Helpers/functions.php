<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

function uploadImage(Request $request, $image = null){
    if($request->hasFile('image')){
        if($image){
            Storage::disk('public')->delete($image);
        }
        $folder = date('Y-m-d');
        return Storage::disk('public')->put("/images/{$folder}", $request['image']);
    }
    return $image;
}