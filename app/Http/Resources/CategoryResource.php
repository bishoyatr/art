<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
    if(isset($_GET['b']))
    {
        $current_total = 0 ;
        $history_total = 0 ;
        $products = $this->products ;
        if(!empty($$products)) {
        foreach($products as $p)
        {
            $lines = $p->productLines ;
            dd($lines);
             if(!empty($lines)) {
            foreach($lines as $line)
            {
                dd($line->current);
            }
        }
        }
        }
    }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'current_attachment_count' => $this->currentAttachmentCount(),
            'history_attachment_count' => $this->historyAttachmentCount(),
        ];
    }
}
