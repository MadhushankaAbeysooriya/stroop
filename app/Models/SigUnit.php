<?php

namespace App\Models;

use App\Models\Establishment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SigUnit extends Model
{
    use HasFactory;

    protected $table = 'm_sig_unit';
    protected $guarded = [];

    public function issue_place()
    {
        return $this->hasOne(Establishment::class, 'id', 'm_issue_place_id');
    }

}
