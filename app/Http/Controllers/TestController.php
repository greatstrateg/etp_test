<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\ListGoods;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(Request $request) {
        $goods = new Goods;
        $str = "<root><goods><name>Шкафы</name><quality>12</quality><guarant>1230000</guarant></goods><goods><name>Ноутбуки</name><quality>100</quality><guarant>9900000</guarant></goods><goods><name>Смартфоны</name><quality>500</quality><guarant>51000000</guarant></goods></root>";

        $xml = simplexml_load_string($str);
        foreach($xml->goods as $el) {
            $goods->name = $el->name;
            $goods->quality = $el->quality;
            $goods->guarant = $el->guarant;
            $goods->id_list = 1;
            dump($goods->save());
        }

        dd($goods->save());
    }

}
