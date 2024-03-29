<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\TopicReplied;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{

    public function creating(Reply $reply){
        $reply->content = clean($reply->content,'user_topic_body');
    }


    public function created(Reply $reply)
    {
        $reply->topic->reply_count =$reply->topic->replies->count();
        $reply->topic->save();

        //通知话题作者有新的评论
        $reply->topic->user->notify(new TopicReplied($reply));
//        return $reply->topic->increment('reply_count',1);
    }

    public  function delected(Reply $reply){
        $reply->topic->updateReplyCount();
    }
}
