<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\ListGoods;
use Illuminate\Http\Request;

class xmlGoodsController extends Controller
{
    public function saveDB(Request $request)
    {
        $list = new ListGoods;
        $list->id_user = 1; //temp decision
        $list->save();
        $id_list = $list->id;


        $xml = simplexml_load_string($request->input('obj'));
        foreach($xml->goods as $el) {
            $goods = new Goods;
            $goods->name = $el->name;
            $goods->quality = $el->quality;
            $goods->guarant = $el->guarant;
            $goods->id_list = $id_list;
            $goods->save();
        }
    }
}
