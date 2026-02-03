<?php

namespace App\Http\Traits;

use Str;
use Intervention\Image\Facades\Image;

trait CustomFileUpload
{
    public function uploadFile($image, $path)
    { 
        $path = env('FRONTEND_path') . '/' . $path;
        $image_name = uniqid(Str::random(12)) . '.' . $image->getClientOriginalExtension();
        $image->move($path, $image_name);
        return $image_name;
    }

    public function uploadImageFile($image, $path)
    {
        
        $image = Image::make($image);

        // Generate a unique name for the converted image
        $name = uniqid(Str::random(12)) . '.webp';

        $folderPath = main_public_path($path);
        $folderPath = str_replace("vore.neuronsit.sg", "vorecentral.com", $folderPath);
        
        if (!is_dir($folderPath)) {
            // Create the folder with write permissions
            mkdir($folderPath, 0777, true);
        }


        // Create the path to save the WEBP file
        $webpPath = public_path($path . '/' . $name);
        $webpPath = str_replace("vore.neuronsit.sg", "vorecentral.com", $webpPath);

        // Convert the image to WEBP format and save it
        $image->save($webpPath);

        // Return the path to the WEBP file
        return $name;
    }

    public function deleteFile($image, $path)
    {
        $path = env('FRONTEND_path') . '/' . $path;
        $image_path = $path . $image;
        if (file_exists($image_path)) {
            @unlink($image_path);
        }
    }
}
