<?php

namespace App\Http\Controllers\Api;

use App\Models\GalleryImage;

class GalleryImageController extends CrudController
{
    protected string $model = GalleryImage::class;
    protected array $with = ['gallery'];
    protected array $uploads = ['image' => 'galleries'];
    protected array $rules = ['gallery_id' => 'required|exists:galleries,id', 'image' => 'required|image|max:10240'];
}
