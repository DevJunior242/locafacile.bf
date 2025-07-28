<?php

namespace App\Http\Controllers;
 
use Illuminate\Support\Facades\Auth;

class NotifController extends Controller
{
    //

    public function markAsread($id)
    {
        $notif = Auth::user()->unreadNotifications->find($id);
        if (!$notif) {
            abort(404);
        }
        $notif->delete();
        return redirect()->back();
    }
}
