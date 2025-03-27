<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAttributeRequest;
use App\Services\AttributeServices\CreateAttributeSerivce;
use App\Services\AttributeServices\PageCreateAttributeService;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function __construct(
        private PageCreateAttributeService $pageCreateAttributeService,
        private CreateAttributeSerivce $createAttributeSerivce
    )
    {
        //
    }

    public function createAttribute(Request $request)
    {
        $result = $this->pageCreateAttributeService->__invoke();

        return $result;
    }

    public function storeAttribute(CreateAttributeRequest $request)
    {
        $result = $this->createAttributeSerivce->__invoke($request);

        if ($result) {
            return redirect()->route('admin.attributes.create', [
                'success' => true,
                'message' => 'Attribute created successfully',
            ]);
        }

        return redirect()->route('admin.attributes.create')
            ->with([
                'success' => false,
                'message' => 'Attribute created failed',
            ])->withInput();
    }
}
