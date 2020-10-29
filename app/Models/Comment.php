<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Comment extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getComments(Int $tweet_id){
        return $this->with('user')->where('tweet_id', $tweet_id)->get();
    }


    public function show(Tweet $tweet, Comment $comment){
        $user=auth()->user();
        $tweet=$tweet->getTweet($tweet->id);
        $comments=$comment->getComments($tweet->id);

        return view ('tweets.show',[
            'user' =>$user,
            'tweet' => $tweet,
            'comments' => $comments
        ]);
    }

    public function commentStore(Int $user_id, Array $data){
        $this->user_id =$user_id;
        $this->tweet_id =$data['tweet_id'];
        $this->text=$data['text'];
        $this->save();
        return ;
    }
}