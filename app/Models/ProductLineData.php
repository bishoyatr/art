<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;
class ProductLineData extends BaseModel
{
    use HasFactory;
     public function __construct($x = null)
    {
        if(!$x)$x='0';
        parent::__construct();
        $this->setTable('data_type_' . $x);
    }
}
