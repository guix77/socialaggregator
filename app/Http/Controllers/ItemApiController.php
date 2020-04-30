<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Item::all()->sortByDesc('published_at')->values();
    }
}
