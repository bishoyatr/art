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
         $images = self::getImageResource($this->image);
         $image = $images[0];
            return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
             'image' =>$images,
             'single_image' =>$image,

            'image' =>self::getImageResource($this->image),
            'pdf' => asset("assets/images/").'/'.$this->pdf,
            'youtube' => $this->youtube ?? '' ,
            'instagram' => $this->instagram ?? '',
            'facebook' => $this->facebook ?? '',
            'shop' => $this->shop ?? ''
             ];
    }

    public static function getImageResource($images){

        $alpoum=[];

        if (is_null(json_decode($images)))
                $alpoum[]= asset("assets/images/") . '/' . $images;

        else {
            foreach (json_decode($images) as $key => $image) {
                $alpoum[] =
                    asset("assets/images/") . '/' . $image
                ;
            }
        }
        return $alpoum;

    }
}
