<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use App\Models\ProductLineData;
class ProductLine extends BaseModel
{
    use HasFactory;

     public function data($type)
    {
        $data = new ProductLineData($type);
        return $data::where('product_id',$this->id)->first();

    }

    public function currentAttachment()
    {
     return $this->hasMany(CurrentProductLineAttatchment::class);
    }
}
