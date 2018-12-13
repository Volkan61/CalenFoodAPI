<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lists;
use App\Listen;

use Illuminate\Support\Facades\DB;

class ListController extends Controller
{
    public function postList(Request $request)
    {

       // echo "asds";
        $list = new Lists();
        $list->text = $request->input('text');
        $list->save();


        $listenid = Listen::find($request->input('listenid'));
        $listenid->listen()->save($list);


        //     $list->listen()->save($listenid);



// Primärschlüssel von liste wird in categorie eingetragen
  //      if($listid!=null) {
    //        $foundListen = Listen::find($id);
      //      $foundListen->category()->save($category);
        //}

        return response()->json([
            'quote' => $list
        ], 201);
    }


    public function getList($id)
    {
        $result =  DB::select(DB::raw('SELECT * FROM liste WHERE listen_id ='.$id));
        return response()->json($result, 200);
    }


}
