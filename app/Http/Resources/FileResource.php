<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'fileName' => $this->file_name,
            'uuid' => $this->uuid,
            'previewUrl' => $this->preview_url,
            'originalUrl' => $this->original_url,
            'order' => $this->order,
            'path' => asset("storage/uploads/$this->order/$this->file_name"),
            'customProperties' => $this->custome_properties,
            'extension' => $this->extension,
            'size' => $this->size,
        ];
    }
}
