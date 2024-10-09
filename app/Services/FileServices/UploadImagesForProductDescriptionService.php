<?php

namespace App\Services\FileServices;

use App\Http\Requests\FileRequests\UploadImageRequest;
use App\Repositories\Eloquents\ProductRepository;
use Exception;
use Illuminate\Support\Facades\Storage;

class UploadImagesForProductDescriptionService
{
    protected ProductRepository $productRepository;

    public function __construct(
        ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    public function __invoke(UploadImageRequest $request, string $collection = null)
    {
        try {
            $product = $this->productRepository->withoutGlobalScopes()
                ->find($request->product_id);

            $file = $request->file('upload');

            $extension = $file->getClientOriginalExtension();
            $nameExtension = $file->getClientOriginalName();
            $name = substr($nameExtension, 0, strlen($nameExtension) - strlen($extension) - 1);

            $isFileNameExisted = Storage::disk('local')->exists("public/uploads/$nameExtension");
            $storeAsName = $isFileNameExisted ? $name . '_' . now()->timestamp . '.' . $file->extension() : $nameExtension;

            Storage::disk('public')->putFileAs(
                '/uploads',
                $file,
                $storeAsName,
            );

            if ($product) {
                $product->addMediaFromDisk("/uploads/$storeAsName", 'public')->toMediaCollection($collection);
            }

            return response()->json(['url' => Storage::url("/uploads/$storeAsName")]);
        } catch (Exception $exception) {
            $fullMsg = '';
            while ($exception !== null) {
                $fullMsg = $exception->getFile() . " " . $exception->getLine() . ": " . $exception->getMessage() . "\n";
                $exception = $exception->getPrevious() ?? null;
            }
            return response()->json(['error' => ['message' => $fullMsg]]);
        }
    }
}
