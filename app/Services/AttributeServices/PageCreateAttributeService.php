<?php

namespace App\Services\AttributeServices;

use App\Repositories\Eloquents\AttributeRepository;

class PageCreateAttributeService
{
    public function __construct(
        private AttributeRepository $attributeRepository
    )
    {
        //
    }

    public function __invoke()
    {
        $attributeGroups = $this->attributeRepository->findByCondition(['group_id' => null])
            ->with(['members'])
            ->get();

        return view('admin.attributes.create', [
            'attributeGroups' => $attributeGroups,
        ]);
    }
}
