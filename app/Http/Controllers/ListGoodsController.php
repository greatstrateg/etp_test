<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListGoods;
use App\Models\Goods;

class ListGoodsController extends Controller
{
    public $el_in_page = 10;

    public function index(Request $request) {

        $pag = $request->input('page');

        $links = ListGoods::orderByDesc('id')->paginate($this->el_in_page);

        $list = ListGoods::orderByDesc('id')
            ->offset(($pag-1)*$this->el_in_page)
            ->take($this->el_in_page)
            ->get();

        return view('admin.listgoods.index', ['list'=>$list, 'links'=>$links]);
    }
}

