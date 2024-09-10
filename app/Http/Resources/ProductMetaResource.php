<?php

namespace App\Http\Resources;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductMetaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $value = null;
        try {
            $value = unserialize($this->value);
        } catch (Exception $exception) {
            $value = $this->value;
        }

        return [
            'key' => $this->key,
            'value' => $value,
            'product_id' => $this->product_id,
        ];
    }
}
