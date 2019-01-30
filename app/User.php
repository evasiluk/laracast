<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function questions() {
        return $this->hasMany('App\Question', 'owner');
    }

    public function IsAdmin() {
        return $this->admin == 1;
    }

    public function votes()
    {
        return $this->belongsToMany('App\Question', 'question_votes')->withTimestamps();;
    }

    public function votedFor(Question $question)
    {
        return $question->votes->contains('user_id', $this->id);
    }

    public function toggleVote(Question $question)
    {
        if($this->votedFor($question)) {
            return $this->unvoteFor($question);
        }
        $this->voteFor($question);
    }

    public function voteFor(Question $question)
    {
        $this->votes()->attach($question->id);
    }

    public function unvoteFor(Question $question)
    {
        $this->votes()->detach($question->id);
    }
}
