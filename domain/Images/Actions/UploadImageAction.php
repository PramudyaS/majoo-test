<?php

namespace Domain\Images\Actions;

use Domain\Images\Models\TemporaryUploadImage;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UploadImageAction
{
    public function execute(Request $request)
    {
        DB::beginTransaction();
        try {
            $upload = new TemporaryUploadImage();
            if($request->hasFile('image')){
                $image = $request->file('image');
            }
            $upload->url    = $image->store('files','public');
            $upload->type   = $image->getClientOriginalExtension();
            $upload->save();

            DB::commit();
        }catch (HttpResponseException $exception)
        {
            DB::rollBack();
            throw new HttpException($exception->getCode(),$exception->getMessage());
        }

        return $upload;
    }
}
