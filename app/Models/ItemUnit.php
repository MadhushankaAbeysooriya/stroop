<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemUnit extends Model
{
    use HasFactory;
    protected $table = 'item_units';
    protected $guarded = [];

    public function stores()
    {
        return $this->hasOne(Item::class, 'id', 'item_id');
    }
}
