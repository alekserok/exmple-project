<?php


namespace App\Http\Controllers\Admin;


use App\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ImagesController
{
    public function destroy($id)
    {
        $image = Image::findOrFail($id);

        $name = str_replace('images/', '', $image->src);

        $matchingFiles = File::glob(storage_path('') . "/app/public/thumbs/*_*_{$name}");

        foreach ($matchingFiles as $val) File::delete($val);

        Storage::disk('public')->delete($image->src);

        $image->delete();

        return $id;
    }
}
