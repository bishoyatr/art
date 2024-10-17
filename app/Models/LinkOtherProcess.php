<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkOtherProcess extends Model
{
    use HasFactory;
    protected $table = 'link_other_process';
    protected $fillable = [
        'parent_id',
        'sub_id',
        'file_type'
    ];
}
