<?php

namespace Domain\Images\Actions;

use Domain\Images\Models\TemporaryUploadImage;
use Illuminate\Support\Facades\Storage;

class DeleteImageAction
{
    public function execute(int $id)
    {
        $image = TemporaryUploadImage::findOrfail($id);
        Storage::disk('public')->delete($image->url);
        $image->delete();
    }
}
