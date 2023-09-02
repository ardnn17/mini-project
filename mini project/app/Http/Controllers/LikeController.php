<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Psy\Command\WhereamiCommand;



class LikeController extends Controller
{

    public function likePost($id)
    {
        $userId = auth()->user()->id;

        $postId = $id;

        $like = Like::where('user_id',$userId)
                    ->where('post_id',$postId)
                    ->first();

        if ($like) {
            // jika user sudah melakukan like maka hapus
            $like->delete();

            return response()->json(['Message'=>'unlike successfully']);

        } else {

            //jika user belum melakukan like maka like
            $like = new Like();
            $like -> post_id = $postId;
            $like -> user_id = $userId;
            $like ->save();

            return response()->json(['message'=>'post liked']);
        }
    }

}
