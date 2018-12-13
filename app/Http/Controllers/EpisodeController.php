<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Episode;
use App\Season;
use App\Source;
use App\Subtitle;

use Illuminate\Support\Facades\DB;

class EpisodeController extends Controller
{
    public function postEpisode(Request $request)
    {
        $episode = new Episode();
        $episode->name = $request->input('name');
        $episode->episodeNo = $request->input('episodeNo');
        $episode->status = $request->input('status');
        $episode->save();
        $seasonid = $request->input('season_id');
        $season= Season::find($seasonid);
        $season->episode()->save($episode);

        return response()->json([
            'episode' => $episode
        ], 201);
    }


    public function getEpisodes($serieid)
    {
        $result =  DB::select(DB::raw('SELECT * FROM episode WHERE season_id ='.$serieid));
        return response()->json(
            $result
        , 201);
    }

   /* public function getEpisodeData($episodeId)
    {
        $result =  DB::select(DB::raw('SELECT * FROM episode WHERE season_id ='.$episodeId));
        return response()->json(
            $result
            , 201);
    }
    */

    public function getEpisodeData(Request $request)
    {

        $episodeId = $request->input('episodeId');

        $episode = Episode::with('source')->with('subtitle')->where('id', $episodeId)->get();



        return response()->json($episode
            , 201);

    }















    public function deleteAllEpisodes(Request $request)
    {
        $seasonId = $request->input('season_id');
        Episode::where('season_id', $seasonId)->delete();

        return response()->json([
            'deleted'
        ], 201);
    }


    public function importEpisodes(Request $request)
    {

        $episodes = $request->input('episodes');
        $seasonNo = $request->input('seasonNo');

        $episodesSplitted = explode(";", $episodes);

        for($i=0;$i<sizeOf($episodesSplitted); $i++) {

            $episodeAttribute = explode(":", $episodesSplitted[$i]);

            $episode = new Episode();
            $episode->name = $episodeAttribute[0];
            $episode->episodeNo = $episodeAttribute[1];
            $episode->status = $episodeAttribute[2];
            $episode->audio = $episodeAttribute[3];
            $episode->subtitle = $episodeAttribute[4];

            $episode->save();

            $season= Season::find($seasonNo);
            $season->episode()->save($episode);


        }

        return response()->json([
            'deleted'
        ], 201);
    }



    public function importTitles(Request $request)
    {

        $episodes = $request->input('titles');
        $seasonNo = $request->input('seasonNo');



        $episodesSplitted = explode(";", $episodes);


        for($i=0;$i<sizeOf($episodesSplitted); $i++) {
            $episodeAttribute = explode("::", $episodesSplitted[$i]);
           //Episode::where('season_id', $seasonNo)->update(['name' => $episodeAttribute[0]]);
           DB::update(DB::raw('UPDATE episode SET title =  "'.$episodeAttribute[0].'" WHERE season_id IN ('.$seasonNo.')'.'AND episodeNo IN('.$episodeAttribute[1].')'));
        }

       // AND episodeNo IN ('.$episodeAttribute[1].')
        return response()->json([
            'deleted' => $episodeAttribute
        ], 201);
    }





}
