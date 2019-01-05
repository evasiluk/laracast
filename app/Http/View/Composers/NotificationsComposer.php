<?php
namespace App\Http\View\Composers;
use Illuminate\View\View;
use App\User;

class NotificationsComposer {
    public function compose(View $view) {
        if(auth()->check()) {
            $view->with('notify_qnt', auth()->user()->notifications->count());
        }
        return true;
    }
}