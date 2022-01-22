<?php

namespace App\Http\Controllers\API\Upload;

use App\Http\Controllers\Controller;
use Domain\Images\Actions\UploadImageAction;
use Illuminate\Http\Request;

class UploadImageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request,UploadImageAction $action)
    {
        $request->validate([
            'image' => ['required','file','max:10240','mimes:jpg,bmp,png']
        ]);

        return response()->json([
            'message'   => 'Success upload image',
            'data'      => $action->execute($request)
        ]);
    }
}
