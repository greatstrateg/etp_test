<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Goods;

class ListGoods extends Model
{
    use HasFactory;

    protected $table = "list_goods";

    public function good() {
        return $this->hasMany(Goods::class, "id_list");
    }
    public function signature() {
        return $this->hasOne(Goods::class, "id_list");
    }
}
