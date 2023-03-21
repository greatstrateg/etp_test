<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListGoods;
use App\Models\Goods;

class ListGoodsController extends Controller
{
    public function index(int $pag = 1) {
        $list = ListGoods::orderByDesc('id')->offset(($pag-1)*10)->take(10)->get();

        return view('admin.listgoods.index', ['list'=>$list]);
    }
}

