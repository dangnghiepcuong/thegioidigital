<?php

namespace App\Services\FileServices;

use App\Http\Requests\UploadImageRequest;
use Exception;
use Illuminate\Support\Facades\Storage;

class UploadImageService
{
    public function __invoke(UploadImageRequest $request)
    {
        try {
            $file = $request->file('upload');
            $extension = $file->getClientOriginalExtension();
            $nameExtension = $file->getClientOriginalName();
            $name = substr($nameExtension, 0, strlen($nameExtension) - strlen($extension) - 1);

            $isFileExisted = Storage::disk('local')->exists("public/uploads/$nameExtension");
            $storeAsName = $isFileExisted ? $name . '_' . now()->timestamp . '.' . $file->extension() : $nameExtension;

            Storage::disk('local')->putFileAs(
                '/public/uploads',
                $request->file('upload'),
                $storeAsName,
            );
            return response()->json(['url' => asset("storage/uploads/$storeAsName")]);
        } catch (Exception $exception) {
            return response()->json(['error' => ['message' => $exception->getMessage()]]);
        }
    }
}
