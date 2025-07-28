<?php

namespace App\Http\Controllers;
 

class RulesController extends Controller
{
    public function fonctionnement()
    {
        return view('rules.fonctionnement');
    }
    public function cgu()
    {
        return view('rules.cgu');
    }
    public function confidentialite()
    {
        return view('rules.config');
    }
    public function qui()
    {
        return view('rules.qui');
    }
    public function legale()
    {
        return view('rules.legale');
    }

    public function help()
    {
        return view('rules.help');
    }
}
