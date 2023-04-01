<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use Illuminate\Http\Request;
use App\Models\ListGoods;
use App\Models\Goods;
use App\Http\Controllers\ListGoodsController;

class ListGoodsControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $my = new ListGoodsController;

        $this->assertEquals(10, $my->el_in_page);
    }
}
