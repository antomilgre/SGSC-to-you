<?php

namespace App\Http\Controllers\Api;

use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends CrudController
{
    protected string $model = Gallery::class;
    protected array $with = ['images'];
    protected array $rules = ['title' => 'required|string|max:255', 'type' => 'nullable|in:photo,video', 'images' => 'nullable|array|max:30', 'images.*' => 'image|max:10240'];

    protected function createRecord(Request $request, array $data): Gallery
    {
        unset($data['images']);
        $gallery = Gallery::create($data);
        $this->storeImages($request, $gallery);
        return $gallery;
    }

    protected function updateRecord(Request $request, \Illuminate\Database\Eloquent\Model $record, array $data): void
    {
        unset($data['images']);
        $record->update($data);
        $this->storeImages($request, $record);
    }

    public function destroy(string $id)
    {
        $gallery = $this->find($id);
        foreach ($gallery->images as $image) {
            Storage::disk('public')->delete($image->image);
        }
        $gallery->delete();
        return $this->success(null, 'Gallery deleted');
    }

    private function storeImages(Request $request, Gallery $gallery): void
    {
        foreach ($request->file('images', []) as $image) {
            GalleryImage::create(['gallery_id' => $gallery->id, 'image' => $image->store('galleries', 'public')]);
        }
    }
}
