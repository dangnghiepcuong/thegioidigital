<?php

namespace App\Http\Requests;

use App\Enums\BadgeBackgroundStyleEnum;
use App\Enums\ModelMetaKey;
use App\Enums\ProductStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUpdateReplicateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:50'],
            'slug' => ['required', 'max:128'],
            'type' => ['required', 'max:30'],
            'status' => ['required', Rule::in(ProductStatusEnum::allCases())],
            'parent_id' => [
                Rule::when(isset($this->parent_id), ['numeric', 'exists:products,id'])
            ],
            ModelMetaKey::TOP_TAGS => [
                Rule::when(strlen($this->str(ModelMetaKey::TOP_TAGS)) !== 0, ['max:25'])
            ],
            ModelMetaKey::THUMB_URL => [
                Rule::when(strlen($this->str(ModelMetaKey::TOP_TAGS)) !== 0, ['url'])
            ],
            ModelMetaKey::BOTTOM_LEFT_STAMP_URL => [
                Rule::when(strlen($this->str(ModelMetaKey::BOTTOM_LEFT_STAMP_URL)) !== 0, ['url'])
            ],
            ModelMetaKey::TOP_RIGHT_STAMP_URL => [
                Rule::when(strlen($this->str(ModelMetaKey::TOP_RIGHT_STAMP_URL)) !== 0, ['url'])
            ],
            'product_attr_badge_background_style' => ['nullable', 'string', Rule::in(BadgeBackgroundStyleEnum::allCases())],
            'product_attr_badge_background_color_1' => ['nullable', Rule::requiredIf(function () {
                return $this->product_attr_badge_background_style != BadgeBackgroundStyleEnum::URL;
            }), 'string'],
            'product_attr_badge_background_color_2' => ['nullable', Rule::requiredIf(function () {
                return in_array($this->product_attr_badge_background_style, BadgeBackgroundStyleEnum::gradientStyles());
            })],
            'product_attr_badge_background_url' => ['nullable', Rule::requiredIf(function () {
                return $this->product_attr_badge_background_style === BadgeBackgroundStyleEnum::URL;
            }), 'url'],
            'product_attr_badge_icon_url' => ['nullable', Rule::requiredIf(function () {
                return $this->product_attr_badge_background_style != null;
            }), 'url'],
            'product_attr_badge_text' => ['nullable', Rule::requiredIf(function () {
                return $this->product_attr_badge_background_style != null;
            }), 'string'],
            'product_attr_badge_text_color' => ['nullable', Rule::requiredIf(function () {
                return $this->product_attr_badge_background_style != null;
            }), 'string'],
            ModelMetaKey::COMPARE_TAGS => [
                Rule::when(strlen($this->str(ModelMetaKey::COMPARE_TAGS)) !== 0, ['max:50'])
            ],
            ModelMetaKey::REGULAR_PRICE => [
                Rule::when(strlen($this->str(ModelMetaKey::REGULAR_PRICE)) !== 0, ['numeric'])
            ],
            ModelMetaKey::PRICE => [
                Rule::when(strlen($this->str(ModelMetaKey::PRICE)) !== 0, ['numeric'])
            ],
            ModelMetaKey::GIFT => [
                Rule::when(strlen($this->str(ModelMetaKey::GIFT)) !== 0, ['numeric'])
            ]
        ];
    }
}
