<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
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

        $response['logo']       = env('APP_URL') . '/' . $response['logo'];
        $response['digital_address'] = env('APP_URL') . '/' . $response['digital_address'];

        return $response;
    }
}
