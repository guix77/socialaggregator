<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemApiController extends Controller
{
    public function index()
    {
        return Item::all()->sortByDesc('published_at')->values();
    }
}
