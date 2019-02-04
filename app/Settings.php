<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = "settings";

    protected $fillable = ["daily_questions_limit", "personal_limit"];
}
