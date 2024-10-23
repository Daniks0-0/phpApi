<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //поля которые отдаем на frontend
        return [
            'id' =>$this->id,
            'name'=>$this->name,
            'created_at'=>$this->created_at,
            'list' => DeskListResource::collection($this->lists),
        ];
    }
}
