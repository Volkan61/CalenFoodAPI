<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Episode;
use App\Season;
use App\Source;

use Illuminate\Support\Facades\DB;

class SourceController extends Controller
{
    public function postSource(Request $request)
    {
        $source = new Source();
        $source->name = $request->input('name');
        $source->source = $request->input('source');
        $source->save();

        $episodeid = $request->input('episodeid');
        $episode = Episode::find($episodeid);
        $episode->source()->save($source);
        return response()->json([
            'episode' => $source
        ], 201);
    }





    public function importSources(Request $request)
    {

        $sources = $request->input('sources');
        $seasonId = $request->input('seasonNo');

        $sourcesSplitted = explode(";", $sources);



        for($i=0;$i<sizeOf($sourcesSplitted); $i++) {

            $sourceAttribute = explode("::", $sourcesSplitted[$i]);

            $source = new Source();
            $source->name = $sourceAttribute[0];
            $source->source = $sourceAttribute[1];
            $source->save();

            $episodeId = $sourceAttribute[2];


            $episode = Episode::where('season_id', $seasonId)->where('episodeNo', $episodeId)->get()->first();
            //$episode= Episode::find(intval($episodeId));
            $episode->source()->save($source);


        }


        return response()->json([
            $episode
        ], 201);
    }
}
