<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;
    protected $fillable = [
    'original_name',
    'path',
    'name',
    'type',
    'extension',
    'size',
    'preview_url',
    'created_by',
    'updated_by',
    ];
}
