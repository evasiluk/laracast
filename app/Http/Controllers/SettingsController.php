<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Settings;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }

    public function update()
    {
        $new_values = request()->validate([
            "daily_questions_limit" => "required|integer",
            "personal_limit" => "required|integer"
        ]);

        $settings = Settings::first();
        $settings->update($new_values);

        return back();
    }
}
