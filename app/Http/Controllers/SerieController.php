<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Serie;
use App\User;

use Illuminate\Support\Facades\Auth;

class SerieController extends Controller
{
    public function postSerie(Request $request)
    {

        $user = Auth::user()->id;

        $role = User::find($user)->role()->get()[0]['role'];


        $output ="no right for posting series";

        if($role=="admin") {
        $serie = new Serie();
        $serie->name = $request->input('name');
        $serie->save();
       // $cateid = Category::find($request->input('cateid'));
       // $liste->category()->save($cateid);
         $output ="POST Serie successful";
        }

        return response()->json([
            $output
        ], 201);


    }


    public function getSeries()
    {
        $series = Serie::all();
        $response = [
            'series' => $series
        ];
        return response()->json($response, 200);
    }
}
