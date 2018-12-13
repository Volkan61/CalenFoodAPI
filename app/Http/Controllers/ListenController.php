<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listen;
use App\Category;

class ListenController extends Controller
{
    public function postListen(Request $request)
    {
        $liste = new Listen();
        $liste->text = $request->input('text');
        $liste->save();
        $cateid = Category::find($request->input('cateid'));
        $liste->category()->save($cateid);

        return response()->json([
            'quote' => $liste
        ], 201);
    }




}
