<?php

namespace App\Http\Controllers;

use App\City;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class LeadController extends Controller
{
    public function show()
    {
        return view('create-lead');
    }
}
