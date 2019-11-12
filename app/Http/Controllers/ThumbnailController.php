<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ThumbnailController
{
    public function index($width, $height, $name)
    {
        $thumb = $width . '_' . $height . '_' . $name;

        if (Storage::exists($thumb)) return redirect('storage/thumbs/' . $thumb);

        if (!Storage::disk('public')->exists('images/' . $name)) return abort(404);

        $image = Image::make(Storage::disk('public')->get('images/' . $name))->fit($width, $height);

        Storage::disk('public')->put('thumbs/' . $thumb, $image->stream());

        return redirect('storage/thumbs/' . $thumb);
    }

}
