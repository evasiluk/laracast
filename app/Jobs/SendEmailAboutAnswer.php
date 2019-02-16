<?php

namespace App\Jobs;

use App\Question;
use App\Mail\NotifyAboutAnswer;
use App\Notifications\QuestionAnswered;
use Illuminate\Support\Facades\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmailAboutAnswer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
	public $question; 
	 
    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->question->user->email)->send(
            new NotifyAboutAnswer($this->question)
        );
        $this->question->user->notify(new QuestionAnswered($this->question));
    }
}
