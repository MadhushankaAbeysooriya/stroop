<?php

namespace App\Models;

use App\Models\Item;
use App\Models\Establishment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SerNo extends Model
{
    use HasFactory;

    protected $table = 'm_seri_no';
    protected $guarded = [];

    public function estb()
    {
        return $this->hasOne(Establishment::class, 'id', 'estb_id');
    }

    public function items()
    {
        return $this->hasOne(Item::class, 'id', 'Item_Auto_Id');
    }
}
