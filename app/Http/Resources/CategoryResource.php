<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        $count_products_stats = $this->count_products_stats() ;
        return [
            'id' => $this->id,
            'name' => $this->name,
           // 'current_attachment_count' => $this->currentAttachmentCount(),
            //'history_attachment_count' => $this->historyAttachmentCount(),
            'current_attachment_count' => $count_products_stats['current_attachment_count'],
            'history_attachment_count' => $count_products_stats['history_attachment_count'],
        ];
    }
}
