<!-- An unexamined life is not worth living. - Socrates -->
@extends('layouts.admin.index')
@section('title', 'Create Attribute')
@section('styles')
    @parent
    @vite("$viewsDir/admin/products/create-edit.css")
    @vite("$viewsDir/components/product/card/index.css")
    @vite("$viewsDir/components/admin/products/section/sections.css")
    @vite("$viewsDir/admin/create.css")
@endsection
@section('content')
    <div class="flex justify-between gap-5">
        <form action="{{ route('admin.attributes.store') }}" method="POST" id="form-create-product-attribute"
        class="w-full">
            @csrf
            <div>
                <label for="product_type" class="block pt-4 font-medium text-gray-900 dark:text-white">
                    Loại sản phẩm
                </label>
                <select id="product-type" name="product_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
        focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600
        dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @if(old('product_type'))
                        <option value="{{ old('product_type') }}">{{ __("product." . old('product_type')) }}</option>
                    @endif
                    @foreach($productTypesEnum as $productTypeEnum)
                        @if($productTypeEnum !== old('product_type'))
                            <option value="{{ $productTypeEnum }}">{{ __("product.$productTypeEnum") }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div>
                <label for="group_id" class="block pt-4 font-medium text-gray-900 dark:text-white">
                    Nhóm thuộc tính
                </label>
                <select id="group-id" name="group_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
        focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600
        dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @if(old('group_id'))
                        <option value="{{ old('group_id') }}">
                            {{ $attributeGroups->find('id', old('group_id'))->name }}
                        </option>
                    @endif
                    <option value=""></option>
                    @foreach($attributeGroups->where('id', '!=', old('group_id')) as $attributeGroup)
                        <option value="{{ $attributeGroup->id }}">{{ $attributeGroup->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="name" class="block pt-4 font-medium text-gray-900 dark:text-white">
                    Mã thuộc tính
                </label>
                <div class="flex items-center">
                    <span>product_attr_&nbsp</span>
                    <input type="text" id="name" name="name"
                           class="w-full bg-gray-50 border border-gray-300 text-gray-900 rounded-lg
               focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700
               dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
               dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="back_camera, storage, screen_resolution,..."
                           value="{{ old('name') ?? null }}" required/>
                </div>
            </div>
            <div>
                <label for="vi_translation" class="block pt-4 font-medium text-gray-900 dark:text-white">
                    Tên thuộc tính (tiếng Việt)
                </label>
                <input type="text" id="vi-translation" name="vi_translation"
                       class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg
               focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700
               dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
               dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="Camera sau, Dung lượng bộ nhớ, Độ phân giải màn hình,..."
                       value="{{ old('vi_translation') ?? null }}" required/>
            </div>
            <div>
                <label for="description" class="block pt-4 font-medium text-gray-900 dark:text-white">
                    Mô tả
                </label>
                <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-gray-900 bg-gray-50 rounded-lg
        border border-gray-300 focus:ring-blue-500 focus:border-blue-500
        dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
        dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Mô tả..."></textarea>

            </div>
            <div class="layout-action-buttons">
                <button id="btn-submit-form-create-attribute" type="button"
                        class="text-gray-900 bg-white border border-gray-300 focus:outline-none
                hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg px-5 py-2.5 me-2 mb-2
                dark:bg-gray-800 dark:text-white dark:border-gray-600
                dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                    Create
                </button>
            </div>
            <div class="layout-errors">
                @foreach ($errors->all() as $error)
                    <span class="error">{{ $error }}</span>
                    <br>
                @endforeach
                @if (!session('success') && session('message'))
                    <span class="error">{{ session('message') }}</span>
                @endif
            </div>
        </form>

        <div class="relative overflow-x-auto w-full">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Product name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Color
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <td class="px-6 py-4">
                        Apple MacBook Pro 17"
                    </td>
                    <td class="px-6 py-4">
                        Silver
                    </td>
                    <td class="px-6 py-4">
                        Laptop
                    </td>
                    <td class="px-6 py-4">
                        $2999
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
@endsection
@section('scripts')
    @parent
    @vite("$viewsDir/admin/attributes/create.js")
@endsection
