<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSubRelation extends Model
{
    use HasFactory;
    protected $table = 'item_sub_relations';
    protected $guarded = [];
}
