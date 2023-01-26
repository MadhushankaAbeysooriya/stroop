<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'm_items';
    protected $guarded = [];

    public function stores()
    {
        return $this->hasOne(Store::class, 'id', 'store_id');
    }

    public function ictcategory()
    {
        return $this->hasOne(ICTCategory::class, 'id', 'ict');
    }

    public function title()
    {
        return $this->hasOne(Title::class, 'id', 'title_no');
    }

    public function measure()
    {
        return $this->hasOne(MesureUnit::class, 'id', 'Unit_Of_Issue');
    }

 public function equipment()
    {
        return $this->hasOne(Equipment::class, 'id', 'category_type');
    }


}
