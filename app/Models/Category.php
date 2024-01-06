<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Category extends BaseModel
{
    use HasFactory;
    protected $fillable = [
    'name',
    'parent_id',
    'is_active',
    'category_type',
    'created_by',
    'updated_by',
    'created_at',
    'updated_at'
    ];

     public function getSub($id)
    {
        return $this->where('parent_id',$id)->where('active', 1)->get();
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
     public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id','id');
    }

    public function GetAllParentCategoriesByCategoryType($category_type)
    {
        return Category::whereNull('parent_id')
            ->where(function($query)use ($category_type){
              $query->whereNull('category_type')->orwhere('category_type',$category_type);
                 })
            ->get();
    }
    public function GetAllSubCategoriesByParentIdAndCategoryType($parent_id,$category_type)
    {
        return Category::where('parent_id',$parent_id)->where(function($query)use ($category_type){
              $query->whereNull('category_type')->orwhere('category_type',$category_type);
                 })
            ->get();
    }

    public function currentAttachmentCount()
    {
        return $this->hasManyThrough(
            ProductLine::class,
            Product::class,
            'category_id', // Foreign key on the products table
            'product_id',  // Foreign key on the product_lines table
            'id',          // Local key on the categories table
            'id'           // Local key on the products table
        )->withCount('currentAttachment')
            ->get()
            ->sum('current_attachment_count');


    }

    public function historyAttachmentCount()
    {
        return $this->hasManyThrough(
            ProductHistoryAttchment::class,
            Product::class,
            'category_id', // Foreign key on the products table...
            'product_id',  // Foreign key on products_history_attachments table...
            'id',          // Local key on the categories table...
            'id'           // Local key on the products table...
        )->count();

    }
}
