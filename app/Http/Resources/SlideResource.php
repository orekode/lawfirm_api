<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SlideResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $response = parent::toArray($request);

        unset(
            $response['created_at'], 
            $response['updated_at'],
        );

        $response['image']       = env('APP_URL') . '/' . $response['image'];

        return $response;
    }
}
