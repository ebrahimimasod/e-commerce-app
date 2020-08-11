<?php


namespace Modules\Media\Service;


use Illuminate\Http\Request;
use Image;
use Modules\Brand\Entities\Brand;
use Modules\Category\Entities\Category;
use Modules\Media\Entities\Media;
use Modules\Media\Http\Requests\UploadImageRequest;
use Modules\Media\Http\Requests\UploadVideoRequest;
use Modules\Product\Entities\Product;
use Modules\User\Entities\User;
use URL;

class MediaService
{

    /**
     * @param array $files
     * @param Product|Category|Brand|User $modelObject
     * @param string $type
     */
    public static function create($files, $modelObject, $type = Media::IMAGE)
    {
        if ($files && sizeof($files) > 0) {
            foreach ($files as $index => $file) {
                $data = [
                    'file_path' => $file,
                    'main' => $index == 0 ? true : false,
                    'type' => $type,
                    'mediaable_id' => $modelObject->id,
                    'mediaable_type' => get_class($modelObject),
                ];
                Media::create($data);
            }
        }

    }


    public static function delete($id)
    {
        $media = Media::findOrFail($id);
        $media->delete();
        return httpResponse('با موفقیت حذف شد.');
    }


    public static function uploadImage(UploadImageRequest $request, $addWaterMark = false)
    {
        $filePath = self::uploadMedia($request, 'image');
        $fullPathFile = self::getFullPathFile($request, $filePath, 'image');
        if ($addWaterMark) {
            self::addWatermarkToIMage($fullPathFile);
        }

        return httpResponse([
            'file' => $filePath,
            'url' => URL::asset($fullPathFile),
        ]);
    }

    public static function uploadVideo(UploadVideoRequest $request)
    {
        $fullPath = self::uploadMedia($request, 'video');
        return httpResponse([
            'file' => $fullPath,
            'url' => URL::asset($fullPath),
        ]);
    }

    public static function uploadDocument(UploadImageRequest $request)
    {
        $fullPath = self::uploadMedia($request, 'document');
        return httpResponse([
            'file' => $fullPath,
            'url' => URL::asset($fullPath),
        ]);
    }


    private static function addWatermarkToIMage($fullPath): void
    {
        $img = Image::make(public_path($fullPath));
        $logoPath = 'assets/images/logo.png';
        /* insert watermark at bottom-right corner with 10px offset */
        $img->insert(public_path($logoPath), 'bottom-right', 10, 10);
        $img->save(public_path($fullPath));
    }

    private static function uploadMedia(Request $request, $mediaType = 'image')
    {
        $file = $request->file($mediaType);
        $pathName = self::getUploadPath($request, $mediaType);
        $fileName = md5(microtime()) . '.' . $file->clientExtension();
        $file->move($pathName, $fileName);
        return $fileName;
    }

    private static function getUploadPath(Request $request, $mediaType = 'image')
    {
        return 'assets/images/' . $request->provider . '/' . $mediaType . 's' . '/';
    }

    private static function getFullPathFile(Request $request, $filePath, $mediaType = 'image')
    {
        return self::getUploadPath($request, $mediaType) . $filePath;
    }

}
