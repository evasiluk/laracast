<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Rubric;
use App\User;
use App\Settings;
use Carbon\Carbon;

class QuestionsController extends Controller
{
    public $onPage = 5;

    public function __construct() {
        $this->middleware("auth")->only(["create", "store", "personal"]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rubrics = Rubric::all();
        $current_rubric = request('rubric') ? intval(request('rubric')) : "";

        if($current_rubric) {
            $questions = Question::where("publish", "=", "1")->where("rubric_id", "=", $current_rubric)->paginate($this->onPage);
        } else {
            $questions = Question::where('publish', '=', '1')->paginate($this->onPage);
        }

        return view('questions.index', compact('questions', 'rubrics', 'current_rubric'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $limits_status = $this->checkAskAvailability();
        $rubrics = Rubric::all();

        return view("questions.create", compact('rubrics', 'limits_status'));

    }

    private function checkAskAvailability()
    {
        $status = [];

        $global_daily_limit = $this->getGlobalLimit();
        $today_global_questions_count = $this->getTodayGlobalQuestionsCount();

        if($today_global_questions_count >= $global_daily_limit) {
            $status["global_limit_reached"] = true;
        }

        $personal_daily_limit = $this->getPersonalLimit();
        $today_user_questions_count = $this->getTodayUserQuestionsCount();

        if($today_user_questions_count >= $personal_daily_limit) {
            $status["personal_limit_reached"] = true;
        }

        return $status;
    }

    protected function getSettings()
    {
        return Settings::first();
    }

    protected function getGlobalLimit()
    {
        $settings = $this->getSettings();
        return $settings->daily_questions_limit;
    }

    protected function getPersonalLimit()
    {
        $settings = $this->getSettings();
        return $settings->personal_limit;
    }

    protected function getTodayGlobalQuestionsCount()
    {
        return Question::whereDate('created_at', Carbon::today())->count();
    }

    protected function getTodayUserQuestionsCount()
    {
        return Question::whereDate('created_at', Carbon::today())->where('owner', auth()->id())->count();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = request()->validate([
           "rubric_id" => "required|integer",
           "question" => "required|min:10|max:1000"
        ]);

        $data["owner"] = auth()->id();

        Question::create($data);

        return redirect("/ask")->with("status", "Ваш вопрос отправлен");
    }

    public function personal() {

        $questions = Question::where("publish", "=", "1")->where("owner", "=", auth()->id())->paginate($this->onPage);
        return view("questions.personal", compact('questions'));
    }

}
