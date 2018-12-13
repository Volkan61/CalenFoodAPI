<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Video;


class VideoController extends Controller
{
    public function postVideo(Request $request)
    {
        $video = new Video();
        $video->url = $request->input('url');
        $video->desc = $request->input('desc');
        $video->save();


        return response()->json([
            'quote' => $video
        ], 201);
    }

    public function getVideos()
    {
        $videos = Video::all();
        $response = [
            'videos' => $videos
        ];
        return response()->json($response, 200);
    }

    public function putVideo(Request $request, $id)
    {
        $video = Video::finde($id);
        if (!quote) {
            return response()->json(['message' => 'Document not found'], 404);
        }
        $video->url = $request->input('url');
        $video->desc = $request->input('desc');
        $video->save();
        return response()->json(['video' => $video], 200);
    }

    public function deleteVideo($id)
    {
        $video = Video::find($id);
        $video->delete();
        return response()->json(['message'=> 'Video deletetd'],200);
    }
}
