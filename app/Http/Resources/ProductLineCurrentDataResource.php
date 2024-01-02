<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductLineCurrentDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
            return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => asset("assets/images/").'/'.$this->image,
            'pdf' => asset("assets/images/").'/'.$this->pdf,
            'youtube' => $this->youtube ?? '' ,
            'instagram' => $this->instagram ?? '',
            'facebook' => $this->facebook ?? '',
            'shop' => $this->shop ?? ''
             ];
    }
}
