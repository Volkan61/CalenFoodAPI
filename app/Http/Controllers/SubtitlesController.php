<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subtitle;
use App\Episode;

class SubtitlesController extends Controller
{




    public function importSubtitles(Request $request)
    {

        $subtitles = $request->input('subtitles');
        $seasonNo = $request->input('seasonNo');

        $subtitlesSplitted = explode(";", $subtitles);

        for($i=0;$i<sizeOf($subtitlesSplitted); $i++) {

            $episodeAttribute = explode("::", $subtitlesSplitted[$i]);

            $subtitle = new Subtitle();
            $subtitle->lang = $episodeAttribute[0];
            $subtitle->label = $episodeAttribute[1];
            $subtitle->source = $episodeAttribute[2];

            $defaultBoolean = $episodeAttribute[3] === "true"? true: false;

            $subtitle->default = $defaultBoolean;
            $subtitle->save();

            $episodeId = $episodeAttribute[4];


            $episode = Episode::where('season_id', $seasonNo)->where('episodeNo', $episodeId)->get()->first();
            $episode->subtitle()->save($subtitle);

        }

        return response()->json([
            'deleted'
        ], 201);
    }
}
