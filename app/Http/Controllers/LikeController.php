<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function likeNews(Request $request, News $news)
    {
        if (!$request->session()->has('device_id')) {
            $deviceId = Str::uuid()->toString();
            $request->session()->put('device_id', $deviceId);
        } else {
            $deviceId = $request->session()->get('device_id');
        }

        $like = Like::where('device_id', $deviceId)->where('news_id', $news->id)->first();

        if ($like) {
            $like->delete();
            $hasLiked = false;
        } else {
            Like::create([
                'device_id' => $deviceId,
                'news_id' => $news->id,
            ]);
            $hasLiked = true;
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'likes' => $news->likes()->count(),
                'has_liked' => $hasLiked,
            ]);
        }

        return back();
    }
}
