<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;

    protected $table = 'm_title';
    protected $guarded = [];

    public function stores()
    {
        return $this->hasOne(Store::class, 'id', 'store_id');
    }

}
