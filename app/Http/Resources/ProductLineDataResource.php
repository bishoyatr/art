<?php

namespace App\Http\Resources;
use App\Models\Attachment;
use App\Http\Resources\AttachmentResource;
use Illuminate\Http\Resources\Json\JsonResource;
class ProductLineDataResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data =[];
        $data['id'] = $this->id;
        //$data['images'] =  AttachmentResource::collection($this->history_album_attachments);
        //$data['pdf'] = AttachmentResource::collection($this->current_pdf_attachment);
       // die("ss");
        return $data;
    }
}
