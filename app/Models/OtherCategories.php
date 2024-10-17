<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherCategories extends Model
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
}
