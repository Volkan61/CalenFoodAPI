<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Entry;

class UnitController extends Controller
{

    public function postEntry(Request $request)
    {
        $video_id = $request->input('video_id');

        $entry = new Entry();
        $entry->text = $request->input('text');
        $entry->save();

        $selectedVideo = Video::find($video_id);
        $selectedVideo->entries()->save($entry);

        return response()->json([
            'quote' => $entry
        ], 201);
    }

    public function getUnits()
    {
        $entrys = Unit::all();
        $response = [
            'units' => $entrys
        ];
        return response()->json($response, 200);
    }

    public function putEntry(Request $request, $id)
    {
        $entry = Unit::find($id);
        if (!quote) {
            return response()->json(['message' => 'Document not found'], 404);
        }
        $entry->url = $request->input('url');
        $entry->desc = $request->input('desc');
        $entry->save();
        return response()->json(['entry' => $entry], 200);
    }


    public function deleteUnit($id)
    {


        $unit = Unit::find($id);
        $unit->delete();
        return response()->json(['message'=> 'Entry deletetd'],200);
    }
}
