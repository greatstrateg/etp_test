<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goods;


class GoodsController extends Controller
{
    public function index($id_list) {
        $goods = Goods::where("id_list", $id_list)->get();

        return view('admin.goods.index', ['goods'=>$goods]);
    }
}
