<?php

namespace App\Traits;

trait ImageTrait
{
    public function uploadImage($request, $name, $forlderName)
    {
        $image = $request->file($name)->hashName();
        $request->file($name)->move($forlderName, $image);
        return $image;
    }
    public function deleteImage($imagePath)
    {
        if (is_file($imagePath) && file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
}
