<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Item::all()->sortByDesc('published_at')->values();
        return Item::Where('status', config('constants.status.published'))->get()->sortByDesc('published_at')->values();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'status' => ['required', 'numeric', 'max:' . count(config('constants.status'))],
        ]);
        $item->status = $request->status;
        $item->save();
        return redirect()->route('home')->with('success', __('Item updated!'));
    }
}
