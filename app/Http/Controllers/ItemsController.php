<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function showItems(Request $request)
    {
        // derByRawメソッドを使って、出品中の商品を先に、購入済みの商品を後に表示している
        $items = Item::orderByRaw( "FIELD(state, '" . Item::STATE_SELLING . "', '" . Item::STATE_BOUGHT . "')" )
            ->orderBy('id', 'DESC')
            ->paginate(1);

        return view('items.items')
            ->with('items', $items);
    }
}
