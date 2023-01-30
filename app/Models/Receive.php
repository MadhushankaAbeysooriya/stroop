<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receive extends Model
{
    use HasFactory;

    protected $table = 'm_issue_stock';
    protected $guarded = [];

    public function items()
    {
        return $this->hasOne(Item::class, 'id', 'Item_Auto_Id');
    }

}
