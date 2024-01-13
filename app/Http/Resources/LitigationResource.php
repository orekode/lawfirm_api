<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LitigationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>image
     */
    public function toArray(Request $request): array
    {
        $response = parent::toArray($request);

        unset(
            $response['created_at'], 
            $response['updated_at'],
        );

        $response['image']       = env('APP_URL') . '/' . $response['image'];
        $response['cover_image'] = env('APP_URL') . '/' . $response['cover_image'];

        return $response;
    }
}
