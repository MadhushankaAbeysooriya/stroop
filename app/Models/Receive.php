<?php

namespace App\Models;

use App\Models\SigUnit;
use App\Models\Establishment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Receive extends Model
{
    use HasFactory;

    protected $table = 'm_issue_stock';
    protected $guarded = [];

    public function items()
    {
        return $this->hasOne(Item::class, 'id', 'Item_Auto_Id');
    }

    public function issue_place()
    {
        return $this->hasOne(Establishment::class, 'id', 'Issued_place_id');
    }

    public function sig_unit()
    {
        return $this->hasOne(SigUnit::class, 'id', 'issu_sig_unit');
    }
}
