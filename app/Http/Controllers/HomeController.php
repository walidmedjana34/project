<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController 
{
    public function home()
    {
        return redirect('/Accueil'); // ✅ Direct URL path
    }
}
