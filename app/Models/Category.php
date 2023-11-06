<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;

class Category extends BaseModel
{
    use HasFactory;

    
     public function getSub($id)
    {
        return $this->where('parent_id',$id)->where('active', 1)->get();
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
