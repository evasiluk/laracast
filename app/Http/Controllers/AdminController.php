<?php

namespace App\Http\Controllers;

use App\Mail\NotifyAboutAnswer;
use App\Notifications\QuestionAnswered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Question;
use App\Rubric;
use App\Settings;
use App\Jobs\SendEmailAboutAnswer;

class AdminController extends Controller
{

    public function __construct() {
        $this->middleware("auth");
        $this->middleware('is_admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::paginate(10);
        $settings = Settings::first();
        
        return view("questions.admin", compact("questions", "settings"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $rubrics = Rubric::all();

        return view("questions.admin-edit", compact("question", "rubrics"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question)
    {
        request()->validate([
            "question" => "required|min:10",
            "answer" => "required_if:publish,on",
        ]);

        $send_notify = false;

        $question->question = request('question');
        $question->answer = request('answer');
        $question->publish = (request('publish') != null)? true : false;
        $question->rubric_id = request("rubric");

        if((request('publish') != null && $question->owner_notified == 0)) {
            $question->owner_notified = $send_notify = true;
        }

        $question->save();

        if($send_notify) {
			$this->notifyUser($question);
        }

        return redirect(action("AdminController@edit", $question->id))->with("status", "Изменения сохранены");
    }

    public function notifyUser(Question $question) {
        SendEmailAboutAnswer::dispatch($question);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
