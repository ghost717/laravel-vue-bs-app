<?php

namespace App\Http\Controllers;

use App\Item;

use Illuminate\Http\Request;
use App\Http\Resources\ItemResource;

class ItemController extends Controller
{
    public function getEquipment()
    {
        return ItemResource::collection(Item::orderBy('id', 'DESC')->where('amount', '>', 0)->paginate(10));
    }

    public function getSteady()
    {
        return ItemResource::collection(Item::orderBy('id', 'DESC')->where('amount', '>=', 5)->paginate(10));
    }

    public function getNull()
    {
        return ItemResource::collection(Item::orderBy('id', 'DESC')->where('amount', '<=', 0)->paginate(10));
    }

    public function export()
    {
        return Excel::download(new ItemExport, 'items.xlsx');
    }

    public function index()
    {
        return ItemResource::collection(Item::orderBy('id', 'DESC')->paginate(10));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'amount' => 'numeric',
        ]);

        $item = new Item;
        $item->name = $request->name;
        $item->amount = $request->amount;

        $item->save();

        return new ItemResource($item);
    }

    public function show(Item $item)
    {
        return new ItemResource($item);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'amount' => 'numeric',
        ]);

        $item = Item::findOrFail($id);
        $item->name = $request->name;
        $item->amount = $request->amount;

        $item->save();
        // $item->update($request->only(['name', 'amount']));

        return new ItemResource($item);
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return response()->json(null, 204);
    }
}
