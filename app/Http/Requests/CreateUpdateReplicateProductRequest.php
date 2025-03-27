<?php

namespace App\Http\Requests;

use App\Enums\BadgeBackgroundStyleEnum;
use App\Enums\ModelMetaKey;
use App\Enums\ProductStatusEnum;
use Illuminate\Contracts\Validation\ValidationRule;
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:50'],
            'slug' => ['required', 'max:128'],
            'type' => ['required', 'max:30'],
            'status' => ['required', Rule::in(ProductStatusEnum::allCases())],
            'parent_id' => ['nullable', 'numeric', 'exists:products,id'],
            ModelMetaKey::TOP_TAGS => ['nullable', 'string'],
            ModelMetaKey::THUMB_URL => ['nullable', 'url'],
            ModelMetaKey::BOTTOM_LEFT_STAMP_URL => ['nullable', 'url'],
            ModelMetaKey::TOP_RIGHT_STAMP_URL => ['nullable', 'url'],
            'product_attr_badge_background_style' => ['nullable', 'string', Rule::in(BadgeBackgroundStyleEnum::allCases())],
            'product_attr_badge_background_color_1' => ['nullable', Rule::requiredIf(function () {
                return $this->input('product_attr_badge_background_style') != BadgeBackgroundStyleEnum::URL;
            }), 'string'],
            'product_attr_badge_background_color_2' => ['nullable', Rule::requiredIf(function () {
                return in_array($this->input('product_attr_badge_background_style'), BadgeBackgroundStyleEnum::gradientStyles());
            })],
            'product_attr_badge_background_url' => ['nullable', Rule::requiredIf(function () {
                return $this->input('product_attr_badge_background_style') === BadgeBackgroundStyleEnum::URL;
            }), 'url'],
            'product_attr_badge_icon_url' => ['nullable', Rule::requiredIf(function () {
                return $this->input('product_attr_badge_background_style') != null;
            }), 'url'],
            'product_attr_badge_text' => ['nullable', Rule::requiredIf(function () {
                return $this->input('product_attr_badge_background_style') != null;
            }), 'string'],
            'product_attr_badge_text_color' => ['nullable', Rule::requiredIf(function () {
                return $this->input('product_attr_badge_background_style') != null;
            }), 'string'],
            ModelMetaKey::COMPARE_TAGS => ['nullable', 'max:50'],
            ModelMetaKey::LIST_PRICE => ['nullable', 'numeric'],
            ModelMetaKey::PRICE => ['nullable', 'numeric'],
            ModelMetaKey::GIFT => ['nullable', 'numeric'],
            'reflect_product_fields_on_variants' => ['nullable', 'array'],
            'reflect_product_meta_fields_on_variants' => ['nullable', 'array'],
            'reflect_product_fields_on_siblings' => ['nullable', 'array'],
            'reflect_product_meta_fields_on_siblings' => ['nullable', 'array'],
        ];
    }

    protected function passedValidation(): void
    {
        // handle reverse badge gradient colors
        if ($this->input(ModelMetaKey::BADGE_BACKGROUND_STYLE)) {
            if ($this->input(ModelMetaKey::BADGE_BACKGROUND_COLOR_REVERSE) === 'true') {
                $this->merge([
                    ModelMetaKey::BADGE_BACKGROUND_COLOR_1 => $this->input(ModelMetaKey::BADGE_BACKGROUND_COLOR_2),
                    ModelMetaKey::BADGE_BACKGROUND_COLOR_2 => $this->input(ModelMetaKey::BADGE_BACKGROUND_COLOR_1),
                ]);
            }

            // remove redundant badge data base on badge bg style
            switch ($this->input(ModelMetaKey::BADGE_BACKGROUND_STYLE)) {
                case BadgeBackgroundStyleEnum::SOLID:
                    $this->merge([
                        ModelMetaKey::BADGE_BACKGROUND_COLOR_2 => null,
                        ModelMetaKey::BADGE_BACKGROUND_COLOR_REVERSE => null,
                        ModelMetaKey::BADGE_BACKGROUND_URL => null,
                    ]);
                    break;
                case BadgeBackgroundStyleEnum::URL:
                    $this->merge([
                        ModelMetaKey::BADGE_BACKGROUND_COLOR_1 => null,
                        ModelMetaKey::BADGE_BACKGROUND_COLOR_2 => null,
                        ModelMetaKey::BADGE_BACKGROUND_COLOR_REVERSE => null,
                    ]);
                    break;
                case BadgeBackgroundStyleEnum::LINEAR_TO_RIGHT:
                case BadgeBackgroundStyleEnum::LINEAR_TO_LEFT:
                case BadgeBackgroundStyleEnum::LINEAR_TO_TOP:
                case BadgeBackgroundStyleEnum::LINEAR_TO_BOTTOM:
                case BadgeBackgroundStyleEnum::RADIAL:
                    $this->merge([
                        ModelMetaKey::BADGE_BACKGROUND_URL => null,
                    ]);
                    break;
                default:
                    $this->merge([
                        ModelMetaKey::BADGE_BACKGROUND_STYLE => null,
                        ModelMetaKey::BADGE_BACKGROUND_COLOR_1 => null,
                        ModelMetaKey::BADGE_BACKGROUND_COLOR_2 => null,
                        ModelMetaKey::BADGE_BACKGROUND_COLOR_REVERSE => null,
                        ModelMetaKey::BADGE_BACKGROUND_URL => null,
                        ModelMetaKey::BADGE_ICON_URL => null,
                        ModelMetaKey::BADGE_TEXT => null,
                        ModelMetaKey::BADGE_TEXT_COLOR => null,
                    ]);
                    break;
            }
        }

        // serialize data
        $topTags = array_filter(explode("\r\n", $this->input(ModelMetaKey::TOP_TAGS)));
        $compareTags = array_filter(explode("\r\n", $this->input(ModelMetaKey::COMPARE_TAGS)));
        $this->merge([
            ModelMetaKey::TOP_TAGS => serialize($topTags),
            ModelMetaKey::COMPARE_TAGS => serialize($compareTags),
        ]);

        // handle reflect badge data on variants & siblings
        $reflectProductMetaFieldsOnVariants = $this->input('reflect_product_meta_fields_on_variants', []);
        // badge reflection is required, add badge attributes to request reflect array
        if (in_array(ModelMetaKey::BADGE, $reflectProductMetaFieldsOnVariants)) {
            $reflectProductMetaFieldsOnVariants = array_merge($reflectProductMetaFieldsOnVariants, [
                ModelMetaKey::BADGE_BACKGROUND_STYLE,
                ModelMetaKey::BADGE_BACKGROUND_COLOR_1,
                ModelMetaKey::BADGE_BACKGROUND_COLOR_2,
                ModelMetaKey::BADGE_BACKGROUND_COLOR_REVERSE,
                ModelMetaKey::BADGE_BACKGROUND_URL,
                ModelMetaKey::BADGE_ICON_URL,
                ModelMetaKey::BADGE_TEXT,
                ModelMetaKey::BADGE_TEXT_COLOR,
            ]);
            // replace new reflect meta
            $this->merge([
                'reflect_product_meta_fields_on_variants' => $reflectProductMetaFieldsOnVariants,
            ]);
        }

        $reflectProductMetaFieldsOnSiblings = $this->input('reflect_product_meta_fields_on_siblings', []);
        if (in_array(ModelMetaKey::BADGE, $reflectProductMetaFieldsOnSiblings)) {
            $reflectProductMetaFieldsOnSiblings = array_merge($reflectProductMetaFieldsOnVariants, [
                ModelMetaKey::BADGE_BACKGROUND_STYLE,
                ModelMetaKey::BADGE_BACKGROUND_COLOR_1,
                ModelMetaKey::BADGE_BACKGROUND_COLOR_2,
                ModelMetaKey::BADGE_BACKGROUND_COLOR_REVERSE,
                ModelMetaKey::BADGE_BACKGROUND_URL,
                ModelMetaKey::BADGE_ICON_URL,
                ModelMetaKey::BADGE_TEXT,
                ModelMetaKey::BADGE_TEXT_COLOR,
            ]);
            $this->merge([
                'reflect_product_meta_fields_on_siblings' => $reflectProductMetaFieldsOnSiblings,
            ]);
        }
    }
}
