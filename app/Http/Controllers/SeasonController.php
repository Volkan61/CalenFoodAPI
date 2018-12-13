<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Episode;
use App\Serie;
use App\Season;

use Illuminate\Support\Facades\DB;

class SeasonController extends Controller
{
    public function postSeason(Request $request)
    {
        $season = new Season();
        $season->name = $request->input('name');
        $season->seasonNo = $request->input('seasonNo');

        $season->save();

        $serieid = $request->input('serieid');
        $serie = Serie::find($serieid);
        $serie->season()->save($season);

        return response()->json([
            'episode' => $season
        ], 201);
    }


    public function getSeasons($serieid)
    {
        $seasons = Season::where('serie_id', $serieid)->get();



        for($i=0;$i < sizeof($seasons); $i++) {
            $seasonid = $seasons[$i]['id'];
            $episodes = Episode::where('season_id', $seasonid)->get();
            $seasons[$i]->episodes = $episodes;
        }

//        $result =  DB::select(DB::raw('SELECT * FROM season,serie WHERE season.serie_id = serie.id AND serie_id ='.$serieid));


        $response = [
            'seasons' => $seasons
        ];

        return response()->json($response
        , 201);

    }

}
