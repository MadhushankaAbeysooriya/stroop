<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $table = 'm_purchase_order';
    protected $guarded = [];

    public function supplier()
    {
        return $this->hasOne(Supplier::class, 'id', 'sup_id');
    }

    public function vote()
    {
        return $this->hasOne(Vote::class, 'id', 'vote_id');
    }

    public function Received()
    {
        return $this->hasOne(Establishment::class, 'id', 'rcvd_to');
    }

}
