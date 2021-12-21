<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index($id)
    {
        $ip = Post::ipUser();

        $likeIp = Like::where('post_id', $id)->get();

        $data = [
            'post_id' => $id,
            'user_ip' => $ip,
        ];
        if($likeIp->contains('user_ip', $ip)){
            foreach ($likeIp as $item){
                if($item->user_ip == $ip ){
                    $item->delete();
                }
            }
        }else{
            Like::create($data);
        }

        return redirect()->back();
    }
}
