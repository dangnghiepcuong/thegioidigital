<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequests\DeleteImageRequest;
use App\Http\Requests\FileRequests\GetImageRequest;
use App\Http\Requests\FileRequests\UploadImageRequest;
use App\Services\FileServices\DeleteImageService;
use App\Services\FileServices\GetImageService;
use App\Services\FileServices\UploadImagesForProductDescriptionService;
use App\Services\FileServices\UploadImagesForProductSliderService;

class FileController extends Controller
{
    public function __construct(
        protected GetImageService $getImageService,
        protected UploadImagesForProductSliderService $UploadImagesForProductSliderService,
        protected UploadImagesForProductDescriptionService $uploadImagesForProductDescriptionService,
        protected DeleteImageService $deleteImageService
    ) {}

    public function getImagesForProductSlider(GetImageRequest $request)
    {
        $response = $this->getImageService->__invoke($request, 'slider');

        return $response;
    }

    public function uploadImagesForProductDescription(UploadImageRequest $request)
    {
        $response = $this->uploadImagesForProductDescriptionService
            ->__invoke($request, 'description');

        return $response;
    }

    public function uploadImagesForProductSlider(UploadImageRequest $request)
    {
        $response = $this->UploadImagesForProductSliderService->__invoke($request, 'slider');

        return $response;
    }

    public function deleteImagesFromProductSlider(DeleteImageRequest $request)
    {
        return $this->deleteImageService->__invoke($request, 'slider');
    }
}
