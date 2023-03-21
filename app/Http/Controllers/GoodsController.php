<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goods;


class GoodsController extends Controller
{
    public function index($id_list) {
        $goods = Goods::where("id_list", $id_list)->get();

        $sum = ceil($goods->sum('guarant'));
        $pay = ceil($sum*0.008);

        return view('admin.goods.index', ['goods'=>$goods, 'sum'=>$sum, 'pay'=>$pay]);
    }
}
