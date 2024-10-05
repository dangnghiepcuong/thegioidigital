<?php

namespace App\Services\FileServices;

use App\Http\Requests\FileRequests\GetImageRequest;
use App\Http\Resources\FileResource;
use App\Repositories\Eloquents\ProductRepository;
use Exception;

class GetImageService
{
    protected ProductRepository $productRepository;

    public function __construct(
        ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    public function __invoke(GetImageRequest $request, string $collection = null)
    {
        try {
            $product = $this->productRepository->withoutGlobalScopes()
                ->find($request->product_id);

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
