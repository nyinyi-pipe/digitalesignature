<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{


    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */


    public function toArray(Request $request): array
    {
        JsonResource::wrap('documents');

        return [
            'id' => $this->id,
            'doc_name' => $this->doc_name,
            'created_at' => $this->created_at,
            'doc_status' => $this->doc_status,
        ];
    }
}
