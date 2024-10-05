<?php

namespace App\Services\FileServices;

use App\Http\Requests\FileRequests\DeleteImageRequest;
use App\Http\Resources\FileResource;
use App\Repositories\Eloquents\ProductRepository;
use Exception;

class DeleteImageService
{
    protected ProductRepository $productRepository;

    public function __construct(
        ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    public function __invoke(DeleteImageRequest $request, string $collection = null)
    {
        try {
            $product = $this->productRepository->withoutGlobalScopes()
                ->find($request->product_id);

            $files = $product->getMedia($collection);
            foreach ($files as $file) {
                if (in_array($file->uuid, $request->slider_images)) {
                    $file->delete();
                }
            }

            return FileResource::collection($product->getMedia($collection));
        } catch (Exception $exception) {
            $fullMsg = '';
            while ($exception !== null) {
                $fullMsg = $exception->getFile() . " " . $exception->getLine() . ": " . $exception->getMessage(). "\n";
                $exception = $exception->getPrevious() ?? null;
            }
            return response()->json(['error' => ['message' => $fullMsg]]);
        }
    }
}
