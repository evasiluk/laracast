<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Events\QuestionWasLiked;
use Auth;


class VotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Question $question)
    {
        auth()->user()->toggleVote($question);
        broadcast(new QuestionWasLiked($question))->toOthers();

        return $question->fresh()->votes->count();
    }
}
