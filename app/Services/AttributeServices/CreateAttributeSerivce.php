<?php

namespace App\Services\AttributeServices;

use App\Http\Requests\CreateAttributeRequest;
use App\Repositories\Eloquents\AttributeRepository;

class CreateAttributeSerivce
{
    public function __construct(
        private AttributeRepository $attributeRepository
    )
    {
        //
    }

    public function __invoke(CreateAttributeRequest $request)
    {
        return $this->attributeRepository->create($request->all());
    }
}
