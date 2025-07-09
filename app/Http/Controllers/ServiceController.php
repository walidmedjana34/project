<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController
{
    public function plan()
    {
        return view('service.services'); // You'll create this view in Step 3
    }
}
