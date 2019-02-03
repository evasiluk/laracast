<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use Auth;


class VotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Question $question)
    {
//        auth()->user()->toggleVote($question);
//        return back();

        auth()->user()->toggleVote($question);
        return $question->fresh()->votes->count();
    }
}
