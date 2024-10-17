<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class otherCurrentAttachments extends Model
{
    use HasFactory;

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
}
