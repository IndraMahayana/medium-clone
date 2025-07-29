<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Post;

class ClapController extends Controller
{
    public function clap(Post $post)
    {

        $user = \Illuminate\Support\Facades\Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $hasClapped = $user->hasClapped($post);

        if($hasClapped) {
            $post->claps()->where('user_id', $user->id)->delete();
        } else {
            $post->claps()->create([
                'user_id' => $user->id,
            ]);
        }
        
        return response()->json([
            'clapsCount' => $post->claps()->count(),
        ]);
    }
}
