<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListSignature extends Model
{
    use HasFactory;

    protected $table = "list_signatures";

    public function listgoods() {
        return $this->BelongTo(ListGoods::class);
    }
}
