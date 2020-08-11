<?php

namespace Modules\Media\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Media\Http\Requests\UploadImageRequest;
use Modules\Media\Service\MediaService;

class MediaController extends Controller
{
    public function uploadImage(UploadImageRequest $request)
    {
        return MediaService::uploadImage($request, true);
    }

    public function destroy($id)
    {
        return MediaService::delete($id);
    }
}
