<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ListGoods;

class Goods extends Model
{
    use HasFactory;

    protected $table = "goods";

    public function listgoods() {
        return $this->BelongTo(ListGoods::class);
    }
}
