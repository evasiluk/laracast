<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ["rubric_id", "question", "answer", "owner", "publish", "owner_notified"];

    public function user()
    {
        return $this->belongsTo('App\User', 'owner');
    }

    public function rubric() {
        return $this->belongsTo('App\Rubric');
    }

    public function votes()
    {
        return $this->hasMany('App\QuestionVote');
    }
}
