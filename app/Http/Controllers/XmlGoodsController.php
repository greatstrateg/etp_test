<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\ListGoods;
use App\Models\ListSignature;
use Illuminate\Http\Request;

class XmlGoodsController extends Controller
{
    public function saveDB(Request $request)
    {
        $validated = $request->validate([
            'xml'=>'required',
            'crypto' => 'required',
        ]);

        $list = new ListGoods;
        $list->id_user = 1; //temp decision
        $list->save();
        $id_list = $list->id;

        $xml = simplexml_load_string($request->input('xml'));
        foreach($xml->goods as $el) {
            $goods = new Goods;
            $goods->name    = $el->name;
            $goods->quality = $el->quality;
            $goods->guarant = $el->guarant;
            $goods->id_list = $id_list;
            $goods->save();
        }

        $sign = new ListSignature;
        $sign->id_list    = $id_list;
        $sign->xml_string = $request->input('xml');
        $sign->signature  = $request->input('crypto');
        $sign->save();

        return $id_list;
//

//
//
//        
//

    }
}
