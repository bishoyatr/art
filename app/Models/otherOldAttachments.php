<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class otherOldAttachments extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'product_id',
        'title',
        'youtube',
        'images',
        'is_active',
        'type',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
        ];
}
