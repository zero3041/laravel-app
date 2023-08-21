<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait StorageImageTrait{
    public function storagetraitUpload($request,$fieldName, $fodername){
        if ($request->hasFile($fieldName)){
            $file = $request->$fieldName;
            $file_name_origin = $file->getClientOriginalName();
            $file_name_hash = str::random(20) . '.' . $file->getClientOriginalExtension();
            $file_path = $request->file($fieldName)->storeAs('public/' . $fodername . '/' . Auth::guard('admin')->id() ,$file_name_hash);
            $dataUploadtrait = [
                'file_name' => $file_name_origin,
                'file_path' => Storage::url($file_path)
            ];
            return $dataUploadtrait;
        }
        return null;
    }
    public function storagetraitUploadMutiple($file, $fodername){
            $file_name_origin = $file->getClientOriginalName();
            $file_name_hash = str::random(20) . '.' . $file->getClientOriginalExtension();
            $file_path = $file->storeAs('public/' . $fodername . '/' . Auth::guard('admin')->id() ,$file_name_hash);
            $dataUploadtrait = [
                'file_name' => $file_name_origin,
                'file_path' => Storage::url($file_path)
            ];
            return $dataUploadtrait;
    }
}
