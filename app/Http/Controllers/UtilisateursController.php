<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
 
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UtilisateursController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $this->authorize('isAdmin', User::class);
        if ($request->has('query')) {
            $query = $request->query('query');
            $users = User::where(function($q) use($query) {
                 $q->where('name', 'LIKE', "%{$query}%")
            ->orwhere('email', 'LIKE', "%{$query}%")
              ->orwhere('phone', 'LIKE', "%{$query}%");
            })->latest()->paginate(10);
        }else{
              $users = User::latest()->paginate(10);
        }
      
        return view('admin.user', ['users' => $users]);
    }

    public function ban(User $user)
    {
         
        $this->authorize('isAdmin', User::class);
        

        if (!$user) {
            return abort(404);
        }

        $user->banned_at = now();
        $user->save();
        return redirect()->back();
    }
    public function unban(User $user)
    { 
        $this->authorize('isAdmin', User::class);
        
        if (!$user) {
            return abort(404);
        }
        $user->banned_at = null;
        $user->save();
        return redirect()->back();
    }
}
