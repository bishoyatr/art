<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentProductLineAttatchment extends Model
{
    use HasFactory;
    public $table="current_product_line_attatchment";
    protected $fillable = [
    'product_line_id',
    'name',
    'description',
    'image',
    'pdf',
    'youtube',
    'instagram',
    'facebook',
    'shop',
    'is_active',
    'product_line_attachment_status',
    'created_by',
    'updated_by',
    'created_at',
    'updated_at'
    ];
    public function getCurrentProductAttachmentByProductId($product_id,$products_line_status)
    {
          return CurrentProductLineAttatchment::where('product_line_id',$product_id)
             ->where('is_active',1)
             ->where(function($query)use ($products_line_status){
              $query->whereNull('product_line_attachment_status')->orwhere('product_line_attachment_status',$products_line_status);
                 })
             ->get();

    }
}
